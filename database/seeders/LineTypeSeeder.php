<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\LineType as Model;

class LineTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [ ['name' => 'Freight'], ['description' => 'Freight line.'] ],
            [ ['name' => 'Item'], ['description' => 'Purchased goods or service line.'] ],
            [ ['name' => 'Miscellaneous'], ['description' => 'Miscellaneous charges line.'] ],
            [ ['name' => 'Tax'], ['description' => 'Tax line.'] ],
            [ ['name' => 'Withholding Tax'], ['description' => 'Withholding tax line.'] ],
        ];

        foreach($data as $row) {
            Model::updateOrCreate(
                $row[0],
                $row[1],
            );
        }
    }
}
