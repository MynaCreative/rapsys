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
            [ ['code' => 'VI 0%'], ['name' => 'Vat In Tax 0%', 'deduction' => 0.0000, 'type' => Model::TYPE_VAT_IN ] ],
            [ ['code' => 'VI 1%'], ['name' => 'Vat In Tax 1%', 'deduction' => 0.0100, 'type' => Model::TYPE_VAT_IN ] ],
            [ ['code' => 'VI 1.1%'], ['name' => 'Vat In Tax 1.1%', 'deduction' => 0.0110, 'type' => Model::TYPE_VAT_IN ] ],
            [ ['code' => 'VI 10%'], ['name' => 'Vat In Tax 10%', 'deduction' => 0.1000, 'type' => Model::TYPE_VAT_IN ] ],
            [ ['code' => 'VI 11%'], ['name' => 'Vat In Tax 11%', 'deduction' => 0.1100, 'type' => Model::TYPE_VAT_IN ] ],
            [ ['code' => 'VO 0%'], ['name' => 'Vat Out Tax 0%', 'deduction' => 0.0000, 'type' => Model::TYPE_VAT_OUT ] ],
            [ ['code' => 'VO 1%'], ['name' => 'Vat Out Tax 1%', 'deduction' => 0.0100, 'type' => Model::TYPE_VAT_OUT ] ],
            [ ['code' => 'VO 1.1%'], ['name' => 'Vat Out Tax 1.1%', 'deduction' => 0.0110, 'type' => Model::TYPE_VAT_OUT ] ],
            [ ['code' => 'VO 10%'], ['name' => 'Vat Out Tax 10%', 'deduction' => 0.1000, 'type' => Model::TYPE_VAT_OUT ] ],
            [ ['code' => 'VO 11%'], ['name' => 'Vat Out Tax 11%', 'deduction' => 0.1100, 'type' => Model::TYPE_VAT_OUT ] ],
            [ ['code' => 'W4(2) 10%'], ['name' => 'Withholding4 (2) 10%', 'deduction' => 0.1000, 'type' => Model::TYPE_VAT_IN ] ],
            [ ['code' => 'W4(2) 20%'], ['name' => 'Withholding4 (2) 20%', 'deduction' => 0.2000, 'type' => Model::TYPE_WITHHOLDING ] ],
            [ ['code' => 'W4(2) 25%'], ['name' => 'Withholding4 (2) 25%', 'deduction' => 0.2500, 'type' => Model::TYPE_WITHHOLDING ] ],
            [ ['code' => 'W15 1,2%'], ['name' => 'Withholding 15 1,2%', 'deduction' => 0.0120, 'type' => Model::TYPE_WITHHOLDING ] ],
            [ ['code' => 'W21 5%'], ['name' => 'Withholding 21 5%', 'deduction' => 0.0500, 'type' => Model::TYPE_WITHHOLDING ] ],
            [ ['code' => 'W23 2%'], ['name' => 'Withholding 23 2%', 'deduction' => 0.0200, 'type' => Model::TYPE_WITHHOLDING ] ],
            [ ['code' => 'W23 4%'], ['name' => 'Withholding 23 4%', 'deduction' => 0.0400, 'type' => Model::TYPE_WITHHOLDING ] ],
            [ ['code' => 'W23 15%'], ['name' => 'Withholding 23 15%', 'deduction' => 0.1500, 'type' => Model::TYPE_WITHHOLDING ] ],
            [ ['code' => 'W26 5%'], ['name' => 'Withholding 26 5%', 'deduction' => 0.0500, 'type' => Model::TYPE_WITHHOLDING ] ],
            [ ['code' => 'W26 10%'], ['name' => 'Withholding 26 10%', 'deduction' => 0.1000, 'type' => Model::TYPE_WITHHOLDING ] ],
            [ ['code' => 'W26 15%'], ['name' => 'Withholding 26 15%', 'deduction' => 0.1500, 'type' => Model::TYPE_WITHHOLDING ] ],
            [ ['code' => 'W26 20%'], ['name' => 'Withholding 26 20%', 'deduction' => 0.2000, 'type' => Model::TYPE_WITHHOLDING ] ],
            [ ['code' => 'C22 0,25%'], ['name' => 'Credit 22 0,25%', 'deduction' => 0.0025, 'type' => Model::TYPE_CREDIT ] ],
            [ ['code' => 'C22 0,3%'], ['name' => 'Credit 22 0,3%', 'deduction' => 0.0030, 'type' => Model::TYPE_CREDIT ] ],
            [ ['code' => 'C22 1,5%'], ['name' => 'Credit 22 1,5%', 'deduction' => 0.0150, 'type' => Model::TYPE_CREDIT ] ],
            [ ['code' => 'C22 2,5%'], ['name' => 'Credit 22 2,5%', 'deduction' => 0.0250, 'type' => Model::TYPE_CREDIT ] ],
            [ ['code' => 'C22 7,5%'], ['name' => 'Credit 22 7,5%', 'deduction' => 0.0750, 'type' => Model::TYPE_CREDIT ] ],
            [ ['code' => 'C23 2%'], ['name' => 'Credit 23 2%', 'deduction' => 0.0200, 'type' => Model::TYPE_CREDIT ] ],
            [ ['code' => 'C23 15%'], ['name' => 'Credit 23 15%', 'deduction' => 0.1500, 'type' => Model::TYPE_CREDIT ] ],
        ];

        foreach($data as $row) {
            Model::updateOrCreate(
                $row[0],
                $row[1],
            );
        }
    }
}
