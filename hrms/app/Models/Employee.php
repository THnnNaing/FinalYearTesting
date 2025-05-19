<?php

// app/Models/Employee.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'first_name', 'last_name', 'email', 'phone', 'address',
        'date_of_birth', 'hire_date', 'department_id', 'job_title_id', 'status', 'user_id'
    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function jobTitle()
    {
        return $this->belongsTo(JobTitle::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function payrolls()
    {
        return $this->hasMany(Payroll::class);
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    public function leaves()
    {
        return $this->hasMany(Leave::class);
    }
}