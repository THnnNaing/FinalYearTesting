<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobTitle extends Model
{
    //
    protected $fillable = ['title', 'description', 'salary_base'];

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }
}
