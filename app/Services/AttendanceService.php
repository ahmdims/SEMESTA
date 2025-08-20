<?php

namespace App\Services;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\UploadedFile;
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

        $photoPath = $validatedData['photo']->store('attendance_photos', 'public');

        return Attendance::create([
            'user_id' => auth()->id(),
            'shift_id' => $qrData['shift_id'],
            'scanned_at' => now(),
            'latitude' => $validatedData['latitude'],
            'longitude' => $validatedData['longitude'],
            'photo_path' => $photoPath,
            'status' => $this->determineStatus(),
        ]);
    }

    private function calculateDistance($lat1, $lon1, $lat2, $lon2): float
    {

    }
    
    private function determineStatus(): string
    {
        return 'on_time';
    }
}