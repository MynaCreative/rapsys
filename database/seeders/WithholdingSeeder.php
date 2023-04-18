<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Withholding as Model;
use App\Repositories\Oracle;

class WithholdingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = Oracle::fetchQuery("
            SELECT ag.GROUP_ID, ag.NAME, ag.DESCRIPTION, atra.TAX_RATE
            FROM AP.AP_AWT_GROUPS ag
            INNER JOIN AP.AP_AWT_TAX_RATES_ALL atra ON ag.NAME = atra.TAX_NAME AND atra.ORG_ID = 103
        ");
        foreach($items as $item){
            Model::updateOrCreate(
                [
                    'code' => $item['GROUP_ID']
                ],
                [
                    'name' => $item['NAME'],
                    'deduction' => $item['TAX_RATE'] / 100,
                    'description' => $item['DESCRIPTION']
                ],
            );
        }
    }
}
