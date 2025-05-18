<!-- resources/views/attendances/index.blade.php -->
@extends('layouts.app')

@section('title', 'Attendances')

@section('content')
    <h1>Attendances</h1>
    <a href="{{ route('attendances.create') }}">Add Attendance</a>
    <table border="1">
        <thead>
            <tr>
                <th>Employee</th>
                <th>Date</th>
                <th>Check In</th>
                <th>Check Out</th>
                <th>Hours Worked</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($attendances as $attendance)
                <tr>
                    <td>{{ $attendance->employee->first_name }} {{ $attendance->employee->last_name }}</td>
                    <td>{{ $attendance->date }}</td>
                    <td>{{ $attendance->check_in }}</td>
                    <td>{{ $attendance->check_out }}</td>
                    <td>{{ $attendance->hours_worked }}</td>
                    <td>{{ $attendance->status }}</td>
                    <td>
                        <a href="{{ route('attendances.edit', $attendance) }}">Edit</a>
                        <form action="{{ route('attendances.destroy', $attendance) }}" method="POST" style="display:inline;">
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