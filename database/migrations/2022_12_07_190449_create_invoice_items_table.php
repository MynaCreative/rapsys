<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Models\Invoice;
use App\Models\Product;
use App\Models\Area;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_items', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->nullable();
            $table->string('code')->nullable();
            $table->string('awb')->nullable();
            $table->string('smu')->nullable();
            $table->integer('document_index')->nullable();

            $table->foreignIdFor(Invoice::class)->nullable()->constrained();
            $table->foreignIdFor(Product::class)->nullable()->constrained();
            $table->foreignIdFor(Area::class)->nullable()->constrained();

            $table->foreignId('withholding_tax_id')->nullable()->constrained('taxes');
            $table->foreignId('vat_tax_id')->nullable()->constrained('taxes');

            $table->decimal('quantity',20,4)->nullable()->default(0);
            $table->decimal('price',20,4)->nullable()->default(0);
            $table->decimal('delta_weight_smu',20,4)->nullable()->default(0);
            $table->decimal('delta_weight_awb',20,4)->nullable()->default(0);
            $table->decimal('invoice_weight_smu',20,4)->nullable()->default(0);
            $table->decimal('invoice_weight_awb',20,4)->nullable()->default(0);
            $table->decimal('withholding_tax',20,4)->nullable()->default(0);
            $table->decimal('vat_tax',20,4)->nullable()->default(0);
            $table->decimal('tax_base',20,4)->nullable()->default(0);
            $table->decimal('amount_awb',20,4)->nullable()->default(0);
            $table->decimal('amount_smu',20,4)->nullable()->default(0);
            $table->decimal('amount_awb_smu',20,4)->nullable()->default(0);

            $table->text('description')->nullable();

            $table->boolean('validation_reference')->nullable();
            $table->boolean('validation_weight')->nullable();
            $table->boolean('validation_scan_compliance')->nullable();
            $table->boolean('validation_ops_plan')->nullable();
            $table->boolean('validation_bill')->nullable();

            $table->json('message')->nullable();

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
        Schema::dropIfExists('invoice_items');
    }
};
