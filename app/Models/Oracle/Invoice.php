<?php

namespace App\Models\Oracle;

use Yajra\Oci8\Eloquent\OracleEloquent as Eloquent;

use App\Traits\Scope as GeneralScope;

class Invoice extends Eloquent
{

    use GeneralScope;
    /**
     * The database connection that should be used by the model.
     *
     * @var string
     */
    protected $connection = 'oracle';

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'APPS.RAPSYS_AP_STG_HEADER';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Define the sequence name used for incrementing
     * Default value would be {table}_{primaryKey}_seq if not set
     */
    public $sequence = null;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'staging_id',
        'ledger_id',
        'org_id',
        'vendor_id',
        'vendor_site_id',
        'trx_number',
        'currency_code',
        'description',
        'amount',
        'ap_invoice_date',
        'ap_invoice_received_date',
        'ap_gl_date',
        'terms_id',
        'ap_source',
        'invoice_type_lookup_code',
        'payment_method_lookup_code',
        'status',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'amount' => 'float',
        'ap_invoice_date' => 'date',
        'ap_invoice_received_date' => 'date',
        'ap_gl_date' => 'date',
        'creation_date' => 'dateTime',
    ];

    /**
     * Get the items for the invoice.
     */
    public function items()
    {
        return $this->hasMany(InvoiceItem::class);
    }
}
