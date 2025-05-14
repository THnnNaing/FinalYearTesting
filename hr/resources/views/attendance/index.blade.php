@extends('layout')
@section('content')
<h1>Attendance</h1>
<form action="{{ route('attendance.checkin') }}" method="POST">
  @csrf
  <button type="submit">Check In</button>
</form>
@foreach($records as $att)
  <p>{{ $att->date }}: In {{ $att->time_in ?? '--' }} | Out {{ $att->time_out ?? '--' }}</p>
  @if($att->time_in && !$att->time_out)
    <form action="{{ route('attendance.checkout', $att) }}" method="POST">
      @csrf
      <button type="submit">Check Out</button>
    </form>
  @endif
@endforeach
@endsection
