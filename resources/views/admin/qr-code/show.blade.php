@extends('layouts.app')

@section('title', 'QR Code')

@section('content')
    <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
        <div class="d-flex flex-column flex-column-fluid">
            <div class="card" id="kt_pricing">
                <div class="card-body p-lg-17">
                    <div class="d-flex flex-column align-items-center text-center">

                        <h1 class="fs-1 fw-bold mb-3">
                            QR Code for {{ $shift->name }}
                        </h1>

                        <h4 class="fw-semibold text-gray-700 mb-4">
                            Location: {{ $shift->location->name }}
                        </h4>

                        <p class="fs-6 text-gray-600 mb-6">
                            Shift Time: <span class="fw-bold">{{ $shift->start_time }} – {{ $shift->end_time }}</span>
                        </p>

                        <div class="mb-6">
                            {!! $qrCode !!}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection