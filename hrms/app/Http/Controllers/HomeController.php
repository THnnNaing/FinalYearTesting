<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = auth()->user();
        
        if ($user->hasRole('Admin')) {
            return redirect()->route('admin.dashboard');
        } elseif ($user->hasRole('HR')) {
            return redirect()->route('hr.dashboard');
        } elseif ($user->hasRole('Employee')) {
            return redirect()->route('employee.dashboard');
        }

        return view('home');
    }
}