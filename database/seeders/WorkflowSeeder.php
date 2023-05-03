<?php

namespace Database\Seeders;

use App\Models\Department;
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
        $group = Model::create(['department_id' => $this->getDepartment('Treasury'), 'code' => 'TRY', 'name' => 'Workflow Treasury']);
        $group->items()->createMany([
            ['user_id' => $this->getUser('wmunaiseche@rpxholding.com'), 'sequence' => 1, 'range_from' => 0, 'range_to' => 5000000, 'description' => 'superior'],
            ['user_id' => $this->getUser('pradikta.putra@rpxholding.com'), 'sequence' => 2, 'range_from' => 5000001, 'range_to' => 10000000, 'description' => 'superior'],
            ['user_id' => $this->getUser('subiyantoro@rpxholding.com'), 'sequence' => 3, 'range_from' => 10000001, 'range_to' => 30000000, 'description' => 'superior'],
        ]);

        $group = Model::create(['department_id' => $this->getDepartment('FA Development'), 'code' => 'FAD', 'name' => 'Workflow FA Development']);
        $group->items()->createMany([
            ['user_id' => $this->getUser('msyukri@rpxholding.com'), 'sequence' => 1, 'range_from' => 0, 'range_to' => 5000000, 'description' => 'superior'],
            ['user_id' => $this->getUser('pradikta.putra@rpxholding.com'), 'sequence' => 2, 'range_from' => 5000001, 'range_to' => 10000000, 'description' => 'superior'],
            ['user_id' => $this->getUser('subiyantoro@rpxholding.com'), 'sequence' => 3, 'range_from' => 10000001, 'range_to' => 30000000, 'description' => 'superior'],
        ]);
    }

    public function getUser($email)
    {
        return User::where('email', $email)->value('id');
    }

    public function getDepartment($name)
    {
        return Department::where('name', $name)->value('id');
    }
}
