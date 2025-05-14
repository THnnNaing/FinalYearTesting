<?php

// app/Http/Controllers/AttendanceController.php
namespace App\Http\Controllers;

use App\Models\Attendance;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        
        $records = $user->hasRole('Admin|HR')
            ? Attendance::with('user')->latest()->paginate(50)
            : $user->attendances()->latest()->paginate(30);

        return view('attendance.index', compact('records'));
    }

    public function checkIn(Request $request)
    {
        $user = $request->user();
        
        $attendance = Attendance::firstOrCreate([
            'user_id' => $user->id,
            'date' => now()->toDateString(),
        ], [
            'time_in' => now(),
            'status' => 'pending'
        ]);

        if ($attendance->wasRecentlyCreated) {
            return back()->with('success', 'Checked in at '.$attendance->time_in->format('h:i A'));
        }

        return back()->with('error', 'Already checked in at '.$attendance->time_in->format('h:i A'));
    }

    public function checkOut(Attendance $attendance)
    {
        abort_unless(
            $attendance->user_id === auth()->id() || auth()->user()->hasRole('Admin|HR'),
            403
        );

        if (!$attendance->time_out) {
            $attendance->update([
                'time_out' => now(),
                'total_hours' => $this->calculateHours($attendance->time_in, now())
            ]);
            
            return back()->with('success', 'Checked out at '.now()->format('h:i A'));
        }

        return back()->with('error', 'Already checked out at '.$attendance->time_out->format('h:i A'));
    }

    protected function calculateHours($start, $end)
    {
        return round($start->diffInMinutes($end) / 60, 2);
    }

    public function report()
    {
        // Monthly report generation logic
    }
}