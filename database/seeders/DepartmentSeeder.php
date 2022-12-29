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
            [ ['name' => 'BPA'], ['cost_center' => 'R006'] ],
            [ ['name' => 'FA Development'], ['cost_center' => 'R007'] ],
            [ ['name' => 'Bill Coll Non Exp'], ['cost_center' => 'R008'] ],
            [ ['name' => 'Billing Express'], ['cost_center' => 'R009'] ],
            [ ['name' => 'Collection Express'], ['cost_center' => 'R010'] ],
            [ ['name' => 'BCAR Retail'], ['cost_center' => 'R011'] ],
            [ ['name' => 'AP'], ['cost_center' => 'R012'] ],
            [ ['name' => 'CM'], ['cost_center' => 'R013'] ],
            [ ['name' => 'Treasury'], ['cost_center' => 'R014'] ],
            [ ['name' => 'Accounting'], ['cost_center' => 'R015'] ],
            [ ['name' => 'Branch SUB'], ['cost_center' => 'R016'] ],
            [ ['name' => 'Branch JOG'], ['cost_center' => 'R017'] ],
            [ ['name' => 'Branch UPG'], ['cost_center' => 'R018'] ],
            [ ['name' => 'Branch DPS'], ['cost_center' => 'R019'] ],
            [ ['name' => 'District Sales East Java'], ['cost_center' => 'R020'] ],
            [ ['name' => 'Branch BDO'], ['cost_center' => 'R021'] ],
            [ ['name' => 'Branch MES'], ['cost_center' => 'R022'] ],
            [ ['name' => 'Branch BPN'], ['cost_center' => 'R023'] ],
            [ ['name' => 'Linehaul Service'], ['cost_center' => 'R024'] ],
            [ ['name' => 'Project Spec DG Handling'], ['cost_center' => 'R025'] ],
            [ ['name' => 'Express Strategic Ops'], ['cost_center' => 'R026'] ],
            [ ['name' => 'Network Operation'], ['cost_center' => 'R027'] ],
            [ ['name' => 'Express Ops CGK'], ['cost_center' => 'R028'] ],
            [ ['name' => 'Express Ops JKT'], ['cost_center' => 'R029'] ],
            [ ['name' => 'Express Ops HLP BJG'], ['cost_center' => 'R030'] ],
            [ ['name' => 'Express Ops CXP'], ['cost_center' => 'R031'] ],
            [ ['name' => 'Express Ops Ecommerce'], ['cost_center' => 'R032'] ],
            [ ['name' => 'Outlet'], ['cost_center' => 'R033'] ],
            [ ['name' => 'Sales Retail'], ['cost_center' => 'R034'] ],
            [ ['name' => 'Transit Whs RCB 1'], ['cost_center' => 'R035'] ],
            [ ['name' => 'Transit Whs RCB 2 Pagi'], ['cost_center' => 'R036'] ],
            [ ['name' => 'Transit Whs RCB 2 Malam'], ['cost_center' => 'R037'] ],
            [ ['name' => 'Distribution Operation'], ['cost_center' => 'R038'] ],
            [ ['name' => 'Contract Logistic Operation'], ['cost_center' => 'R039'] ],
            [ ['name' => 'Sales CL & Distribution'], ['cost_center' => 'R040'] ],
            [ ['name' => 'Solution Design'], ['cost_center' => 'R041'] ],
            [ ['name' => 'Sales Domestic East'], ['cost_center' => 'R042'] ],
            [ ['name' => 'Sales Domestic West'], ['cost_center' => 'R043'] ],
            [ ['name' => 'Sales Ecommerce East'], ['cost_center' => 'R044'] ],
            [ ['name' => 'Sales Ecommerce West'], ['cost_center' => 'R045'] ],
            [ ['name' => 'Sales International'], ['cost_center' => 'R046'] ],
            [ ['name' => 'ITD - Technology Operation'], ['cost_center' => 'R047'] ],
            [ ['name' => 'ITD - Exp Syst Analyst'], ['cost_center' => 'R048'] ],
            [ ['name' => 'ITD - Nexp Syst Analyst'], ['cost_center' => 'R049'] ],
            [ ['name' => 'ITD - Ops Development'], ['cost_center' => 'R050'] ],
            [ ['name' => 'ITD - IT Application'], ['cost_center' => 'R051'] ],
            [ ['name' => 'Operation Clearance & Freight'], ['cost_center' => 'R052'] ],
            [ ['name' => 'CS & PCC'], ['cost_center' => 'R053'] ],
            [ ['name' => 'Product Development'], ['cost_center' => 'R054'] ],
            [ ['name' => 'Engineering'], ['cost_center' => 'R055'] ],
            [ ['name' => 'People Development'], ['cost_center' => 'R056'] ],
            [ ['name' => 'GA & Asset Management'], ['cost_center' => 'R057'] ],
            [ ['name' => 'Government Relation'], ['cost_center' => 'R058'] ],
            [ ['name' => 'Security'], ['cost_center' => 'R059'] ],
            [ ['name' => 'HSE'], ['cost_center' => 'R060'] ],
            [ ['name' => 'HR Strategic'], ['cost_center' => 'R061'] ],
            [ ['name' => 'HR Operation'], ['cost_center' => 'R062'] ],
            [ ['name' => 'HR Service'], ['cost_center' => 'R063'] ],
            [ ['name' => 'SPA'], ['cost_center' => 'R064'] ],
            [ ['name' => 'Marketing Research'], ['cost_center' => 'R065'] ],
            [ ['name' => 'Marketing Research'], ['cost_center' => 'R066'] ],
            [ ['name' => 'Quality'], ['cost_center' => 'R067'] ],
            [ ['name' => 'SBD'], ['cost_center' => 'R068'] ],
            [ ['name' => 'Property Maintenance'], ['cost_center' => 'R069'] ],
            [ ['name' => 'Project Development Property'], ['cost_center' => 'R070'] ],
            [ ['name' => 'Sales & Service'], ['cost_center' => 'R071'] ],
            [ ['name' => 'Management 1'], ['cost_center' => 'R072'] ],
            [ ['name' => 'Management 2'], ['cost_center' => 'R073'] ],
            [ ['name' => 'Management 3'], ['cost_center' => 'R074'] ],
            [ ['name' => 'Management 4'], ['cost_center' => 'R075'] ],
            [ ['name' => 'Branch PKU'], ['cost_center' => 'R076'] ],
            [ ['name' => 'Branch BTH'], ['cost_center' => 'R077'] ],
            [ ['name' => 'Branch PLM'], ['cost_center' => 'R078'] ],
            [ ['name' => 'Branch SOC'], ['cost_center' => 'R079'] ],
            [ ['name' => 'Branch SRG'], ['cost_center' => 'R080'] ],
        ];

        foreach($data as $row) {
            Model::updateOrCreate(
                $row[0],
                $row[1],
            );
        }
    }
}
