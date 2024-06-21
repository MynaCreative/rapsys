<?php

namespace App\Repositories;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

use Maatwebsite\Excel\Facades\Excel;
use Spatie\Activitylog\Facades\LogBatch;

use App\Jobs\DeltaValidation;

use App\Models\Invoice as Model;
use App\Mail\Invoice as ModelMail;
use App\Imports\DataImport;
use App\Helpers\Relationship;
use App\Exports\Invoice\Sample as SampleTemplate;
use App\Exports\Invoice\Header as HeaderReport;
use App\Exports\Invoice\Revision as RevisionTemplate;
use App\Exports\Invoice\RevisionAll as RevisionTemplateAll;
use App\Jobs\ExpenseValidation;
use App\Jobs\InvoiceValidation;
use App\Models\Approval;
use App\Models\Area;
use App\Models\CostCenter;
use App\Models\Currency;
use App\Models\Department;
use App\Models\Expense;
use App\Models\Interco;
use App\Models\InvoiceAwb;
use App\Models\InvoiceCons;
use App\Models\InvoiceExpense;
use App\Models\InvoiceSmu;
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
use Illuminate\Bus\Batch;
use Illuminate\Support\Facades\Bus;
use Throwable;

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
                $items = 0;
                $validated_items = 0;
                if ($item->job_batch) {
                    $batch = Bus::findBatch($item->job_batch);
                    if ($batch) {
                        $items = $batch->totalJobs;
                        $validated_items = $batch->totalJobs - $batch->pendingJobs;
                    }
                }
                // $items = $item->smuItems->count() + $item->awbItems()->where('invoice_smu_id', null)->count();
                // $validated_items = $item->smuItems()->where('is_validated', true)->count() + $item->awbItems()->where('is_validated', true)->where('invoice_smu_id', null)->count();
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
                    'items'                             => $items,
                    'validated_items'                   => $validated_items,
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
            ->with(['createdUser:id,name', 'updatedUser:id,name', 'expense'])
            // ->where('document_status', '!=', Model::DOCUMENT_STATUS_DRAFT)
            ->latest();

        return $query->paginate($request->per_page ?? 10)->withQueryString()
            ->through(function ($item) {
                return [
                    'id'                                => $item->id,
                    'code'                              => $item->code,
                    'vendor'                            => $item->vendor,
                    'document_status'                   => $item->document_status,
                    'approval_status'                   => $item->approval_status,
                    'department'                        => $item->department,
                    'vendor_site'                       => $item->vendorSite,
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
                    'expense'                           => $item->expense,
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
    public static function statistic(Request $request)
    {
        return [
            'all' => Model::count(),
            'pending' => Model::where('approval_status', 'pending')->count(),
            'approved' => Model::where('approval_status', 'approved')->count(),
            'rejected' => Model::where('approval_status', 'rejected')->count(),
        ];
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

                if ($request->expenses) {
                    if ($request->id == null) {
                        foreach ($request->expenses as $upload) {
                            $expense = $model->expenses()->create([
                                'expense_id' => $upload['expense_id'],
                                'cost_center_id' => $upload['cost_center_id'] ?? null,
                                'withholding_id' => $upload['withholding_id']  ?? null,
                                'tax_id' => $upload['tax_id']  ?? null,
                                'type' => $upload['type']  ?? null
                            ]);
                            if (isset($upload['excel_file'])) {
                                $rows = Excel::toCollection(new DataImport, $upload['excel_file'])
                                    ->first()
                                    ->map(function ($item, $index) use ($upload, $uuid, $expense) {
                                        $date_item = null;
                                        if (isset($item['date_item'])) {
                                            $date_item = Carbon::instance(Date::excelToDateTimeObject($item['date_item']));
                                        }
                                        return [
                                            ...$item,
                                            'uuid'                  => $uuid,
                                            'sequence_number'       => $index + 1,
                                            'date_item'             => $date_item,
                                            'invoice_expense_id'    => $expense->id,
                                            'expense_id'            => $upload['expense_id'],
                                            'cost_center_id'        => $upload['cost_center_id'] ?? null,
                                            'withholding_id'        => $upload['withholding_id']  ?? null,
                                            'tax_id'                => $upload['tax_id']  ?? null,
                                            'type'                  => $upload['type']  ?? null,
                                            'is_validated'          => 0,
                                        ];
                                    })
                                    ->toArray();
                                switch ($upload['type']) {
                                    case Expense::TYPE_AWB:
                                        $model->awbItems()->createMany($rows);
                                        break;
                                    case Expense::TYPE_SMU:
                                        $model->smuItems()->createMany($rows);
                                        break;
                                    case Expense::TYPE_CONS:
                                        $model->consItems()->createMany($rows);
                                        break;
                                }
                            }
                        }
                    } else {
                        foreach ($request->expenses as $upload) {
                            $expense = $model->expenses()->where('id', $upload['id'])->first();
                            $expense->update([
                                'cost_center_id' => $upload['cost_center_id'] ?? null,
                                'withholding_id' => $upload['withholding_id']  ?? null,
                                'tax_id' => $upload['tax_id']  ?? null,
                            ]);
                            if (isset($upload['excel_file'])) {
                                $rows = Excel::toCollection(new DataImport, $upload['excel_file'])
                                    ->first()
                                    ->map(function ($item) use ($upload) {
                                        return [
                                            ...$item,
                                            'cost_center_id'    => $upload['cost_center_id'] ?? null,
                                            'withholding_id'    => $upload['withholding_id']  ?? null,
                                            'tax_id'            => $upload['tax_id']  ?? null,
                                            'is_validated'      => 0,
                                        ];
                                    })
                                    ->toArray();
                                switch ($upload['type']) {
                                    case Expense::TYPE_AWB:
                                        self::saveAwbItem($model, $rows ?? []);
                                        break;
                                    case Expense::TYPE_SMU:
                                        self::saveSmuItem($model, $rows ?? []);
                                        break;
                                    case Expense::TYPE_CONS:
                                        self::saveConsItem($model, $rows ?? []);
                                        break;
                                }
                            }
                        }
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
        $rows = Excel::toCollection(new DataImport, $request->file('excel_file'))->first()->toArray();
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
     * Export to storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Model
     */
    public static function invoiceHeaderExport($request)
    {
        $date = now()->format('d-m-Y H:i:s');
        $name = str((new \ReflectionClass(__CLASS__))->getShortName())->kebab();
        return Excel::download(new HeaderReport($request), "{$name}-header-{$date}.xlsx");
    }

    /**
     * Revision to storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Model
     */
    public function revision($expense_id)
    {
        $date = now()->format('d-m-Y H:i:s');
        $name = str((new \ReflectionClass(__CLASS__))->getShortName())->kebab();
        $expense = $this->model->expenses()->where('id', $expense_id)->first();
        $items = [];
        $awbs = [];
        $smus = [];
        if ($expense->type == InvoiceExpense::TYPE_AWB) {
            $awbs = $expense->awbItems()
                ->when(!request()->get('all'), function ($query) {
                    $query->where('validation_score', '!=', 5);
                })
                ->get();
            $items = $awbs;
        }
        if ($expense->type == InvoiceExpense::TYPE_SMU) {
            $awbs = $expense->awbItems()
                ->when(!request()->get('all'), function ($query) {
                    $query->where('validation_score', '!=', 5);
                })
                ->get();
            $smus = $expense->smuItems()
                ->when(!request()->get('all'), function ($query) {
                    $query->where('validation_score', '!=', 5);
                })
                ->get();
            $items = $smus;
        }
        if ($expense->type == InvoiceExpense::TYPE_CONS) {
            $awbs = $expense->awbItems()
                ->when(!request()->get('all'), function ($query) {
                    $query->where('validation_score', '!=', 5);
                })
                ->get();
            $cons = $expense->consItems()
                ->when(!request()->get('all'), function ($query) {
                    $query->where('validation_score', '!=', 5);
                })
                ->get();
            $items = $cons;
        }
        $name = request()->get('all') ? 'all' : 'revision-invalid';
        if (request()->get('all')) {
            return Excel::download(new RevisionTemplateAll($smus, $awbs), "{$name}-{$expense->expense->code}-line-import-{$name}-{$date}.xlsx");
        } else {
            return Excel::download(new RevisionTemplate($items), "{$name}-{$expense->expense->code}-line-import-{$name}-{$date}.xlsx");
        }
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

                InvoiceValidation::dispatch($this->model);

                return $this->model;
            });
        });

        return $transaction;
    }

    /**
     * Update the specified resource in storage.
     *
     * @return Model
     */
    public function deltaValidate(): Model
    {
        $startTime = now();
        Log::info("Validation processing [{$this->model->invoice_number}] started at: " . $startTime, [
            'invoice' => [
                'id' => $this->model->id,
                'invoice_number' => $this->model->invoice_number,
                'invoice_date' => $this->model->invoice_date,
                'due_date' => $this->model->due_date,
                'posting_date' => $this->model->posting_date
            ],
            'user' => auth()->user()
        ]);

        $jobs = [];
        // if ($this->model->smuItems) {
        //     $smuItems = $this->model->smuItems->where('validation_score', '!=', 5);
        //     // $smuItems = $this->model->smuItems->where('is_validated', false);
        //     foreach ($smuItems as $item) {
        //         $item->awbItems()->delete();
        //         $amount = $item->amount;
        //         $tax = 0;
        //         $withholding = 0;
        //         $amountAfterTax = $amount;
        //         if ($item->tax && $item->withholding) {
        //             $tax = ($amount * $item->tax->deduction);
        //             $withholding = ($amount * $item->withholding->deduction);

        //             $amountAfterTax = $amount + $tax - $withholding;
        //         }
        //         $item->update([
        //             'is_validated' => false,
        //             'vat_tax' => $tax,
        //             'withholding_tax' => $withholding,
        //             'amount_after_tax' => $amountAfterTax
        //         ]);
        //         $jobs[] = new DeltaValidation($item, 'SMU');
        //     }
        // }

        // if ($this->model->awbItems) {
        //     $awbItems = $this->model->awbItems->where('validation_score', '!=', 5)->where('uuid', '!=', null);
        //     // $awbItems = $this->model->awbItems->where('is_validated', false)->where('uuid', '!=', null);
        //     foreach ($awbItems as $item) {
        //         $amount = $item->amount;
        //         $tax = 0;
        //         $withholding = 0;
        //         $amountAfterTax = $amount;
        //         if ($item->tax && $item->withholding) {
        //             $tax = ($amount * $item->tax->deduction);
        //             $withholding = ($amount * $item->withholding->deduction);

        //             $amountAfterTax = $amount + $tax - $withholding;
        //         }
        //         $item->update([
        //             'is_validated' => false,
        //             'vat_tax' => $tax,
        //             'withholding_tax' => $withholding,
        //             'amount_after_tax' => $amountAfterTax
        //         ]);
        //         $jobs[] = new DeltaValidation($item, 'AWB');
        //     }
        // }

        $jobs[] = new DeltaValidation($this->model->id);

        $expenses = InvoiceExpense::where('invoice_id', $this->model->id)->get();
        if ($expenses) {
            foreach ($expenses as $expense) {
                if ($expense->expense_id != 1) {
                    $jobs[] = new ExpenseValidation($expense);
                }
            }
        }

        $jobs[] = new InvoiceValidation($this->model);

        $batch = Bus::batch($jobs)
            ->then(function (Batch $batch) use ($startTime) {
                // All jobs completed successfully...
                $endTime = now();
                $duration = $endTime->diffInSeconds($startTime);

                Log::notice("Validation processing [{$this->model->invoice_number}] completed at: " . $endTime, [
                    'start' => $startTime,
                    'end' => $endTime,
                    'duration' => $duration,
                ]);
            })->catch(function (Batch $batch, Throwable $e) use ($startTime) {
                // First batch job failure detected...
                $endTime = now();
                $duration = $endTime->diffInSeconds($startTime);

                Log::error("Validation processing [{$this->model->invoice_number}] failed at: " . $endTime, [
                    'start' => $startTime,
                    'end' => $endTime,
                    'duration' => $duration,
                    'message' => $e->getMessage(),

                ]);
            })->dispatch();

        $this->model->update([
            'job_batch' => $batch->id
        ]);

        return $this->model;
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
            'expenses' => function ($query) {
                $query->with(['expense', 'withholding', 'tax', 'costCenter']);
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
            'sbus' => Sbu::select(['id', 'name'])->get(),
            'invoice_types' => InvoiceType::select(['id', 'name'])->get(),
            'currencies' => Currency::select(['id', 'name'])->get(),
            'intercos' => Interco::select(['id', 'name'])->get(),
            'vendors' => Vendor::select(['id', 'name'])->get(),
            'vendor_sites' => VendorSite::select(['id', 'name', 'vendor_id'])->get(),
            'terms' => Term::select(['id', 'name', 'day'])->get(),
            /** Item */
            'expenses' => Expense::select('id', 'icon', 'code', 'name', 'type')->get()->append('type_text'),
            'products' => Product::select('id', 'name')->get(),
            'areas' => Area::select('id', 'name')->get(),
            'departments' => Department::select('id', 'name')->whereIn('id', function ($query) {
                $query->select('department_id')
                    ->from('workflows');
            })->get(),
            'taxes' => Tax::select('id', 'name')->get(),
            'withholdings' => Withholding::select('id', 'name')->get(),
            'sales_channels' => SalesChannel::select('id', 'name')->get(),
            'cost_centers' => CostCenter::select('id', 'name')->get(),
        ];
    }

    /**
     * Add new attachments
     */
    public static function saveDocumentApproval(Model $model, $request)
    {
        $workflows = WorkflowItem::query()
            ->whereRelation('workflow', 'department_id', $model->department_id)
            ->where(function ($query) use ($model) {
                $query->whereBetween('range_from', [0, $model->total_amount_invalid])
                    ->orWhereBetween('range_to', [0, $model->total_amount_invalid]);
            })
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
                'status' => 'pending',
                'description' => $item->description,
                'current' => $index == 0,
                'position' => $position,
            ]);
            if ($index == 0) {
                Mail::to(auth()->user()->email)->send(new ModelMail($model, auth()->user(), 'created'));
                Mail::to($item->user->email)->send(new ModelMail($model, $item->user, 'approval'));
            }
        }
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
     * Save awb items
     */
    public static function saveAwbItem(Model $model, $items)
    {
        if (!empty($items)) {
            foreach ($items as $item) {
                InvoiceAwb::find($item['id'])->update(
                    $item
                );
            }
        }
    }

    /**
     * Save smu items
     */
    public static function saveSmuItem(Model $model, $items)
    {
        if (!empty($items)) {
            foreach ($items as $item) {
                InvoiceSmu::find($item['id'])->update(
                    $item
                );
            }
        }
    }

    /**
     * Save cons items
     */
    public static function saveConsItem(Model $model, $items)
    {
        if (!empty($items)) {
            foreach ($items as $item) {
                InvoiceCons::find($item['id'])->update(
                    $item
                );
            }
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
