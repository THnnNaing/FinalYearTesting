<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run()
    {
        $roles = [
            ['name' => 'Admin', 'description' => 'System Administrator'],
            ['name' => 'HR', 'description' => 'Human Resources Manager'],
            ['name' => 'Employee', 'description' => 'Company Employee'],
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}