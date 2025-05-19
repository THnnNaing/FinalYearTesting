<?php

namespace App\Models;

use Illuminate\Support\Facades\Log;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    protected $fillable = ['name', 'email', 'password', 'role_id'];
    protected $hidden = ['password', 'remember_token'];
    protected $casts = ['email_verified_at' => 'datetime'];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function employee()
    {
        return $this->hasOne(Employee::class);
    }

    // public function hasRole(string $role): bool
    // {
    //     if (!$this->role) {
    //         Log::warning("User {$this->id} has no role assigned.");
    //         return false;
    //     }
    //     return $this->role->name === $role;
    // }

    // public function hasPermission(string $permission): bool
    // {
    //     if (!$this->role) {
    //         Log::warning("User {$this->id} has no role, cannot check permission: {$permission}");
    //         return false;
    //     }
    //     return $this->role->hasPermission($permission);
    // }
}