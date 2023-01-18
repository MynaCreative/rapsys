<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

use App\Traits\Signature;
use App\Traits\Scope as GeneralScope;

class Invoice extends Model
{
    use HasFactory, LogsActivity, GeneralScope, Signature;

    const DOCUMENT_STATUS_DRAFT     = 'draft';
    const DOCUMENT_STATUS_PUBLISHED = 'published';
    const DOCUMENT_STATUS_CANCELLED = 'cancelled';
    const DOCUMENT_STATUS_CLOSED    = 'closed';

    const APPROVAL_STATUS_NONE      = 'none';
    const APPROVAL_STATUS_PENDING   = 'pending';
    const APPROVAL_STATUS_APPROVED  = 'approved';
    const APPROVAL_STATUS_REJECTED  = 'rejected';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'uuid',
        'code',

        'invoice_type_id',
        'currency_id',
        'interco_id',
        'vendor_id',
        'term_id',
        'sbu_id',

        'invoice_number',
        'supplier_tax_invoice',

        'posting_date',
        'invoice_date',
        'invoice_receipt_date',
        'supplier_tax_invoice_date',

        'term_date',
        'due_date',

        'total_amount',
        'total_amount_valid',
        'total_amount_invalid',

        'document_status',
        'approval_status',
        'document_status_time',
        'approval_status_time',

        'note',
        'cancel_remark',
        'reject_remark',

        'published_at',
        'created_by',
        'updated_by'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'total_amount'              => 'decimal:4',
        'total_amount_valid'        => 'decimal:4',
        'total_amount_invalid'      => 'decimal:4',

        'document_status_time'      => 'datetime',
        'approval_status_time'      => 'datetime',
        'published_at'              => 'datetime',
    ];

    /**
     *
     * @param  string  $value
     * @return void
     */
    public function setCreatedAtAttribute($value)
    {
        $this->attributes['created_at'] = $value;
        $id = DB::table('INFORMATION_SCHEMA.TABLES')->select('AUTO_INCREMENT as id')
                ->where('TABLE_SCHEMA', DB::connection()->getDatabaseName())
                ->where('TABLE_NAME', (new self)->getTable())
                ->value('id');
        $this->attributes['code'] = 'INV'.sprintf('%03d', $id);
    }

    /**
     * Get the invoice type that owns the invoice.
     */
    public function invoiceType()
    {
        return $this->belongsTo(InvoiceType::class);
    }

    /**
     * Get the currency that owns the invoice.
     */
    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }

    /**
     * Get the interco that owns the invoice.
     */
    public function interco()
    {
        return $this->belongsTo(Interco::class);
    }

    /**
     * Get the vendor that owns the invoice.
     */
    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    /**
     * Get the term that owns the invoice.
     */
    public function term()
    {
        return $this->belongsTo(Term::class);
    }

    /**
     * Get the sbu that owns the invoice.
     */
    public function sbu()
    {
        return $this->belongsTo(Sbu::class);
    }

    /**
     * Get the items for the invoice.
     */
    public function items()
    {
        return $this->hasMany(InvoiceItem::class);
    }

    /**
     * Get the attachments for the invoice.
     */
    public function attachments()
    {
        return $this->hasMany(InvoiceAttachment::class);
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
