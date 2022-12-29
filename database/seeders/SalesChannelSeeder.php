<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\SalesChannel as Model;

class SalesChannelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [ ['code' => 'Internal'], ['name' => 'Internal', 'coa' => 'R0310'] ],
            [ ['code' => 'B2B'], ['name' => 'Corporate-B2B-None', 'coa' => 'C0100'] ],
            [ ['code' => 'MAM'], ['name' => 'Corporate-B2B-Major Account (MAM)', 'coa' => 'C0101'] ],
            [ ['code' => 'WSC'], ['name' => 'Retail-C2C-WSC', 'coa' => 'R0308'] ],
            [ ['code' => 'ECOM'], ['name' => 'Retail-B2C-E-Commerce', 'coa' => 'R0204'] ],
            [ ['code' => 'ASC'], ['name' => 'Retail-C2C-ASC', 'coa' => 'R0309'] ],
            [ ['code' => 'RTL'], ['name' => 'Retail-None-None', 'coa' => 'R0000'] ],
            [ ['code' => 'NDV'], ['name' => 'Retail-B2C-Outlet 2 Outlet', 'coa' => 'R0206'] ],
            [ ['code' => 'AGENT'], ['name' => 'Retail-C2C-Agent', 'coa' => 'R0307'] ],
            [ ['code' => 'LOG'], ['name' => 'Corporate-B2B-None', 'coa' => 'C0100'] ],
        ];

        foreach($data as $row) {
            Model::updateOrCreate(
                $row[0],
                $row[1],
            );
        }
    }
}
