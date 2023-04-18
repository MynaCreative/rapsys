<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Currency as Model;
use App\Repositories\Oracle;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = Oracle::fetchQuery("
            SELECT CURRENCY_CODE, NAME, DESCRIPTION
            FROM APPS.FND_CURRENCIES_VL
            WHERE CURRENCY_CODE IN (
                'AUD',
                'EUR',
                'GBP',
                'IDR',
                'JPY',
                'SGD',
                'USD',
                'STAT'
            )
        ");
        foreach($items as $item){
            Model::updateOrCreate(
                [
                    'code' => $item['CURRENCY_CODE']
                ],
                [
                    'name' => $item['NAME'],
                    'description' => $item['DESCRIPTION'],
                ],
            );
        }
    }
}
