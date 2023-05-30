<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

use App\Traits\Signature;

class InvoiceSmu extends Model
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
        'expense_id',
        'cost_center_id',

        'tax_id',
        'withholding_id',

        'code',
        'type',
        'route',
        'date_item',

        'weight',
        'amount',
        'total_weight_awb',
        'total_weight_dim',
        'total_weight_actual',

        'withholding_tax',
        'vat_tax',
        'total',

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
        'weight'                        => 'float',
        'amount'                        => 'float',
        'total_weight_awb'              => 'float',
        'total_weight_dim'              => 'float',
        'total_weight_actual'           => 'float',

        'withholding_tax'               => 'float',
        'vat_tax'                       => 'float',
        'total'                         => 'float',

        'validation_reference'          => 'boolean',
        'validation_weight'             => 'boolean',
        'validation_scan_compliance'    => 'boolean',
        'validation_ops_plan'           => 'boolean',
        'validation_bill'               => 'boolean',
        'is_validated'                  => 'boolean',
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