<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Bus\Batchable;
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
    use Batchable, Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

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
    public $timeout = 10000;
    public $memory = 2048;

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
        $area = null;
        $product = null;
        $salesChannel = null;
        $areaId = null;
        $productId = null;
        $salesChannelId = null;
        $messages = [];

        $validationReference = (trim($delta['msg']) == 'Data Found') ? true : false;
        if ($validationReference || $item->validation_reference) {
            if (isset($delta['data'][0]['origin'])) {
                $area = $this->getArea($delta['data'][0]['origin']);
                if ($area) {
                    $areaId = optional($area)->id;
                } else {
                    $messages[] = "Area: '" . $delta['data'][0]['origin'] . "' not found in RAPsys database";
                }
            } else {
                $messages[] = "AWB: '" . $item->code . "' doesn't have origin";
            }
            if (isset($delta['data'][0]['sales_channel'])) {
                $salesChannel = $this->getSalesChannel($delta['data'][0]['sales_channel']);
                if ($salesChannel) {
                    $salesChannelId = optional($salesChannel)->id;
                } else {
                    $messages[] = "Sales Channel: '" . $delta['data'][0]['sales_channel'] . "' not found in RAPsys database";
                }
            } else {
                $messages[] = "AWB: '" . $item->code . "' doesn't have sales_channel";
            }
            if (isset($delta['data'][0]['service_type_id'])) {
                $product = $this->getProduct($delta['data'][0]['service_type_id']);
                if ($product) {
                    $productId = optional($product)->id;
                } else {
                    $messages[] = "Product: '" . $delta['data'][0]['service_type_id'] . "' not found in RAPsys database";
                }
            } else {
                $messages[] = "AWB: '" . $item->code . "' doesn't have service_type_id";
            }
            // $validationBillExist = $this->validationBill($item->id, $item->expense_id, $item->code);
            $validationBillExist = false;
            if ((!$validationBillExist && $area && $salesChannel && $product) || $item->validation_bill) {
                $validationWeight = $delta['data'][0]['tot_weight'] == $item->weight ? true : false;
                if ($validationWeight || $item->validation_weight) {
                    if ($item->expense->mandatory_scan) {
                        // $deltaBatch = Delta::awbBatch([$item->code]);
                        // $tracking = array_column($deltaBatch['data']['tracking'], 'tracking_id');
                        // $referenceMandatoryScan = $this->operationPattern($tracking, $item->expense->mandatory_scan);
                        $deltaScanCompliance = Delta::awbScanCompliance($item->code, $item->expense->with_scan, $item->expense->or_scan);
                        $referenceMandatoryScan = trim($deltaScanCompliance['msg']) === 'Data Found';
                        if (!$referenceMandatoryScan) {
                            $messages[] = "AWB: '" . $item->code . "' not passed scan compliance";
                        }
                    } else {
                        $messages[] = "Expense doesn't have mandatory scan";
                    }
                } else {
                    $messages[] = "AWB: '" . $item->code . "' weight is : {$item->weight} but delta is : " . $delta['data'][0]['tot_weight'];
                }
            } else {
                $messages[] = "AWB: '" . $item->code . "' already billed";
            }
        } else {
            $messages[] = "AWB: '" . $item->code . "' not found in Delta API";
        }
        $validation_score = $validationReference + !$validationBillExist + $validationWeight + $referenceMandatoryScan + $referenceOpsPlan;

        $tax = 0;
        $withholding = 0;
        $amountAfterTax = $item->amount;
        if ($item->tax && $item->withholding) {
            $tax = (float) ($item->amount * $item->tax->deduction);
            $withholding = (float) ($item->amount * $item->withholding->deduction);

            $amountAfterTax = (float) ($item->amount + $tax - $withholding);
        }

        $item->update([
            'area_id' => $areaId,
            'product_id' => $productId,
            'sales_channel_id' => $salesChannelId,

            'amount' => $item->amount,
            'delta_amount' => $item->amount,
            'delta_percentage' => 0,

            'vat_tax' => $tax,
            'withholding_tax' => $withholding,
            'amount_after_tax' => $amountAfterTax,

            'validation_reference' => $validationReference,
            'validation_bill' => !$validationBillExist,
            'validation_weight' => $validationWeight,
            'validation_scan_compliance' => $referenceMandatoryScan,
            'validation_ops_plan' => $referenceOpsPlan,

            'delta_weight' => $delta['data'][0]['tot_weight'] ?? null,
            'delta_weight_dim' => $delta['data'][0]['tot_dimensi'] ?? null,
            'delta_weight_actual' => $delta['data'][0]['tot_act_weight'] ?? null,

            'validation_score' => $validation_score,
            'is_validated' => true,
            'message' => count($messages) > 0 ? implode(', ', $messages) : null,

            'dist' => implode('-', [
                $item->invoice->sbu->coa ?? null,
                $area ? optional($area)->coa : null,
                $item->costCenter->cost_center ?? null,
                $item->expense->coa ?? $item->expense_coa,
                $salesChannel ? optional($salesChannel)->coa : null,
                $product ? optional($product)->coa : null,
                $item->invoice->interco->coa ?? null,
                '0000',
                '0000',
            ])
        ]);
    }

    public function validationSMU($item)
    {
        info($item->code);
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

        $messages = [];

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
                        if (!$referenceMandatoryScan) {
                            $messages[] = "SMU: '" . $item->code . "' not passed scan compliance";
                        }
                    } else {
                        $messages[] = "Expense doesn't have mandatory scan";
                    }
                } else {
                    $messages[] = "SMU: '" . $item->code . "' weight is : {$item->weight} but delta is : " . $delta['data']['total_weight_smu'];
                }
            }
        } else {
            $messages[] = "SMU: '" . $item->code . "' not found in Delta API";
        }
        $validation_score = $validationReference + !$validationBillExist + $validationWeight + $referenceMandatoryScan + $referenceOpsPlan;
        $awbItems = [];
        // if ($validation_score >= 2) {
        if (isset($delta['data']['airwaybill'])) {
            foreach ($delta['data']['airwaybill'] as $awbItem) {
                $awbMessages = [];
                $area = null;
                $product = null;
                $salesChannel = null;
                $areaId = null;
                $productId = null;
                $salesChannelId = null;
                if ($awbItem['awb']) {
                    $deltaAwb = Delta::awbDetail($awbItem['awb']);
                    if (trim($deltaAwb['msg']) == 'Data Found') {
                        if (isset($deltaAwb['data'][0]['origin'])) {
                            $area = $this->getArea($deltaAwb['data'][0]['origin']);
                            if ($area) {
                                $areaId = optional($area)->id;
                            } else {
                                $awbMessages[] = "Area: '" . $delta['data'][0]['origin'] . "' not found in RAPsys database";
                            }
                        } else {
                            $awbMessages[] = "AWB: '" . $awbItem['awb'] . "' doesn't have origin";
                        }
                        if (isset($deltaAwb['data'][0]['sales_channel'])) {
                            $salesChannel = $this->getSalesChannel($deltaAwb['data'][0]['sales_channel']);
                            if ($salesChannel) {
                                $salesChannelId = optional($salesChannel)->id;
                            } else {
                                $awbMessages[] = "Sales Channel: '" . $delta['data'][0]['sales_channel'] . "' not found in RAPsys database";
                            }
                        } else {
                            $awbMessages[] = "AWB: '" . $awbItem['awb'] . "' doesn't have sales_channel";
                        }
                        if (isset($deltaAwb['data'][0]['service_type_id'])) {
                            $product = $this->getProduct($deltaAwb['data'][0]['service_type_id']);
                            if ($product) {
                                $productId = optional($product)->id;
                            } else {
                                $awbMessages[] = "Product: '" . $delta['data'][0]['service_type_id'] . "' not found in RAPsys database";
                            }
                        } else {
                            $awbMessages[] = "AWB: '" . $awbItem['awb'] . "' doesn't have service_type_id";
                        }
                    } else {
                        $awbMessages[] = "AWB: '" . $awbItem['awb'] . "' not found in Delta API";
                    }

                    $percentage = (($awbItem['total_weight_awb'] / $delta['data']['tot_weight_all_awb']) * 100);
                    $amount = (float) ($item->amount * ($awbItem['total_weight_awb'] / $delta['data']['tot_weight_all_awb']));

                    $tax = 0;
                    $withholding = 0;
                    $amountAfterTax = $amount;
                    if ($item->tax && $item->withholding) {
                        $tax = (float) ($amount * $item->tax->deduction);
                        $withholding = (float) ($amount * $item->withholding->deduction);

                        $amountAfterTax = (float) ($amount + $tax - $withholding);
                    }

                    $awbItems[] = [
                        'invoice_id' => $item->invoice_id,
                        'expense_id' => $item->expense_id,
                        'invoice_expense_id' => $item->invoice_expense_id,
                        'cost_center_id' => $item->cost_center_id,
                        'tax_id' => $item->tax_id,
                        'withholding_id' => $item->withholding_id,
                        'smu' => $item->code,
                        'code' => $awbItem['awb'],
                        'weight' => $awbItem['total_weight_awb'],
                        'delta_weight' => $awbItem['total_weight_awb'],
                        'delta_weight_actual' => $awbItem['total_weight_actual'],
                        'delta_weight_dim' => $awbItem['total_weight_dim'],

                        'area_id' => $areaId,
                        'product_id' => $productId,
                        'sales_channel_id' => $salesChannelId,

                        'amount' => $amount,
                        'delta_amount' => $amount,
                        'delta_percentage' => $percentage,

                        'vat_tax' => $tax,
                        'withholding_tax' => $withholding,
                        'amount_after_tax' => $amountAfterTax,

                        'message' => count($awbMessages) > 0 ? implode(', ', $awbMessages) : null,
                        'validation_score' => count($awbMessages),
                        'is_validated' => 1,

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

            'message' => count($messages) > 0 ? implode(', ', $messages) : null,
            'awb_message' => count($awbItems) > 0 ? implode(', ', array_column($awbItems, 'message')) : null,
        ]);
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
        $data = SalesChannel::where('code', $code)->select(['id', 'coa'])->first();
        return $data ?? false;
    }

    public function getArea($code)
    {
        $data = Area::where('code', $code)->select(['id', 'coa'])->first();
        return $data ?? false;
    }

    public function getProduct($code)
    {
        $data = Product::where('code', $code)->select(['id', 'coa'])->first();
        return $data ?? false;
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
