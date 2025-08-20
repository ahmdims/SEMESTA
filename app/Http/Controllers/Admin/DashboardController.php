<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\PredictionService;
use App\Models\User;
use App\Models\Attendance;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    protected $predictionService;

    public function __construct(PredictionService $predictionService)
    {
        $this->predictionService = $predictionService;
    }

    public function index()
    {
        $totalGuards = User::where('role', 'guard')->count();
        $presentToday = Attendance::whereDate('scanned_at', Carbon::today())
            ->distinct('user_id')
            ->count();
        $dailyAttendancePercentage = ($totalGuards > 0) 
            ? round(($presentToday / $totalGuards) * 100) 
            : 0;

        $atRiskGuards = $this->predictionService->getAtRiskGuards(3);

        $monthlyAttendance = Attendance::select(
                DB::raw('DATE(scanned_at) as date'),
                DB::raw('count(case when status = "on_time" then 1 end) as on_time'),
                DB::raw('count(case when status = "late" then 1 end) as late')
            )
            ->whereMonth('scanned_at', Carbon::now()->month)
            ->groupBy('date')
            ->orderBy('date', 'ASC')
            ->get();
        
        $chartLabels = $monthlyAttendance->pluck('date')->map(function ($date) {
            return Carbon::parse($date)->format('M d');
        });
        $chartOnTimeData = $monthlyAttendance->pluck('on_time');
        $chartLateData = $monthlyAttendance->pluck('late');

        $topLateEmployees = User::where('role', 'guard')
            ->withCount(['attendances' => function ($query) {
                $query->where('status', 'late');
            }])
            ->orderBy('attendances_count', 'desc')
            ->take(10)
            ->get();

        return view('admin.dashboard', compact(
            'dailyAttendancePercentage',
            'atRiskGuards',
            'chartLabels',
            'chartOnTimeData',
            'chartLateData',
            'topLateEmployees'
        ));
    }
}
