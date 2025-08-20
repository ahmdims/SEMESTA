<?php

namespace App\Services;

use Illuminate\Support\Facades\Crypt;
use App\Models\Attendance;
use App\Models\Location;

class AttendanceService
{
    const ALLOWED_RADIUS = 30;

    public function recordAttendance(array $validatedData): Attendance
    {
        $qrData = json_decode(Crypt::decryptString($validatedData['qr_code']), true);

        if (now()->timestamp > $qrData['expires_at']) {
            throw new \Exception('QR Code has expired.');
        }

        $location = Location::findOrFail($qrData['location_id']);
        $distance = $this->calculateDistance(
            $location->latitude,
            $location->longitude,
            $validatedData['latitude'],
            $validatedData['longitude']
        );

        if ($distance > self::ALLOWED_RADIUS) {
            throw new \Exception('You are not within the allowed attendance radius.');
        }

        return Attendance::create([
            'user_id' => auth()->id(),
            'shift_id' => $qrData['shift_id'],
            'scanned_at' => now(),
            'latitude' => $validatedData['latitude'],
            'longitude' => $validatedData['longitude'],
            'status' => $this->determineStatus(),
        ]);
    }

    private function calculateDistance($lat1, $lon1, $lat2, $lon2): float
    {
        $earthRadius = 6371000;

        $latFrom = deg2rad($lat1);
        $lonFrom = deg2rad($lon1);
        $latTo = deg2rad($lat2);
        $lonTo = deg2rad($lon2);

        $latDelta = $latTo - $latFrom;
        $lonDelta = $lonTo - $lonFrom;

        $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
            cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));
        return $angle * $earthRadius;
    }

    private function determineStatus(): string
    {
        return 'on_time';
    }
}