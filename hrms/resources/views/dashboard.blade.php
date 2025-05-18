<!-- resources/views/dashboard.blade.php -->
@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <h1>Welcome to HRMS</h1>
    @auth
        <p>Welcome, {{ Auth::user()->name }}! Select a module from the navigation to manage HR data.</p>
    @else
        <p>Please <a href="{{ route('login') }}">login</a> to access HR management features.</p>
    @endauth
@endsection