<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Tax as Model;
use App\Repositories\Oracle;

class TaxSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = Oracle::fetchQuery("
            SELECT TAX_RATE_ID, TAX, DESCRIPTION, PERCENTAGE_RATE
            FROM APPS.ZX_RATES_VL
        ");
        foreach($items as $item){
            Model::updateOrCreate(
                [
                    'code' => $item['TAX_RATE_ID']
                ],
                [
                    'name' => $item['TAX'],
                    'deduction' => $item['PERCENTAGE_RATE'] / 100,
                ],
            );
        }
    }
}
