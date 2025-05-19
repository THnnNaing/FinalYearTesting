<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use App\Models\Department;
use App\Models\JobTitle;
use App\Models\Employee;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create Roles
        $adminRole = Role::create(['name' => 'admin', 'description' => 'Full access']);
        $hrManagerRole = Role::create(['name' => 'hr_manager', 'description' => 'HR management']);
        $employeeRole = Role::create(['name' => 'employee', 'description' => 'Limited access']);

        // Create Users
        $adminUser = User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'role_id' => $adminRole->id,
        ]);

        $hrUser = User::create([
            'name' => 'HR Manager',
            'email' => 'hr@example.com',
            'password' => bcrypt('password'),
            'role_id' => $hrManagerRole->id,
        ]);

        $employeeUser = User::create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => bcrypt('password'),
            'role_id' => $employeeRole->id,
        ]);

        // Departments
        $hrDept = Department::create(['name' => 'HR', 'description' => 'Human Resources']);

        // Job Titles
        $manager = JobTitle::create(['title' => 'Manager', 'salary_base' => 5000]);
        $developer = JobTitle::create(['title' => 'Developer', 'salary_base' => 4000]);

        // Employees
        Employee::create([
            'first_name' => 'Admin',
            'last_name' => 'User',
            'email' => 'admin@example.com',
            'phone' => '1234567890',
            'address' => '123 Main St',
            'date_of_birth' => '1980-01-01',
            'hire_date' => '2025-01-01',
            'department_id' => $hrDept->id,
            'job_title_id' => $manager->id,
            'status' => 'active',
            'user_id' => $adminUser->id,
        ]);

        Employee::create([
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'john@example.com',
            'phone' => '1234567890',
            'address' => '123 Main St',
            'date_of_birth' => '1990-01-01',
            'hire_date' => '2025-01-01',
            'department_id' => $hrDept->id,
            'job_title_id' => $developer->id,
            'status' => 'active',
            'user_id' => $employeeUser->id,
        ]);
    }
}