<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// routes/web.php
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\JobTitleController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\PayrollController;
use App\Http\Controllers\DeductionController;
use App\Http\Controllers\BonusController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\LeaveController;

// Public routes (if any)
// Breeze authentication routes are included via auth.php

// Protected routes
Route::middleware(['auth'])->group(function () {
    // Dashboard
    Route::get('/', function () {
        return view('dashboard');
    })->name('dashboard');

    // Resource routes
    Route::resource('departments', DepartmentController::class);
    Route::resource('job-titles', JobTitleController::class);
    Route::resource('employees', EmployeeController::class);
    Route::resource('payrolls', PayrollController::class);
    Route::resource('deductions', DeductionController::class);
    Route::resource('bonuses', BonusController::class);
    Route::resource('attendances', AttendanceController::class);
    Route::resource('leaves', LeaveController::class);
});

// Include Breeze authentication routes
require __DIR__.'/auth.php';