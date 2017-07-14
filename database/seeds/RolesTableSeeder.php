<?php

use Illuminate\Database\Seeder;
use App\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    
    public function run()
    {
        $role = new Role();
        $role->role = 'Admin';
        $role->save();
        $role = new Role();
        $role->role = 'Lead Assessor';
        $role->save();
        $role = new Role();
        $role->role = 'Assessor';
        $role->save();
        $role = new Role();
        $role->role = 'Project Manager';
        $role->save();
        $role = new Role();
        $role->role = 'QA';
        $role->save();
        $role = new Role();
        $role->role = 'Approver';
        $role->save();
        $role = new Role();
        $role->role = 'Manager';
        $role->save();
        $role = new Role();
        $role->role = 'Project Participant';
        $role->save();
        $role = new Role();
        $role->role = 'Guest';
        $role->save();
    }
}
