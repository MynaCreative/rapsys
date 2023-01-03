<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

use Maatwebsite\Excel\Facades\Excel;

use App\Imports\DataImport;
use App\Models\OpsPlan as Model;

class OpsPlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rows = Excel::toCollection(new DataImport, storage_path('imports/ops_plan_99.xlsx'))->first();
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
