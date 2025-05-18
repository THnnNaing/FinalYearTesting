<!-- resources/views/leaves/index.blade.php -->
@extends('layouts.app')

@section('title', 'Leaves')

@section('content')
    <h1>Leaves</h1>
    <a href="{{ route('leaves.create') }}">Add Leave</a>
    <table border="1">
        <thead>
            <tr>
                <th>Employee</th>
                <th>Leave Type</th>
                <th>Period</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($leaves as $leave)
                <tr>
                    <td>{{ $leave->employee->first_name }} {{ $leave->employee->last_name }}</td>
                    <td>{{ $leave->leave_type }}</td>
                    <td>{{ $leave->start_date }} to {{ $leave->end_date }}</td>
                    <td>{{ $leave->status }}</td>
                    <td>
                        <a href="{{ route('leaves.edit', $leave) }}">Edit</a>
                        <form action="{{ route('leaves.destroy', $leave) }}" method="POST" style="display:inline;">
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