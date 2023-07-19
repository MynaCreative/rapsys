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
        $this->workflowData();
        $this->workflowImport();
    }

    public function workflowData()
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

    public function workflowImport()
    {
        $data = collect([
            ['dept_name' => 'Branch BDO', 'employee_name' => 'Dina Indika Putri', 'user_id' => 'dputri', 'employee_email' => 'dputri@rpxholding.com', 'position_name' => 'Requestor', 'sequence' => '0', 'amount_from' => '0', 'amount_to' => '10000000000', 'employee_id' => '7193727'],
            ['dept_name' => 'Branch BDO', 'employee_name' => 'Reyhan Sigit Sulistyo', 'user_id' => 'rsulistyo', 'employee_email' => 'rsulistyo@rpxholding.com', 'position_name' => 'Manager', 'sequence' => '1', 'amount_from' => '0', 'amount_to' => '10000000000', 'employee_id' => '7237392'],
            ['dept_name' => 'Branch BDO', 'employee_name' => 'Reza Nugraha', 'user_id' => 'rnugraha', 'employee_email' => 'rnugraha@rpxholding.com', 'position_name' => 'Senior Manager', 'sequence' => '2', 'amount_from' => '0', 'amount_to' => '10000000000', 'employee_id' => '7227187'],
            ['dept_name' => 'Branch BDO', 'employee_name' => 'Arwiyanto ', 'user_id' => 'arwiyanto', 'employee_email' => 'arwiyanto@rpxholding.com', 'position_name' => 'General Manager', 'sequence' => '3', 'amount_from' => '0', 'amount_to' => '10000000000', 'employee_id' => '1141058'],
            ['dept_name' => 'Branch BDO', 'employee_name' => 'Riza Triyadi', 'user_id' => 'rtriyadi', 'employee_email' => 'rtriyadi@rpxholding.com', 'position_name' => 'Chief Operation Officer', 'sequence' => '4', 'amount_from' => '5000000', 'amount_to' => '10000000000', 'employee_id' => '2040928'],
            ['dept_name' => 'Branch BDO', 'employee_name' => 'Ahsan Syahrir', 'user_id' => 'asyahrir', 'employee_email' => 'asyahrir@rpxholding.com', 'position_name' => 'Budget', 'sequence' => '5', 'amount_from' => '0', 'amount_to' => '10000000000', 'employee_id' => '2228246'],
            ['dept_name' => 'Branch BPN', 'employee_name' => 'Kristina Sampe Lolo', 'user_id' => 'klolo', 'employee_email' => 'klolo@rpxholding.com', 'position_name' => 'Requestor', 'sequence' => '0', 'amount_from' => '0', 'amount_to' => '10000000000', 'employee_id' => '98227147'],
            ['dept_name' => 'Branch BPN', 'employee_name' => 'Akhmad Yusron Fuad', 'user_id' => 'afuad', 'employee_email' => 'afuad@rpxholding.com', 'position_name' => 'Manager', 'sequence' => '1', 'amount_from' => '0', 'amount_to' => '10000000000', 'employee_id' => '7227171'],
            ['dept_name' => 'Branch BPN', 'employee_name' => 'Reza Nugraha', 'user_id' => 'rnugraha', 'employee_email' => 'rnugraha@rpxholding.com', 'position_name' => 'Senior Manager', 'sequence' => '2', 'amount_from' => '0', 'amount_to' => '10000000000', 'employee_id' => '7227187'],
            ['dept_name' => 'Branch BPN', 'employee_name' => 'Arwiyanto ', 'user_id' => 'arwiyanto', 'employee_email' => 'arwiyanto@rpxholding.com', 'position_name' => 'General Manager', 'sequence' => '3', 'amount_from' => '0', 'amount_to' => '10000000000', 'employee_id' => '1141058'],
            ['dept_name' => 'Branch BPN', 'employee_name' => 'Riza Triyadi', 'user_id' => 'rtriyadi', 'employee_email' => 'rtriyadi@rpxholding.com', 'position_name' => 'Chief Operation Officer', 'sequence' => '4', 'amount_from' => '5000000', 'amount_to' => '10000000000', 'employee_id' => '2040928'],
            ['dept_name' => 'Branch BPN', 'employee_name' => 'Ahsan Syahrir', 'user_id' => 'asyahrir', 'employee_email' => 'asyahrir@rpxholding.com', 'position_name' => 'Budget', 'sequence' => '5', 'amount_from' => '0', 'amount_to' => '10000000000', 'employee_id' => '2228246'],
            ['dept_name' => 'Branch BTH', 'employee_name' => 'Dhini Puji Ridhowati', 'user_id' => 'dridhowati', 'employee_email' => 'dridhowati@rpxholding.com', 'position_name' => 'Requestor', 'sequence' => '0', 'amount_from' => '0', 'amount_to' => '10000000000', 'employee_id' => '99210974'],
            ['dept_name' => 'Branch BTH', 'employee_name' => 'Pratomi Arjuna', 'user_id' => 'parjuna', 'employee_email' => 'parjuna@rpxholding.com', 'position_name' => 'Manager', 'sequence' => '1', 'amount_from' => '0', 'amount_to' => '10000000000', 'employee_id' => '4201092'],
            ['dept_name' => 'Branch BTH', 'employee_name' => 'Reza Nugraha', 'user_id' => 'rnugraha', 'employee_email' => 'rnugraha@rpxholding.com', 'position_name' => 'Senior Manager', 'sequence' => '2', 'amount_from' => '0', 'amount_to' => '10000000000', 'employee_id' => '7227187'],
            ['dept_name' => 'Branch BTH', 'employee_name' => 'Arwiyanto ', 'user_id' => 'arwiyanto', 'employee_email' => 'arwiyanto@rpxholding.com', 'position_name' => 'General Manager', 'sequence' => '3', 'amount_from' => '0', 'amount_to' => '10000000000', 'employee_id' => '1141058'],
            ['dept_name' => 'Branch BTH', 'employee_name' => 'Riza Triyadi', 'user_id' => 'rtriyadi', 'employee_email' => 'rtriyadi@rpxholding.com', 'position_name' => 'Chief Operation Officer', 'sequence' => '4', 'amount_from' => '5000000', 'amount_to' => '10000000000', 'employee_id' => '2040928'],
            ['dept_name' => 'Branch BTH', 'employee_name' => 'Ahsan Syahrir', 'user_id' => 'asyahrir', 'employee_email' => 'asyahrir@rpxholding.com', 'position_name' => 'Budget', 'sequence' => '5', 'amount_from' => '0', 'amount_to' => '10000000000', 'employee_id' => '2228246'],
            ['dept_name' => 'Branch DPS', 'employee_name' => 'Ni Kadek Pariani', 'user_id' => 'npariani', 'employee_email' => 'npariani@rpxholding.com', 'position_name' => 'Requestor', 'sequence' => '0', 'amount_from' => '0', 'amount_to' => '10000000000', 'employee_id' => '7215360'],
            ['dept_name' => 'Branch DPS', 'employee_name' => 'Carolia Kusuma Ayu', 'user_id' => 'cayu', 'employee_email' => 'cayu@rpxholding.com', 'position_name' => 'Manager', 'sequence' => '1', 'amount_from' => '0', 'amount_to' => '10000000000', 'employee_id' => '7121624'],
            ['dept_name' => 'Branch DPS', 'employee_name' => 'Arwiyanto ', 'user_id' => 'arwiyanto', 'employee_email' => 'arwiyanto@rpxholding.com', 'position_name' => 'General Manager', 'sequence' => '2', 'amount_from' => '0', 'amount_to' => '10000000000', 'employee_id' => '1141058'],
            ['dept_name' => 'Branch DPS', 'employee_name' => 'Riza Triyadi', 'user_id' => 'rtriyadi', 'employee_email' => 'rtriyadi@rpxholding.com', 'position_name' => 'Chief Operation Officer', 'sequence' => '3', 'amount_from' => '5000000', 'amount_to' => '10000000000', 'employee_id' => '2040928'],
            ['dept_name' => 'Branch DPS', 'employee_name' => 'Ahsan Syahrir', 'user_id' => 'asyahrir', 'employee_email' => 'asyahrir@rpxholding.com', 'position_name' => 'Budget', 'sequence' => '4', 'amount_from' => '0', 'amount_to' => '10000000000', 'employee_id' => '2228246'],
            ['dept_name' => 'Branch JOG', 'employee_name' => 'Surtika ', 'user_id' => 'surtika', 'employee_email' => 'surtika@rpxholding.com', 'position_name' => 'Requestor', 'sequence' => '0', 'amount_from' => '0', 'amount_to' => '10000000000', 'employee_id' => '7226474'],
            ['dept_name' => 'Branch JOG', 'employee_name' => 'Muhamad Lukman Al Hakim', 'user_id' => 'mhakim1', 'employee_email' => 'mhakim1@rpxholding.com', 'position_name' => 'Manager', 'sequence' => '1', 'amount_from' => '0', 'amount_to' => '10000000000', 'employee_id' => '1151187'],
            ['dept_name' => 'Branch JOG', 'employee_name' => 'Arwiyanto ', 'user_id' => 'arwiyanto', 'employee_email' => 'arwiyanto@rpxholding.com', 'position_name' => 'General Manager', 'sequence' => '2', 'amount_from' => '0', 'amount_to' => '10000000000', 'employee_id' => '1141058'],
            ['dept_name' => 'Branch JOG', 'employee_name' => 'Riza Triyadi', 'user_id' => 'rtriyadi', 'employee_email' => 'rtriyadi@rpxholding.com', 'position_name' => 'Chief Operation Officer', 'sequence' => '3', 'amount_from' => '5000000', 'amount_to' => '10000000000', 'employee_id' => '2040928'],
            ['dept_name' => 'Branch JOG', 'employee_name' => 'Ahsan Syahrir', 'user_id' => 'asyahrir', 'employee_email' => 'asyahrir@rpxholding.com', 'position_name' => 'Budget', 'sequence' => '4', 'amount_from' => '0', 'amount_to' => '10000000000', 'employee_id' => '2228246'],
            ['dept_name' => 'Branch MES', 'employee_name' => 'Julaila ', 'user_id' => 'julaila', 'employee_email' => 'julaila@rpxholding.com', 'position_name' => 'Requestor', 'sequence' => '0', 'amount_from' => '0', 'amount_to' => '10000000000', 'employee_id' => '7215355'],
            ['dept_name' => 'Branch MES', 'employee_name' => 'Dedi Sanjaya', 'user_id' => 'dsanjaya', 'employee_email' => 'dsanjaya@rpxholding.com', 'position_name' => 'Manager', 'sequence' => '1', 'amount_from' => '0', 'amount_to' => '10000000000', 'employee_id' => '7215758'],
            ['dept_name' => 'Branch MES', 'employee_name' => 'Reza Nugraha', 'user_id' => 'rnugraha', 'employee_email' => 'rnugraha@rpxholding.com', 'position_name' => 'Senior Manager', 'sequence' => '2', 'amount_from' => '0', 'amount_to' => '10000000000', 'employee_id' => '7227187'],
            ['dept_name' => 'Branch MES', 'employee_name' => 'Arwiyanto ', 'user_id' => 'arwiyanto', 'employee_email' => 'arwiyanto@rpxholding.com', 'position_name' => 'General Manager', 'sequence' => '3', 'amount_from' => '0', 'amount_to' => '10000000000', 'employee_id' => '1141058'],
            ['dept_name' => 'Branch MES', 'employee_name' => 'Riza Triyadi', 'user_id' => 'rtriyadi', 'employee_email' => 'rtriyadi@rpxholding.com', 'position_name' => 'Chief Operation Officer', 'sequence' => '4', 'amount_from' => '5000000', 'amount_to' => '10000000000', 'employee_id' => '2040928'],
            ['dept_name' => 'Branch MES', 'employee_name' => 'Ahsan Syahrir', 'user_id' => 'asyahrir', 'employee_email' => 'asyahrir@rpxholding.com', 'position_name' => 'Budget', 'sequence' => '5', 'amount_from' => '0', 'amount_to' => '10000000000', 'employee_id' => '2228246'],
            ['dept_name' => 'Branch PKU', 'employee_name' => 'Siti Aisyah ', 'user_id' => 'saisyah', 'employee_email' => 'saisyah@rpxholding.com', 'position_name' => 'Requestor', 'sequence' => '0', 'amount_from' => '0', 'amount_to' => '10000000000', 'employee_id' => '7142014'],
            ['dept_name' => 'Branch PKU', 'employee_name' => 'Indra Budiman', 'user_id' => 'ibudiman', 'employee_email' => 'ibudiman@rpxholding.com', 'position_name' => 'Supervisor', 'sequence' => '1', 'amount_from' => '0', 'amount_to' => '10000000000', 'employee_id' => '7215225'],
            ['dept_name' => 'Branch PKU', 'employee_name' => 'Reza Nugraha', 'user_id' => 'rnugraha', 'employee_email' => 'rnugraha@rpxholding.com', 'position_name' => 'Senior Manager', 'sequence' => '2', 'amount_from' => '0', 'amount_to' => '10000000000', 'employee_id' => '7227187'],
            ['dept_name' => 'Branch PKU', 'employee_name' => 'Arwiyanto ', 'user_id' => 'arwiyanto', 'employee_email' => 'arwiyanto@rpxholding.com', 'position_name' => 'General Manager', 'sequence' => '3', 'amount_from' => '0', 'amount_to' => '10000000000', 'employee_id' => '1141058'],
            ['dept_name' => 'Branch PKU', 'employee_name' => 'Riza Triyadi', 'user_id' => 'rtriyadi', 'employee_email' => 'rtriyadi@rpxholding.com', 'position_name' => 'Chief Operation Officer', 'sequence' => '4', 'amount_from' => '5000000', 'amount_to' => '10000000000', 'employee_id' => '2040928'],
            ['dept_name' => 'Branch PKU', 'employee_name' => 'Ahsan Syahrir', 'user_id' => 'asyahrir', 'employee_email' => 'asyahrir@rpxholding.com', 'position_name' => 'Budget', 'sequence' => '5', 'amount_from' => '0', 'amount_to' => '10000000000', 'employee_id' => '2228246'],
            ['dept_name' => 'Branch PLM', 'employee_name' => 'M. Aben Jauhari', 'user_id' => 'mjauhari', 'employee_email' => 'mjauhari@rpxholding.com', 'position_name' => 'Requestor', 'sequence' => '0', 'amount_from' => '0', 'amount_to' => '10000000000', 'employee_id' => '7215632'],
            ['dept_name' => 'Branch PLM', 'employee_name' => 'Yessy Anggraini', 'user_id' => 'yanggraini', 'employee_email' => 'yanggraini@rpxholding.com', 'position_name' => 'Manager', 'sequence' => '1', 'amount_from' => '0', 'amount_to' => '10000000000', 'employee_id' => '2175606'],
            ['dept_name' => 'Branch PLM', 'employee_name' => 'Reza Nugraha', 'user_id' => 'rnugraha', 'employee_email' => 'rnugraha@rpxholding.com', 'position_name' => 'Senior Manager', 'sequence' => '2', 'amount_from' => '0', 'amount_to' => '10000000000', 'employee_id' => '7227187'],
            ['dept_name' => 'Branch PLM', 'employee_name' => 'Arwiyanto ', 'user_id' => 'arwiyanto', 'employee_email' => 'arwiyanto@rpxholding.com', 'position_name' => 'General Manager', 'sequence' => '3', 'amount_from' => '0', 'amount_to' => '10000000000', 'employee_id' => '1141058'],
            ['dept_name' => 'Branch PLM', 'employee_name' => 'Riza Triyadi', 'user_id' => 'rtriyadi', 'employee_email' => 'rtriyadi@rpxholding.com', 'position_name' => 'Chief Operation Officer', 'sequence' => '4', 'amount_from' => '5000000', 'amount_to' => '10000000000', 'employee_id' => '2040928'],
            ['dept_name' => 'Branch PLM', 'employee_name' => 'Ahsan Syahrir', 'user_id' => 'asyahrir', 'employee_email' => 'asyahrir@rpxholding.com', 'position_name' => 'Budget', 'sequence' => '5', 'amount_from' => '0', 'amount_to' => '10000000000', 'employee_id' => '2228246'],
            ['dept_name' => 'Branch SOC', 'employee_name' => 'Gino ', 'user_id' => 'gino1', 'employee_email' => 'gino1@rpxholding.com', 'position_name' => 'Requestor', 'sequence' => '0', 'amount_from' => '0', 'amount_to' => '10000000000', 'employee_id' => '7150363'],
            ['dept_name' => 'Branch SOC', 'employee_name' => 'Satria Panji Kusuma', 'user_id' => 'skusuma', 'employee_email' => 'skusuma@rpxholding.com', 'position_name' => 'Supervisor', 'sequence' => '1', 'amount_from' => '0', 'amount_to' => '10000000000', 'employee_id' => '7216021'],
            ['dept_name' => 'Branch SOC', 'employee_name' => 'Arwiyanto ', 'user_id' => 'arwiyanto', 'employee_email' => 'arwiyanto@rpxholding.com', 'position_name' => 'General Manager', 'sequence' => '2', 'amount_from' => '0', 'amount_to' => '10000000000', 'employee_id' => '1141058'],
            ['dept_name' => 'Branch SOC', 'employee_name' => 'Riza Triyadi', 'user_id' => 'rtriyadi', 'employee_email' => 'rtriyadi@rpxholding.com', 'position_name' => 'Chief Operation Officer', 'sequence' => '3', 'amount_from' => '5000000', 'amount_to' => '10000000000', 'employee_id' => '2040928'],
            ['dept_name' => 'Branch SOC', 'employee_name' => 'Ahsan Syahrir', 'user_id' => 'asyahrir', 'employee_email' => 'asyahrir@rpxholding.com', 'position_name' => 'Budget', 'sequence' => '4', 'amount_from' => '0', 'amount_to' => '10000000000', 'employee_id' => '2228246'],
            ['dept_name' => 'Branch SRG', 'employee_name' => 'Renie Wiyanti', 'user_id' => 'rwiyanti', 'employee_email' => 'rwiyanti@rpxholding.com', 'position_name' => 'Requestor', 'sequence' => '0', 'amount_from' => '0', 'amount_to' => '10000000000', 'employee_id' => '7960963'],
            ['dept_name' => 'Branch SRG', 'employee_name' => 'Wildan Aziz Wijanarko,', 'user_id' => 'wwijanarko', 'employee_email' => 'wwijanarko@rpxholding.com', 'position_name' => 'Manager', 'sequence' => '1', 'amount_from' => '0', 'amount_to' => '10000000000', 'employee_id' => '7226586'],
            ['dept_name' => 'Branch SRG', 'employee_name' => 'Arwiyanto ', 'user_id' => 'arwiyanto', 'employee_email' => 'arwiyanto@rpxholding.com', 'position_name' => 'General Manager', 'sequence' => '2', 'amount_from' => '0', 'amount_to' => '10000000000', 'employee_id' => '1141058'],
            ['dept_name' => 'Branch SRG', 'employee_name' => 'Riza Triyadi', 'user_id' => 'rtriyadi', 'employee_email' => 'rtriyadi@rpxholding.com', 'position_name' => 'Chief Operation Officer', 'sequence' => '3', 'amount_from' => '5000000', 'amount_to' => '10000000000', 'employee_id' => '2040928'],
            ['dept_name' => 'Branch SRG', 'employee_name' => 'Ahsan Syahrir', 'user_id' => 'asyahrir', 'employee_email' => 'asyahrir@rpxholding.com', 'position_name' => 'Budget', 'sequence' => '4', 'amount_from' => '0', 'amount_to' => '10000000000', 'employee_id' => '2228246'],
            ['dept_name' => 'Branch SUB', 'employee_name' => 'Niswatin ', 'user_id' => 'niswatin', 'employee_email' => 'niswatin@rpxholding.com', 'position_name' => 'Requestor', 'sequence' => '0', 'amount_from' => '0', 'amount_to' => '10000000000', 'employee_id' => '7226755'],
            ['dept_name' => 'Branch SUB', 'employee_name' => 'Johan Saputra Yachya,', 'user_id' => 'jyachya', 'employee_email' => 'jyachya@rpxholding.com', 'position_name' => 'Manager', 'sequence' => '1', 'amount_from' => '0', 'amount_to' => '10000000000', 'employee_id' => '7226218'],
            ['dept_name' => 'Branch SUB', 'employee_name' => 'Arwiyanto ', 'user_id' => 'arwiyanto', 'employee_email' => 'arwiyanto@rpxholding.com', 'position_name' => 'General Manager', 'sequence' => '2', 'amount_from' => '0', 'amount_to' => '10000000000', 'employee_id' => '1141058'],
            ['dept_name' => 'Branch SUB', 'employee_name' => 'Riza Triyadi', 'user_id' => 'rtriyadi', 'employee_email' => 'rtriyadi@rpxholding.com', 'position_name' => 'Chief Operation Officer', 'sequence' => '3', 'amount_from' => '5000000', 'amount_to' => '10000000000', 'employee_id' => '2040928'],
            ['dept_name' => 'Branch SUB', 'employee_name' => 'Ahsan Syahrir', 'user_id' => 'asyahrir', 'employee_email' => 'asyahrir@rpxholding.com', 'position_name' => 'Budget', 'sequence' => '4', 'amount_from' => '0', 'amount_to' => '10000000000', 'employee_id' => '2228246'],
            ['dept_name' => 'Branch UPG', 'employee_name' => 'Asni ', 'user_id' => 'asni', 'employee_email' => 'asni@rpxholding.com', 'position_name' => 'Requestor', 'sequence' => '0', 'amount_from' => '0', 'amount_to' => '10000000000', 'employee_id' => '7215369'],
            ['dept_name' => 'Branch UPG', 'employee_name' => 'Arwiyanto ', 'user_id' => 'arwiyanto', 'employee_email' => 'arwiyanto@rpxholding.com', 'position_name' => 'General Manager', 'sequence' => '2', 'amount_from' => '0', 'amount_to' => '10000000000', 'employee_id' => '1141058'],
            ['dept_name' => 'Branch UPG', 'employee_name' => 'Michael Jamlean', 'user_id' => 'mjamlean', 'employee_email' => 'mjamlean@rpxholding.com', 'position_name' => 'Manager', 'sequence' => '2', 'amount_from' => '0', 'amount_to' => '10000000000', 'employee_id' => '7204163'],
            ['dept_name' => 'Branch UPG', 'employee_name' => 'Riza Triyadi', 'user_id' => 'rtriyadi', 'employee_email' => 'rtriyadi@rpxholding.com', 'position_name' => 'Chief Operation Officer', 'sequence' => '3', 'amount_from' => '5000000', 'amount_to' => '10000000000', 'employee_id' => '2040928'],
            ['dept_name' => 'Branch UPG', 'employee_name' => 'Ahsan Syahrir', 'user_id' => 'asyahrir', 'employee_email' => 'asyahrir@rpxholding.com', 'position_name' => 'Budget', 'sequence' => '4', 'amount_from' => '0', 'amount_to' => '10000000000', 'employee_id' => '2228246'],
            ['dept_name' => 'Express Ops CGK', 'employee_name' => 'Nisma Damayanti', 'user_id' => 'ndamayanti', 'employee_email' => 'ndamayanti@rpxholding.com', 'position_name' => 'Requestor', 'sequence' => '0', 'amount_from' => '0', 'amount_to' => '10000000000', 'employee_id' => '7193001'],
            ['dept_name' => 'Express Ops CGK', 'employee_name' => 'Dwi Budhi Hartono', 'user_id' => 'dhartono', 'employee_email' => 'dhartono@rpxholding.com', 'position_name' => 'Manager', 'sequence' => '1', 'amount_from' => '0', 'amount_to' => '10000000000', 'employee_id' => '2000241'],
            ['dept_name' => 'Express Ops CGK', 'employee_name' => 'Suroto ', 'user_id' => 'scarmen', 'employee_email' => 'scarmen@rpxholding.com', 'position_name' => 'Senior Manager', 'sequence' => '2', 'amount_from' => '0', 'amount_to' => '10000000000', 'employee_id' => '2900012'],
            ['dept_name' => 'Express Ops CGK', 'employee_name' => 'Ridha Faried Firdaus', 'user_id' => 'rfaried', 'employee_email' => 'rfaried@rpxholding.com', 'position_name' => 'General Manager', 'sequence' => '3', 'amount_from' => '0', 'amount_to' => '10000000000', 'employee_id' => '7111559'],
            ['dept_name' => 'Express Ops CGK', 'employee_name' => 'Riza Triyadi', 'user_id' => 'rtriyadi', 'employee_email' => 'rtriyadi@rpxholding.com', 'position_name' => 'Chief Operation Officer', 'sequence' => '4', 'amount_from' => '5000000', 'amount_to' => '10000000000', 'employee_id' => '2040928'],
            ['dept_name' => 'Express Ops CGK', 'employee_name' => 'Ahsan Syahrir', 'user_id' => 'asyahrir', 'employee_email' => 'asyahrir@rpxholding.com', 'position_name' => 'Budget', 'sequence' => '5', 'amount_from' => '0', 'amount_to' => '10000000000', 'employee_id' => '2228246'],
            ['dept_name' => 'Express Ops CXP', 'employee_name' => 'Wahyu Nurningsih', 'user_id' => 'wnurningsih', 'employee_email' => 'wnurningsih@rpxholding.com', 'position_name' => 'Requestor', 'sequence' => '0', 'amount_from' => '0', 'amount_to' => '10000000000', 'employee_id' => '2187003'],
            ['dept_name' => 'Express Ops CXP', 'employee_name' => 'Eko Budi Santoso', 'user_id' => 'esantoso', 'employee_email' => 'esantoso@rpxholding.com', 'position_name' => 'Manager', 'sequence' => '1', 'amount_from' => '0', 'amount_to' => '10000000000', 'employee_id' => '2990280'],
            ['dept_name' => 'Express Ops CXP', 'employee_name' => 'Suroto ', 'user_id' => 'scarmen', 'employee_email' => 'scarmen@rpxholding.com', 'position_name' => 'Senior Manager', 'sequence' => '2', 'amount_from' => '0', 'amount_to' => '10000000000', 'employee_id' => '2900012'],
            ['dept_name' => 'Express Ops CXP', 'employee_name' => 'Ridha Faried Firdaus', 'user_id' => 'rfaried', 'employee_email' => 'rfaried@rpxholding.com', 'position_name' => 'General Manager', 'sequence' => '3', 'amount_from' => '0', 'amount_to' => '10000000000', 'employee_id' => '7111559'],
            ['dept_name' => 'Express Ops CXP', 'employee_name' => 'Riza Triyadi', 'user_id' => 'rtriyadi', 'employee_email' => 'rtriyadi@rpxholding.com', 'position_name' => 'Chief Operation Officer', 'sequence' => '4', 'amount_from' => '5000000', 'amount_to' => '10000000000', 'employee_id' => '2040928'],
            ['dept_name' => 'Express Ops CXP', 'employee_name' => 'Ahsan Syahrir', 'user_id' => 'asyahrir', 'employee_email' => 'asyahrir@rpxholding.com', 'position_name' => 'Budget', 'sequence' => '5', 'amount_from' => '0', 'amount_to' => '10000000000', 'employee_id' => '2228246'],
            ['dept_name' => 'Express Ops Ecommerce', 'employee_name' => 'Guruh Widharsa Kusuma ', 'user_id' => 'gkusuma', 'employee_email' => 'gkusuma@rpxholding.com', 'position_name' => 'Requestor', 'sequence' => '0', 'amount_from' => '0', 'amount_to' => '10000000000', 'employee_id' => '2131731'],
            ['dept_name' => 'Express Ops Ecommerce', 'employee_name' => 'Samuel Parningotan Pane', 'user_id' => 'spane', 'employee_email' => 'spane@rpxholding.com', 'position_name' => 'Manager', 'sequence' => '1', 'amount_from' => '0', 'amount_to' => '10000000000', 'employee_id' => '1141094'],
            ['dept_name' => 'Express Ops Ecommerce', 'employee_name' => 'Ridha Faried Firdaus', 'user_id' => 'rfaried', 'employee_email' => 'rfaried@rpxholding.com', 'position_name' => 'General Manager', 'sequence' => '3', 'amount_from' => '0', 'amount_to' => '10000000000', 'employee_id' => '7111559'],
            ['dept_name' => 'Express Ops Ecommerce', 'employee_name' => 'Faisal Nasution', 'user_id' => 'fnasution', 'employee_email' => 'fnasution@rpxholding.com', 'position_name' => 'Senior Manager', 'sequence' => '2', 'amount_from' => '0', 'amount_to' => '10000000000', 'employee_id' => '2970082'],
            ['dept_name' => 'Express Ops Ecommerce', 'employee_name' => 'Riza Triyadi', 'user_id' => 'rtriyadi', 'employee_email' => 'rtriyadi@rpxholding.com', 'position_name' => 'Chief Operation Officer', 'sequence' => '4', 'amount_from' => '5000000', 'amount_to' => '10000000000', 'employee_id' => '2040928'],
            ['dept_name' => 'Express Ops Ecommerce', 'employee_name' => 'Ahsan Syahrir', 'user_id' => 'asyahrir', 'employee_email' => 'asyahrir@rpxholding.com', 'position_name' => 'Budget', 'sequence' => '5', 'amount_from' => '0', 'amount_to' => '10000000000', 'employee_id' => '2228246'],
            ['dept_name' => 'Express Ops HLP BJG', 'employee_name' => 'M. Renando Berry', 'user_id' => 'mberry', 'employee_email' => 'mberry@rpxholding.com', 'position_name' => 'Requestor', 'sequence' => '0', 'amount_from' => '0', 'amount_to' => '10000000000', 'employee_id' => '7215447'],
            ['dept_name' => 'Express Ops HLP BJG', 'employee_name' => 'Daniel Dwiputra', 'user_id' => 'dputra', 'employee_email' => 'dputra@rpxholding.com', 'position_name' => 'Manager', 'sequence' => '1', 'amount_from' => '0', 'amount_to' => '10000000000', 'employee_id' => '1151122'],
            ['dept_name' => 'Express Ops HLP BJG', 'employee_name' => 'Suroto ', 'user_id' => 'scarmen', 'employee_email' => 'scarmen@rpxholding.com', 'position_name' => 'Senior Manager', 'sequence' => '2', 'amount_from' => '0', 'amount_to' => '10000000000', 'employee_id' => '2900012'],
            ['dept_name' => 'Express Ops HLP BJG', 'employee_name' => 'Ridha Faried Firdaus', 'user_id' => 'rfaried', 'employee_email' => 'rfaried@rpxholding.com', 'position_name' => 'General Manager', 'sequence' => '3', 'amount_from' => '0', 'amount_to' => '10000000000', 'employee_id' => '7111559'],
            ['dept_name' => 'Express Ops HLP BJG', 'employee_name' => 'Riza Triyadi', 'user_id' => 'rtriyadi', 'employee_email' => 'rtriyadi@rpxholding.com', 'position_name' => 'Chief Operation Officer', 'sequence' => '4', 'amount_from' => '5000000', 'amount_to' => '10000000000', 'employee_id' => '2040928'],
            ['dept_name' => 'Express Ops HLP BJG', 'employee_name' => 'Ahsan Syahrir', 'user_id' => 'asyahrir', 'employee_email' => 'asyahrir@rpxholding.com', 'position_name' => 'Budget', 'sequence' => '5', 'amount_from' => '0', 'amount_to' => '10000000000', 'employee_id' => '2228246'],
            ['dept_name' => 'Express Ops JKT', 'employee_name' => 'Jessica Tamara Susanto', 'user_id' => 'jsusanto', 'employee_email' => 'jsusanto@rpxholding.com', 'position_name' => 'Requestor', 'sequence' => '0', 'amount_from' => '0', 'amount_to' => '10000000000', 'employee_id' => '7204365'],
            ['dept_name' => 'Express Ops JKT', 'employee_name' => 'Encep Fitrah', 'user_id' => 'efitrah', 'employee_email' => 'efitrah@rpxholding.com', 'position_name' => 'Manager', 'sequence' => '1', 'amount_from' => '0', 'amount_to' => '10000000000', 'employee_id' => '7165708'],
            ['dept_name' => 'Express Ops JKT', 'employee_name' => 'Suroto ', 'user_id' => 'scarmen', 'employee_email' => 'scarmen@rpxholding.com', 'position_name' => 'Senior Manager', 'sequence' => '2', 'amount_from' => '0', 'amount_to' => '10000000000', 'employee_id' => '2900012'],
            ['dept_name' => 'Express Ops JKT', 'employee_name' => 'Ridha Faried Firdaus', 'user_id' => 'rfaried', 'employee_email' => 'rfaried@rpxholding.com', 'position_name' => 'General Manager', 'sequence' => '3', 'amount_from' => '0', 'amount_to' => '10000000000', 'employee_id' => '7111559'],
            ['dept_name' => 'Express Ops JKT', 'employee_name' => 'Riza Triyadi', 'user_id' => 'rtriyadi', 'employee_email' => 'rtriyadi@rpxholding.com', 'position_name' => 'Chief Operation Officer', 'sequence' => '4', 'amount_from' => '5000000', 'amount_to' => '10000000000', 'employee_id' => '2040928'],
            ['dept_name' => 'Express Ops JKT', 'employee_name' => 'Ahsan Syahrir', 'user_id' => 'asyahrir', 'employee_email' => 'asyahrir@rpxholding.com', 'position_name' => 'Budget', 'sequence' => '5', 'amount_from' => '0', 'amount_to' => '10000000000', 'employee_id' => '2228246'],
            ['dept_name' => 'Express Strategic Ops', 'employee_name' => 'Jessica Souhoka', 'user_id' => 'jsouhoka', 'employee_email' => 'jsouhoka@rpxholding.com', 'position_name' => 'Requestor', 'sequence' => '0', 'amount_from' => '0', 'amount_to' => '10000000000', 'employee_id' => '7226195'],
            ['dept_name' => 'Express Strategic Ops', 'employee_name' => 'Army Irfan', 'user_id' => 'airfan', 'employee_email' => 'airfan@rpxholding.com', 'position_name' => 'Manager', 'sequence' => '1', 'amount_from' => '0', 'amount_to' => '10000000000', 'employee_id' => '7070840'],
            ['dept_name' => 'Express Strategic Ops', 'employee_name' => 'Ridha Faried Firdaus', 'user_id' => 'rfaried', 'employee_email' => 'rfaried@rpxholding.com', 'position_name' => 'General Manager', 'sequence' => '2', 'amount_from' => '0', 'amount_to' => '10000000000', 'employee_id' => '7111559'],
            ['dept_name' => 'Express Strategic Ops', 'employee_name' => 'Riza Triyadi', 'user_id' => 'rtriyadi', 'employee_email' => 'rtriyadi@rpxholding.com', 'position_name' => 'Chief Operation Officer', 'sequence' => '3', 'amount_from' => '5000000', 'amount_to' => '10000000000', 'employee_id' => '2040928'],
            ['dept_name' => 'Express Strategic Ops', 'employee_name' => 'Ahsan Syahrir', 'user_id' => 'asyahrir', 'employee_email' => 'asyahrir@rpxholding.com', 'position_name' => 'Budget', 'sequence' => '4', 'amount_from' => '0', 'amount_to' => '10000000000', 'employee_id' => '2228246'],
            ['dept_name' => 'Linehaul Service', 'employee_name' => 'Rizhal Rachmawan', 'user_id' => 'rrachmawan1', 'employee_email' => 'rrachmawan1@rpxholding.com', 'position_name' => 'Requestor', 'sequence' => '0', 'amount_from' => '0', 'amount_to' => '10000000000', 'employee_id' => '7050690'],
            ['dept_name' => 'Linehaul Service', 'employee_name' => 'RIZKI DWI RAHMADI', 'user_id' => 'rrahmadi', 'employee_email' => 'rrahmadi@rpxholding.com', 'position_name' => 'Manager', 'sequence' => '1', 'amount_from' => '0', 'amount_to' => '10000000000', 'employee_id' => '7162270'],
            ['dept_name' => 'Linehaul Service', 'employee_name' => 'Ridha Faried Firdaus', 'user_id' => 'rfaried', 'employee_email' => 'rfaried@rpxholding.com', 'position_name' => 'General Manager', 'sequence' => '2', 'amount_from' => '0', 'amount_to' => '10000000000', 'employee_id' => '7111559'],
            ['dept_name' => 'Linehaul Service', 'employee_name' => 'Riza Triyadi', 'user_id' => 'rtriyadi', 'employee_email' => 'rtriyadi@rpxholding.com', 'position_name' => 'Chief Operation Officer', 'sequence' => '3', 'amount_from' => '5000000', 'amount_to' => '10000000000', 'employee_id' => '2040928'],
            ['dept_name' => 'Linehaul Service', 'employee_name' => 'Ahsan Syahrir', 'user_id' => 'asyahrir', 'employee_email' => 'asyahrir@rpxholding.com', 'position_name' => 'Budget', 'sequence' => '4', 'amount_from' => '0', 'amount_to' => '10000000000', 'employee_id' => '2228246'],
            ['dept_name' => 'Network Operation', 'employee_name' => 'Onelysia Marthing', 'user_id' => 'omarthing', 'employee_email' => 'omarthing@rpxholding.com', 'position_name' => 'Requestor', 'sequence' => '0', 'amount_from' => '0', 'amount_to' => '10000000000', 'employee_id' => '7215375'],
            ['dept_name' => 'Network Operation', 'employee_name' => 'Sigit Pujatmoko', 'user_id' => 'spujatmoko', 'employee_email' => 'spujatmoko@rpxholding.com', 'position_name' => 'Manager', 'sequence' => '1', 'amount_from' => '0', 'amount_to' => '10000000000', 'employee_id' => '2980123'],
            ['dept_name' => 'Network Operation', 'employee_name' => 'Faisal Nasution', 'user_id' => 'fnasution', 'employee_email' => 'fnasution@rpxholding.com', 'position_name' => 'Senior Manager', 'sequence' => '2', 'amount_from' => '0', 'amount_to' => '10000000000', 'employee_id' => '02970082'],
            ['dept_name' => 'Network Operation', 'employee_name' => 'Ridha Faried Firdaus', 'user_id' => 'rfaried', 'employee_email' => 'rfaried@rpxholding.com', 'position_name' => 'General Manager', 'sequence' => '3', 'amount_from' => '0', 'amount_to' => '10000000000', 'employee_id' => '7111559'],
            ['dept_name' => 'Network Operation', 'employee_name' => 'Riza Triyadi', 'user_id' => 'rtriyadi', 'employee_email' => 'rtriyadi@rpxholding.com', 'position_name' => 'Chief Operation Officer', 'sequence' => '4', 'amount_from' => '5000000', 'amount_to' => '10000000000', 'employee_id' => '2040928'],
            ['dept_name' => 'Network Operation', 'employee_name' => 'Ahsan Syahrir', 'user_id' => 'asyahrir', 'employee_email' => 'asyahrir@rpxholding.com', 'position_name' => 'Budget', 'sequence' => '5', 'amount_from' => '0', 'amount_to' => '10000000000', 'employee_id' => '2228246'],
            ['dept_name' => 'Outlet', 'employee_name' => 'Rizki Evita', 'user_id' => 'revita', 'employee_email' => 'revita@rpxholding.com', 'position_name' => 'Requestor', 'sequence' => '0', 'amount_from' => '0', 'amount_to' => '10000000000', 'employee_id' => '7181364'],
            ['dept_name' => 'Outlet', 'employee_name' => 'Naufal Zuhdi', 'user_id' => 'nzuhdi', 'employee_email' => 'nzuhdi@rpxholding.com', 'position_name' => 'Manager', 'sequence' => '1', 'amount_from' => '0', 'amount_to' => '10000000000', 'employee_id' => '9203130'],
            ['dept_name' => 'Outlet', 'employee_name' => 'Faisal Nasution', 'user_id' => 'fnasution', 'employee_email' => 'fnasution@rpxholding.com', 'position_name' => 'Senior Manager', 'sequence' => '2', 'amount_from' => '0', 'amount_to' => '10000000000', 'employee_id' => '2970082'],
            ['dept_name' => 'Outlet', 'employee_name' => 'Ridha Faried Firdaus', 'user_id' => 'rfaried', 'employee_email' => 'rfaried@rpxholding.com', 'position_name' => 'General Manager', 'sequence' => '3', 'amount_from' => '0', 'amount_to' => '10000000000', 'employee_id' => '7111559'],
            ['dept_name' => 'Outlet', 'employee_name' => 'Riza Triyadi', 'user_id' => 'rtriyadi', 'employee_email' => 'rtriyadi@rpxholding.com', 'position_name' => 'Chief Operation Officer', 'sequence' => '4', 'amount_from' => '5000000', 'amount_to' => '10000000000', 'employee_id' => '2040928'],
            ['dept_name' => 'Outlet', 'employee_name' => 'Ahsan Syahrir', 'user_id' => 'asyahrir', 'employee_email' => 'asyahrir@rpxholding.com', 'position_name' => 'Budget', 'sequence' => '5', 'amount_from' => '0', 'amount_to' => '10000000000', 'employee_id' => '2228246'],
            ['dept_name' => 'Project Spec DG Handling', 'employee_name' => 'Jessica Souhoka', 'user_id' => 'jsouhoka', 'employee_email' => 'jsouhoka@rpxholding.com', 'position_name' => 'Requestor', 'sequence' => '0', 'amount_from' => '0', 'amount_to' => '10000000000', 'employee_id' => '7226195'],
            ['dept_name' => 'Project Spec DG Handling', 'employee_name' => 'M. Wahyu Wicaksono', 'user_id' => 'mwicaksono', 'employee_email' => 'mwicaksono@rpxholding.com', 'position_name' => 'Manager', 'sequence' => '1', 'amount_from' => '0', 'amount_to' => '10000000000', 'employee_id' => '1141051'],
            ['dept_name' => 'Project Spec DG Handling', 'employee_name' => 'Ridha Faried Firdaus', 'user_id' => 'rfaried', 'employee_email' => 'rfaried@rpxholding.com', 'position_name' => 'General Manager', 'sequence' => '2', 'amount_from' => '0', 'amount_to' => '10000000000', 'employee_id' => '7111559'],
            ['dept_name' => 'Project Spec DG Handling', 'employee_name' => 'Riza Triyadi', 'user_id' => 'rtriyadi', 'employee_email' => 'rtriyadi@rpxholding.com', 'position_name' => 'Chief Operation Officer', 'sequence' => '3', 'amount_from' => '5000000', 'amount_to' => '10000000000', 'employee_id' => '2040928'],
            ['dept_name' => 'Project Spec DG Handling', 'employee_name' => 'Ahsan Syahrir', 'user_id' => 'asyahrir', 'employee_email' => 'asyahrir@rpxholding.com', 'position_name' => 'Budget', 'sequence' => '4', 'amount_from' => '0', 'amount_to' => '10000000000', 'employee_id' => '2228246'],
            ['dept_name' => 'Network Operation', 'employee_name' => 'Ridha Faried Firdaus', 'user_id' => 'rfaried', 'employee_email' => 'rfaried@rpxholding.com', 'position_name' => 'General Manager', 'sequence' => '3', 'amount_from' => '0', 'amount_to' => '10000000000', 'employee_id' => '7111559'],
            ['dept_name' => 'Branch SUB', 'employee_name' => 'Arwiyanto ', 'user_id' => 'arwiyanto', 'employee_email' => 'arwiyanto@rpxholding.com', 'position_name' => 'General Manager', 'sequence' => '2', 'amount_from' => '', 'amount_to' => '', 'employee_id' => '1141058'],
        ]);

        $grouped = $data->groupBy('dept_name');

        foreach ($grouped->all() as $department => $item) {
            $workflowItem = $item
                ->filter(function ($row) {
                    return $row['sequence'] > 0;
                })
                ->map(function ($row) {
                    return [
                        'user_id' => $this->getUser($row['employee_email']),
                        'sequence' => $row['sequence'],
                        'range_from' => $row['amount_from'] != '' ? $row['amount_from'] : 0,
                        'range_to' => $row['amount_to'] != '' ? $row['amount_from'] : 0,
                        'description' => 'superior'
                    ];
                })->all();
            $group = Model::create(['department_id' => $this->getDepartment($department), 'code' => $department, 'name' => 'Workflow ' . $department]);
            $group->items()->createMany($workflowItem);
        }
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
