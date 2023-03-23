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
     * Get the invoice that owns the model.
     */
    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }
}
