<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\QRCodeService;
use App\Models\Shift;

class QRCodeController extends Controller
{
    protected $qrCodeService;

    public function __construct(QRCodeService $qrCodeService)
    {
        $this->qrCodeService = $qrCodeService;
    }

    public function show(Shift $shift)
    {
        $qrCode = $this->qrCodeService->generateForShift($shift->id, $shift->location_id);
        return view('admin.qr-code.show', compact('qrCode', 'shift'));
    }
}