<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Vendor as Model;
use App\Models\Site;
use App\Models\Sbu;

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
            [ ['code' => '120'], [
                'name'      => 'Garuda Indonesia (Persero) Tbk, PT',
                'site_id'   => 1,
                'sbu_id'    => 1
            ] ],
        ];

        foreach($data as $row) {
            Model::updateOrCreate(
                $row[0],
                $row[1],
            );
        }
    }
}
