<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ops_plans', function (Blueprint $table) {
            $table->id();
            $table->string('service_type')->nullable();
            $table->string('origin_city')->nullable();
            $table->string('origin_station')->nullable();
            $table->string('pick_up_served_by')->nullable();
            $table->string('hub_origin')->nullable();
            $table->string('scan_origin')->nullable();
            $table->string('dest_city')->nullable();
            $table->string('dest_station')->nullable();
            $table->string('delivery_served_by')->nullable();
            $table->string('hub_dest')->nullable();
            $table->string('scan_dest')->nullable();
            $table->string('is_active')->nullable();
            $table->boolean('pick_up_cost')->nullable();
            $table->boolean('agent_pickup')->nullable();
            $table->boolean('vendor_pickup')->nullable();
            $table->boolean('outlet_dropoff')->nullable();
            $table->boolean('consolidator_pickup')->nullable();
            $table->boolean('shuttle_to_hub_consol_origin')->nullable();
            $table->boolean('shuttle_pup_consolagent_origin')->nullable();
            $table->boolean('mde')->nullable();
            $table->boolean('sorting_origin')->nullable();
            $table->boolean('handover_to_vendor_origin')->nullable();
            $table->boolean('shuttle_origin')->nullable();
            $table->boolean('trucking_firstmile_rpx')->nullable();
            $table->boolean('trucking_firstmile_vendor')->nullable();
            $table->boolean('kereta_firstmile')->nullable();
            $table->boolean('smu_firstmile')->nullable();
            $table->string('hub_station_origin')->nullable();
            $table->boolean('receive_shipment_origin')->nullable();
            $table->boolean('hub_origin_rpx')->nullable();
            $table->boolean('hub_origin_vendor')->nullable();
            $table->boolean('warehouse_in_edc')->nullable();
            $table->boolean('shuttle_penarikan_edc')->nullable();
            $table->boolean('sorting_edc')->nullable();
            $table->boolean('shuttle_to_ra')->nullable();
            $table->boolean('trucking_middlemile')->nullable();
            $table->boolean('kereta_middlemile')->nullable();
            $table->boolean('smu_middlemile')->nullable();
            $table->string('hub_station_dest')->nullable();
            $table->boolean('receive_shipment_dest')->nullable();
            $table->boolean('hub_dest_rpx')->nullable();
            $table->boolean('hub_dest_vendor')->nullable();
            $table->boolean('warehouse_in_dest')->nullable();
            $table->boolean('shuttle_penarikan_dest')->nullable();
            $table->boolean('sorting_dest')->nullable();
            $table->boolean('rpx_delivery')->nullable();
            $table->boolean('shuttle_to_consolagent_dest')->nullable();
            $table->boolean('hub_consol_to_consolidator_dest')->nullable();
            $table->boolean('consolidator_delivery')->nullable();
            $table->boolean('agent_delivery')->nullable();
            $table->boolean('vendor_delivery')->nullable();
            $table->boolean('outlet_handling_delivery')->nullable();

            $table->unsignedInteger('created_by')->nullable();
            $table->unsignedInteger('updated_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ops_plans');
    }
};
