<?php

namespace App\Jobs;

use App\Models\Approval;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\Workflow;
use App\Repositories\Delta;

class DeltaValidation implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The invoice instance.
     *
     * @var \App\Models\Invoice
     */
    public $invoice;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Invoice $invoice)
    {
        $this->invoice = $invoice;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if($this->invoice->items){
            foreach($this->invoice->items as $item){
                if($item->expense_code == 'MNL'){
                    if($item->type == 'AWB'){
                        $delta = Delta::awbDetail($item->awb);

                        $validationReference = (trim($delta['msg']) == 'Data Found') ? true : false;
                        if($validationReference){
                            $item->update([
                                'validation_reference' => $validationReference,
                                'is_validated' => true,
                            ]);

                            $validationWeight = $delta['data'][0]['tot_weight'] == $item->invoice_weight_awb ? true : false;
                            $item->update([
                                'delta_weight_awb' => $delta['data'][0]['tot_weight'],
                            ]);

                            if($validationWeight){
                                $item->update([
                                    'validation_weight' => $validationWeight,
                                    'validation_scan_compliance' => true,
                                    'validation_ops_plan' => true,
                                    'validation_bill' => true,
                                    'is_validated' => true,
                                ]);
                            }
                        }
                    }
                    if($item->type == 'SMU'){
                        $delta = Delta::smu($item->smu);

                        $validationReference = (trim($delta['msg']) == 'Data Found') ? true : false;
                        if($validationReference){
                            $item->update([
                                'validation_reference' => $validationReference,
                                'is_validated' => true,
                            ]);

                            $validationWeight = $delta['data']['total_weight_smu'] == $item->invoice_weight_smu ? true : false;
                            $item->update([
                                'delta_weight_smu' => $delta['data']['total_weight_smu'],
                            ]);

                            if($validationWeight){
                                $item->update([
                                    'validation_weight' => $validationWeight,
                                    'validation_scan_compliance' => true,
                                    'validation_ops_plan' => true,
                                    'validation_bill' => true,
                                    'is_validated' => true,
                                ]);
                            }
                        }
                    }
                }else{
                    if($item->type == 'AWB'){
                        $delta = Delta::awbDetail($item->awb);

                        $validationReference = (trim($delta['msg']) == 'Data Found') ? true : false;
                        if($validationReference){
                            $item->update([
                                'validation_reference' => $validationReference,
                                'is_validated' => true,
                            ]);

                            $validationWeight = $delta['data'][0]['tot_weight'] == $item->invoice_weight_awb ? true : false;
                            $item->update([
                                'delta_weight_awb' => $delta['data'][0]['tot_weight'],
                            ]);

                            if($validationWeight){
                                $item->update([
                                    'validation_weight' => $validationWeight,
                                    'is_validated' => true,
                                ]);

                                if($item->expense->mandatory_scan){
                                    $deltaBatch = Delta::awbBatch([$item->awb]);
                                    $tracking = array_column($deltaBatch['data']['tracking'], 'tracking_id');
                                    $referenceMandatoryScan = $this->operationPattern($tracking, $item->expense->mandatory_scan);
                                    if($referenceMandatoryScan){
                                        $item->update([
                                            'validation_scan_compliance' => $referenceMandatoryScan,
                                            'validation_ops_plan' => true,
                                            'validation_bill' => true,
                                            'is_validated' => true,
                                        ]);
                                    }
                                }else{
                                    $item->update([
                                        'validation_weight' => $validationWeight,
                                        'validation_scan_compliance' => true,
                                        'validation_ops_plan' => true,
                                        'validation_bill' => true,
                                        'is_validated' => true,
                                    ]);
                                }
                            }
                        }
                    }
                    if($item->type == 'SMU'){
                        $delta = Delta::smu($item->smu);

                        $validationReference = (trim($delta['msg']) == 'Data Found') ? true : false;
                        if($validationReference){
                            $item->update([
                                'validation_reference' => $validationReference,
                                'is_validated' => true,
                            ]);

                            $validationWeight = $delta['data']['total_weight_smu'] == $item->invoice_weight_smu ? true : false;
                            $item->update([
                                'delta_weight_smu' => $delta['data']['total_weight_smu'],
                            ]);

                            if($validationWeight){
                                $item->update([
                                    'validation_weight' => $validationWeight,
                                    'is_validated' => true,
                                ]);

                                if($item->expense->mandatory_scan){
                                    $awb = array_column($delta['data']['airwaybill'], 'awb');
                                    $deltaBatch = Delta::awbBatch($awb);
                                    $tracking = array_reduce($deltaBatch['data'], function ($carry, $item) {
                                        return array_merge($carry, array_column($item['tracking'], 'tracking_id'));
                                    }, []);
                                    $tracking = array_column(array_unique($tracking), 'tracking_id');
                                    $referenceMandatoryScan = $this->operationPattern($tracking, $item->expense->mandatory_scan);
                                    if($referenceMandatoryScan){
                                        $item->update([
                                            'validation_scan_compliance' => $referenceMandatoryScan,
                                            'validation_ops_plan' => true,
                                            'validation_bill' => true,
                                            'is_validated' => true,
                                        ]);
                                    }
                                }else{
                                    $item->update([
                                        'validation_weight' => $validationWeight,
                                        'validation_scan_compliance' => true,
                                        'validation_ops_plan' => true,
                                        'validation_bill' => true,
                                        'is_validated' => true,
                                    ]);
                                }
                            }
                        }
                    }
                }

                $amount = $item->amount_awb + $item->amount_smu;
                $vatTax = 0;
                $withholdingTax = 0;
                $amountAfterTax = $amount;
                if($item->tax && $item->withholding){
                    $vatTax = ($amount * $item->tax->deduction);
                    $withholdingTax = ($amount * $item->withholding->deduction);

                    $amountAfterTax = $amount + $vatTax - $withholdingTax;
                }

                
                $validation_score = array_sum([
                    $item->validation_reference,
                    $item->validation_weight,
                    $item->validation_scan_compliance,
                    $item->validation_ops_plan,
                    $item->validation_bill,
                ]);
                $item->update([
                    'vat_tax' => $vatTax,
                    'withholding_tax' => $withholdingTax,
                    'amount' => $amountAfterTax,
                    'validation_score'  => $validation_score,
                    'code'              => implode('-', [
                        $this->invoice->sbu->coa ?? null,
                        $item->area->coa ?? null,
                        $item->cost_center ?? null,
                        $item->expense->coa ?? null,
                        '00000',
                        $item->product->coa ?? null,
                        $this->invoice->interco->coa ?? null,
                        '0000',
                        '0000',
                    ])
                ]);
            }
        }
        $this->invoice->update([
            'total_item' => count($this->invoice->items),
            'total_amount' => ($this->invoice->items->sum('amount_awb'))+($this->invoice->items->sum('amount_smu')),
            'total_amount_valid' => InvoiceItem::where('invoice_id', $this->invoice->id)->where('validation_score',5)->get()->sum(function ($item) {
                return $item->amount_awb + $item->amount_smu;
            }),
            'total_amount_invalid' => InvoiceItem::where('invoice_id', $this->invoice->id)->where('validation_score','!=',5)->get()->sum(function ($item) {
                return $item->amount_awb + $item->amount_smu;
            }),
            'total_amount_after_tax' => $this->invoice->items->sum('amount'),
            'total_amount_after_tax_valid' => InvoiceItem::where('invoice_id', $this->invoice->id)->where('validation_score',5)->get()->sum('amount'),
            'total_amount_after_tax_invalid' => InvoiceItem::where('invoice_id', $this->invoice->id)->where('validation_score','!=',5)->get()->sum('amount')
        ]);

        if($this->invoice->document_status == 'published'){
            $this->createApproval($this->invoice);
        }
    }

    /**
     * Create approval
     */
    public function createApproval(Invoice $model, $reset = false){
        $workflows = Workflow::query()
        ->whereBetween('range_from', [0, $model->total_amount])
        ->orWhereBetween('range_to', [0, $model->total_amount])
        ->orderBy('sequence')
        ->get();

        foreach($workflows as $index => $workflow){
            $position = null;
            if ($workflows->first()->id === $workflow->id) {
                $position = 'first';
            }
            if ($workflows->last()->id === $workflow->id) {
                $position = 'last';
            }
            Approval::create([
                'workflow_id' => $workflow->id,
                'invoice_id' => $model->id,
                'user_id' => $workflow->user_id,
                'current' => $workflows->first()->id === $workflow->id,
                'position' => $position,
                'sequence' => $index+1
            ]);
        }
    }

    public function operationPattern($tracking, $operation_pattern){
        $result = null;

        // replace OR with | and AND with & in the pattern
        $operation_pattern = str_replace("OR", "|", $operation_pattern);
        $operation_pattern = str_replace("AND", "&", $operation_pattern);
        
        // loop through the tracking and set the value to 1 or 0 if present in the tracking
        // if not present in the tracking, set the value to 0
        $pattern = $operation_pattern;
        foreach(array_unique(explode("|", $operation_pattern)) as $key) {
            $key = trim($key, "&");
            if (in_array($key, $tracking)) {
                $pattern = str_replace($key, 1, $pattern);
            } else {
                $pattern = str_replace($key, 0, $pattern);
            }
        }

        // evaluate the pattern as a boolean expression
        eval("\$result = (bool)($pattern);");

        return (bool) $result;
    }
}
