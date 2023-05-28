<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Expense as Model;

class ExpenseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [['code' => 'MNL'], ['type' => null, 'coa' => null, 'coa_description' => null, 'icon' => 'ri-picture-in-picture-line', 'mandatory_scan' => null, 'name' => 'Manual']],
            [['code' => 'SAR'], ['type' => Model::TYPE_SMU, 'coa' => 501311, 'coa_description' => 'Airfreight (SMU)', 'icon' => 'ri-archive-line', 'mandatory_scan' => 'SMU&GLO', 'with_scan' => 'SMU,GLO', 'or_scan' => null, 'name' => 'SMU Airlines']],
            [['code' => 'HSR'], ['type' => Model::TYPE_SMU, 'coa' => 501204, 'coa_description' => 'RA Charges', 'icon' => 'ri-archive-drawer-line', 'mandatory_scan' => 'GLO', 'with_scan' => 'GLO', 'or_scan' => null, 'name' => 'Handling SMU / RA Charges']],
            [['code' => 'DLO'], ['type' => Model::TYPE_AWB, 'coa' => 501103, 'coa_description' => 'Delivery', 'icon' => 'ri-car-line', 'mandatory_scan' => 'HOV&POD', 'with_scan' => 'HOV,POD', 'or_scan' => null, 'name' => 'Delivery Only']],
            [['code' => 'PCO'], ['type' => Model::TYPE_AWB, 'coa' => 501102, 'coa_description' => 'Pick up', 'icon' => 'ri-truck-line', 'mandatory_scan' => 'PUP|PUX', 'with_scan' => 'PUP,PUX', 'or_scan' => null, 'name' => 'Pickup Only']],
            [['code' => 'PCD'], ['type' => Model::TYPE_AWB, 'coa' => 501102, 'coa_description' => 'Pick up', 'icon' => 'ri-caravan-line', 'mandatory_scan' => '(PUP|PUX)&HOV', 'with_scan' => 'HOV', 'or_scan' => 'PUP,PUX', 'name' => 'Pickup & Delivery']],
            [['code' => 'CSL'], ['type' => Model::TYPE_AWB, 'coa' => 509011, 'coa_description' => 'Technical Fee', 'icon' => 'ri-suitcase-line', 'mandatory_scan' => 'POD|DEX07|DRO|PUP|MDE', 'with_scan' => null, 'or_scan' => 'POD,DEX07,DRO,PUP,MDE', 'name' => 'Consolidator']],
            [['code' => 'MBG'], ['type' => Model::TYPE_AWB, 'coa' => 501104, 'coa_description' => 'Money Back Guarantee', 'icon' => 'ri-alarm-warning-line', 'mandatory_scan' => 'MSP|STAT37|DEX37|POD', 'with_scan' => null, 'or_scan' => 'MSP,STAT37,DEX37,POD', 'name' => 'MBG (Damage/Missing)']],
            [['code' => 'SHH'], ['type' => Model::TYPE_AWB, 'coa' => 501102, 'coa_description' => 'Pick up', 'icon' => 'ri-notification-badge-line', 'mandatory_scan' => 'POD', 'with_scan' => 'POD', 'or_scan' => null, 'name' => 'SHCP/Handcarry Handling']],
            [['code' => 'TMK'], ['type' => Model::TYPE_AWB, 'coa' => 502004, 'coa_description' => 'Daily Allowance', 'icon' => 'ri-calendar-line', 'mandatory_scan' => 'PUP|PUX|POD|DEX07', 'with_scan' => null, 'or_scan' => 'PUP,PUX,POD,DEX07', 'name' => 'Tagihan Mitra Kurir (Insentif Bulanan)']],
            [['code' => 'RVN'], ['type' => Model::TYPE_AWB, 'coa' => 506003, 'coa_description' => 'Vehicle rent', 'icon' => 'ri-bus-2-line', 'mandatory_scan' => null, 'with_scan' => null, 'or_scan' => null, 'name' => 'Rental Van']],
            [['code' => 'TLH'], ['type' => Model::TYPE_AWB, 'coa' => 501315, 'coa_description' => 'Truckfreight', 'icon' => 'ri-subway-line', 'mandatory_scan' => 'LTO', 'with_scan' => 'LTO', 'or_scan' => null, 'name' => 'Trucking Line Haul']],
        ];

        foreach ($data as $row) {
            Model::updateOrCreate(
                $row[0],
                $row[1],
            );
        }
    }
}
