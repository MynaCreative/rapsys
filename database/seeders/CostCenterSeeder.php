<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\CostCenter as Model;

class CostCenterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [['name' => 'F001 - Express Operation Department'], ['cost_center' => 'F001']],
            [['name' => 'F002 - Express Operation Linehaul Department'], ['cost_center' => 'F002']],
            [['name' => 'F003 - Clearance and Air Freight Department'], ['cost_center' => 'F003']],
            [['name' => 'F005 - Clearance and Sea Freight Department'], ['cost_center' => 'F005']],
            [['name' => 'F006 - Cross Border Department'], ['cost_center' => 'F006']],
            [['name' => 'F007 - Contract Logistic Operation Department'], ['cost_center' => 'F007']],
            [['name' => 'F008 - Distribution Operation Department'], ['cost_center' => 'F008']],
            [['name' => 'F009 - Transit Warehouse Department'], ['cost_center' => 'F009']],
            [['name' => 'F010 - Express Operation E - Commerce Departmen'], ['cost_center' => 'F010']],
            [['name' => 'F011 - Security Department'], ['cost_center' => 'F011']],
            [['name' => 'F012 - Property Department'], ['cost_center' => 'F012']],
            [['name' => 'F014 - Express Strategic Operation Department'], ['cost_center' => 'F014']],
            [['name' => 'F101 - Engineering Department'], ['cost_center' => 'F101']],
            [['name' => 'F102 - Customer Service Department'], ['cost_center' => 'F102']],
            [['name' => 'G701 - Treasury & AP Department'], ['cost_center' => 'G701']],
            [['name' => 'G702 - Accounting & Tax Department'], ['cost_center' => 'G702']],
            [['name' => 'G703 - Billing & Collection Department'], ['cost_center' => 'G703']],
            [['name' => 'G705 - FAD, BPA, & Proc'], ['cost_center' => 'G705']],
            [['name' => 'G706 - Legal Department'], ['cost_center' => 'G706']],
            [['name' => 'G707 - Corporate Strategic Pricing, Solution De'], ['cost_center' => 'G707']],
            [['name' => 'G708 - Human Resource Department'], ['cost_center' => 'G708']],
            [['name' => 'G709 - Corporate Services Department'], ['cost_center' => 'G709']],
            [['name' => 'G710 - IT Department'], ['cost_center' => 'G710']],
            [['name' => 'G711 - Product Development Department'], ['cost_center' => 'G711']],
            [['name' => 'G712 - Quality Department'], ['cost_center' => 'G712']],
            [['name' => 'G715 - Internal Audit and Risk Management Depar'], ['cost_center' => 'G715']],
            [['name' => 'G716 - Property Department'], ['cost_center' => 'G716']],
            [['name' => 'G750 - Management'], ['cost_center' => 'G750']],
            [['name' => 'O001 - Express Operation Department'], ['cost_center' => 'O001']],
            [['name' => 'O002 - Express Operation Linehaul Department'], ['cost_center' => 'O002']],
            [['name' => 'O003 - Clearance and Air Freight Department'], ['cost_center' => 'O003']],
            [['name' => 'O005 - Clearance and Sea Freight Department'], ['cost_center' => 'O005']],
            [['name' => 'O006 - Cross Border Department'], ['cost_center' => 'O006']],
            [['name' => 'O007 - Contract Logistic Operation Department'], ['cost_center' => 'O007']],
            [['name' => 'O008 - Distribution Operation Department'], ['cost_center' => 'O008']],
            [['name' => 'O009 - Transit Warehouse Department'], ['cost_center' => 'O009']],
            [['name' => 'O010 - Express Operation E - Commerce Departmen'], ['cost_center' => 'O010']],
            [['name' => 'O011 - Security Department'], ['cost_center' => 'O011']],
            [['name' => 'O012 - Property Department'], ['cost_center' => 'O012']],
            [['name' => 'O014 - Express Strategic Operation Department'], ['cost_center' => 'O014']],
            [['name' => 'O015 - IT Department - Enabler'], ['cost_center' => 'O015']],
            [['name' => 'S301 - Sales Department'], ['cost_center' => 'S301']],
            [['name' => 'S302 - Sales MAM Department'], ['cost_center' => 'S302']],
            [['name' => 'S303 - Telesales Department'], ['cost_center' => 'S303']],
            [['name' => 'S305 - Sales Planning & Program Department'], ['cost_center' => 'S305']],
            [['name' => 'S306 - Marketing Department'], ['cost_center' => 'S306']],
            [['name' => 'S307 - Network Development Department'], ['cost_center' => 'S307']],
        ];

        foreach ($data as $row) {
            Model::updateOrCreate(
                $row[0],
                $row[1],
            );
        }
    }
}
