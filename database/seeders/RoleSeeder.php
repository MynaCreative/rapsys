<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Role as Model;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::create(['name' => 'Administrator']);

        $requestor = Model::create(['name' => 'Requestor']);
        $requestor->syncPermissions(['invoice', 'report']);

        $requestor = Model::create(['name' => 'Approval']);
        $requestor->syncPermissions(['approval', 'invoice', 'report']);

        $requestor = Model::create(['name' => 'Master']);
        $requestor->syncPermissions([
            'expense',
            'area',
            'product',
            'department',
            'sales-channel',
            'vendor',
            'invoice-type',
            'line-type',
            'currency',
            'term',
            'tax',
            'sbu',
            'interco',
        ]);

        $requestor = Model::create(['name' => 'Super User']);
        $requestor->syncPermissions([
            'user',
            'role',
            'permission',
            'permission-group',

            'workflow',
        ]);
    }
}
