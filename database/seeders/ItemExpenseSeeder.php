<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\ItemExpense as Model;

class ItemExpenseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [ ['name' => 'SMU Cost'], ['coa' => '501311'] ],
            [ ['name' => 'Sewa Mobil'], ['coa' => '504001'] ],
            [ ['name' => 'Pickup & Delivery Fee'], ['coa' => '520000'] ],
        ];

        foreach($data as $row) {
            Model::updateOrCreate(
                $row[0],
                $row[1],
            );
        }
    }
}
