<?php

// app/Models/Attendance.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Attendance extends Model
{
    protected $fillable = [
        'employee_id', 'date', 'check_in', 'check_out', 'status', 'hours_worked'
    ];

    protected $casts = [
        'check_in' => 'datetime',
        'check_out' => 'datetime',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function calculateHoursWorked()
    {
        if ($this->check_in && $this->check_out) {
            $this->hours_worked = $this->check_in->diffInHours($this->check_out);
            $this->save();
        }
    }
}
