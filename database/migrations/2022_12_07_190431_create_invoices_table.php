<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Models\InvoiceType;
use App\Models\Department;
use App\Models\Currency;
use App\Models\Interco;
use App\Models\Vendor;
use App\Models\Term;
use App\Models\Sbu;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->nullable();

            $table->foreignIdFor(InvoiceType::class)->nullable()->constrained();
            $table->foreignIdFor(Department::class)->nullable()->constrained();
            $table->foreignIdFor(Currency::class)->nullable()->constrained();
            $table->foreignIdFor(Interco::class)->nullable()->constrained();
            $table->foreignIdFor(Vendor::class)->nullable()->constrained();
            $table->foreignIdFor(Term::class)->nullable()->constrained();
            $table->foreignIdFor(Sbu::class)->nullable()->constrained();

            $table->string('code')->unique();
            $table->string('invoice_number')->nullable();
            $table->string('supplier_tax_invoice')->nullable();

            $table->date('posting_date')->nullable();
            $table->date('invoice_date')->nullable();
            $table->date('invoice_receipt_date')->nullable();
            $table->date('supplier_tax_invoice_date')->nullable();

            $table->date('term_date')->nullable();
            $table->date('due_date')->nullable();

            $table->integer('total_item')->nullable()->default(0);
            $table->integer('total_item_validated')->nullable()->default(0);
            $table->decimal('total_amount',20,4)->nullable()->default(0);
            $table->decimal('total_amount_after_tax',20,4)->nullable()->default(0);
            $table->decimal('total_amount_valid',20,4)->nullable()->default(0);
            $table->decimal('total_amount_invalid',20,4)->nullable()->default(0);
            $table->decimal('total_amount_after_tax_valid',20,4)->nullable()->default(0);
            $table->decimal('total_amount_after_tax_invalid',20,4)->nullable()->default(0);

            $table->text('expenses')->nullable();

            /** Standard Header Status **/
            $table->string('document_status')->default('draft')->nullable();
            $table->string('approval_status')->default('none')->nullable();

            $table->dateTime('document_status_time')->nullable();
            $table->dateTime('approval_status_time')->nullable();

            $table->text('note')->nullable();
            $table->text('cancel_remark')->nullable();
            $table->text('reject_remark')->nullable();

            /** Standard HeaderTimestamp **/
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->dateTime('published_at')->nullable();
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
        Schema::dropIfExists('invoices');
    }
};
