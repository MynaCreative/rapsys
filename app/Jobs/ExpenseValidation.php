<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Http\Client\Response;

use App\Models\InvoiceExpense;

class ExpenseValidation implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The invoice instance.
     *
     * @var \App\Models\Invoice
     */
    public $expense;

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
    public function __construct(InvoiceExpense $expense)
    {
        $this->expense = $expense;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if ($this->expense->type == InvoiceExpense::TYPE_AWB) {
            $this->summaryAWB($this->expense);
        }
        if ($this->expense->type == InvoiceExpense::TYPE_SMU) {
            $this->summarySMU($this->expense);
        }
    }

    public function summaryAWB($expense)
    {
        $expense->update([
            'total_amount' => $expense->awbItems->sum('amount'),
            'total_amount_after_tax' => $expense->awbItems->sum('amount_after_tax'),

            'total_weight' => $expense->awbItems->sum('weight'),
            'total_weight_all_awb' => $expense->awbItems->sum('delta_weight'),
            'total_weight_dim_all_awb' => $expense->awbItems->sum('delta_weight_dim'),
            'total_weight_actual_all_awb' => $expense->awbItems->sum('delta_weight_actual'),

            'total_withholding_tax' => $expense->awbItems->sum('withholding_tax'),
            'total_vat_tax' => $expense->awbItems->sum('vat_tax'),
            'grand_total' => $expense->awbItems->sum('amount_after_tax'),

            'total_valid_amount' => $expense->awbItems->where('validation_reference', 1)->sum('amount'),
            'total_invalid_amount' => $expense->awbItems->where('validation_reference', 0)->sum('amount'),

            'total_valid_amount_validation_reference' => $expense->awbItems->where('validation_reference', 1)->sum('amount'),
            'total_valid_amount_validation_weight' => $expense->awbItems->where('validation_weight', 1)->sum('amount'),
            'total_valid_amount_validation_scan_compliance' => $expense->awbItems->where('validation_scan_compliance', 1)->sum('amount'),
            'total_valid_amount_validation_ops_plan' => $expense->awbItems->where('validation_ops_plan', 1)->sum('amount'),
            'total_valid_amount_validation_bill' => $expense->awbItems->where('validation_bill', 1)->sum('amount'),

            'total_invalid_amount_validation_reference' => $expense->awbItems->where('validation_reference', 0)->sum('amount'),
            'total_invalid_amount_validation_weight' => $expense->awbItems->where('validation_weight', 0)->sum('amount'),
            'total_invalid_amount_validation_scan_compliance' => $expense->awbItems->where('validation_scan_compliance', 0)->sum('amount'),
            'total_invalid_amount_validation_ops_plan' => $expense->awbItems->where('validation_ops_plan', 0)->sum('amount'),
            'total_invalid_amount_validation_bill' => $expense->awbItems->where('validation_bill', 0)->sum('amount'),

            'total_weight_validation_reference' => $expense->awbItems->where('validation_reference', 0)->sum('weight'),
            'total_weight_validation_weight' => $expense->awbItems->where('validation_weight', 0)->sum('weight'),
            'total_weight_validation_scan_compliance' => $expense->awbItems->where('validation_scan_compliance', 0)->sum('weight'),
            'total_weight_validation_ops_plan' => $expense->awbItems->where('validation_ops_plan', 0)->sum('weight'),
            'total_weight_validation_bill' => $expense->awbItems->where('validation_bill', 0)->sum('weight'),

            'total_validation_reference' => $expense->awbItems->where('validation_reference', 0)->count(),
            'total_validation_weight' => $expense->awbItems->where('validation_weight', 0)->count(),
            'total_validation_scan_compliance' => $expense->awbItems->where('validation_scan_compliance', 0)->count(),
            'total_validation_ops_plan' => $expense->awbItems->where('validation_ops_plan', 0)->count(),
            'total_validation_bill' => $expense->awbItems->where('validation_bill', 0)->count(),
            'total_validation_score' => $expense->awbItems->sum('validation_score'),
        ]);
    }

    public function summarySMU($expense)
    {
        $expense->update([
            'total_amount' => $expense->smuItems->sum('amount'),
            'total_amount_after_tax' => $expense->smuItems->sum('amount_after_tax'),

            'total_valid_amount' => $expense->smuItems->where('validation_reference', 1)->sum('amount'),
            'total_invalid_amount' => $expense->smuItems->where('validation_reference', 0)->sum('amount'),

            'total_weight' => $expense->smuItems->sum('weight'),
            'total_weight_smu' => $expense->smuItems->sum('total_weight_smu'),
            'total_weight_all_awb' => $expense->smuItems->sum('total_weight_awb'),
            'total_weight_dim_all_awb' => $expense->smuItems->sum('total_weight_dim'),
            'total_weight_actual_all_awb' => $expense->smuItems->sum('total_weight_actual'),

            'total_withholding_tax' => $expense->smuItems->sum('withholding_tax'),
            'total_vat_tax' => $expense->smuItems->sum('vat_tax'),
            'grand_total' => $expense->smuItems->sum('amount_after_tax'),

            'total_valid_amount_validation_reference' => $expense->smuItems->where('validation_reference', 1)->sum('amount'),
            'total_valid_amount_validation_weight' => $expense->smuItems->where('validation_weight', 1)->sum('amount'),
            'total_valid_amount_validation_scan_compliance' => $expense->smuItems->where('validation_scan_compliance', 1)->sum('amount'),
            'total_valid_amount_validation_ops_plan' => $expense->smuItems->where('validation_ops_plan', 1)->sum('amount'),
            'total_valid_amount_validation_bill' => $expense->smuItems->where('validation_bill', 1)->sum('amount'),

            'total_invalid_amount_validation_reference' => $expense->smuItems->where('validation_reference', 0)->sum('amount'),
            'total_invalid_amount_validation_weight' => $expense->smuItems->where('validation_weight', 0)->sum('amount'),
            'total_invalid_amount_validation_scan_compliance' => $expense->smuItems->where('validation_scan_compliance', 0)->sum('amount'),
            'total_invalid_amount_validation_ops_plan' => $expense->smuItems->where('validation_ops_plan', 0)->sum('amount'),
            'total_invalid_amount_validation_bill' => $expense->smuItems->where('validation_bill', 0)->sum('amount'),

            'total_weight_validation_reference' => $expense->smuItems->where('validation_reference', 0)->sum('weight'),
            'total_weight_validation_weight' => $expense->smuItems->where('validation_weight', 0)->sum('weight'),
            'total_weight_validation_scan_compliance' => $expense->smuItems->where('validation_scan_compliance', 0)->sum('weight'),
            'total_weight_validation_ops_plan' => $expense->smuItems->where('validation_ops_plan', 0)->sum('weight'),
            'total_weight_validation_bill' => $expense->smuItems->where('validation_bill', 0)->sum('weight'),

            'total_validation_reference' => $expense->smuItems->where('validation_reference', 0)->count(),
            'total_validation_weight' => $expense->smuItems->where('validation_weight', 0)->count(),
            'total_validation_scan_compliance' => $expense->smuItems->where('validation_scan_compliance', 0)->count(),
            'total_validation_ops_plan' => $expense->smuItems->where('validation_ops_plan', 0)->count(),
            'total_validation_bill' => $expense->smuItems->where('validation_bill', 0)->count(),
            'total_validation_score' => $expense->smuItems->sum('validation_score'),
        ]);
    }
}
