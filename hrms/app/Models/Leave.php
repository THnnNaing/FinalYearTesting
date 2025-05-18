<?php

// app/Models/Leave.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
    protected $fillable = [
        'employee_id', 'leave_type', 'start_date', 'end_date', 'status', 'reason'
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}