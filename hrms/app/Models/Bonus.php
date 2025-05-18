<?php

// app/Models/Bonus.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bonus extends Model
{
    protected $fillable = ['payroll_id', 'type', 'amount', 'description'];

    public function payroll()
    {
        return $this->belongsTo(Payroll::class);
    }
}