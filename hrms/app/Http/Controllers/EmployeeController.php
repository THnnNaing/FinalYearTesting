<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Department;
use App\Models\JobTitle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::with(['department', 'jobTitle'])
            ->when(Auth::user() && Auth::user()->role === 'employee', function ($query) {
                return $query->where('user_id', Auth::id());
            })
            ->get();

        return view('employees.index', compact('employees'));
    }

    public function create()
    {
        $departments = Department::all();
        $jobTitles = JobTitle::all();
        return view('employees.create', compact('departments', 'jobTitles'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:employees,email',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'date_of_birth' => 'nullable|date',
            'hire_date' => 'required|date',
            'department_id' => 'required|exists:departments,id',
            'job_title_id' => 'required|exists:job_titles,id',
            'status' => 'required|in:active,inactive,terminated',
            'user_id' => 'nullable|exists:users,id',
        ]);

        Employee::create($validated);
        return redirect()->route('employees.index')->with('success', 'Employee added successfully.');
    }

    public function edit(Employee $employee)
    {
        if (Auth::user() && Auth::user()->role === 'employee' && $employee->user_id !== Auth::id()) {
            abort(403, 'Unauthorized: You can only edit your own profile.');
        }

        $departments = Department::all();
        $jobTitles = JobTitle::all();
        return view('employees.edit', compact('employee', 'departments', 'jobTitles'));
    }

    public function update(Request $request, Employee $employee)
    {
        if (Auth::user() && Auth::user()->role === 'employee' && $employee->user_id !== Auth::id()) {
            abort(403, 'Unauthorized: You can only edit your own profile.');
        }

        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:employees,email,' . $employee->id,
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'date_of_birth' => 'nullable|date',
            'hire_date' => 'required|date',
            'department_id' => 'required|exists:departments,id',
            'job_title_id' => 'required|exists:job_titles,id',
            'status' => 'required|in:active,inactive,terminated',
            'user_id' => 'nullable|exists:users,id',
        ]);

        $employee->update($validated);
        return redirect()->route('employees.index')->with('success', 'Employee updated successfully.');
    }

    public function destroy(Employee $employee)
    {
        $employee->delete();
        return redirect()->route('employees.index')->with('success', 'Employee deleted successfully.');
    }
}