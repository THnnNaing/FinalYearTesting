<!-- resources/views/payrolls/index.blade.php -->
@extends('layouts.app')

@section('title', 'Payrolls')

@section('content')
    <h1>Payrolls</h1>
    <a href="{{ route('payrolls.create') }}">Add Payroll</a>
    <table border="1">
        <thead>
            <tr>
                <th>Employee</th>
                <th>Pay Period</th>
                <th>Net Salary</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($payrolls as $payroll)
                <tr>
                    <td>{{ $payroll->employee->first_name }} {{ $payroll->employee->last_name }}</td>
                    <td>{{ $payroll->pay_period_start }} to {{ $payroll->pay_period_end }}</td>
                    <td>{{ $payroll->net_salary }}</td>
                    <td>{{ $payroll->status }}</td>
                    <td>
                        <a href="{{ route('payrolls.edit', $payroll) }}">Edit</a>
                        <form action="{{ route('payrolls.destroy', $payroll) }}" method="POST" style="display:inline;">
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