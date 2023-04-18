<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Term as Model;
use App\Repositories\Oracle;

class TermSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = Oracle::fetchQuery("
            SELECT t.TERM_ID, t.NAME, t.DESCRIPTION, tl.DUE_DAYS
            FROM AP.AP_TERMS_TL t
            INNER JOIN AP.AP_TERMS_LINES tl ON t.TERM_ID = tl.TERM_ID
        ");
        foreach($items as $item){
            Model::updateOrCreate(
                [
                    'code' => $item['TERM_ID']
                ],
                [
                    'name' => $item['NAME'],
                    'day' => $item['DUE_DAYS'],
                    'description' => $item['DESCRIPTION']
                ],
            );
        }
    }
}
