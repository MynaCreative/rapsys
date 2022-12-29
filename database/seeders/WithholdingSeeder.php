<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Withholding as Model;

class WithholdingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [ ['code' => 'PPH 15 1,8 %'], ['name' => 'PPH 15 1,8 %', 'deduction' => 0.0180, 'description' => 'Pembayaran Sewa Pesawat' ] ],
            [ ['code' => 'PPH 21 -2,5 %'], ['name' => 'PPH 21 -2,5 %', 'deduction' => 0.0250, 'description' => 'Vendor Perorangan' ] ],
            [ ['code' => 'PPH 21 -5%'], ['name' => 'PPH 21 -5%', 'deduction' => 0.0500, 'description' => 'Vendor Perorangan' ] ],
            [ ['code' => 'PPH 23 -0,5%'], ['name' => 'PPH 23 -0,5%', 'deduction' => 0.0050, 'description' => 'Opsional' ] ],
            [ ['code' => 'PPH 23 -15%'], ['name' => 'PPH 23 -15%', 'deduction' => 0.1500, 'description' => 'Dividen, Royalti, Bunga, Hadia & Penghargaan' ] ],
            [ ['code' => 'PPH 23 -2%'], ['name' => 'PPH 23 -2%', 'deduction' => 0.0200, 'description' => 'Sewa (selain tanah & bangunan) & jasa' ] ],
            [ ['code' => 'PPH 23 -30%'], ['name' => 'PPH 23 -30%', 'deduction' => 0.3000, 'description' => 'Dividen, Royalti, Bunga, Hadia & Penghargaan' ] ],
            [ ['code' => 'PPH 23 -4%'], ['name' => 'PPH 23 -4%', 'deduction' => 0.0400, 'description' => 'Sewa (selain tanah & bangunan) & jasa' ] ],
            [ ['code' => 'PPH 26 -10%'], ['name' => 'PPH 26 -10%', 'deduction' => 0.1000, 'description' => 'Subjek Wajib Pajak Luar Negeri' ] ],
            [ ['code' => 'PPH 26 -20%'], ['name' => 'PPH 26 -20%', 'deduction' => 0.2000, 'description' => 'Subjek Wajib Pajak Luar Negeri' ] ],
            [ ['code' => 'PPH 4 (2) -10%'], ['name' => 'PPH 4 (2) -10%', 'deduction' => 0.1000, 'description' => 'Sewa Tanah & Bangunan' ] ],
            [ ['code' => 'PPH 4 (2) -2%'], ['name' => 'PPH 4 (2) -2%', 'deduction' => 0.0200, 'description' => 'Jasa Kontruksi Pelaksana' ] ],
            [ ['code' => 'PPH 4 (2) -2,5%'], ['name' => 'PPH 4 (2) -2,5%', 'deduction' => 0.0250, 'description' => 'Penjual atas Tanah & Bangunan' ] ],
            [ ['code' => 'PPH 4 (2) -3%'], ['name' => 'PPH 4 (2) -3%', 'deduction' => 0.0300, 'description' => 'Jasa Kontruksi Pelaksana' ] ],
        ];

        foreach($data as $row) {
            Model::updateOrCreate(
                $row[0],
                $row[1],
            );
        }
    }
}
