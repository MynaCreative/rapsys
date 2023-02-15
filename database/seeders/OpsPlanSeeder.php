<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

use Maatwebsite\Excel\Facades\Excel;

use App\Imports\DataImport;
use App\Models\OpsPlan as Model;
use App\Imports\OpsPlanImport;

class OpsPlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Excel::import(new OpsPlanImport, storage_path('imports/ops_plan_ecp.xlsx'));
        // Excel::import(new OpsPlanImport, storage_path('imports/ops_plan_hwp.xlsx'));
        // Excel::import(new OpsPlanImport, storage_path('imports/ops_plan_mdp.xlsx'));
        // Excel::import(new OpsPlanImport, storage_path('imports/ops_plan_ndp.xlsx'));
        // Excel::import(new OpsPlanImport, storage_path('imports/ops_plan_phw.xlsx'));
        // Excel::import(new OpsPlanImport, storage_path('imports/ops_plan_psc.xlsx'));
        // Excel::import(new OpsPlanImport, storage_path('imports/ops_plan_psm.xlsx'));
        // Excel::import(new OpsPlanImport, storage_path('imports/ops_plan_psn.xlsx'));
        // Excel::import(new OpsPlanImport, storage_path('imports/ops_plan_pss.xlsx'));
        // Excel::import(new OpsPlanImport, storage_path('imports/ops_plan_sdp.xlsx'));
        // Excel::import(new OpsPlanImport, storage_path('imports/ops_plan_psr_1.1.xlsx'));
        // Excel::import(new OpsPlanImport, storage_path('imports/ops_plan_psr_1.2.xlsx'));
        // Excel::import(new OpsPlanImport, storage_path('imports/ops_plan_psr_2.1.xlsx'));
        // Excel::import(new OpsPlanImport, storage_path('imports/ops_plan_psr_2.1.xlsx'));
        // Excel::import(new OpsPlanImport, storage_path('imports/ops_plan_rgp_1.1.xlsx'));
        // Excel::import(new OpsPlanImport, storage_path('imports/ops_plan_rgp_1.2.xlsx'));
        // Excel::import(new OpsPlanImport, storage_path('imports/ops_plan_rgp_2.1.xlsx'));
        // Excel::import(new OpsPlanImport, storage_path('imports/ops_plan_rgp_2.1.xlsx'));
    }

    public function import(){
        $rows = Excel::toCollection(new DataImport, storage_path('imports/ops_plan.xlsx'))->first();
        $this->command->getOutput()->progressStart($rows->count());
        DB::transaction(function () use ($rows) {
            foreach($rows as $row){
                $value = $row->except(['created_by','updated_by','created_at','updated_at'])->toArray();
                Model::create($value);
                $this->command->getOutput()->progressAdvance();
            }
        });
        $this->command->getOutput()->progressFinish();
    }
}
