<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\Models\Invoice as Model;
use App\Mail\Invoice as ModelMail;
use App\Models\Approval as ModelsApproval;
use App\Models\WorkflowItem;
use Illuminate\Support\Facades\Mail;

class Approval
{
    private Model $model;

    /**
     * Initialize the repository from model.
     *
     * @param Model $model
     * @return Area
     */
    public static function init(Model $model): Approval
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
        return $request->user()->currentApprovals->load(['invoice', 'invoice.createdUser', 'invoice.vendor', 'invoice.vendorSite', 'invoice.department']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return Model
     */
    public function update($request): Model
    {
        // $this->model->fill($request->sanitizedData());
        // $this->model->updateOrFail();

        if ($request->approval_status == 'approved' || $request->approval_status == 'rejected') {
            $currentReleaser = $this->model->approvals->where('user_id', auth()->user()->id)->first();
            $nextReleaser = $this->model->approvals->where('id', $currentReleaser->id + 1)->first();
            $lastReleaser = $this->model->approvals->max('id');

            if ($request->approval_status === 'approved') {
                $currentReleaser->update(['note' => $request->approval_note, 'status' => 'approved', 'approved_at' => now(), 'current' => false]);
                if ($currentReleaser->id == $lastReleaser) {
                    $this->model->update([
                        'document_status' => 'closed',
                        'approval_status' => 'approved',
                        'approval_status_time' => now()
                    ]);
                    $staging_id = Oracle::latestIdTable('APPS.RAPSYS_AP_STG_HEADER', 'staging_id');
                    Oracle::insertTable('APPS.RAPSYS_AP_STG_HEADER', [
                        'staging_id' => $staging_id,
                        'ledger_id' => 2024,
                        'org_id' => 103,
                        'vendor_id' => $this->model->vendor_id,
                        'vendor_site_id' => $this->model->vendor_site_id,
                        'trx_number' => $this->model->invoice_number,
                        'currency_code' => $this->model->currency->code,
                        'description' => $this->model->note,
                        'amount' => $this->model->total_amount,
                        'ap_invoice_date' => date('d-M-Y', strtotime($this->model->invoice_date)),
                        'ap_invoice_received_date' => date('d-M-Y', strtotime($this->model->invoice_receipt_date)),
                        'ap_gl_date' => date('d-M-Y', strtotime($this->model->posting_date)),
                        'supplier_tax_invoice_date' => date('d-M-Y', strtotime($this->model->supplier_tax_invoice_date)),
                        'supplier_tax_invoice_number' => $this->model->supplier_tax_invoice,
                        'ap_source' => 'RAPSYS',
                        'terms_id' => $this->model->term->code,
                        'invoice_type_lookup_code' => strtoupper($this->model->invoiceType->name),
                        'payment_method_lookup_code' => 'CHECK',
                        'status' => 'I',
                    ]);


                    $key = 1;
                    foreach ($this->model->dists['items'] as $line) {
                        Oracle::insertTable('APPS.RAPSYS_AP_STG_LINE', [
                            'staging_id' => $staging_id,
                            'staging_line_id' => Oracle::latestIdTable('APPS.RAPSYS_AP_STG_LINE', 'staging_line_id'),
                            'ledger_id' => 2024,
                            'org_id' => 103,
                            'line_number' => $key,
                            'description' => $line['description'],
                            'line_type_code' => 'ITEM',
                            'ppn_code' => null,
                            'tax_rate_id' => null,
                            'awt_group_id' => $line['awt_group_id'],
                            'amount' => $line['amount'],
                            'dist_code_concat' => $line['dist_code_concat'],
                        ]);
                        $key++;
                    }
                    foreach ($this->model->dists['taxes'] as $tax) {
                        Oracle::insertTable('APPS.RAPSYS_AP_STG_LINE', [
                            'staging_id' => $staging_id,
                            'staging_line_id' => Oracle::latestIdTable('APPS.RAPSYS_AP_STG_LINE', 'staging_line_id'),
                            'ledger_id' => 2024,
                            'org_id' => 103,
                            'line_number' => $key,
                            'description' => $tax['description'],
                            'line_type_code' => 'TAX',
                            'ppn_code' => $tax['ppn_code'],
                            'tax_rate_id' => $tax['tax_rate_id'],
                            'amount' => $tax['amount'],
                        ]);
                        $key++;
                    }
                } else {
                }
            } else if ($request->approval_status === 'rejected') {
                $currentReleaser->update(['note' => $request->approval_note, 'status' => 'approved', 'rejected_at' => now(), 'current' => false]);

                $this->model->update([
                    'approval_status' => 'rejected',
                    'reject_remarks' => $request->reject_remarks
                ]);

                Mail::to($this->model->createdUser->email)->send(new ModelMail($this->model, $this->model->createdUser, 'rejected'));
            }
            if ($nextReleaser && $request->approval_status !== 'rejected') {
                ModelsApproval::where('id', $nextReleaser->id)->update(['current' => true, 'rejected_at' => null, 'approved_at' => null]);
            }
        }

        return $this->model;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return Model
     */
    public function updateOldMethod($request): Model
    {
        // $this->model->fill($request->sanitizedData());
        // $this->model->updateOrFail();

        if ($request->approval_status == 'approved' || $request->approval_status == 'rejected') {
            $currentReleaser = $this->model->approvals->where('user_id', auth()->user()->id)->first();
            $nextReleaser = $this->model->approvals->where('id', $currentReleaser->id + 1)->first();
            $lastReleaser = $this->model->approvals->max('id');

            if ($request->approval_status === 'approved') {
                $currentReleaser->update(['note' => $request->approval_note, 'status' => 'approved', 'approved_at' => now(), 'current' => false]);
                if ($currentReleaser->id == $lastReleaser) {
                    $this->model->update([
                        'document_status' => 'closed',
                        'approval_status' => 'approved',
                        'approval_status_time' => now()
                    ]);
                    $staging_id = Oracle::latestIdTable('APPS.RAPSYS_AP_STG_HEADER', 'staging_id');
                    Oracle::insertTable('APPS.RAPSYS_AP_STG_HEADER', [
                        'staging_id' => $staging_id,
                        'ledger_id' => 2024,
                        'org_id' => 103,
                        'vendor_id' => $this->model->vendor_id,
                        'vendor_site_id' => $this->model->vendor_site_id,
                        'trx_number' => $this->model->invoice_number,
                        'currency_code' => $this->model->currency->code,
                        'description' => $this->model->note,
                        'amount' => $this->model->total_amount,
                        'ap_invoice_date' => date('d-M-Y', strtotime($this->model->invoice_date)),
                        'ap_invoice_received_date' => date('d-M-Y', strtotime($this->model->invoice_receipt_date)),
                        'ap_gl_date' => date('d-M-Y', strtotime($this->model->posting_date)),
                        'supplier_tax_invoice_date' => date('d-M-Y', strtotime($this->model->supplier_tax_invoice_date)),
                        'supplier_tax_invoice_number' => $this->model->supplier_tax_invoice,
                        'ap_source' => 'RAPSYS',
                        'terms_id' => $this->model->term->code,
                        'invoice_type_lookup_code' => strtoupper($this->model->invoiceType->name),
                        'payment_method_lookup_code' => 'CHECK',
                        'status' => 'I',
                    ]);

                    $items = [];
                    $distGroups = $this->model->items->groupBy('dist');

                    foreach ($distGroups as $group) {
                        $item = $group->first();
                        $awb = null;
                        if ($item->type == 'SMU') {
                            $smu = Delta::smu($item->code);
                            $awb = count($smu['data']['airwaybill']) . ' AWB';
                        }
                        $description = implode(' | ', array_filter([
                            $item->expense->code,
                            $group->count() . ' ' . $item->type,
                            $awb,
                            $item->area->code
                        ]));
                        $amount = $group->sum('amount');

                        $items[] = [
                            'description' => $description,
                            'line_type_code' => 'ITEM',
                            'ppn_code' => null,
                            'tax_rate_id' => null,
                            'awt_group_id' => $item->withholding->code,
                            'amount' => $amount,
                            'dist_code_concat' => $item->dist,
                        ];
                        $items[] = [
                            'description' => $description,
                            'line_type_code' => 'TAX',
                            'ppn_code' => $item->tax->name,
                            'tax_rate_id' => $item->tax->code,
                            'amount' => $item->tax->deduction * $amount,
                        ];
                    };
                    $lineItems = collect($items)->where('line_type_code', 'ITEM');
                    $lineTaxs = collect($items)->where('line_type_code', 'TAX')->groupBy('ppn_code')->map(function ($tax) {
                        $item = $tax->first();
                        return [
                            'description' => $item['ppn_code'],
                            'line_type_code' => 'TAX',
                            'ppn_code' => $item['ppn_code'],
                            'tax_rate_id' => $item['tax_rate_id'],
                            'amount' => $tax->sum('amount'),
                        ];
                    });
                    $key = 1;
                    foreach ($lineItems as $lineKey => $line) {
                        Oracle::insertTable('APPS.RAPSYS_AP_STG_LINE', [
                            'staging_id' => $staging_id,
                            'staging_line_id' => Oracle::latestIdTable('APPS.RAPSYS_AP_STG_LINE', 'staging_line_id'),
                            'ledger_id' => 2024,
                            'org_id' => 103,
                            'line_number' => $key,
                            'description' => $line['description'],
                            'line_type_code' => 'ITEM',
                            'ppn_code' => null,
                            'tax_rate_id' => null,
                            'awt_group_id' => $line['awt_group_id'],
                            'amount' => $line['amount'],
                            'dist_code_concat' => $line['dist_code_concat'],
                        ]);
                        $key++;
                    }
                    foreach ($lineTaxs as $tax) {
                        Oracle::insertTable('APPS.RAPSYS_AP_STG_LINE', [
                            'staging_id' => $staging_id,
                            'staging_line_id' => Oracle::latestIdTable('APPS.RAPSYS_AP_STG_LINE', 'staging_line_id'),
                            'ledger_id' => 2024,
                            'org_id' => 103,
                            'line_number' => $key,
                            'description' => $tax['description'],
                            'line_type_code' => 'TAX',
                            'ppn_code' => $tax['ppn_code'],
                            'tax_rate_id' => $tax['tax_rate_id'],
                            'amount' => $tax['amount'],
                        ]);
                        $key++;
                    }
                    // Oracle::insertTable('APPS.RAPSYS_AP_STG_LINE', [
                    //     'staging_id' => $staging_id,
                    //     'staging_line_id' => Oracle::latestIdTable('APPS.RAPSYS_AP_STG_LINE', 'staging_line_id'),
                    //     'ledger_id' => 2024,
                    //     'org_id' => 103,
                    //     'line_number' => $key,
                    //     'description' => $description,
                    //     'line_type_code' => 'ITEM',
                    //     'ppn_code' => null,
                    //     'tax_rate_id' => null,
                    //     'awt_group_id' => $item->withholding->code,
                    //     'amount' => $amount,
                    //     'dist_code_concat' => $item->dist,
                    // ]);
                    // $key++;
                    // if ($item->tax) {
                    //     Oracle::insertTable('APPS.RAPSYS_AP_STG_LINE', [
                    //         'staging_id' => $staging_id,
                    //         'staging_line_id' => Oracle::latestIdTable('APPS.RAPSYS_AP_STG_LINE', 'staging_line_id'),
                    //         'ledger_id' => 2024,
                    //         'org_id' => 103,
                    //         'line_number' => $key,
                    //         'description' => $description,
                    //         'line_type_code' => 'TAX',
                    //         'ppn_code' => $item->tax->name,
                    //         'tax_rate_id' => $item->tax->code,
                    //         'amount' => $item->tax->deduction * $amount,
                    //     ]);
                    //     $key++;
                    // }
                    // Mail::to($this->model->createdUser->email)->send(new ModelMail($this->model, $this->model->createdUser->email, 'approved'));
                } else {
                    // Mail::to($nextReleaser->user->email)->send(new ModelMail($this->model, $nextReleaser->user->email, 'approval'));

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
            } else if ($request->approval_status === 'rejected') {
                $currentReleaser->update(['note' => $request->approval_note, 'status' => 'approved', 'rejected_at' => now(), 'current' => false]);

                $this->model->update([
                    'approval_status' => 'rejected',
                    'reject_remarks' => $request->reject_remarks
                ]);

                Mail::to($this->model->createdUser->email)->send(new ModelMail($this->model, $this->model->createdUser->email, 'rejected'));
            }
            if ($nextReleaser && $request->approval_status !== 'rejected') {
                ModelsApproval::where('id', $nextReleaser->id)->update(['current' => true, 'rejected_at' => null, 'approved_at' => null]);
            }
        }

        return $this->model;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return Model
     */
    public function updateWithoutGroup($request): Model
    {
        // $this->model->fill($request->sanitizedData());
        // $this->model->updateOrFail();

        if ($request->approval_status == 'approved' || $request->approval_status == 'rejected') {
            $currentReleaser = $this->model->approvals->where('user_id', auth()->user()->id)->first();
            $nextReleaser = $this->model->approvals->where('id', $currentReleaser->id + 1)->first();
            $lastReleaser = $this->model->approvals->max('id');

            if ($request->approval_status === 'approved') {
                $currentReleaser->update(['note' => $request->approval_note, 'status' => 'approved', 'approved_at' => now(), 'current' => false]);
                if ($currentReleaser->id == $lastReleaser) {
                    $this->model->update([
                        'document_status' => 'closed',
                        'approval_status' => 'approved',
                        'approval_status_time' => now()
                    ]);
                    $staging_id = Oracle::latestIdTable('APPS.RAPSYS_AP_STG_HEADER', 'staging_id');
                    Oracle::insertTable('APPS.RAPSYS_AP_STG_HEADER', [
                        'staging_id' => $staging_id,
                        'ledger_id' => 2024,
                        'org_id' => 103,
                        'vendor_id' => $this->model->vendor_id,
                        'vendor_site_id' => $this->model->vendor_site_id,
                        'trx_number' => $this->model->invoice_number,
                        'currency_code' => $this->model->currency->code,
                        'description' => $this->model->note,
                        'amount' => $this->model->total_amount,
                        'ap_invoice_date' => date('d-M-Y', strtotime($this->model->invoice_date)),
                        'ap_invoice_received_date' => date('d-M-Y', strtotime($this->model->invoice_receipt_date)),
                        'ap_gl_date' => date('d-M-Y', strtotime($this->model->posting_date)),
                        'supplier_tax_invoice_date' => date('d-M-Y', strtotime($this->model->supplier_tax_invoice_date)),
                        'supplier_tax_invoice_number' => $this->model->supplier_tax_invoice,
                        'ap_source' => 'RAPSYS',
                        'terms_id' => $this->model->term->code,
                        'invoice_type_lookup_code' => strtoupper($this->model->invoiceType->name),
                        'payment_method_lookup_code' => 'CHECK',
                        'status' => 'I',
                    ]);

                    $key = 1;
                    $this->model->items->groupBy('dist')->each(function ($group) use ($staging_id, &$key) {
                        $item = $group->first();
                        $awb = null;
                        if ($item->type == 'SMU') {
                            $smu = Delta::smu($item->code);
                            $awb = count($smu['data']['airwaybill']) . ' AWB';
                        }
                        $description = implode(' | ', array_filter([
                            $item->expense->code,
                            $group->count() . ' ' . $item->type,
                            $awb,
                            $item->area->code
                        ]));
                        $amount = $group->sum('amount');
                        Oracle::insertTable('APPS.RAPSYS_AP_STG_LINE', [
                            'staging_id' => $staging_id,
                            'staging_line_id' => Oracle::latestIdTable('APPS.RAPSYS_AP_STG_LINE', 'staging_line_id'),
                            'ledger_id' => 2024,
                            'org_id' => 103,
                            'line_number' => $key,
                            'description' => $description,
                            'line_type_code' => 'ITEM',
                            'ppn_code' => null,
                            'tax_rate_id' => null,
                            'awt_group_id' => $item->withholding->code,
                            'amount' => $amount,
                            'dist_code_concat' => $item->dist,
                        ]);
                        $key++;
                        if ($item->tax) {
                            Oracle::insertTable('APPS.RAPSYS_AP_STG_LINE', [
                                'staging_id' => $staging_id,
                                'staging_line_id' => Oracle::latestIdTable('APPS.RAPSYS_AP_STG_LINE', 'staging_line_id'),
                                'ledger_id' => 2024,
                                'org_id' => 103,
                                'line_number' => $key,
                                'description' => $description,
                                'line_type_code' => 'TAX',
                                'ppn_code' => $item->tax->name,
                                'tax_rate_id' => $item->tax->code,
                                'amount' => $item->tax->deduction * $amount,
                            ]);
                            $key++;
                        }
                    });
                    Mail::to($this->model->createdUser->email)->send(new ModelMail($this->model, $this->model->createdUser, 'approved'));
                } else {
                    Mail::to($nextReleaser->user->email)->send(new ModelMail($this->model, $nextReleaser->user, 'approval'));

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
            } else if ($request->approval_status === 'rejected') {
                $currentReleaser->update(['note' => $request->approval_note, 'status' => 'approved', 'rejected_at' => now(), 'current' => false]);

                $this->model->update([
                    'approval_status' => 'rejected',
                    'reject_remarks' => $request->reject_remarks
                ]);

                Mail::to($this->model->createdUser->email)->send(new ModelMail($this->model, $this->model->createdUser, 'rejected'));
            }
            if ($nextReleaser && $request->approval_status !== 'rejected') {
                ModelsApproval::where('id', $nextReleaser->id)->update(['current' => true, 'rejected_at' => null, 'approved_at' => null]);
            }
        }

        return $this->model;
    }

    /**
     * Display the specified resource.
     *
     * @return Model
     */
    public function show(): Model
    {
        return $this->model->load([
            'createdUser:id,name',
            'updatedUser:id,name',
            'invoiceType:id,name',
            'currency:id,name',
            'department:id,name',
            'sbu:id,name',
            'interco:id,name',
            'term:id,name',
            'vendor',
            'vendorSite',
            'items',
            'attachments',
            'approvals.user'
        ]);
    }
}
