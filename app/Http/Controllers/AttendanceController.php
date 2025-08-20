<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AttendanceService;

class AttendanceController extends Controller
{
    protected $attendanceService;

    public function __construct(AttendanceService $attendanceService)
    {
        $this->attendanceService = $attendanceService;
    }

    public function create()
    {
        return view('attendance.scan');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'qr_code' => 'required|string',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'photo' => 'required|image',
        ]);

        try {
            $this->attendanceService->recordAttendance($validatedData);
            return redirect()->route('dashboard')->with('success', 'Attendance recorded successfully!');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}