<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Scan Attendance QR Code') }}
        </h2>
    </x-slot>

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

                        <div>
                            <h3 class="font-semibold">QR Code Scanned Successfully!</h3>
                            <p>Please take a selfie to confirm your attendance.</p>
                        </div>

                        <div>
                            <video id="player" controls autoplay class="w-full rounded-md border"></video>
                            <button type="button" id="capture"
                                class="mt-2 inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                                Take Photo
                            </button>
                            <canvas id="canvas" class="hidden"></canvas>
                            <input type="hidden" name="photo" id="photo_result">
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
        // ... JavaScript logic will go here ...
        // 1. Initialize html5-qrcode scanner.
        // 2. On scan success:
        //    a. Stop the scanner.
        //    b. Populate the qr_code_result input.
        //    c. Get GPS location and populate latitude/longitude inputs.
        //    d. Show the form and the selfie camera view.
        // 3. On "Take Photo" click:
        //    a. Draw video frame to the hidden canvas.
        //    b. Convert canvas to blob/dataURL and set it to the photo_result input.
        // 4. On form submit, all data is sent to the backend.
    </script>
</x-app-layout>