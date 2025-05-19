<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = ['name', 'description'];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function permissions(): array
    {
        return match ($this->name) {
            'admin' => [
                'view_employees', 'create_employees', 'edit_employees', 'delete_employees',
                'view_payrolls', 'create_payrolls', 'edit_payrolls', 'delete_payrolls',
                'view_attendances', 'create_attendances', 'edit_attendances', 'delete_attendances',
                'view_leaves', 'create_leaves', 'edit_leaves', 'delete_leaves',
                'view_departments', 'create_departments', 'edit_departments', 'delete_departments',
                'view_job_titles', 'create_job_titles', 'edit_job_titles', 'delete_job_titles',
                'view_deductions', 'create_deductions', 'edit_deductions', 'delete_deductions',
                'view_bonuses', 'create_bonuses', 'edit_bonuses', 'delete_bonuses',
            ],
            'hr_manager' => [
                'view_employees', 'create_employees', 'edit_employees',
                'view_payrolls', 'create_payrolls', 'edit_payrolls',
                'view_attendances', 'create_attendances', 'edit_attendances',
                'view_leaves', 'create_leaves', 'edit_leaves',
                'view_departments', 'view_job_titles',
                'view_deductions', 'create_deductions', 'edit_deductions',
                'view_bonuses', 'create_bonuses', 'edit_bonuses',
            ],
            'employee' => [
                'view_leaves', 'create_leaves', 'view_attendances',
            ],
            default => [],
        };
    }

    public function hasPermission(string $permission): bool
    {
        return in_array($permission, $this->permissions());
    }
}