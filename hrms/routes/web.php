<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\JobTitleController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\PayrollController;
use App\Http\Controllers\DeductionController;
use App\Http\Controllers\BonusController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\LeaveController;

Route::middleware(['auth'])->group(function () {
    Route::get('/', fn () => view('dashboard'))->name('dashboard');

    Route::resource('departments', DepartmentController::class)->middleware([
        'index:view_departments',
        'create:create_departments',
        'store:create_departments',
        'show:view_departments',
        'edit:edit_departments',
        'update:edit_departments',
        'destroy:delete_departments',
    ]);

    Route::resource('job-titles', JobTitleController::class)->middleware([
        'index:view_job_titles',
        'create:create_job_titles',
        'store:create_job_titles',
        'show:view_job_titles',
        'edit:edit_job_titles',
        'update:edit_job_titles',
        'destroy:delete_job_titles',
    ]);

    Route::resource('employees', EmployeeController::class)->middleware([
        'index:view_employees',
        'create:create_employees',
        'store:create_employees',
        'show:view_employees',
        'edit:edit_employees',
        'update:edit_employees',
        'destroy:delete_employees',
    ]);

    Route::resource('payrolls', PayrollController::class)->middleware([
        'index:view_payrolls',
        'create:create_payrolls',
        'store:create_payrolls',
        'show:view_payrolls',
        'edit:edit_payrolls',
        'update:edit_payrolls',
        'destroy:delete_payrolls',
    ]);

    Route::resource('deductions', DeductionController::class)->middleware([
        'index:view_deductions',
        'create:create_deductions',
        'store:create_deductions',
        'show:view_deductions',
        'edit:edit_deductions',
        'update:edit_deductions',
        'destroy:delete_deductions',
    ]);

    Route::resource('bonuses', BonusController::class)->middleware([
        'index:view_bonuses',
        'create:create_bonuses',
        'store:create_bonuses',
        'show:view_bonuses',
        'edit:edit_bonuses',
        'update:edit_bonuses',
        'destroy:delete_bonuses',
    ]);

    Route::resource('attendances', AttendanceController::class)->middleware([
        'index:view_attendances',
        'create:create_attendances',
        'store:create_attendances',
        'show:view_attendances',
        'edit:edit_attendances',
        'update:edit_attendances',
        'destroy:delete_attendances',
    ]);

    Route::resource('leaves', LeaveController::class)->middleware([
        'index:view_leaves',
        'create:create_leaves',
        'store:create_leaves',
        'show:view_leaves',
        'edit:edit_leaves',
        'update:edit_leaves',
        'destroy:delete_leaves',
    ]);
});

require __DIR__.'/auth.php';