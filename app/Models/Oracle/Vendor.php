<?php

namespace App\Models\Oracle;

use Yajra\Oci8\Eloquent\OracleEloquent as Eloquent;

class Vendor extends Eloquent
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
    protected $table = 'AP.AP_SUPPLIERS';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'vendor_id';

    /**
     * Get the sites for the vendor.
     */
    public function sites()
    {
        return $this->hasMany(VendorSite::class, 'vendor_id', 'vendor_id');
    }
}
