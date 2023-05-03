<?php

namespace App\Repositories;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\Storage;

use Maatwebsite\Excel\Facades\Excel;
use Spatie\Activitylog\Facades\LogBatch;

use App\Jobs\DeltaValidation;

use App\Models\Invoice as Model;
use App\Mail\Invoice as ModelMail;
use App\Imports\DataImport;
use App\Helpers\Relationship;
use App\Exports\Invoice\Sample as SampleTemplate;
use App\Jobs\InvoiceValidation;
use App\Models\Approval;
use App\Models\Area;
use App\Models\Currency;
use App\Models\Department;
use App\Models\Expense;
use App\Models\Interco;
use App\Models\InvoiceType;
use App\Models\Oracle\Invoice as OracleInvoice;
use App\Models\Oracle\InvoiceItem;
use App\Models\Product;
use App\Models\SalesChannel;
use App\Models\Sbu;
use App\Models\Tax;
use App\Models\Term;
use App\Models\Vendor;
use App\Models\VendorSite;
use App\Models\Withholding;
use App\Models\Workflow;
use App\Models\WorkflowItem;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Carbon\Carbon;

class Invoice
{
    private Model $model;

    static  $uploadPath = 'invoices';

    /**
     * Initialize the repository from model.
     *
     * @param Model $model
     * @return Invoice
     */
    public static function init(Model $model): Invoice
    {
        $instance = new self;
        $instance->model = $model;

        return $instance;
    }

    /**
     * Display all of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Model
     */
    public static function all(Request $request)
    {
        $query = Model::ordering($request)
            ->filtering($request)
            ->searching($request, ['code', 'invoice_number'])
            ->with(['createdUser:id,name', 'updatedUser:id,name', 'vendor:id,code,name'])
            ->latest();

        return $query->paginate($request->per_page ?? 10)->withQueryString()
            ->through(function ($item) {
                return [
                    'id'                                => $item->id,
                    'code'                              => $item->code,
                    'vendor'                            => $item->vendor,
                    'document_status'                   => $item->document_status,
                    'approval_status'                   => $item->approval_status,
                    'total_amount'                      => $item->total_amount,
                    'total_amount_valid'                => $item->total_amount_valid,
                    'total_amount_invalid'              => $item->total_amount_invalid,
                    'total_amount_after_tax'            => $item->total_amount_after_tax,
                    'total_amount_after_tax_valid'      => $item->total_amount_after_tax_valid,
                    'total_amount_after_tax_invalid'    => $item->total_amount_after_tax_invalid,
                    'invoice_number'                    => $item->invoice_number,
                    'invoice_date'                      => $item->invoice_date,
                    'invoice_receipt_date'              => $item->invoice_receipt_date,
                    'items'                             => $item->items->count(),
                    'validated_items'                   => $item->items()->where('is_validated', true)->count(),
                    'description'                       => $item->description,
                    'created_user'                      => $item->createdUser,
                    'updated_user'                      => $item->updatedUser,
                    'created_at'                        => $item->created_at,
                    'updated_at'                        => $item->updated_at,
                    'deleted_at'                        => $item->deleted_at,
                ];
            });
    }

