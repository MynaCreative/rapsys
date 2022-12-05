<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\PermissionGroup as Model;

class PermissionGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $group = Model::create(['name' => 'General', 'sequence' => 1]);
        $group->permissions()->createMany([
            ['name' => 'inbox', 'label' => 'Inbox'],
        ]);

        $group = Model::create(['name' => 'Transaction', 'sequence' => 2]);
        $group->permissions()->createMany([
            ['name' => 'invoice', 'label' => 'Invoice'],
            ['name' => 'report', 'label' => 'Report'],
        ]);

        $group = Model::create(['name' => 'Master', 'sequence' => 3]);
        $group->permissions()->createMany([
            ['name' => 'expense', 'label' => 'Expense'],
            ['name' => 'area', 'label' => 'Area'],
            ['name' => 'product', 'label' => 'Product'],
            ['name' => 'department', 'label' => 'Department'],
            ['name' => 'sales-channel', 'label' => 'Sales Channel'],
            ['name' => 'vendor', 'label' => 'Vendor'],
            ['name' => 'invoice-type', 'label' => 'Invoice Type'],
            ['name' => 'line-type', 'label' => 'Line Type'],
            ['name' => 'currency', 'label' => 'Currency'],
            ['name' => 'term', 'label' => 'Term'],
            ['name' => 'tax', 'label' => 'Tax'],
        ]);

        $group = Model::create(['name' => 'Administrator', 'sequence' => 4]);
        $group->permissions()->createMany([
            ['name' => 'user', 'label' => 'User'],
            ['name' => 'role', 'label' => 'Role'],
            ['name' => 'permission', 'label' => 'Permission'],
            ['name' => 'permission-group', 'label' => 'Permission Group'],
        ]);

        $group = Model::create(['name' => 'Configuration', 'sequence' => 5]);
        $group->permissions()->createMany([
            ['name' => 'approval', 'label' => 'Approval'],
        ]);
    }
}
