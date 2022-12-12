<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Vendor as Model;

class VendorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [ ['name' => 'Vendor 1'], ['site' => 'Jakarta'] ],
            [ ['name' => 'Vendor 2'], ['site' => 'Bandung'] ],
            [ ['name' => 'Vendor 3'], ['site' => 'Medan'] ],
        ];

        foreach($data as $row) {
            Model::updateOrCreate(
                $row[0],
                $row[1],
            );
        }
    }
}
