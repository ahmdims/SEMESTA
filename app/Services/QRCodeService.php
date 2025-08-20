<?php

namespace App\Services;

use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Crypt;

class QRCodeService
{
    public function generateForShift(int $shiftId, int $locationId): string
    {
        $data = [
            'shift_id' => $shiftId,
            'location_id' => $locationId,
            'expires_at' => now()->addHour()->timestamp,
        ];

        $encryptedData = Crypt::encryptString(json_encode($data));

        return QrCode::size(200)->generate($encryptedData);
    }
}