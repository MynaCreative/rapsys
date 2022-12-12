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
        'code',
        'awb',
        'smu',
        'document_index',

        'invoice_id',
        'product_id',
        'area_id',

        'withholding_tax_id',
        'vat_tax_id',

        'quantity',
        'price',
        'delta_weight_smu',
        'delta_weight_awb',
        'invoice_weight_smu',
        'invoice_weight_awb',
        'withholding_tax',
        'vat_tax',
        'tax_base',
        'amount_awb',
        'amount_smu',
        'amount_awb_smu',

        'description',

        'validation_reference',
        'validation_weight',
        'validation_scan_compliance',
        'validation_ops_plan',
        'validation_bill',

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
        'quantity'                      => 'float',
        'price'                         => 'float',
        'delta_weight_smu'              => 'float',
        'delta_weight_awb'              => 'float',
        'invoice_weight_smu'            => 'float',
        'invoice_weight_awb'            => 'float',
        'withholding_tax'               => 'float',
        'vat_tax'                       => 'float',
        'tax_base'                      => 'float',
        'amount_awb'                    => 'float',
        'amount_smu'                    => 'float',
        'amount_awb_smu'                => 'float',

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
     * Get the withholding tax that owns the invoice item.
     */
    public function withholdingTax()
    {
        return $this->belongsTo(Tax::class);
    }

    /**
     * Get the vat tax that owns the invoice item.
     */
    public function vatTax()
    {
        return $this->belongsTo(Tax::class);
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
