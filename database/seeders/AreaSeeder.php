<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Area as Model;

class AreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [ ['code' => 'RKO'], ['name' => 'Jakarta-Rawabokor', 'coa' => 'JAK008'] ],
            [ ['code' => 'PLM'], ['name' => 'Palembang-None', 'coa' => 'PLM000'] ],
            [ ['code' => 'KGD'], ['name' => 'Jakarta-Kelapa Gading', 'coa' => 'JAK022'] ],
            [ ['code' => 'BTH'], ['name' => 'Batam-None', 'coa' => 'BTH000'] ],
            [ ['code' => 'BDO'], ['name' => 'Bandung-None', 'coa' => 'BDO000'] ],
            [ ['code' => 'JKT'], ['name' => 'Jakarta-Palbatu', 'coa' => 'JAK001'] ],
            [ ['code' => 'SBG'], ['name' => 'Jakarta-Purwakarta', 'coa' => 'JAK020'] ],
            [ ['code' => 'CBN'], ['name' => 'Cirebon-None', 'coa' => 'CBN000'] ],
            [ ['code' => 'DPS'], ['name' => 'Denpasar-None', 'coa' => 'DPS000'] ],
            [ ['code' => 'BPN'], ['name' => 'Balikpapan-None', 'coa' => 'BPN000'] ],
            [ ['code' => 'MES'], ['name' => 'Medan-None', 'coa' => 'MES000'] ],
            [ ['code' => 'CXP'], ['name' => 'Jakarta-Cibitung', 'coa' => 'JAK005'] ],
            [ ['code' => 'BJG'], ['name' => 'Jakarta-Bogor', 'coa' => 'JAK006'] ],
            [ ['code' => 'KRC'], ['name' => 'Jakarta-Balaraja', 'coa' => 'JAK007'] ],
            [ ['code' => 'SUB'], ['name' => 'Surabaya-None', 'coa' => 'SUB000'] ],
            [ ['code' => 'CGK'], ['name' => 'Jakarta-Kebon Jeruk', 'coa' => 'JAK003'] ],
            [ ['code' => 'PRJ'], ['name' => 'Jakarta-Kebon Jeruk', 'coa' => 'JAK003'] ],
            [ ['code' => 'BTJ'], ['name' => 'Medan-Banda Aceh', 'coa' => 'MES001'] ],
            [ ['code' => 'UPG'], ['name' => 'Ujungpandang-None', 'coa' => 'UPG000'] ],
            [ ['code' => 'TRK'], ['name' => 'Balikpapan-Tarakan', 'coa' => 'BPN002'] ],
            [ ['code' => 'PWL'], ['name' => 'Yogyakarta-Purwekerto', 'coa' => 'JOG001'] ],
            [ ['code' => 'HLP'], ['name' => 'Jakarta-HLPA', 'coa' => 'JAK002'] ],
            [ ['code' => 'BDJ'], ['name' => 'Banjarmasin-None', 'coa' => 'BDJ000'] ],
            [ ['code' => 'MDC'], ['name' => 'Manado-None', 'coa' => 'MDC000'] ],
            [ ['code' => 'TKG'], ['name' => 'Palembang-Bandar Lampung', 'coa' => 'PLM003'] ],
            [ ['code' => 'PNK'], ['name' => 'Pontianak-None', 'coa' => 'PNK000'] ],
            [ ['code' => 'JOG'], ['name' => 'Yogyakarta-None', 'coa' => 'JOG000'] ],
            [ ['code' => 'EDC'], ['name' => 'Jakarta-Rawabokor', 'coa' => 'JAK008'] ],
            [ ['code' => 'SRG'], ['name' => 'Semarang-None', 'coa' => 'SRG000'] ],
            [ ['code' => 'PGK'], ['name' => 'Palembang-Pangkal Pinang', 'coa' => 'PLM001'] ],
            [ ['code' => 'SOC'], ['name' => 'Solo-None', 'coa' => 'SOC000'] ],
            [ ['code' => 'PKU'], ['name' => 'Riau - Pekanbaru-None', 'coa' => 'PKU000'] ],
            [ ['code' => 'CIN'], ['name' => 'Jakarta-Cilegon', 'coa' => 'JAK015'] ],
            [ ['code' => 'GTO'], ['name' => 'Ujungpandang-Ternate', 'coa' => 'UPG007'] ],
            [ ['code' => 'KOE'], ['name' => 'Denpasar-Kupang', 'coa' => 'DPS002'] ],
            [ ['code' => 'AMI'], ['name' => 'Denpasar-Mataram', 'coa' => 'DPS001'] ],
            [ ['code' => 'PKL'], ['name' => 'Semarang-Pekalongan', 'coa' => 'SRG001'] ],
            [ ['code' => 'PLW'], ['name' => 'Ujungpandang-Palu', 'coa' => 'UPG001'] ],
            [ ['code' => 'DJB'], ['name' => 'Riau - Pekanbaru-Jambi', 'coa' => 'PKU002'] ],
            [ ['code' => 'PDG'], ['name' => 'Riau - Pekanbaru-Padang', 'coa' => 'PKU001'] ],
            [ ['code' => 'BKS'], ['name' => 'Riau - Pekanbaru-Bengkulu', 'coa' => '#N/A'] ],
            [ ['code' => 'MTP'], ['name' => 'Banjarmasin-Martapura', 'coa' => 'BDJ001'] ],
            [ ['code' => 'BOT'], ['name' => 'Balikpapan-Bontang', 'coa' => 'BPN001'] ],
            [ ['code' => 'TNJ'], ['name' => 'Palembang-Tanjung Pandan', 'coa' => 'PLM002'] ],
            [ ['code' => 'CBT'], ['name' => 'Jakarta-Cibitung', 'coa' => 'JAK005'] ],
            [ ['code' => 'MRD'], ['name' => 'Jakarta-Cibitung', 'coa' => 'JAK005'] ],
        ];

        foreach($data as $row) {
            Model::updateOrCreate(
                $row[0],
                $row[1],
            );
        }
    }
}
