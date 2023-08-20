<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

use App\Traits\Signature;

class InvoiceExpense extends Model
{
    use HasFactory, LogsActivity, Signature;

    const TYPE_SMU = 1;
    const TYPE_AWB = 2;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'uuid',
        'sequence_number',

        'invoice_id',
        'expense_id',
        'cost_center_id',
        'sales_channel_id',
        'product_id',
        'area_id',
        'tax_id',
        'withholding_id',

        'type',

        'total_amount',
        'total_amount_after_tax',

        'total_weight',
        'total_weight_smu',
        'total_weight_all_awb',
        'total_weight_dim_all_awb',
        'total_weight_actual_all_awb',

        'total_withholding_tax',
        'total_vat_tax',
        'grand_total',

        'total_valid_amount',
        'total_invalid_amount',

        'total_valid_validation_reference',
        'total_valid_validation_weight',
        'total_valid_validation_scan_compliance',
        'total_valid_validation_ops_plan',
        'total_valid_validation_bill',

        'total_weight_validation_reference',
        'total_weight_validation_weight',
        'total_weight_validation_scan_compliance',
        'total_weight_validation_ops_plan',
        'total_weight_validation_bill',

        'total_validation_reference',
        'total_validation_weight',
        'total_validation_scan_compliance',
        'total_validation_ops_plan',
        'total_validation_bill',
        'total_validation_score',

        'created_by',
        'updated_by'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'total_amount'                              => 'float',
        'total_amount_after_tax'                    => 'float',

        'total_weight'                              => 'float',
        'total_weight_smu'                          => 'float',
        'total_weight_all_awb'                      => 'float',
        'total_weight_dim_all_awb'                  => 'float',
        'total_weight_actual_all_awb'               => 'float',

        'total_withholding_tax'                     => 'float',
        'total_vat_tax'                             => 'float',
        'grand_total'                               => 'float',

        'total_valid_amount'                        => 'float',
        'total_invalid_amount'                      => 'float',

        'total_weight_validation_reference'         => 'float',
        'total_weight_validation_weight'            => 'float',
        'total_weight_validation_scan_compliance'   => 'float',
        'total_weight_validation_ops_plan'          => 'float',
        'total_weight_validation_bill'              => 'float',

        'total_validation_reference'                => 'integer',
        'total_validation_weight'                   => 'integer',
        'total_validation_scan_compliance'          => 'integer',
        'total_validation_ops_plan'                 => 'integer',
        'total_validation_bill'                     => 'integer',

        'total_valid_amount_validation_reference'          => 'float',
        'total_valid_amount_validation_weight'             => 'float',
        'total_valid_amount_validation_scan_compliance'    => 'float',
        'total_valid_amount_validation_ops_plan'           => 'float',
        'total_valid_amount_validation_bill'               => 'float',

        'total_invalid_amount_validation_reference'          => 'float',
        'total_invalid_amount_validation_weight'             => 'float',
        'total_invalid_amount_validation_scan_compliance'    => 'float',
        'total_invalid_amount_validation_ops_plan'           => 'float',
        'total_invalid_amount_validation_bill'               => 'float',
    ];

    protected $appends = ['excel_file'];

    public function getExcelFileAttribute()
    {

        return null;
    }

    /**
     * Get the invoice that owns the invoice item.
     */
    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }

    /**
     * Get the expense that owns the invoice item.
     */
    public function expense()
    {
        return $this->belongsTo(Expense::class);
    }

    /**
     * Get the cost center that owns the invoice item.
     */
    public function costCenter()
    {
        return $this->belongsTo(CostCenter::class);
    }

    /**
     * Get the sales channel tax that owns the invoice item.
     */
    public function salesChannel()
    {
        return $this->belongsTo(SalesChannel::class);
    }

    /**
     * Get the product that owns the invoice item.
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Get the area that owns the invoice item.
     */
    public function area()
    {
        return $this->belongsTo(Area::class);
    }

    /**
     * Get the tax that owns the invoice item.
     */
    public function tax()
    {
        return $this->belongsTo(Tax::class);
    }

    /**
     * Get the withholding tax that owns the invoice item.
     */
    public function withholding()
    {
        return $this->belongsTo(Withholding::class);
    }

    /**
     * Get the smu items for the invoice.
     */
    public function smuItems()
    {
        return $this->hasMany(InvoiceSmu::class, 'invoice_expense_id')->latest()->orderBy('validation_score');
    }

    /**
     * Get the awb items for the invoice.
     */
    public function awbItems()
    {
        return $this->hasMany(InvoiceAwb::class, 'invoice_expense_id')->latest()->orderBy('validation_score');
    }

    /**
     * Logging activity history.
     */
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName((new self)->getTable())
            ->logOnly($this->fillable)
            ->logOnlyDirty();
    }
}
