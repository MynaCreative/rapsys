<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Currency as Model;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [ ['code' => 'AUD'], ['name' => 'Australian Dollar'] ],
            [ ['code' => 'EUR'], ['name' => 'Euro'] ],
            [ ['code' => 'GBP'], ['name' => 'Pound Sterling'] ],
            [ ['code' => 'IDR'], ['name' => 'Rupiah'] ],
            [ ['code' => 'JPY'], ['name' => 'Yen'] ],
            [ ['code' => 'SGD'], ['name' => 'Singapore Dollar'] ],
            [ ['code' => 'USD'], ['name' => 'US Dollar'] ],
            [ ['code' => 'STAT'], ['name' => 'Statistical'] ],
        ];

        foreach($data as $row) {
            Model::updateOrCreate(
                $row[0],
                $row[1],
            );
        }
    }
}
