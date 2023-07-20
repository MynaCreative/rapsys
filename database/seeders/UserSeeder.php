<?php

namespace Database\Seeders;

use App\Models\Department;
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
            'department_id' => 51,
            'name'          => 'FA Dev',
            'username'      => 'fa-development',
            'email'         => 'fa-development@rpxholding.com',
            'password'      => 'password',
        ]);
        $user->assignRole('Administrator');

        $user = Model::factory()->create([
            'department_id' => 51,
            'name'          => 'Mamik Rahayu',
            'username'      => 'mrahayu1',
            'email'         => 'mrahayu1@rpxholding.com',
            'password'      => 'password',
            'position'      => 'Position'
        ]);
        $user->assignRole('Administrator');

        $user = Model::factory()->create([
            'department_id' => 51,
            'name'          => 'Leo Alfa Risma Savitri',
            'username'      => 'lsavitri',
            'email'         => 'lsavitri@rpxholding.com',
            'password'      => 'password',
            'position'      => 'Position'
        ]);
        $user->assignRole('Administrator');

        $user = Model::factory()->create([
            'department_id' => 7,
            'name'          => 'Muh Ismail Syukri',
            'username'      => 'msyukri',
            'email'         => 'msyukri@rpxholding.com',
            'password'      => 'password',
            'position'      => 'Manager'
        ]);
        $user->assignRole('Super User');

        $user = Model::factory()->create([
            'department_id' => 7,
            'name'          => 'Pradikta Putra',
            'username'      => 'pradikta.putra',
            'email'         => 'pradikta.putra@rpxholding.com',
            'password'      => 'password',
            'position'      => 'Senior Manager'
        ]);
        $user->assignRole('Approver');

        $user = Model::factory()->create([
            'department_id' => 7,
            'name'          => 'Welliam Munaiseche',
            'username'      => 'wmunaiseche',
            'email'         => 'wmunaiseche@rpxholding.com',
            'password'      => 'password',
            'position'      => 'Manager'
        ]);
        $user->assignRole('Approver');

        $user = Model::factory()->create([
            'department_id' => 7,
            'name'          => 'Subiyantoro',
            'username'      => 'subiyantoro',
            'email'         => 'subiyantoro@rpxholding.com',
            'password'      => 'password',
            'position'      => 'General Manager'
        ]);
        $user->assignRole('Approver');

        $user = Model::factory()->create([
            'department_id' => 7,
            'name'          => 'Tri Haryati',
            'username'      => 'tharyati',
            'email'         => 'tharyati@rpxholding.com',
            'password'      => 'password',
            'position'      => 'Position'
        ]);
        $user->assignRole('Requestor');

        $user = Model::factory()->create([
            'department_id' => 7,
            'name'          => 'Arfian Fidya',
            'username'      => 'autama',
            'email'         => 'autama@rpxholding.com',
            'password'      => 'password',
            'position'      => 'Position'
        ]);
        $user->assignRole('Master');

        $data = [
            ['department' => 'Branch BDO', 'name' => 'Dina Indika Putri', 'username' => 'dputri', 'email' => 'dputri@rpxholding.com', 'position' => 'Requestor'],
            ['department' => 'Branch BDO', 'name' => 'Reyhan Sigit Sulistyo', 'username' => 'rsulistyo', 'email' => 'rsulistyo@rpxholding.com', 'position' => 'Manager'],
            ['department' => 'Branch BDO', 'name' => 'Reza Nugraha', 'username' => 'rnugraha', 'email' => 'rnugraha@rpxholding.com', 'position' => 'Senior Manager'],
            ['department' => 'Branch BDO', 'name' => 'Arwiyanto', 'username' => 'arwiyanto', 'email' => 'arwiyanto@rpxholding.com', 'position' => 'General Manager'],
            ['department' => 'Branch BDO', 'name' => 'Riza Triyadi', 'username' => 'rtriyadi', 'email' => 'rtriyadi@rpxholding.com', 'position' => 'Chief Operation Officer'],
            ['department' => 'Branch BDO', 'name' => 'Ahsan Syahrir', 'username' => 'asyahrir', 'email' => 'asyahrir@rpxholding.com', 'position' => 'Budget'],
            ['department' => 'Branch BPN', 'name' => 'Kristina Sampe Lolo', 'username' => 'klolo', 'email' => 'klolo@rpxholding.com', 'position' => 'Requestor'],
            ['department' => 'Branch BPN', 'name' => 'Akhmad Yusron Fuad', 'username' => 'afuad', 'email' => 'afuad@rpxholding.com', 'position' => 'Manager'],
            ['department' => 'Branch BTH', 'name' => 'Dhini Puji Ridhowati', 'username' => 'dridhowati', 'email' => 'dridhowati@rpxholding.com', 'position' => 'Requestor'],
            ['department' => 'Branch BTH', 'name' => 'Pratomi Arjuna', 'username' => 'parjuna', 'email' => 'parjuna@rpxholding.com', 'position' => 'Manager'],
            ['department' => 'Branch DPS', 'name' => 'Ni Kadek Pariani', 'username' => 'npariani', 'email' => 'npariani@rpxholding.com', 'position' => 'Requestor'],
            ['department' => 'Branch DPS', 'name' => 'Carolia Kusuma Ayu', 'username' => 'cayu', 'email' => 'cayu@rpxholding.com', 'position' => 'Manager'],
            ['department' => 'Branch JOG', 'name' => 'Surtika', 'username' => 'surtika', 'email' => 'surtika@rpxholding.com', 'position' => 'Requestor'],
            ['department' => 'Branch JOG', 'name' => 'Muhamad Lukman Al Hakim', 'username' => 'mhakim1', 'email' => 'mhakim1@rpxholding.com', 'position' => 'Manager'],
            ['department' => 'Branch MES', 'name' => 'Julaila', 'username' => 'julaila', 'email' => 'julaila@rpxholding.com', 'position' => 'Requestor'],
            ['department' => 'Branch MES', 'name' => 'Dedi Sanjaya', 'username' => 'dsanjaya', 'email' => 'dsanjaya@rpxholding.com', 'position' => 'Manager'],
            ['department' => 'Branch PKU', 'name' => 'Siti Aisyah', 'username' => 'saisyah', 'email' => 'saisyah@rpxholding.com', 'position' => 'Requestor'],
            ['department' => 'Branch PKU', 'name' => 'Indra Budiman', 'username' => 'ibudiman', 'email' => 'ibudiman@rpxholding.com', 'position' => 'Supervisor'],
            ['department' => 'Branch PLM', 'name' => 'M. Aben Jauhari', 'username' => 'mjauhari', 'email' => 'mjauhari@rpxholding.com', 'position' => 'Requestor'],
            ['department' => 'Branch PLM', 'name' => 'Yessy Anggraini', 'username' => 'yanggraini', 'email' => 'yanggraini@rpxholding.com', 'position' => 'Manager'],
            ['department' => 'Branch SOC', 'name' => 'Gino', 'username' => 'gino1', 'email' => 'gino1@rpxholding.com', 'position' => 'Requestor'],
            ['department' => 'Branch SOC', 'name' => 'Satria Panji Kusuma', 'username' => 'skusuma', 'email' => 'skusuma@rpxholding.com', 'position' => 'Supervisor'],
            ['department' => 'Branch SRG', 'name' => 'Renie Wiyanti', 'username' => 'rwiyanti', 'email' => 'rwiyanti@rpxholding.com', 'position' => 'Requestor'],
            ['department' => 'Branch SRG', 'name' => 'Wildan Aziz Wijanarko', 'username' => 'wwijanarko', 'email' => 'wwijanarko@rpxholding.com', 'position' => 'Manager'],
            ['department' => 'Branch SUB', 'name' => 'Niswatin', 'username' => 'niswatin', 'email' => 'niswatin@rpxholding.com', 'position' => 'Requestor'],
            ['department' => 'Branch SUB', 'name' => 'Johan Saputra Yachya', 'username' => 'jyachya', 'email' => 'jyachya@rpxholding.com', 'position' => 'Manager'],
            ['department' => 'Branch UPG', 'name' => 'Asni', 'username' => 'asni', 'email' => 'asni@rpxholding.com', 'position' => 'Requestor'],
            ['department' => 'Branch UPG', 'name' => 'Michael Jamlean', 'username' => 'mjamlean', 'email' => 'mjamlean@rpxholding.com', 'position' => 'Manager'],
            ['department' => 'Express Ops CGK', 'name' => 'Nisma Damayanti', 'username' => 'ndamayanti', 'email' => 'ndamayanti@rpxholding.com', 'position' => 'Requestor'],
            ['department' => 'Express Ops CGK', 'name' => 'Dwi Budhi Hartono', 'username' => 'dhartono', 'email' => 'dhartono@rpxholding.com', 'position' => 'Manager'],
            ['department' => 'Express Ops CGK', 'name' => 'Suroto', 'username' => 'scarmen', 'email' => 'scarmen@rpxholding.com', 'position' => 'Senior Manager'],
            ['department' => 'Express Ops CGK', 'name' => 'Ridha Faried Firdaus', 'username' => 'rfaried', 'email' => 'rfaried@rpxholding.com', 'position' => 'General Manager'],
            ['department' => 'Express Ops CXP', 'name' => 'Wahyu Nurningsih', 'username' => 'wnurningsih', 'email' => 'wnurningsih@rpxholding.com', 'position' => 'Requestor'],
            ['department' => 'Express Ops CXP', 'name' => 'Eko Budi Santoso', 'username' => 'esantoso', 'email' => 'esantoso@rpxholding.com', 'position' => 'Manager'],
            ['department' => 'Express Ops Ecommerce', 'name' => 'Guruh Widharsa Kusuma', 'username' => 'gkusuma', 'email' => 'gkusuma@rpxholding.com', 'position' => 'Requestor'],
            ['department' => 'Express Ops Ecommerce', 'name' => 'Samuel Parningotan Pane', 'username' => 'spane', 'email' => 'spane@rpxholding.com', 'position' => 'Manager'],
            ['department' => 'Express Ops Ecommerce', 'name' => 'Faisal Nasution', 'username' => 'fnasution', 'email' => 'fnasution@rpxholding.com', 'position' => 'Senior Manager'],
            ['department' => 'Express Ops HLP BJG', 'name' => 'M. Renando Berry', 'username' => 'mberry', 'email' => 'mberry@rpxholding.com', 'position' => 'Requestor'],
            ['department' => 'Express Ops HLP BJG', 'name' => 'Daniel Dwiputra', 'username' => 'dputra', 'email' => 'dputra@rpxholding.com', 'position' => 'Manager'],
            ['department' => 'Express Ops JKT', 'name' => 'Jessica Tamara Susanto', 'username' => 'jsusanto', 'email' => 'jsusanto@rpxholding.com', 'position' => 'Requestor'],
            ['department' => 'Express Ops JKT', 'name' => 'Encep Fitrah', 'username' => 'efitrah', 'email' => 'efitrah@rpxholding.com', 'position' => 'Manager'],
            ['department' => 'Express Strategic Ops', 'name' => 'Jessica Souhoka', 'username' => 'jsouhoka', 'email' => 'jsouhoka@rpxholding.com', 'position' => 'Requestor'],
            ['department' => 'Express Strategic Ops', 'name' => 'Army Irfan', 'username' => 'airfan', 'email' => 'airfan@rpxholding.com', 'position' => 'Manager'],
            ['department' => 'Linehaul Service', 'name' => 'Rizhal Rachmawan', 'username' => 'rrachmawan1', 'email' => 'rrachmawan1@rpxholding.com', 'position' => 'Requestor'],
            ['department' => 'Linehaul Service', 'name' => 'RIZKI DWI RAHMADI', 'username' => 'rrahmadi', 'email' => 'rrahmadi@rpxholding.com', 'position' => 'Manager'],
            ['department' => 'Network Operation', 'name' => 'Onelysia Marthing', 'username' => 'omarthing', 'email' => 'omarthing@rpxholding.com', 'position' => 'Requestor'],
            ['department' => 'Network Operation', 'name' => 'Sigit Pujatmoko', 'username' => 'spujatmoko', 'email' => 'spujatmoko@rpxholding.com', 'position' => 'Manager'],
            ['department' => 'Outlet', 'name' => 'Rizki Evita', 'username' => 'revita', 'email' => 'revita@rpxholding.com', 'position' => 'Requestor'],
            ['department' => 'Outlet', 'name' => 'Naufal Zuhdi', 'username' => 'nzuhdi', 'email' => 'nzuhdi@rpxholding.com', 'position' => 'Manager'],
            ['department' => 'Project Spec DG Handling', 'name' => 'M. Wahyu Wicaksono', 'username' => 'mwicaksono', 'email' => 'mwicaksono@rpxholding.com', 'position' => 'Manager'],
        ];

        foreach ($data as $row) {
            $user = Model::factory()->create([
                'department_id' => $this->getDepartment($row['department']),
                'name'          => $row['name'],
                'username'      => $row['username'],
                'email'         => $row['email'],
                'position'      => $row['position'],
                'password'      => 'password',
            ]);
            if ($row['position'] == 'Requestor') {
                $user->assignRole('Requestor');
            } else {
                $user->assignRole('Approver');
            }
        }
    }

    public function getDepartment($name)
    {
        return Department::where('name', $name)->value('id');
    }
}