    /**
     * Display all of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Model
     */
    public static function report(Request $request)
    {
        $query = Model::ordering($request)
            ->filtering($request)
            ->searching($request, ['code', 'invoice_number'])
            ->with(['createdUser:id,name', 'updatedUser:id,name'])
            ->where('document_status', '!=', Model::DOCUMENT_STATUS_DRAFT)
            ->latest();

        return $query->paginate($request->per_page ?? 10)->withQueryString()
            ->through(function ($item) {
                return [
                    'id'                                => $item->id,
                    'code'                              => $item->code,
                    'vendor'                            => $item->vendor,
                    'document_status'                   => $item->document_status,
                    'approval_status'                   => $item->approval_status,
                    'total_amount'                      => $item->total_amount,
                    'total_amount_valid'                => $item->total_amount_valid,
                    'total_amount_invalid'              => $item->total_amount_invalid,
                    'total_amount_after_tax'            => $item->total_amount_after_tax,
                    'total_amount_after_tax_valid'      => $item->total_amount_after_tax_valid,
                    'total_amount_after_tax_invalid'    => $item->total_amount_after_tax_invalid,
                    'invoice_number'                    => $item->invoice_number,
                    'invoice_date'                      => $item->invoice_date,
                    'invoice_receipt_date'              => $item->invoice_receipt_date,
                    'description'                       => $item->description,
                    'created_user'                      => $item->createdUser,
                    'updated_user'                      => $item->updatedUser,
                    'created_at'                        => $item->created_at,
                    'updated_at'                        => $item->updated_at,
                    'deleted_at'                        => $item->deleted_at,
                ];
            });
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Model
     */
    public static function save($request): Model
    {
        $transaction = DB::transaction(function () use ($request) {
            return LogBatch::withinBatch(function (string $uuid) use ($request) {
                if ($request->items) {
                    $items = array_map(function ($item, $index) use ($uuid, $request) {
                        return array_merge($item, [
                            'uuid'                      => $uuid,
                            'sequence_number'           => $index + 1,
                        ]);
                    }, $request->items, array_keys($request->items));
                }
                $request->merge([
                    'uuid'                          => $uuid,
                    'approval_status'               => Model::APPROVAL_STATUS_NONE,
                    'approval_status_time'          => null,
                    'document_status_time'          => null,
                    'published_at'                  => null,
                ]);

                $model = Model::updateOrCreate([
                    'code' => $request->code
                ], $request->except(['items', 'uploads']));

                /**
                 * Document Item
                 */
                self::saveDocumentItem($model, $items ?? []);

                if ($request->uploads) {
                    foreach ($request->uploads as $upload) {
                        $rows = Excel::toCollection(new DataImport, $upload['excel_file'])
                            ->first()
                            ->map(function ($item, $index) use ($upload, $uuid) {
                                $date_item = null;
                                if (isset($item['date_item'])) {
                                    $date_item = Carbon::instance(Date::excelToDateTimeObject($item['date_item']));
                                }
                                return [
                                    ...$item,
                                    'uuid'              => $uuid,
                                    'sequence_number'   => $index + 1,
                                    'date_item'         => $date_item,
                                    'expense_id'        => (int) $upload['expense_id'],
                                    'type'              => $upload['type']
                                ];
                            })
                            ->toArray();
                        $model->items()->createMany($rows);
                    }
                }

                /**
                 * Document Attachment
                 */
                if ($request->id) {
                    self::deleteDocumentAttachment($model, $request);
                    self::saveDocumentAttachment($model, $request, true);
                } else {
                    self::saveDocumentAttachment($model, $request);
                }

                foreach ($model->items as $item) {
                    DeltaValidation::dispatch($item);
                }
                InvoiceValidation::dispatch($model);
                return $model;
            });
        });

        return $transaction;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Model
     */
    public static function store($request): Model
    {
        $transaction = DB::transaction(function () use ($request) {
            return LogBatch::withinBatch(function (string $uuid) use ($request) {
                if ($request->items) {
                    $items = array_map(function ($item, $index) use ($uuid, $request) {
                        return array_merge($item, [
                            'uuid'                      => $uuid,
                            'sequence_number'           => $index + 1,
                        ]);
                    }, $request->items, array_keys($request->items));
                }
                $request->merge([
                    'uuid'                          => $uuid,
                    'document_status'               => Model::DOCUMENT_STATUS_PUBLISHED,
                    'approval_status'               => Model::APPROVAL_STATUS_PENDING,
                    'approval_status_time'          => null,
                    'document_status_time'          => now(),
                    'published_at'                  => now(),
                ]);

                $model = new Model($request->except('items'));
                $model->saveOrFail();

                /**
                 * Document Item
                 */
                self::saveDocumentItem($model, $items ?? []);

                /**
                 * Document Attachment
                 */
                self::saveDocumentAttachment($model, $request);

                /**
                 * Document Aproval
                 */
                self::saveDocumentApproval($model, $request);

                foreach ($model->items as $item) {
                    DeltaValidation::dispatch($item);
                }
                InvoiceValidation::dispatch($model);

                return $model;
            });
        });

        return $transaction;
    }

    /**
     * Import to storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Model
     */
    public static function import($request): void
    {
        $rows = Excel::toCollection(new DataImport, $request->file('excel_file'))
            ->first()
            ->toArray();
        DB::transaction(function () use ($rows) {
            foreach ($rows as $row) {
                Model::updateOrCreate(
                    ['code' => $row['code']],
                    $row
                );
            }
        });
    }

    /**
     * Import to storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Model
     */
    public static function importSample($expense)
    {
        $date = now()->format('d-m-Y H:i:s');
        $name = str((new \ReflectionClass(__CLASS__))->getShortName())->kebab();
        return Excel::download(new SampleTemplate($expense), "{$name}-{$expense}-line-import-sample-{$date}.xlsx");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return Model
     */
    public function update($request): Model
    {
        $transaction = DB::transaction(function () use ($request) {
            return LogBatch::withinBatch(function (string $uuid) use ($request) {
                if ($request->items) {
                    $items = array_map(function ($item, $index) use ($uuid, $request) {
                        return array_merge($item, [
                            'uuid'                      => $uuid,
                            'sequence_number'           => $index + 1,
                        ]);
                    }, $request->items, array_keys($request->items));
                }
                $request->merge([
                    'uuid'                          => $uuid,
                    'document_status'               => Model::DOCUMENT_STATUS_PUBLISHED,
                    'approval_status'               => Model::APPROVAL_STATUS_PENDING,
                    'approval_status_time'          => null,
                    'document_status_time'          => now(),
                    'published_at'                  => now(),
                ]);

                $this->model->fill($request->except('items'));
                $this->model->updateOrFail();

                /**
                 * Document Item
                 */
                self::saveDocumentItem($this->model, $items ?? []);

                /**
                 * Document Attachment
                 */
                self::deleteDocumentAttachment($this->model, $request);
                self::saveDocumentAttachment($this->model, $request, true);

                /**
                 * Document Aproval
                 */
                self::saveDocumentApproval($this->model, $request);

                foreach ($this->model->items as $item) {
                    DeltaValidation::dispatch($item);
                }
                InvoiceValidation::dispatch($this->model);

                return $this->model;
            });
        });

        return $transaction;
    }

    /**
     * Display the specified resource.
     *
     * @return Model
     */
    public function show(): Model
    {
        $model = $this->model->load([
            'createdUser:id,name',
            'updatedUser:id,name',
            'department:id,name',
            'attachments',
            'items' => function ($query) {
                $query->with(['withholding', 'tax', 'area', 'product', 'salesChannel', 'costCenter']);
            },
        ]);
        $model->uploads = [];
        return $model;
    }

    /**
     * Display the specified resource.
     *
     * @return Model
     */
    public function approval(): Model
    {
        $model = $this->model->load([
            'createdUser:id,name',
            'updatedUser:id,name',
            'department:id,name',
            'approvals.user',
        ]);
        return $model;
    }

    /**
     * Display the specified resource.
     *
     * @return Model
     */
    public static function smuPreview($code)
    {
        return Delta::smu($code);
    }

    /**
     * Delete the specified resource from storage.
     *
     * @return bool|null
     */
    public function delete(): bool
    {
        return $this->model->deleteOrFail();
    }

    /**
     * Force Delete the specified resource from storage.
     *
     * @return bool|null
     */
    public function forceDelete(): bool
    {
        return $this->model->forceDelete();
    }

    /**
     * Restore the specified resource from storage.
     *
     * @return bool|null
     */
    public function restore(): bool
    {
        return $this->model->restore();
    }

    /**
     * Data reference resource for this resource.
     *
     * @return array|null
     */
    public static function reference(): array
    {
        return [
            /** Header */
            'sbus' => Sbu::pluck('name', 'id'),
            'invoice_types' => InvoiceType::pluck('name', 'id'),
            'currencies' => Currency::pluck('name', 'id'),
            'intercos' => Interco::pluck('name', 'id'),
            'vendors' => Vendor::pluck('name', 'id'),
            'vendor_sites' => VendorSite::all()->map(function ($item) {
                return [
                    'value' => $item->id,
                    'label' => $item->name,
                    'vendor_id' => $item->vendor_id,
                ];
            }),
            'terms' => Term::all()->map(function ($item) {
                return [
                    'value' => $item->id,
                    'label' => $item->name,
                    'day' => $item->day,
                ];
            }),
            /** Item */
            'expenses' => Expense::select('id', 'icon', 'code', 'name', 'type')->get()->append('type_text'),
            'products' => Product::select('id', 'name')->get(),
            'areas' => Area::select('id', 'name')->get(),
            'departments' => Department::select('id', 'name')->get(),
            'taxes' => Tax::select('id', 'name')->get(),
            'withholdings' => Withholding::select('id', 'name')->get(),
            'sales_channels' => SalesChannel::select('id', 'name')->get(),
        ];
    }

    /**
     * Add new attachments
     */
    public static function saveDocumentApproval(Model $model, $request)
    {
        $workflows = WorkflowItem::query()
            ->whereRelation('workflow', 'department_id', $model->department_id)
            ->whereBetween('range_from', [0, $model->total_amount])
            ->orWhereBetween('range_to', [0, $model->total_amount])
            ->orderBy('sequence')
            ->get();
        foreach ($workflows as $index => $item) {
            $position = null;
            if ($workflows->first()->id === $item->id) {
                $position = 'first';
            }
            if ($workflows->last()->id === $item->id) {
                $position = 'last';
            }
            Approval::create([
                'user_id' => $item->user_id,
                'workflow_id' => $item->workflow_id,
                'sequence' => $item->sequence,
                'workflow_item_id' => $item->id,
                'invoice_id' => $model->id,
                'status' => 'waiting approval',
                'status' => $item->description,
                'current' => $index == 0,
                'position' => $position,
            ]);
            if ($index == 0) {
                Mail::to(auth()->user()->email)->send(new ModelMail($model, auth()->user()->email, 'created'));
                Mail::to($item->user->email)->send(new ModelMail($model, $item->user, 'approval'));
            }
        }

        // $staging_id = Oracle::latestIdTable('APPS.RAPSYS_AP_STG_HEADER', 'staging_id');
        // Oracle::insertTable('APPS.RAPSYS_AP_STG_HEADER', [
        //     'staging_id' => $staging_id,
        //     'ledger_id' => 2024,
        //     'org_id' => 103,
        //     'vendor_id' => $model->vendor_id,
        //     'vendor_site_id' => $model->vendor_site_id,
        //     'trx_number' => $model->invoice_number,
        //     'currency_code' => $model->currency->code,
        //     'description' => $model->note,
        //     'amount' => $model->total_amount,
        //     'ap_invoice_date' => date('d-M-Y', strtotime($model->invoice_date)),
        //     'ap_invoice_received_date' => date('d-M-Y', strtotime($model->invoice_receipt_date)),
        //     'ap_gl_date' => date('d-M-Y', strtotime($model->posting_date)),
        //     'supplier_tax_invoice_date' => date('d-M-Y', strtotime($model->supplier_tax_invoice_date)),
        //     'supplier_tax_invoice_number' => $model->supplier_tax_invoice,
        //     'ap_source' => 'RAPSYS',
        //     'terms_id' => $model->term->code,
        //     'invoice_type_lookup_code' => strtoupper($model->invoiceType->name),
        //     'payment_method_lookup_code' => 'CHECK',
        //     'status' => 'I',
        // ]);

        // $key = 1;
        // $model->items->groupBy('dist')->each(function ($group) use ($staging_id, &$key) {
        //     $item = $group->first();
        //     $awb = null;
        //     if ($item->type == 'SMU') {
        //         $smu = Delta::smu($item->code);
        //         $awb = count($smu['data']['airwaybill']) . ' AWB';
        //     }
        //     $description = implode(' | ', array_filter([
        //         $item->expense->code,
        //         $group->count() . ' ' . $item->type,
        //         $awb,
        //         $item->area->code
        //     ]));
        //     $amount = $group->sum('amount');
        //     Oracle::insertTable('APPS.RAPSYS_AP_STG_LINE', [
        //         'staging_id' => $staging_id,
        //         'staging_line_id' => Oracle::latestIdTable('APPS.RAPSYS_AP_STG_LINE', 'staging_line_id'),
        //         'ledger_id' => 2024,
        //         'org_id' => 103,
        //         'line_number' => $key,
        //         'description' => $description,
        //         'line_type_code' => 'ITEM',
        //         'ppn_code' => null,
        //         'tax_rate_id' => null,
        //         'awt_group_id' => $item->withholding->code,
        //         'amount' => $amount,
        //         'dist_code_concat' => $item->dist,
        //     ]);
        //     $key++;
        //     if ($item->tax) {
        //         Oracle::insertTable('APPS.RAPSYS_AP_STG_LINE', [
        //             'staging_id' => $staging_id,
        //             'staging_line_id' => Oracle::latestIdTable('APPS.RAPSYS_AP_STG_LINE', 'staging_line_id'),
        //             'ledger_id' => 2024,
        //             'org_id' => 103,
        //             'line_number' => $key,
        //             'description' => $description,
        //             'line_type_code' => 'TAX',
        //             'ppn_code' => $item->tax->name,
        //             'tax_rate_id' => $item->tax->code,
        //             'amount' => $amount,
        //         ]);
        //         $key++;
        //     }
        // });

        // begin
        //     fnd_request.submit_request(
        //         'RPX Customization Application', -- application short name
        //         'RPX - AP INSERT RAPSYS', -- concurrent program short name
        //         'FEB-23', -- parameter string
        //         null, -- description
        //         null, -- start time
        //         null, -- subrequest flag
        //         null -- run alone flag
        //     );
        // end;

    }

    /**
     * Save items
     */
    public static function saveDocumentItem(Model $model, $items)
    {
        if (!empty($items)) {
            Relationship::proccesRelationWithRequest(
                $model->items(),
                $items
            );
        }
    }

    /**
     * Add new attachments
     */
    public static function saveDocumentAttachment(Model $model, $request, $onUpdate = false)
    {
        $attachments = [];
        $items = 'attachments';
        $has_attachments = $onUpdate ? $request->hasFile($items) : $request->attachments;
        if ($has_attachments) {
            foreach ($request->file($items) as $attachment) {
                $attachments[] = self::uploadFile($attachment);
            }
        }
        $model->attachments()->createMany($attachments);
    }

    /**
     * Delete attachments
     */
    public static function deleteDocumentAttachment(Model $model, $request)
    {
        $requestAttachments = $request->attachments ? array_column($request->attachments, 'id') : [];
        $deletedAttachments = $model->attachments->whereNotIn('id', $requestAttachments);
        foreach ($deletedAttachments as $item) {
            self::deleteFile($item);
            $item->delete();
        }
    }

    /**
     * Upload File
     */
    public static function uploadFile($file)
    {
        $path           = 'public/' . self::$uploadPath;
        $url            = 'storage/' . self::$uploadPath;
        $timestamp      = now()->format('YmdHs');
        $extension      = $file->getClientOriginalExtension();
        $type           = $file->getClientMimeType();
        $size           = $file->getSize();
        $nameOriginal   = $file->getClientOriginalName();
        $nameUpload     = $timestamp . '_' . str($nameOriginal)->slug() . '.' . $extension;

        $file->storeAs($path, $nameUpload);

        return [
            'name'      => $nameOriginal,
            'storage'   => $nameUpload,
            'path'      => $path,
            'url'       => $url,
            'size'      => $size,
            'type'      => $type,
            'extension' => $extension,
        ];
    }

    /**
     * Delete File
     */
    public static function deleteFile($file)
    {
        $path = 'public/' . self::$uploadPath;
        Storage::delete($path . '/' . $file->storage);
    }
}
