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
use App\Models\InvoiceExpense;
use App\Models\InvoiceSmu;
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
        Schema::create('invoice_awbs', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->nullable();
            $table->integer('sequence_number')->nullable();

            $table->foreignIdFor(Invoice::class)->nullable()->constrained();
            $table->foreignIdFor(InvoiceExpense::class)->nullable()->constrained();
            $table->foreignIdFor(InvoiceSmu::class)->nullable()->constrained();

            $table->foreignIdFor(Expense::class)->nullable()->constrained();
            $table->foreignIdFor(CostCenter::class)->nullable()->constrained();
            $table->foreignIdFor(SalesChannel::class)->nullable()->constrained();
            $table->foreignIdFor(Product::class)->nullable()->constrained();
            $table->foreignIdFor(Area::class)->nullable()->constrained();
            $table->foreignIdFor(Tax::class)->nullable()->constrained();
            $table->foreignIdFor(Withholding::class)->nullable()->constrained();

            $table->string('dist')->nullable();
            $table->string('code')->nullable();
            $table->string('type')->nullable();
            $table->string('route')->nullable();
            $table->date('date_item')->nullable();

            $table->decimal('weight', 20, 4)->nullable()->default(0);
            $table->decimal('amount', 20, 4)->nullable()->default(0);
            $table->decimal('delta_weight', 20, 4)->nullable()->default(0);
            $table->decimal('delta_weight_dim', 20, 4)->nullable()->default(0);
            $table->decimal('delta_weight_actual', 20, 4)->nullable()->default(0);
            $table->decimal('delta_amount', 20, 4)->nullable()->default(0);
            $table->decimal('delta_percentage', 20, 4)->nullable()->default(0);

            $table->decimal('withholding_tax', 20, 4)->nullable()->default(0);
            $table->decimal('vat_tax', 20, 4)->nullable()->default(0);
            $table->decimal('total', 20, 4)->nullable()->default(0);

            $table->text('description')->nullable();

            $table->boolean('validation_reference')->nullable()->default(false);
            $table->boolean('validation_bill')->nullable()->default(false);
            $table->boolean('validation_weight')->nullable()->default(false);
            $table->boolean('validation_scan_compliance')->nullable()->default(false);
            $table->boolean('validation_ops_plan')->nullable()->default(false);
            $table->integer('validation_score')->nullable()->default(0);

            $table->boolean('is_validated')->default(false);
            $table->text('message')->nullable();

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
        Schema::dropIfExists('invoice_awbs');
    }
};
