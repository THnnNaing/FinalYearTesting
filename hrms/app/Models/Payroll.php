<?php

// app/Models/Payroll.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payroll extends Model
{
    protected $fillable = [
        'employee_id', 'pay_period_start', 'pay_period_end',
        'basic_salary', 'overtime_pay', 'bonuses', 'deductions', 'net_salary', 'status'
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function deductions()
    {
        return $this->hasMany(Deduction::class);
    }

    public function bonuses()
    {
        return $this->hasMany(Bonus::class);
    }

    public function calculateNetSalary()
    {
        $this->net_salary = $this->basic_salary + $this->overtime_pay + $this->bonuses - $this->deductions;
        $this->save();
    }
}
