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
                        enctype="multipart/form-data" class="mt-6 space-y-6 hidden">
                        @csrf
                        <input type="hidden" name="qr_code" id="qr_code_result">
                        <input type="hidden" name="latitude" id="latitude">
                        <input type="hidden" name="longitude" id="longitude">
                        <input type="hidden" name="photo" id="photo_result">

                        <div>
                            <h3 class="font-semibold">QR Code Scanned Successfully!</h3>
                            <p>Please take a selfie to confirm your attendance.</p>
                        </div>

                        <div>
                            <video id="player" autoplay class="w-full rounded-md border"></video>
                            <button type="button" id="capture"
                                class="mt-2 inline-flex items-center px-4 py-2 bg-gray-800 text-white rounded-md hover:bg-gray-700">
                                Take Photo
                            </button>
                            <canvas id="canvas" class="hidden"></canvas>
                        </div>

                        <div>
                            <x-primary-button>
                                {{ __('Submit Attendance') }}
                            </x-primary-button>
                        </div>
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
        const player = document.getElementById("player");
        const canvas = document.getElementById("canvas");
        const captureButton = document.getElementById("capture");
        const photoInput = document.getElementById("photo_result");

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
                }, function (error) {
                    alert("Failed to get location: " + error.message);
                });
            } else {
                alert("Geolocation not supported by this browser.");
            }

            attendanceForm.classList.remove("hidden");

            navigator.mediaDevices.getUserMedia({ video: true })
                .then(stream => {
                    player.srcObject = stream;
                })
                .catch(err => {
                    console.error("Camera access denied: ", err);
                    alert("Unable to access camera.");
                });
        }

        const html5QrcodeScanner = new Html5QrcodeScanner(
            "qr-reader", { fps: 10, qrbox: 250 }
        );
        html5QrcodeScanner.render(onScanSuccess);

        captureButton.addEventListener("click", function () {
            const context = canvas.getContext("2d");
            canvas.width = player.videoWidth;
            canvas.height = player.videoHeight;
            context.drawImage(player, 0, 0, canvas.width, canvas.height);

            const dataUrl = canvas.toDataURL("image/png");
            photoInput.value = dataUrl;

            alert("Photo captured successfully!");
        });
    </script>
</x-app-layout>