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
            [ ['code' => 'VN1'], ['name' => 'Vendor 1', 'site' => 'Jakarta'] ],
            [ ['code' => 'VN2'], ['name' => 'Vendor 2', 'site' => 'Bandung'] ],
            [ ['code' => 'VN3'], ['name' => 'Vendor 3', 'site' => 'Medan'] ],
        ];

        foreach($data as $row) {
            Model::updateOrCreate(
                $row[0],
                $row[1],
            );
        }
    }
}
