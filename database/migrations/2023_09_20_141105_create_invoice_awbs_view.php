<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Staudenmeir\LaravelMigrationViews\Facades\Schema;

return new class extends Migration
{
    private $viewName = 'view_invoice_awbs';
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $query = DB::table('invoice_awbs')
            ->join('invoices', 'invoices.id', '=', 'invoice_awbs.invoice_id')
            ->select('invoices.code as invoice_code', 'invoices.invoice_number', 'invoices.supplier_tax_invoice', 'invoices.posting_date', 'invoices.term_date', 'invoice_awbs.*');

        Schema::createOrReplaceView($this->viewName, $query);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropViewIfExists($this->viewName);
    }
};
