<!-- resources/views/employees/index.blade.php -->
@extends('layouts.app')

@section('title', 'Employees')

@section('content')
    <h1>Employees</h1>
    <a href="{{ route('employees.create') }}">Add Employee</a>
    <table border="1">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Department</th>
                <th>Job Title</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($employees as $employee)
                <tr>
                    <td>{{ $employee->first_name }} {{ $employee->last_name }}</td>
                    <td>{{ $employee->email }}</td>
                    <td>{{ $employee->department->name }}</td>
                    <td>{{ $employee->jobTitle->title }}</td>
                    <td>{{ $employee->status }}</td>
                    <td>
                        <a href="{{ route('employees.edit', $employee) }}">Edit</a>
                        <form action="{{ route('employees.destroy', $employee) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection