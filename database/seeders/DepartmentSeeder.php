<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Department as Model;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [ ['code' => 'INA'], ['name' => 'Internal Audit', 'cost_center' => 'R001'] ],
            [ ['code' => 'PRC'], ['name' => 'Procurement', 'cost_center' => 'R002'] ],
            [ ['code' => 'LGL'], ['name' => 'Legal', 'cost_center' => 'R003'] ],
            [ ['code' => 'TAX'], ['name' => 'Tax', 'cost_center' => 'R004'] ],
            [ ['code' => 'PRC'], ['name' => 'Pricing', 'cost_center' => 'R005'] ],
        ];

        foreach($data as $row) {
            Model::updateOrCreate(
                $row[0],
                $row[1],
            );
        }
    }
}
