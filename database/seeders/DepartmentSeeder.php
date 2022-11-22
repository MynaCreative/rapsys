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
            [ ['name' => 'Internal Audit'], ['cost_center' => 'R001'] ],
            [ ['name' => 'Procurement'], ['cost_center' => 'R002'] ],
            [ ['name' => 'Legal'], ['cost_center' => 'R003'] ],
            [ ['name' => 'Tax'], ['cost_center' => 'R004'] ],
            [ ['name' => 'Pricing'], ['cost_center' => 'R005'] ],
        ];

        foreach($data as $row) {
            Model::updateOrCreate(
                $row[0],
                $row[1],
            );
        }
    }
}
