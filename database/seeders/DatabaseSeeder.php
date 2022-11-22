<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

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

        $this->call(UserSeeder::class);
        $this->call(AreaSeeder::class);
        $this->call(ExpenseSeeder::class);
        $this->call(ProductSeeder::class);
        $this->call(DepartmentSeeder::class);
        $this->call(InvoiceTypeSeeder::class);
        $this->call(SalesChannelSeeder::class);
    }
}
