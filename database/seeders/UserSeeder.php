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
        Model::factory()->create([
            'name' => 'Muhammad Cahya',
            'username' => 'muhammadcahyax',
            'email' => 'muhammadcahyax@gmail.com',
            'password' => 'password',
        ]);
    }
}
