<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Expense as Model;

class ExpenseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [ ['code' => 'ODA'], ['name' => 'Forward Shipment','coa' => '504001'] ],
            [ ['code' => 'PUD'], ['name' => 'Pickup & Delivery Fee','coa' => '520000'] ],
            [ ['code' => 'SMU'], ['name' => 'SMU Cost','coa' => '501311'] ],
        ];

        foreach($data as $row) {
            Model::updateOrCreate(
                $row[0],
                $row[1],
            );
        }
    }
}
