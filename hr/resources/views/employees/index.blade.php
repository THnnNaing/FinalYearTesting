@extends('layout')
@section('content')
<h1>Employees</h1>
<a href="{{ route('employees.create') }}">Add Employee</a>
<table>
  <tr><th>Name</th><th>Email</th><th>Actions</th></tr>
  @foreach($employees as $emp)
    <tr>
      <td>{{ $emp->name }}</td>
      <td>{{ $emp->email }}</td>
      <td>
        <a href="{{ route('employees.edit', $emp) }}">Edit</a>
        <form action="{{ route('employees.destroy', $emp) }}" method="POST" style="display:inline">
          @csrf @method('DELETE')
          <button type="submit">Delete</button>
        </form>
      </td>
    </tr>
  @endforeach
</table>
@endsection
