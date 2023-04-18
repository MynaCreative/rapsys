<?php

namespace App\Models\Oracle;

use Yajra\Oci8\Eloquent\OracleEloquent as Eloquent;

class InvoiceItem extends Eloquent
{
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
    protected $table = 'APPS.RAPSYS_AP_STG_LINE';

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
        'staging_line_id',
        'ledger_id',
        'org_id',
        'line_number',
        'description', 
        'line_type_code',
        'ppn_code',
        'tax_rate_id',
        'awt_group_id',
        'amount',
        'dist_code_concat',
    ];

    /**
     * Get the invoice that owns the model.
     */
    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }
}
