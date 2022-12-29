<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Interco as Model;

class IntercoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [ ['code' => 'RWA'], ['name' => 'PT Repex Wahana (holding)', 'coa' => '01'] ],
            [ ['code' => 'RPI'], ['name' => 'PT Repex Perdana International', 'coa' => '02'] ],
            [ ['code' => 'APA'], ['name' => 'PT Antareja Prima Antaran', 'coa' => '03'] ],
            [ ['code' => 'WDI'], ['name' => 'PT Wahana Dirgantara', 'coa' => '04'] ],
            [ ['code' => 'PSE'], ['name' => 'PT Pelangi Semesta', 'coa' => '05'] ],
            [ ['code' => 'REX'], ['name' => 'PT Republic Express', 'coa' => '06'] ],
            [ ['code' => 'SSA'], ['name' => 'PT Sena Satwika', 'coa' => '07'] ],
            [ ['code' => 'SBA'], ['name' => 'PT Sentra Banuadhi', 'coa' => '08'] ],
            [ ['code' => 'STU'], ['name' => 'PT Senatran Utama', 'coa' => '09'] ],
            [ ['code' => 'CPE'], ['name' => 'Central Pasific Express', 'coa' => '10'] ],
            [ ['code' => 'WSR'], ['name' => 'PT Wahana Senareksa', 'coa' => '11'] ],
            [ ['code' => 'PLE'], ['name' => 'PT Pelangi Labuan Resort', 'coa' => '12'] ],
            [ ['code' => 'PGL'], ['name' => 'PT Pelangi Global Logistik', 'coa' => '13'] ],
        ];

        foreach($data as $row) {
            Model::updateOrCreate(
                $row[0],
                $row[1],
            );
        }
    }
}
