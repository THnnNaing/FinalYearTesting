<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    EmployeeController,
    AttendanceController,
    LeaveController,
    PayrollController,
    ProfileController,
    DashboardController
};

/*-------------------------------------------------------------------------
| Public Routes
|------------------------------------------------------------------------*/
Route::get('/', function () {
    return view('welcome');
})->name('home');

/*-------------------------------------------------------------------------
| Authentication Routes (Laravel Breeze)
|------------------------------------------------------------------------*/
require __DIR__.'/auth.php';

/*-------------------------------------------------------------------------
| Authenticated Routes
|------------------------------------------------------------------------*/
Route::middleware(['auth', 'verified'])->group(function () {
    // Dashboard Route (now using a controller for better organization)
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Profile Routes
    Route::prefix('profile')->group(function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    /*---------------------------------------------------------------------
    | Admin & HR Routes
    |--------------------------------------------------------------------*/
    Route::middleware('role:Admin|HR')->prefix('management')->name('management.')->group(function() {
        // Employee Management
        Route::resource('employees', EmployeeController::class)->except(['create', 'store'])
            ->parameters(['employees' => 'user']); // More semantic parameter name
        
        // Payroll Management
        Route::resource('payrolls', PayrollController::class)
            ->withTrashed(['show', 'edit', 'update']); // Allow viewing/editing deleted records
        
        // Leave Management
        Route::resource('leaves', LeaveController::class)->except(['create', 'store']);
        Route::patch('leaves/{leave}/approve', [LeaveController::class, 'approve'])
            ->name('leaves.approve');
        Route::patch('leaves/{leave}/reject', [LeaveController::class, 'reject'])
            ->name('leaves.reject');
        Route::get('leaves/calendar', [LeaveController::class, 'calendar'])
            ->name('leaves.calendar');
    });

    /*---------------------------------------------------------------------
    | Employee & HR Routes
    |--------------------------------------------------------------------*/
    Route::middleware('role:Employee|HR')->group(function() {
        // Attendance Module
        Route::prefix('attendance')->name('attendance.')->group(function() {
            Route::get('/', [AttendanceController::class, 'index'])->name('index');
            Route::get('/history', [AttendanceController::class, 'history'])->name('history');
            Route::get('/report', [AttendanceController::class, 'report'])->name('report');
            Route::post('/check-in', [AttendanceController::class, 'checkIn'])->name('checkin');
            Route::post('/{attendance}/check-out', [AttendanceController::class, 'checkOut'])
                ->name('checkout');
            Route::get('/{attendance}/edit', [AttendanceController::class, 'edit'])
                ->name('edit')->middleware('role:HR');
            Route::patch('/{attendance}', [AttendanceController::class, 'update'])
                ->name('update')->middleware('role:HR');
        });
        
        // Leave Requests
        Route::resource('leaves', LeaveController::class)->only(['index', 'create', 'store', 'show'])
            ->names([
                'index' => 'leaves.my.index',
                'create' => 'leaves.my.create',
                'store' => 'leaves.my.store',
                'show' => 'leaves.my.show'
            ]);
    });

    /*---------------------------------------------------------------------
    | Admin-Only Routes
    |--------------------------------------------------------------------*/
    Route::middleware('role:Admin')->prefix('admin')->name('admin.')->group(function() {
        Route::get('/settings', function() {
            return view('admin.settings');
        })->name('settings');
        
        Route::get('/audit-log', [\App\Http\Controllers\Admin\AuditLogController::class, 'index'])
            ->name('audit.log');
            
        Route::get('/system-health', [\App\Http\Controllers\Admin\SystemHealthController::class, 'index'])
            ->name('system.health');
    });
});

/*-------------------------------------------------------------------------
| Additional Features (consider adding these later)
|------------------------------------------------------------------------*/
// Route::get('/api-docs', ...); // API Documentation
// Route::get('/health-check', ...); // System health check endpoint