<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Term as Model;

class TermSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [ ['code' => '07D'], ['name' => '07 Days'] ],
            [ ['code' => '14D'], ['name' => '14 Days'] ],
            [ ['code' => '15D'], ['name' => '15 Days'] ],
            [ ['code' => '21D'], ['name' => '21 Days'] ],
            [ ['code' => '30D'], ['name' => '30 Days'] ],
            [ ['code' => '60D'], ['name' => '60 Days'] ],
            [ ['code' => 'IMD'], ['name' => 'Immediate'] ],
        ];

        foreach($data as $row) {
            Model::updateOrCreate(
                $row[0],
                $row[1],
            );
        }
    }
}
