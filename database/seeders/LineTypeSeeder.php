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
            [ ['code' => 'FRG'], ['name' => 'Freight', 'description' => 'Freight line.'] ],
            [ ['code' => 'ITM'], ['name' => 'Item', 'description' => 'Purchased goods or service line.'] ],
            [ ['code' => 'MSC'], ['name' => 'Miscellaneous', 'description' => 'Miscellaneous charges line.'] ],
            [ ['code' => 'TAX'], ['name' => 'Tax', 'description' => 'Tax line.'] ],
            [ ['code' => 'WHT'], ['name' => 'Withholding Tax', 'description' => 'Withholding tax line.'] ],
        ];

        foreach($data as $row) {
            Model::updateOrCreate(
                $row[0],
                $row[1],
            );
        }
    }
}
