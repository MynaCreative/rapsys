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
            'position'  => Model::POSITION_VP,
            'name'      => 'Administrator',
            'username'  => 'administrator',
            'email'     => 'administrator@rpx.co.id',
            'password'  => 'password',
        ]);
        $user->assignRole('Administrator');

        $user = Model::factory()->create([
            'position'  => Model::POSITION_STAFF,
            'name'      => 'Super User',
            'username'  => 'super.user',
            'email'     => 'super.user@rpx.co.id',
            'password'  => 'password',
        ]);
        $user->assignRole('Super User');

        $user = Model::factory()->create([
            'position'  => Model::POSITION_MANAGER,
            'name'      => 'Manager',
            'username'  => 'manager',
            'email'     => 'manager@rpx.co.id',
            'password'  => 'password',
        ]);
        $user->assignRole('Approval');

        $user = Model::factory()->create([
            'position'  => Model::POSITION_SPECIALIST,
            'name'      => 'Specialist',
            'username'  => 'specialist',
            'email'     => 'specialist@rpx.co.id',
            'password'  => 'password',
        ]);
        $user->assignRole('Approval');

        $user = Model::factory()->create([
            'position'  => Model::POSITION_STAFF,
            'name'      => 'Requestor',
            'username'  => 'requestor',
            'email'     => 'requestor@rpx.co.id',
            'password'  => 'password',
        ]);
        $user->assignRole('Requestor');

        $user = Model::factory()->create([
            'position'  => Model::POSITION_STAFF,
            'name'      => 'Master',
            'username'  => 'master',
            'email'     => 'master@rpx.co.id',
            'password'  => 'password',
        ]);
        $user->assignRole('Master');
    }
}
