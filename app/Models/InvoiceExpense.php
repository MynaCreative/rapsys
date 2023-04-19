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

        'total_weight',
        'total_amount',
        'total_delta_weight',
        'total_delta_amount',

        'total_withholding_tax',
        'total_vat_tax',
        'grand_total',

        'validation_reference',
        'validation_weight',
        'validation_scan_compliance',
        'validation_ops_plan',
        'validation_bill',
        'validation_score',

        'created_by',
        'updated_by'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'total_weight'                  => 'float',
        'total_amount'                  => 'float',
        'total_delta_weight'            => 'float',
        'total_delta_amount'            => 'float',

        'total_withholding_tax'         => 'float',
        'total_vat_tax'                 => 'float',
        'grand_total'                   => 'float',

        'validation_reference'          => 'boolean',
        'validation_weight'             => 'boolean',
        'validation_scan_compliance'    => 'boolean',
        'validation_ops_plan'           => 'boolean',
        'validation_bill'               => 'boolean',
    ];

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
