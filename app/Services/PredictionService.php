<?php

namespace App\Services;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

class PredictionService
{
    public function getAtRiskGuards(int $limit = 3): Collection
    {
        $sevenDaysAgo = Carbon::now()->subDays(7)->startOfDay();

        $guards = User::where('role', 'guard')->get();

        $guardsWithRiskScore = $guards->map(function ($guard) use ($sevenDaysAgo) {
            $lateCount = $guard->attendances()
                ->where('status', 'late')
                ->where('scanned_at', '>=', $sevenDaysAgo)
                ->count();

            $guard->lates_last_7_days = $lateCount;

            return $guard;
        });

        $atRiskGuards = $guardsWithRiskScore->filter(function ($guard) {
            return $guard->lates_last_7_days > 0;
        });

        $sortedGuards = $atRiskGuards->sortByDesc('lates_last_7_days');

        return $sortedGuards->take($limit);
    }
}