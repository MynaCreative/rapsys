<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Http\Client\Response;

use App\Models\SalesChannel;
use App\Models\InvoiceItem;
use App\Models\Product;
use App\Models\Area;

use App\Repositories\Delta;

class DeltaValidation implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The invoice instance.
     *
     * @var \App\Models\Invoice
     */
    public $item;

    /**
     * The number of seconds the job can run before timing out.
     * php artisan queue:listen --tries=3 --memory=1024 --timeout=6300
     *
     * @var int
     */
    public $timeout = 6300;
    public $memory = 1024;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(InvoiceItem $item)
    {
        $this->item = $item;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $item = $this->item;
        if ($item->validation_score != '5' && $item->type == 'AWB') {
            $delta = Delta::awbDetail($item->code);

            $validationReference = (trim($delta['msg']) == 'Data Found') ? true : false;
            if ($validationReference) {
                $item->update([
                    'area_id' => $this->getArea($delta['data'][0]['origin']),
                    'sales_channel_id' => $this->getSalesChannel($delta['data'][0]['sales_channel']),
                    'product_id' => $this->getProduct($delta['data'][0]['service_type_id']),
                    'validation_reference' => $validationReference,
                ]);

                $validationBillExist = $this->validationBill($item->id, $item->expense_id, $item->code);
                if (!$validationBillExist) {
                    $item->update([
                        'validation_bill' => !$validationBillExist,
                    ]);

                    $validationWeight = $delta['data'][0]['tot_weight'] == $item->weight ? true : false;
                    $item->update([
                        'delta_weight' => $delta['data'][0]['tot_weight'],
                    ]);

                    if ($validationWeight) {
                        $item->update([
                            'validation_weight' => $validationWeight,
                        ]);

                        if ($item->expense->mandatory_scan) {
                            $deltaBatch = Delta::awbBatch([$item->code]);
                            $tracking = array_column($deltaBatch['data']['tracking'], 'tracking_id');
                            $referenceMandatoryScan = $this->operationPattern($tracking, $item->expense->mandatory_scan);
                            if ($referenceMandatoryScan) {
                                $item->update([
                                    'validation_scan_compliance' => $referenceMandatoryScan,
                                    'validation_ops_plan' => true,
                                ]);
                            }
                        } else {
                            $item->update([
                                'validation_weight' => $validationWeight,
                                'validation_scan_compliance' => true,
                                'validation_ops_plan' => true,
                            ]);
                        }
                    }
                }
            }
        }
        if ($item->validation_score != '5' && $item->type == 'SMU') {
            $delta = Delta::smu($item->code);

            $validationReference = (trim($delta['msg']) == 'Data Found') ? true : false;
            if ($validationReference) {
                $awb = Delta::awbDetail($delta['data']['airwaybill'][0]['awb']);
                $item->update([
                    // 'area_id' => $this->getArea($awb['data'][0]['origin']),
                    // 'sales_channel_id' => $this->getSalesChannel($awb['data'][0]['sales_channel']),
                    // 'product_id' => $this->getProduct($awb['data'][0]['service_type_id']),
                    'validation_reference' => $validationReference,
                ]);

                $validationBillExist = $this->validationBill($item->id, $item->expense_id, $item->code);
                if (!$validationBillExist) {
                    $item->update([
                        'validation_bill' => !$validationBillExist,
                    ]);

                    $validationWeight = $delta['data']['total_weight_smu'] == $item->weight ? true : false;
                    $item->update([
                        'delta_weight' => $delta['data']['total_weight_smu'],
                    ]);

                    if ($validationWeight) {
                        $item->update([
                            'validation_weight' => $validationWeight,
                        ]);

                        if ($item->expense->mandatory_scan) {
                            $awbs = array_filter(array_column($delta['data']['airwaybill'], 'awb'));
                            // $mandatoryScans = [];
                            // foreach ($awbs as $awb) {
                            //     $deltaBatch = Delta::awbBatch([$awb]);
                            //     $tracking = array_unique(array_column($deltaBatch['data']['tracking'], 'tracking_id'));
                            //     $mandatoryScans[] = $this->operationPattern($tracking, $item->expense->mandatory_scan);
                            // }
                            // $referenceMandatoryScan = (in_array(false, $mandatoryScans, true) === false);
                            $deltaScanCompliance = Delta::awbScanCompliance(implode(',', $awbs), $item->expense->with_scan, $item->expense->or_scan);
                            $referenceMandatoryScan = trim($deltaScanCompliance['msg']) === 'Data Found';
                            if ($referenceMandatoryScan) {
                                $item->update([
                                    'validation_scan_compliance' => $referenceMandatoryScan,
                                    'validation_ops_plan' => true,
                                ]);
                            }
                        } else {
                            $item->update([
                                'validation_weight' => $validationWeight,
                                'validation_scan_compliance' => true,
                                'validation_ops_plan' => true,
                            ]);
                        }
                    }
                }
            }
        }

        $amount = $item->amount;
        $vatTax = 0;
        $withholdingTax = 0;
        $amountAfterTax = $amount;
        if ($item->tax && $item->withholding) {
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
            'validation_ops_plan'   => true,
            'is_validated'          => true,
            'vat_tax'               => $vatTax,
            'withholding_tax'       => $withholdingTax,
            'total'                 => $amountAfterTax,
            'validation_score'      => $validation_score,
            'dist'                  => implode('-', [
                $item->invoice->sbu->coa ?? null,
                $item->area->coa ?? null,
                $item->costCenter->cost_center ?? null,
                $item->expense->coa ?? $item->expense_coa,
                $item->salesChannel->coa ?? null,
                $item->product->coa ?? null,
                $item->invoice->interco->coa ?? null,
                '0000',
                '0000',
            ])
        ]);
    }

    public function validationBill($id, $expense, $code)
    {
        // return false;
        return InvoiceItem::where('id', '!=', $id)
            ->where('expense_id', $expense)
            ->where('code', $code)
            ->exists();
    }

    public function getSalesChannel($code)
    {
        return SalesChannel::where('code', $code)->value('id');
    }

    public function getArea($code)
    {
        return Area::where('code', $code)->value('id');
    }

    public function getProduct($code)
    {
        return Product::where('code', $code)->value('id');
    }

    public function operationPattern($tracking, $operation_pattern)
    {
        $result = null;

        // replace OR with | and AND with & in the pattern
        $operation_pattern = str_replace("OR", "|", $operation_pattern);
        $operation_pattern = str_replace("AND", "&", $operation_pattern);

        // loop through the tracking and set the value to 1 or 0 if present in the tracking
        // if not present in the tracking, set the value to 0
        $pattern = $operation_pattern;
        foreach (array_unique(explode("|", $operation_pattern)) as $key) {
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
