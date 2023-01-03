<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

use App\Traits\Signature;

class OpsPlan extends Model
{
    use HasFactory, SoftDeletes, Signature;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'service_type',
        'origin_city',
        'origin_station',
        'pick_up_served_by',
        'hub_origin',
        'scan_origin',
        'dest_city',
        'dest_station',
        'delivery_served_by',
        'hub_dest',
        'scan_dest',
        'is_active',
        'pick_up_cost',
        'agent_pickup',
        'vendor_pickup',
        'outlet_dropoff',
        'consolidator_pickup',
        'shuttle_to_hub_consol_origin',
        'shuttle_pup_consolagent_origin',
        'mde',
        'sorting_origin',
        'handover_to_vendor_origin',
        'shuttle_origin',
        'trucking_firstmile_rpx',
        'trucking_firstmile_vendor',
        'kereta_firstmile',
        'smu_firstmile',
        'hub_station_origin',
        'receive_shipment_origin',
        'hub_origin_rpx',
        'hub_origin_vendor',
        'warehouse_in_edc',
        'shuttle_penarikan_edc',
        'sorting_edc',
        'shuttle_to_ra',
        'trucking_middlemile',
        'kereta_middlemile',
        'smu_middlemile',
        'hub_station_dest',
        'receive_shipment_dest',
        'hub_dest_rpx',
        'hub_dest_vendor',
        'warehouse_in_dest',
        'shuttle_penarikan_dest',
        'sorting_dest',
        'rpx_delivery',
        'shuttle_to_consolagent_dest',
        'hub_consol_to_consolidator_dest',
        'consolidator_delivery',
        'agent_delivery',
        'vendor_delivery',
        'outlet_handling_delivery',
        'created_by',
        'updated_by',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'pick_up_cost'                      => 'boolean',
        'agent_pickup'                      => 'boolean',
        'vendor_pickup'                     => 'boolean',
        'outlet_dropoff'                    => 'boolean',
        'consolidator_pickup'               => 'boolean',
        'shuttle_to_hub_consol_origin'      => 'boolean',
        'shuttle_pup_consolagent_origin'    => 'boolean',
        'mde'                               => 'boolean',
        'sorting_origin'                    => 'boolean',
        'handover_to_vendor_origin'         => 'boolean',
        'shuttle_origin'                    => 'boolean',
        'trucking_firstmile_rpx'            => 'boolean',
        'trucking_firstmile_vendor'         => 'boolean',
        'kereta_firstmile'                  => 'boolean',
        'smu_firstmile'                     => 'boolean',
        'receive_shipment_origin'           => 'boolean',
        'hub_origin_rpx'                    => 'boolean',
        'hub_origin_vendor'                 => 'boolean',
        'warehouse_in_edc'                  => 'boolean',
        'shuttle_penarikan_edc'             => 'boolean',
        'sorting_edc'                       => 'boolean',
        'shuttle_to_ra'                     => 'boolean',
        'trucking_middlemile'               => 'boolean',
        'kereta_middlemile'                 => 'boolean',
        'smu_middlemile'                    => 'boolean',
        'receive_shipment_dest'             => 'boolean',
        'hub_dest_rpx'                      => 'boolean',
        'hub_dest_vendor'                   => 'boolean',
        'warehouse_in_dest'                 => 'boolean',
        'shuttle_penarikan_dest'            => 'boolean',
        'sorting_dest'                      => 'boolean',
        'rpx_delivery'                      => 'boolean',
        'shuttle_to_consolagent_dest'       => 'boolean',
        'hub_consol_to_consolidator_dest'   => 'boolean',
        'consolidator_delivery'             => 'boolean',
        'agent_delivery'                    => 'boolean',
        'vendor_delivery'                   => 'boolean',
        'outlet_handling_delivery'          => 'boolean',
    ];
}
