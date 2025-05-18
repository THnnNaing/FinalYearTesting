<!-- resources/views/employees/create.blade.php -->
@extends('layouts.app')

@section('title', 'Add Employee')

@section('content')
    <h1>Add Employee</h1>
    <form action="{{ route('employees.store') }}" method="POST">
        @csrf
        <div>
            <label>First Name</label>
            <input type="text" name="first_name" required>
        </div>
        <div>
            <label>Last Name</label>
            <input type="text" name="last_name" required>
        </div>
        <div>
            <label>Email</label>
            <input type="email" name="email" required>
        </div>
        <div>
            <label>Phone</label>
            <input type="text" name="phone">
        </div>
        <div>
            <label>Address</label>
            <textarea name="address"></textarea>
        </div>
        <div>
            <label>Date of Birth</label>
            <input type="date" name="date_of_birth">
        </div>
        <div>
            <label>Hire Date</label>
            <input type="date" name="hire_date" required>
        </div>
        <div>
            <label>Department</label>
            <select name="department_id" required>
                @foreach ($departments as $department)
                    <option value="{{ $department->id }}">{{ $department->name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label>Job Title</label>
            <select name="job_title_id" required>
                @foreach ($jobTitles as $jobTitle)
                    <option value="{{ $jobTitle->id }}">{{ $jobTitle->title }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label>Status</label>
            <select name="status" required>
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
                <option value="terminated">Terminated</option>
            </select>
        </div>
        <button type="submit">Save</button>
    </form>
@endsection