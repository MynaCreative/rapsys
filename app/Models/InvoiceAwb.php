<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

use App\Traits\Signature;

class InvoiceAwb extends Model
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
        'invoice_expense_id',
        'invoice_smu_id',

        'expense_id',
        'cost_center_id',
        'sales_channel_id',
        'product_id',
        'area_id',
        'tax_id',
        'withholding_id',

        'dist',
        'smu',
        'code',
        'route',
        'date_item',
        'scan_compliance',

        'amount',
        'vat_tax',
        'withholding_tax',
        'amount_after_tax',

        'weight',
        'delta_weight',
        'delta_weight_dim',
        'delta_weight_actual',
        'delta_amount',
        'delta_percentage',

        'description',

        'validation_reference',
        'validation_weight',
        'validation_scan_compliance',
        'validation_ops_plan',
        'validation_bill',
        'validation_score',

        'is_validated',
        'message',

        'created_by',
        'updated_by'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'amount'                        => 'float',
        'vat_tax'                       => 'float',
        'withholding_tax'               => 'float',
        'amount_after_tax'              => 'float',

        'weight'                        => 'float',
        'delta_weight'                  => 'float',
        'delta_weight_dim'              => 'float',
        'delta_weight_actual'           => 'float',
        'delta_amount'                  => 'float',
        'delta_percentage'              => 'float',

        'validation_reference'          => 'boolean',
        'validation_weight'             => 'boolean',
        'validation_scan_compliance'    => 'boolean',
        'validation_ops_plan'           => 'boolean',
        'validation_bill'               => 'boolean',
        'is_validated'                  => 'boolean',
        'scan_compliance'               => 'json',
    ];

    /**
     * Get the invoice that owns the invoice item.
     */
    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }

    /**
     * Get the invoice expense that owns the invoice item.
     */
    public function invoiceExpense()
    {
        return $this->belongsTo(InvoiceExpense::class);
    }

    /**
     * Get the invoice smu that owns the invoice item.
     */
    public function invoiceSmu()
    {
        return $this->belongsTo(InvoiceSmu::class);
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
