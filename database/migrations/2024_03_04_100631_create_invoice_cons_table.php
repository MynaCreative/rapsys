<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Models\Tax;
use App\Models\CostCenter;
use App\Models\Invoice;
use App\Models\Expense;
use App\Models\InvoiceCons;
use App\Models\InvoiceExpense;
use App\Models\Withholding;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_cons', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->nullable();
            $table->integer('sequence_number')->nullable();

            $table->foreignIdFor(Invoice::class)->nullable()->constrained()->index('testing_yo');
            $table->foreignIdFor(InvoiceExpense::class)->nullable()->constrained();

            $table->foreignIdFor(Expense::class)->nullable()->constrained();
            $table->foreignIdFor(CostCenter::class)->nullable()->constrained();

            $table->foreignIdFor(Tax::class)->nullable()->constrained();
            $table->foreignIdFor(Withholding::class)->nullable()->constrained();

            $table->string('code')->nullable();
            $table->string('route')->nullable();
            $table->text('scan_compliance')->nullable();
            $table->date('date_item')->nullable();

            $table->decimal('amount', 20, 4)->nullable()->default(0);
            $table->decimal('withholding_tax', 20, 4)->nullable()->default(0);
            $table->decimal('vat_tax', 20, 4)->nullable()->default(0);
            $table->decimal('amount_after_tax', 20, 4)->nullable()->default(0);

            $table->decimal('weight', 20, 4)->nullable()->default(0);
            $table->decimal('total_weight_cons', 20, 4)->nullable()->default(0);
            $table->decimal('total_weight_awb', 20, 4)->nullable()->default(0);
            $table->decimal('total_weight_dim', 20, 4)->nullable()->default(0);
            $table->decimal('total_weight_actual', 20, 4)->nullable()->default(0);

            $table->text('description')->nullable();

            $table->boolean('validation_reference')->nullable()->default(false);
            $table->boolean('validation_bill')->nullable()->default(false);
            $table->boolean('validation_weight')->nullable()->default(false);
            $table->boolean('validation_scan_compliance')->nullable()->default(false);
            $table->boolean('validation_ops_plan')->nullable()->default(false);
            $table->boolean('validation_data_revenue')->nullable()->default(false);
            $table->integer('validation_score')->nullable()->default(0);

            $table->boolean('is_validated')->default(false);
            $table->text('message')->nullable();
            $table->text('awb_message')->nullable();

            /** Standard Item Timestamp **/
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->timestamps();
            $table->engine = 'MyISAM';
        });

        Schema::table('invoice_awbs', function (Blueprint $table) {
            $table->after('invoice_smu_id', function ($table) {
                $table->foreignIdFor(InvoiceCons::class)->nullable()->constrained();
            });
            $table->after('smu', function ($table) {
                $table->string('cons')->nullable();
            });
            $table->after('validation_ops_plan', function ($table) {
                $table->boolean('validation_data_revenue')->nullable()->default(false);
            });
        });

        Schema::table('invoice_smus', function (Blueprint $table) {
            $table->after('validation_ops_plan', function ($table) {
                $table->boolean('validation_data_revenue')->nullable()->default(false);
            });
        });

        Schema::table('invoice_expenses', function (Blueprint $table) {
            $table->after('total_weight_smu', function ($table) {
                $table->decimal('total_weight_cons', 20, 4)->nullable()->default(0);
            });
            $table->after('total_valid_amount_validation_ops_plan', function ($table) {
                $table->boolean('total_valid_amount_validation_data_revenue')->nullable()->default(false);
            });
            $table->after('total_invalid_amount_validation_ops_plan', function ($table) {
                $table->boolean('total_invalid_amount_validation_data_revenue')->nullable()->default(false);
            });
            $table->after('total_weight_validation_ops_plan', function ($table) {
                $table->boolean('total_weight_validation_data_revenue')->nullable()->default(false);
            });
            $table->after('total_validation_ops_plan', function ($table) {
                $table->boolean('total_validation_data_revenue')->nullable()->default(false);
            });
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoice_cons');
    }
};
