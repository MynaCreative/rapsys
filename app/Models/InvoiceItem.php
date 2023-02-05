<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

use App\Traits\Signature;

class InvoiceItem extends Model
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

        'code',
        'type',
        'expense_code',
        'awb',
        'smu',
        'route',
        'cost_center',
        'description',
        'date_smu',
        'date_awb',

        'invoice_id',
        'expense_id',
        'product_id',
        'area_id',

        'tax_id',
        'withholding_id',

        'delta_weight_smu',
        'delta_weight_awb',
        'invoice_weight_smu',
        'invoice_weight_awb',

        'amount_awb',
        'amount_smu',
        'amount_awb_smu',

        'withholding_tax',
        'vat_tax',
        'amount',

        'description',
        'is_manual',
        'is_validated',

        'validation_reference',
        'validation_weight',
        'validation_scan_compliance',
        'validation_ops_plan',
        'validation_bill',
        'validation_score',

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
        'delta_weight_smu'              => 'float',
        'delta_weight_awb'              => 'float',
        'invoice_weight_smu'            => 'float',
        'invoice_weight_awb'            => 'float',

        'amount_awb'                    => 'float',
        'amount_smu'                    => 'float',
        'amount_awb_smu'                => 'float',

        'withholding_tax'               => 'float',
        'vat_tax'                       => 'float',
        'amount'                        => 'float',

        'is_manual'                     => 'boolean',
        'is_validated'                  => 'boolean',
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
