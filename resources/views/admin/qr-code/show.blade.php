<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            QR Code for: {{ $shift->name }} at {{ $shift->location->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 text-center">
                    <h3 class="text-lg font-medium mb-4">
                        Scan this code for {{ $shift->start_time }} - {{ $shift->end_time }} shift.
                    </h3>
                    <div class="flex justify-center">
                        {!! $qrCode !!}
                    </div>
                    <p class="mt-4 text-sm text-gray-600">
                        Note: This QR code is unique and will expire in one hour.
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>