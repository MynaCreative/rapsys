<?php

namespace App\Models\Oracle;

use Yajra\Oci8\Eloquent\OracleEloquent as Eloquent;

class Invoice extends Eloquent
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
    protected $table = 'APPS.RAPSYS_AP_STG_HEADER';

    /**
     * Get the items for the invoice.
     */
    public function items()
    {
        return $this->hasMany(InvoiceItem::class);
    }
}
