<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        DB::transaction(function () {
            activity()->withoutLogs(function () {
                $this->call(DepartmentSeeder::class);
                $this->call(CostCenterSeeder::class);
                $this->call(PermissionGroupSeeder::class);
                $this->call(RoleSeeder::class);
                $this->call(UserSeeder::class);
                $this->call(WorkflowSeeder::class);

                $this->call(SbuSeeder::class);
                $this->call(TaxSeeder::class);
                $this->call(AreaSeeder::class);
                $this->call(TermSeeder::class);
                $this->call(IntercoSeeder::class);
                $this->call(ExpenseSeeder::class);
                $this->call(ProductSeeder::class);
                $this->call(CurrencySeeder::class);
                $this->call(LineTypeSeeder::class);
                $this->call(InvoiceTypeSeeder::class);
                $this->call(WithholdingSeeder::class);
                $this->call(SalesChannelSeeder::class);

                $this->call(VendorSeeder::class);
                $this->call(OpsPlanSeeder::class);
            });
        });
    }
}
