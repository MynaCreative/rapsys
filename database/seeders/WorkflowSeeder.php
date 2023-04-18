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
            [['user_id' => $this->getUser('msyukri@rpxholding.com')], ['sequence' => 1, 'range_from' => 0, 'range_to' => 5000000]],
            [['user_id' => $this->getUser('pradikta.putra@rpxholding.com')], ['sequence' => 2, 'range_from' => 5000001, 'range_to' => 10000000]],
            [['user_id' => $this->getUser('subiyantoro@rpxholding.com')], ['sequence' => 3, 'range_from' => 10000001, 'range_to' => 30000000]],
        ];

        foreach ($data as $row) {
            Model::updateOrCreate(
                $row[0],
                $row[1],
            );
        }
    }

    public function getUser($email)
    {
        return User::where('email', $email)->value('id');
    }
}
