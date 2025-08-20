@extends('layouts.app')

@section('title', 'Scan Attendance QR Code')

@section('content')
<div class="app-main flex-column flex-row-fluid" id="kt_app_main">
    <div class="d-flex flex-column flex-column-fluid">
        <div class="card" id="kt_pricing">
            <div class="card-body p-lg-17">
                <div class="d-flex flex-column align-items-center text-center">

                    <h1 class="fs-1 fw-bold mb-3">
                        Scan Attendance QR Code
                    </h1>

                    @if (session('attendance_success'))
                        <div class="mb-4 bg-green-100 border-l-4 border-green-500 text-green-700 p-4" role="alert">
                            <p class="font-bold">Success</p>
                            <p>{{ session('attendance_success') }}</p>
                        </div>
                    @endif

                    @if (session('attendance_error'))
                        <div class="mb-4 bg-red-100 border-l-4 border-red-500 text-red-700 p-4" role="alert">
                            <p class="font-bold">Failed</p>
                            <p>{{ session('attendance_error') }}</p>
                        </div>
                    @endif

                    <div id="qr-reader" style="width: 300px; margin-bottom: 1rem;"></div>
                    <div id="qr-reader-results" class="mb-3"></div>

                    <form id="attendance-form" action="{{ route('attendance.store') }}" method="POST" class="mt-6 space-y-6 hidden">
                        @csrf
                        <input type="hidden" name="qr_code" id="qr_code_result">
                        <input type="hidden" name="latitude" id="latitude">
                        <input type="hidden" name="longitude" id="longitude">

                        <div>
                            <h3 class="font-semibold">QR Code scanned successfully!</h3>
                            <p>Submitting attendance data...</p>
                        </div>

                        <button type="submit" class="btn btn-primary">
                            Submit Attendance
                        </button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
<script>
    const qrResult = document.getElementById("qr-reader-results");
    const qrCodeInput = document.getElementById("qr_code_result");
    const attendanceForm = document.getElementById("attendance-form");

    function onScanSuccess(decodedText, decodedResult) {
        html5QrcodeScanner.clear().then(_ => {
            console.log("QR Code scanning stopped.");
        }).catch(error => {
            console.error("Failed to stop scanner.", error);
        });

        qrResult.innerHTML = `<span class="text-success fw-bold">QR Code: ${decodedText}</span>`;
        qrCodeInput.value = decodedText;

        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function (position) {
                document.getElementById("latitude").value = position.coords.latitude;
                document.getElementById("longitude").value = position.coords.longitude;

                attendanceForm.submit();
            }, function (error) {
                alert("Failed to get location: " + error.message);
            });
        } else {
            alert("Geolocation is not supported by this browser.");
        }

        attendanceForm.classList.remove("hidden");
    }

    const html5QrcodeScanner = new Html5QrcodeScanner(
        "qr-reader", { fps: 10, qrbox: 250 }
    );
    html5QrcodeScanner.render(onScanSuccess);
</script>
@endsection
