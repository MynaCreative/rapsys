<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Workflow as Model;
use App\Models\User;

class WorkflowSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [ ['user_id' => $this->getUser('pradikta.putra@rpxholding.com')], ['sequence' => 1] ],
            [ ['user_id' => $this->getUser('wmunaiseche@rpxholding.com')], ['sequence' => 2] ],
        ];

        foreach($data as $row) {
            Model::updateOrCreate(
                $row[0],
                $row[1],
            );
        }
    }

    public function getUser($email){
        return User::where('email', $email)->value('id');
    }
}
