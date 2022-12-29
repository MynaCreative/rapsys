<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\InvoiceType as Model;

class InvoiceTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [ ['code' => 'STD'], ['name' => 'Standard', 'description' => 'Standard Invoice'] ],
            [ ['code' => 'CRM'], ['name' => 'Credit Memo', 'description' => 'Credit Memo'] ],
            [ ['code' => 'DBM'], ['name' => 'Debit Memo', 'description' => 'Debit Memo'] ],
            [ ['code' => 'EXR'], ['name' => 'Expense Report', 'description' => 'Employee Expense Report'] ],
            [ ['code' => 'PRP'], ['name' => 'Prepayment', 'description' => 'Prepayments, advances and finances'] ],
            [ ['code' => 'RTR'], ['name' => 'Retainage Release', 'description' => 'Retainage Release Invoices'] ],
            [ ['code' => 'WHT'], ['name' => 'Withholding Tax', 'description' => 'Withholding Tax Invoice'] ],
            [ ['code' => 'MXD'], ['name' => 'Mixed', 'description' => 'Mixed type invoice'] ],
        ];

        foreach($data as $row) {
            Model::updateOrCreate(
                $row[0],
                $row[1],
            );
        }
    }
}
