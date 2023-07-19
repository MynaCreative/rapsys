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

        'invoice_id',
        'invoice_expense_id',
        'expense_id',
        'cost_center_id',
        'sales_channel_id',
        'product_id',
        'area_id',
        'tax_id',
        'withholding_id',

        'dist',
        'code',
        'type',
        'expense_coa',
        'route',
        'date_item',

        'amount',
        'amount_after_tax',

        'weight',

        'withholding_tax',
        'vat_tax',
        'total',

        'description',

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
        'amount_after_tax'              => 'float',

        'weight'                        => 'float',

        'withholding_tax'               => 'float',
        'vat_tax'                       => 'float',
        'total'                         => 'float',
    ];

    /**
     *
     * @param  string  $value
     * @return void
     */
    public function setUpdatedAtAttribute($value)
    {
        $this->attributes['updated_at'] = $value;

        $amount = $this->amount;
        $tax = 0;
        $withholding = 0;
        $amountAfterTax = $amount;
        if ($this->tax && $this->withholding) {
            $tax = ($amount * $this->tax->deduction);
            $withholding = ($amount * $this->withholding->deduction);

            $amountAfterTax = $amount + $tax - $withholding;
        }
        $this->attributes['vat_tax'] = $tax;
        $this->attributes['withholding_tax'] = $withholding;
        $this->attributes['total'] = $amountAfterTax;
        $this->attributes['amount_after_tax'] = $amountAfterTax;

        $this->attributes['dist'] = implode('-', [
            $this->invoice->sbu->coa ?? null,
            $this->area->coa ?? null,
            $this->costCenter->cost_center ?? null,
            $this->expense_coa ?? null,
            $this->salesChannel->coa ?? null,
            $this->product->coa ?? null,
            $this->invoice->interco->coa ?? null,
            '0000',
            '0000',
        ]);
    }

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
