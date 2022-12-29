<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Tax as Model;

class TaxSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [ ['code' => 'NO VAT'], ['name' => 'NO VAT', 'deduction' => 0.0000 ] ],
            [ ['code' => 'VAT 1'], ['name' => 'VAT 1', 'deduction' => 0.0100 ] ],
            [ ['code' => 'VAT 10'], ['name' => 'VAT 10', 'deduction' => 0.1000 ] ],
            [ ['code' => 'VAT 1 (BATAM)'], ['name' => 'VAT 1 (BATAM)', 'deduction' => 0.0100 ] ],
            [ ['code' => 'VAT 10 (BATAM)'], ['name' => 'VAT 10 (BATAM)', 'deduction' => 0.1000 ] ],
            [ ['code' => 'VAT 1 NON REC'], ['name' => 'VAT 1 NON REC', 'deduction' => 0.0100 ] ],
            [ ['code' => 'VAT 10 NON REC'], ['name' => 'VAT 10 NON REC', 'deduction' => 0.1000 ] ],
            [ ['code' => 'PB 1'], ['name' => 'PB 1', 'deduction' => 0.0000 ] ],
        ];

        foreach($data as $row) {
            Model::updateOrCreate(
                $row[0],
                $row[1],
            );
        }
    }
}
