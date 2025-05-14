<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\HR\DashboardController as HRDashboardController;
use App\Http\Controllers\Employee\DashboardController as EmployeeDashboardController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/register', [RegisterController::class, 'create'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    
    // Admin routes
    Route::prefix('admin')->name('admin.')->middleware('role:Admin')->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    });
    
    // HR routes
    Route::prefix('hr')->name('hr.')->middleware('role:HR')->group(function () {
        Route::get('/dashboard', [HRDashboardController::class, 'index'])->name('dashboard');
    });
    
    // Employee routes
    Route::prefix('employee')->name('employee.')->middleware('role:Employee')->group(function () {
        Route::get('/dashboard', [EmployeeDashboardController::class, 'index'])->name('dashboard');
    });
});