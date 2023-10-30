<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Staudenmeir\LaravelMigrationViews\Facades\Schema;

class UpdateView extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:view';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update view';

    private $viewName = 'view_invoice_awbs';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $query = DB::table('invoice_awbs')
            ->join('invoices', 'invoices.id', '=', 'invoice_awbs.invoice_id')
            ->select([
                'invoices.code as invoice_code',
                'invoices.invoice_number',
                'invoices.supplier_tax_invoice',
                'invoices.invoice_date',
                'invoices.posting_date',
                'invoices.term_date',
                'invoices.document_status',
                'invoices.approval_status',
                DB::raw('(CASE
                    WHEN invoices.document_status = "closed" THEN "N"
                    WHEN invoices.document_status = "cancelled" THEN "Y"
                    ELSE null
                END) AS void_status'),
                'invoice_awbs.*'
            ]);

        Schema::createOrReplaceView($this->viewName, $query);
    }
}
