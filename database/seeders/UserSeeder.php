<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\User as Model;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = Model::factory()->create([
            'position'  => Model::POSITION_IT,
            'name'      => 'Mamik Rahayu',
            'username'  => 'mrahayu1',
            'email'     => 'mrahayu1@rpxholding.com',
            'password'  => 'password',
        ]);
        $user->assignRole('Administrator');

        $user = Model::factory()->create([
            'position'  => Model::POSITION_IT,
            'name'      => 'FA Dev',
            'username'  => 'fa-development',
            'email'     => 'fa-development@rpxholding.com',
            'password'  => 'password',
        ]);
        $user->assignRole('Administrator');

        $user = Model::factory()->create([
            'position'  => Model::POSITION_FINANCE,
            'name'      => 'Muh Ismail Syukri',
            'username'  => 'msyukri',
            'email'     => 'msyukri@rpxholding.com',
            'password'  => 'password',
        ]);
        $user->assignRole('Super User');

        $user = Model::factory()->create([
            'position'  => Model::POSITION_FINANCE,
            'name'      => 'Pradikta Putra',
            'username'  => 'pradikta.putra',
            'email'     => 'pradikta.putra@rpxholding.com',
            'password'  => 'password',
        ]);
        $user->assignRole('Approver');

        $user = Model::factory()->create([
            'position'  => Model::POSITION_FINANCE,
            'name'      => 'Welliam Munaiseche',
            'username'  => 'wmunaiseche',
            'email'     => 'wmunaiseche@rpxholding.com',
            'password'  => 'password',
        ]);
        $user->assignRole('Approver');

        $user = Model::factory()->create([
            'position'  => Model::POSITION_FINANCE,
            'name'      => 'Tri Haryati',
            'username'  => 'tharyati',
            'email'     => 'tharyati@rpxholding.com',
            'password'  => 'password',
        ]);
        $user->assignRole('Requestor');

        $user = Model::factory()->create([
            'position'  => Model::POSITION_FINANCE,
            'name'      => 'Arfian Fidya',
            'username'  => 'autama',
            'email'     => 'autama@rpxholding.com',
            'password'  => 'password',
        ]);
        $user->assignRole('Master');
    }
}
