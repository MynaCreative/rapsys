<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Product as Model;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [ ['code' => 'NAN'], ['name' => 'None','coa' => '00000'] ],
            [ ['code' => 'PDG'], ['name' => 'Padang','coa' => '00001'] ],
            [ ['code' => 'PSR'], ['name' => 'Pas Reguler - PSR','coa' => 'ER002'] ],
            [ ['code' => 'RGP'], ['name' => 'Regular Package','coa' => 'ED002'] ],
        ];

        foreach($data as $row) {
            Model::updateOrCreate(
                $row[0],
                $row[1],
            );
        }
    }
}
