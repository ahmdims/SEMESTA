<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Scan Attendance QR Code') }}
        </h2>
    </x-slot>

    @if (session('attendance_success'))
        <div class="mb-4 bg-green-100 border-l-4 border-green-500 text-green-700 p-4" role="alert">
            <p class="font-bold">Berhasil</p>
            <p>{{ session('attendance_success') }}</p>
        </div>
    @endif

    @if (session('attendance_error'))
        <div class="mb-4 bg-red-100 border-l-4 border-red-500 text-red-700 p-4" role="alert">
            <p class="font-bold">Gagal</p>
            <p>{{ session('attendance_error') }}</p>
        </div>
    @endif

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <div id="qr-reader" style="width: 500px"></div>
                    <div id="qr-reader-results"></div>

                    <form id="attendance-form" action="{{ route('attendance.store') }}" method="POST"
                        class="mt-6 space-y-6 hidden">
                        @csrf
                        <input type="hidden" name="qr_code" id="qr_code_result">
                        <input type="hidden" name="latitude" id="latitude">
                        <input type="hidden" name="longitude" id="longitude">

                        <div>
                            <h3 class="font-semibold">QR Code berhasil dipindai!</h3>
                            <p>Mengirim data absensi...</p>
                        </div>

                        <x-primary-button>
                            {{ __('Submit Attendance') }}
                        </x-primary-button>
                    </form>
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

            qrResult.innerHTML = `<span class="text-green-600 font-bold">QR Code: ${decodedText}</span>`;
            qrCodeInput.value = decodedText;

            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function (position) {
                    document.getElementById("latitude").value = position.coords.latitude;
                    document.getElementById("longitude").value = position.coords.longitude;

                    // Langsung submit form setelah mendapatkan lokasi
                    attendanceForm.submit();
                }, function (error) {
                    alert("Gagal mendapatkan lokasi: " + error.message);
                });
            } else {
                alert("Geolocation tidak didukung oleh browser ini.");
            }

            attendanceForm.classList.remove("hidden");
        }

        const html5QrcodeScanner = new Html5QrcodeScanner(
            "qr-reader", { fps: 10, qrbox: 250 }
        );
        html5QrcodeScanner.render(onScanSuccess);
    </script>
</x-app-layout>