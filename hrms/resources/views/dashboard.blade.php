@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <h1 class="display-4">Welcome to HRMS</h1>
                <p class="lead">Welcome, {{ Auth::user()->name }}! Select a module from the navigation to manage HR data.</p>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Quick Access</h5>
            </div>
            <div class="card-body">
                <div class="list-group">
                    <a href="{{ route('employees.index') }}" class="list-group-item list-group-item-action d-flex align-items-center">
                        <i class="fas fa-users fa-fw me-3"></i>
                        <span>Employees Management</span>
                    </a>
                    <a href="{{ route('payrolls.index') }}" class="list-group-item list-group-item-action d-flex align-items-center">
                        <i class="fas fa-money-bill-wave fa-fw me-3"></i>
                        <span>Payroll Processing</span>
                    </a>
                    <a href="{{ route('attendances.index') }}" class="list-group-item list-group-item-action d-flex align-items-center">
                        <i class="fas fa-calendar-check fa-fw me-3"></i>
                        <span>Attendance Tracking</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-6">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Recent Activity</h5>
            </div>
            <div class="card-body">
                <div class="list-group">
                    <div class="list-group-item">
                        <div class="d-flex w-100 justify-content-between">
                            <small class="text-muted">Today</small>
                        </div>
                        <p class="mb-1">5 new employees added</p>
                    </div>
                    <div class="list-group-item">
                        <div class="d-flex w-100 justify-content-between">
                            <small class="text-muted">Yesterday</small>
                        </div>
                        <p class="mb-1">Payroll processed for 120 employees</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection