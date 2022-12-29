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
            [ ['code' => 'MDP'], ['name' => 'Mid Day Package (MDP)','coa' => 'ED003'] ],
            [ ['code' => 'NDP'], ['name' => 'Next Day Package (NDP)','coa' => 'ED004'] ],
            [ ['code' => 'SDP'], ['name' => 'Same Day Package (SDP)','coa' => 'ED002'] ],
            [ ['code' => 'RGP'], ['name' => 'Regular Package (RGP)','coa' => 'ED005'] ],
            [ ['code' => 'NSA'], ['name' => 'Regular Package (RGP) - NSA','coa' => 'ED005'] ],
            [ ['code' => 'PSR'], ['name' => 'PAS - Regular (PSR)','coa' => 'ER019'] ],
            [ ['code' => 'PSN'], ['name' => 'Next Day Package (NDP)','coa' => 'ED004'] ],
            [ ['code' => 'HCP'], ['name' => 'Hand Carry Package (HCP)','coa' => 'ED001'] ],
            [ ['code' => 'HWP'], ['name' => 'Heavy Weight Package (HWP)','coa' => 'ED027'] ],
            [ ['code' => 'PSC'], ['name' => 'Economy Package (ECP)','coa' => 'ED026'] ],
            [ ['code' => 'ECP'], ['name' => 'Economy Package (ECP)','coa' => 'ED026'] ],
            [ ['code' => 'PSS'], ['name' => 'Same Day Package (SDP)','coa' => 'ED002'] ],
            [ ['code' => 'PHW'], ['name' => 'Heavy Weight Package (HWP)','coa' => 'ED027'] ],
            [ ['code' => 'ID'] , ['name' => 'Regular Package (RGP) - ID','coa' => 'ED005'] ],
            [ ['code' => 'IRG'], ['name' => 'International Reguler (IRG) APA','coa' => 'ED025'] ],
            [ ['code' => 'IPR'], ['name' => 'International Priority (IPR) APA','coa' => 'ED023'] ],
            [ ['code' => 'PSM'], ['name' => 'Mid Day Package (MDP)','coa' => 'ED003'] ],
        ];

        foreach($data as $row) {
            Model::updateOrCreate(
                $row[0],
                $row[1],
            );
        }
    }
}
