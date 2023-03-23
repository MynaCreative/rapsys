<?php

namespace App\Models\Oracle;

use Yajra\Oci8\Eloquent\OracleEloquent as Eloquent;

class VendorSite extends Eloquent
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
    protected $table = 'AP.AP_SUPPLIER_SITES_ALL';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'vendor_site_id';

    /**
     * Get the vendor that owns the model.
     */
    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'vendor_id', 'vendor_id');
    }
}
