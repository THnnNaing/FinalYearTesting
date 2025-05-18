<?php

// database/seeders/DatabaseSeeder.php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Department;
use App\Models\JobTitle;
use App\Models\Employee;
use App\Models\Payroll;
use App\Models\Attendance;
use App\Models\Leave;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create a user
        $user = User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
        ]);

        // Departments
        $hr = Department::create(['name' => 'HR', 'description' => 'Human Resources']);
        $it = Department::create(['name' => 'IT', 'description' => 'Information Technology']);

        // Job Titles
        $manager = JobTitle::create(['title' => 'Manager', 'salary_base' => 5000]);
        $developer = JobTitle::create(['title' => 'Developer', 'salary_base' => 4000]);

        // Employees (linked to user)
        $employee = Employee::create([
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'admin@example.com', // Match user email
            'phone' => '1234567890',
            'address' => '123 Main St',
            'date_of_birth' => '1990-01-01',
            'hire_date' => '2025-01-01',
            'department_id' => $hr->id,
            'job_title_id' => $manager->id,
            'status' => 'active',
            'user_id' => $user->id,
        ]);

        // Payroll
        $payroll = Payroll::create([
            'employee_id' => $employee->id,
            'pay_period_start' => '2025-05-01',
            'pay_period_end' => '2025-05-31',
            'basic_salary' => 5000,
            'overtime_pay' => 200,
            'bonuses' => 500,
            'deductions' => 700,
            'status' => 'pending',
            'net_salary' => 5000 + 200 + 500 - 700,
        ]);

        // Attendance
        Attendance::create([
            'employee_id' => $employee->id,
            'date' => '2025-05-01',
            'check_in' => '2025-05-01 09:00:00',
            'check_out' => '2025-05-01 17:00:00',
            'status' => 'present',
            'hours_worked' => 8,
        ]);

        // Leave
        Leave::create([
            'employee_id' => $employee->id,
            'leave_type' => 'Sick',
            'start_date' => '2025-05-10',
            'end_date' => '2025-05-12',
            'status' => 'approved',
            'reason' => 'Medical reasons',
        ]);
    }
}
