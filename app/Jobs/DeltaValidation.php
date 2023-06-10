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
    public $type;

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
    public function __construct($item, $type)
    {
        $this->item = $item;
        $this->type = $type;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if ($this->type == 'AWB') {
            $this->validationAWB($this->item);
        }
        if ($this->type == 'SMU') {
            $this->validationSMU($this->item);
        }
    }

    public function validationAWB($item)
    {
        $delta = Delta::awbDetail($item->code);

        /**
         * Validation
         */
        $validationReference = false;
        $validationBillExist = false;
        $validationWeight = false;
        $referenceMandatoryScan = false;
        $referenceOpsPlan = true;

        $validationReference = (trim($delta['msg']) == 'Data Found') ? true : false;
        if ($validationReference) {
            $area = $this->getArea($delta['data'][0]['origin']);
            $salesChannel = $this->getSalesChannel($delta['data'][0]['sales_channel']);
            $product = $this->getProduct($delta['data'][0]['service_type_id']);
            $validationBillExist = $this->validationBill($item->id, $item->expense_id, $item->code);
            if (!$validationBillExist) {
                $validationWeight = $delta['data'][0]['tot_weight'] == $item->weight ? true : false;
                if ($validationWeight) {
                    if ($item->expense->mandatory_scan) {
                        // $deltaBatch = Delta::awbBatch([$item->code]);
                        // $tracking = array_column($deltaBatch['data']['tracking'], 'tracking_id');
                        // $referenceMandatoryScan = $this->operationPattern($tracking, $item->expense->mandatory_scan);
                        $deltaScanCompliance = Delta::awbScanCompliance($item->code, $item->expense->with_scan, $item->expense->or_scan);
                        $referenceMandatoryScan = trim($deltaScanCompliance['msg']) === 'Data Found';
                    }
                }
            }
        }
        $validation_score = $validationReference + !$validationBillExist + $validationWeight + $referenceMandatoryScan + $referenceOpsPlan;
        $item->update([
            'area_id' => optional($area)->id,
            'sales_channel_id' => optional($salesChannel)->id,
            'product_id' => optional($product)->id,

            'validation_reference' => $validationReference,
            'validation_bill' => !$validationBillExist,
            'validation_weight' => $validationWeight,
            'validation_scan_compliance' => $referenceMandatoryScan,
            'validation_ops_plan' => $referenceOpsPlan,

            'delta_weight' => $delta['data'][0]['tot_weight'],
            'delta_weight_dim' => $delta['data'][0]['tot_dimensi'],
            'delta_weight_actual' => $delta['data'][0]['tot_act_weight'],

            'validation_score' => $validation_score,
            'is_validated' => true,

            'dist' => implode('-', [
                $item->invoice->sbu->coa ?? null,
                optional($area)->coa ?? null,
                $item->costCenter->cost_center ?? null,
                $item->expense->coa ?? $item->expense_coa,
                optional($salesChannel)->coa ?? null,
                optional($product)->coa ?? null,
                $item->invoice->interco->coa ?? null,
                '0000',
                '0000',
            ])
        ]);
    }

    public function validationSMU($item)
    {
        $delta = Delta::smu($item->code);

        /**
         * Validation
         */
        $validationReference = false;
        $validationBillExist = false;
        $validationWeight = false;
        $referenceMandatoryScan = false;
        $referenceOpsPlan = true;

        /**
         * Weight
         */
        $totalWeightSmu = 0;
        $totalWeightAwb = 0;
        $totalWeightDim = 0;
        $totalWeightActual = 0;

        $validationReference = (trim($delta['msg']) == 'Data Found') ? true : false;
        if ($validationReference) {
            $validationBillExist = $this->validationBill($item->id, $item->expense_id, $item->code);
            if (!$validationBillExist) {
                $validationWeight = $delta['data']['total_weight_smu'] == $item->weight ? true : false;
                $totalWeightSmu = $delta['data']['total_weight_smu'];
                $totalWeightAwb = $delta['data']['tot_weight_all_awb'];
                $totalWeightDim = $delta['data']['tot_weight_dim_all_awb'];
                $totalWeightActual = $delta['data']['tot_weight_actual_all_awb'];

                if ($validationWeight) {
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
                    }
                }
            }
        }
        $validation_score = $validationReference + !$validationBillExist + $validationWeight + $referenceMandatoryScan + $referenceOpsPlan;
        $item->update([
            'validation_reference' => $validationReference,
            'validation_bill' => !$validationBillExist,
            'validation_weight' => $validationWeight,
            'validation_scan_compliance' => $referenceMandatoryScan,
            'validation_ops_plan' => $referenceOpsPlan,

            'total_weight_smu' => $totalWeightSmu,
            'total_weight_awb' => $totalWeightAwb,
            'total_weight_dim' => $totalWeightDim,
            'total_weight_actual' => $totalWeightActual,

            'validation_score' => $validation_score,
            'is_validated' => true,
        ]);
        if ($validation_score == 5) {
            $awbItems = [];
            foreach ($delta['data']['airwaybill'] as $awbItem) {
                if ($awbItem['awb']) {
                    $deltaAwb = Delta::awbDetail($awbItem['awb']);
                    $area = $this->getArea($deltaAwb['data'][0]['origin']);
                    $salesChannel = $this->getSalesChannel($deltaAwb['data'][0]['sales_channel']);
                    $product = $this->getProduct($deltaAwb['data'][0]['service_type_id']);

                    $amount = ($item->amount * ($awbItem['total_weight_awb'] / $delta['data']['tot_weight_all_awb']));
                    $percentage = (($awbItem['total_weight_awb'] / $delta['data']['tot_weight_all_awb']) * 100);

                    $tax = 0;
                    $withholding = 0;
                    $amountAfterTax = $amount;
                    if ($item->tax && $item->withholding) {
                        $tax = ($amount * $item->tax->deduction);
                        $withholding = ($amount * $item->withholding->deduction);

                        $amountAfterTax = $amount + $tax - $withholding;
                    }

                    $awbItems[] = [
                        'invoice_id' => $item->invoice_id,
                        'expense_id' => $item->expense_id,
                        'cost_center_id' => $item->cost_center_id,
                        'tax_id' => $item->tax_id,
                        'withholding_id' => $item->withholding_id,
                        'code' => $awbItem['awb'],
                        'weight' => $awbItem['total_weight_awb'],
                        'delta_weight' => $awbItem['total_weight_awb'],
                        'delta_weight_actual' => $awbItem['total_weight_actual'],
                        'delta_weight_dim' => $awbItem['total_weight_dim'],

                        'area_id' => $area->id,
                        'sales_channel_id' => $salesChannel->id,
                        'product_id' => $product->id,

                        'amount' => $amount,
                        'delta_amount' => $amount,
                        'delta_percentage' => $percentage,

                        'vat_tax' => $tax,
                        'withholding_tax' => $withholding,
                        'amount_after_tax' => $amountAfterTax,

                        'dist' => implode('-', [
                            $item->invoice->sbu->coa ?? null,
                            $area->coa ?? null,
                            $item->costCenter->cost_center ?? null,
                            $item->expense->coa ?? $item->expense_coa,
                            $salesChannel->coa ?? null,
                            $product->coa ?? null,
                            $item->invoice->interco->coa ?? null,
                            '0000',
                            '0000',
                        ])
                    ];
                }
            }
            $item->awbItems()->createMany($awbItems);
        }
    }

    public function validationBill($id, $expense, $code)
    {
        return InvoiceItem::where('id', '!=', $id)
            ->where('expense_id', $expense)
            ->where('code', $code)
            ->exists();
    }

    public function getSalesChannel($code)
    {
        return SalesChannel::where('code', $code)->select(['id', 'coa'])->first();
    }

    public function getArea($code)
    {
        return Area::where('code', $code)->select(['id', 'coa'])->first();
    }

    public function getProduct($code)
    {
        return Product::where('code', $code)->select(['id', 'coa'])->first();
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
