<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HRMS - @yield('title')</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <nav>
        <a href="{{ route('dashboard') }}">Home</a> |
        @auth
            <a href="{{ route('departments.index') }}">Departments</a> |
            <a href="{{ route('job-titles.index') }}">Job Titles</a> |
            <a href="{{ route('employees.index') }}">Employees</a> |
            <a href="{{ route('payrolls.index') }}">Payrolls</a> |
            <a href="{{ route('attendances.index') }}">Attendances</a> |
            <a href="{{ route('leaves.index') }}">Leaves</a> |
            <span>Welcome, {{ Auth::user()->name }}</span> |
            <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit">Logout</button>
            </form>
        @else
            <a href="{{ route('login') }}">Login</a> |
            <a href="{{ route('register') }}">Register</a>
        @endauth
    </nav>
    <div>
        @yield('content')
    </div>
</body>
</html>