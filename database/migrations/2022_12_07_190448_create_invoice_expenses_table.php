<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Models\Tax;
use App\Models\Area;
use App\Models\CostCenter;
use App\Models\Invoice;
use App\Models\Product;
use App\Models\Expense;
use App\Models\Withholding;
use App\Models\SalesChannel;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_expenses', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->nullable();
            $table->integer('sequence_number')->nullable();

            $table->foreignIdFor(Invoice::class)->nullable()->constrained();
            $table->foreignIdFor(Expense::class)->nullable()->constrained();
            $table->foreignIdFor(CostCenter::class)->nullable()->constrained();
            $table->foreignIdFor(SalesChannel::class)->nullable()->constrained();
            $table->foreignIdFor(Product::class)->nullable()->constrained();
            $table->foreignIdFor(Area::class)->nullable()->constrained();
            $table->foreignIdFor(Tax::class)->nullable()->constrained();
            $table->foreignIdFor(Withholding::class)->nullable()->constrained();

            $table->string('type')->nullable();

            $table->decimal('total_weight', 20, 4)->nullable()->default(0);
            $table->decimal('total_amount', 20, 4)->nullable()->default(0);
            $table->decimal('total_weight_smu', 20, 4)->nullable()->default(0);
            $table->decimal('total_weight_all_awb', 20, 4)->nullable()->default(0);
            $table->decimal('total_weight_dim_all_awb', 20, 4)->nullable()->default(0);
            $table->decimal('total_weight_actual_all_awb', 20, 4)->nullable()->default(0);

            $table->decimal('total_withholding_tax', 20, 4)->nullable()->default(0);
            $table->decimal('total_vat_tax', 20, 4)->nullable()->default(0);
            $table->decimal('grand_total', 20, 4)->nullable()->default(0);

            $table->boolean('total_validation_reference')->nullable()->default(false);
            $table->boolean('total_validation_bill')->nullable()->default(false);
            $table->boolean('total_validation_weight')->nullable()->default(false);
            $table->boolean('total_validation_scan_compliance')->nullable()->default(false);
            $table->boolean('total_validation_ops_plan')->nullable()->default(false);
            $table->integer('total_validation_score')->nullable()->default(0);

            /** Standard Item Timestamp **/
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoice_expenses');
    }
};
