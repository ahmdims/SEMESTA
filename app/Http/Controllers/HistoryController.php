<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HistoryController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        $attendances = \App\Models\Attendance::where('user_id', $userId)
            ->with(['shift.location'])
            ->latest('scanned_at')
            ->paginate(15);

        return view('attendance.history', compact('attendances'));
    }
}