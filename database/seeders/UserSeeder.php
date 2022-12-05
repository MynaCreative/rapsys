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
            'name' => 'Super User',
            'username' => 'super.user',
            'email' => 'super.user@rpx.co.id',
            'password' => 'password',
        ]);
        $user->assignRole('Super User');
    }
}
