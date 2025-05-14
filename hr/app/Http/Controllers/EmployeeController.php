<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index() {
        $employees = User::role('Employee')->get();
        return view('employees.index', compact('employees'));
    }

    public function create() {
        return view('employees.create');
    }

    public function store(Request $request) {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
        $user->assignRole('Employee');  // assign Employee role:contentReference[oaicite:16]{index=16}
        return redirect()->route('employees.index')->with('success', 'Employee added.');
    }

    public function edit(User $employee) {
        return view('employees.edit', compact('employee'));
    }

    public function update(Request $request, User $employee) {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$employee->id,
            // password optional on update
        ]);
        $employee->update($data);
        return redirect()->route('employees.index')->with('success', 'Employee updated.');
    }

    public function destroy(User $employee) {
        $employee->delete();
        return back()->with('success', 'Employee deleted.');
    }
}
