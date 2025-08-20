<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Attendance;

class DashboardController extends Controller
{
    public function index()
    {
        if (Auth::user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        if (Auth::user()->role === 'guard') {

            $onTime = Attendance::where('status', 'on_time')->count();
            $late = Attendance::where('status', 'late')->count();

            $summary = [
                'on_time' => $onTime,
                'late' => $late,
            ];

            return view('dashboard', compact('summary'));
        }

        return redirect('/');
    }
}
