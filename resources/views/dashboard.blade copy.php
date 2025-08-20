@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="app-main flex-column flex-row-fluid " id="kt_app_main">
        <div class="d-flex flex-column flex-column-fluid">

            <div id="kt_app_content" class="app-content flex-column-fluid">
                <div id="kt_app_content_container" class="app-container container-fluid">
                    <div class="row g-5 gx-xl-10">
                        <div class="row g-5 g-xl-10">

                            <div class="col-md-6 col-xl-3 mb-xxl-10">
                                <div class="card overflow-hidden h-md-50 mb-5 mb-xl-10">
                                    <div class="card-body d-flex justify-content-between flex-column px-0 pb-0">
                                        <div class="mb-4 px-9">
                                            <div class="d-flex align-items-center mb-2">
                                                <span class="fs-2hx fw-bold text-success me-2 lh-1">
                                                    {{ $summary['on_time'] ?? 0 }}
                                                </span>
                                            </div>
                                            <span class="fs-6 fw-semibold text-gray-500">On Time</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 col-xl-3 mb-xxl-10">
                                <div class="card overflow-hidden h-md-50 mb-5 mb-xl-10">
                                    <div class="card-body d-flex justify-content-between flex-column px-0 pb-0">
                                        <div class="mb-4 px-9">
                                            <div class="d-flex align-items-center mb-2">
                                                <span class="fs-2hx fw-bold text-warning me-2 lh-1">
                                                    {{ $summary['late'] ?? 0 }}
                                                </span>
                                            </div>
                                            <span class="fs-6 fw-semibold text-gray-500">Late</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 col-xl-3 mb-xxl-10">
                                <div class="card overflow-hidden h-md-50 mb-5 mb-xl-10">
                                    <div class="card-body d-flex justify-content-between flex-column px-0 pb-0">
                                        <div class="mb-4 px-9">
                                            <div class="d-flex align-items-center mb-2">
                                                <span class="fs-2hx fw-bold text-danger me-2 lh-1">
                                                    {{ $summary['absent'] ?? 0 }}
                                                </span>
                                            </div>
                                            <span class="fs-6 fw-semibold text-gray-500">Absent</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 col-xl-3 mb-xxl-10">
                                <div class="card overflow-hidden h-md-50 mb-5 mb-xl-10">
                                    <div class="card-body d-flex justify-content-between flex-column px-0 pb-0">
                                        <div class="mb-4 px-9">
                                            <div class="d-flex align-items-center mb-2">
                                                <span class="fs-2hx fw-bold text-primary me-2 lh-1">
                                                    {{ $summary['attendance_rate'] ?? 0 }}%
                                                </span>
                                            </div>
                                            <span class="fs-6 fw-semibold text-gray-500">Attendance Rate</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="row g-5 g-xl-10">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title fw-bold text-gray-800">Attendance History</h3>
                                </div>
                                <div class="card-body">
                                    <table class="table align-middle table-row-dashed fs-6 gy-5">
                                        <thead>
                                            <tr class="text-gray-500 fw-semibold fs-7 text-uppercase gs-0">
                                                <th>Date & Time</th>
                                                <th>Location</th>
                                                <th>Shift</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($attendances as $attendance)
                                                <tr>
                                                    <td>{{ $attendance->scanned_at->translatedFormat('l, d F Y H:i') }}</td>
                                                    <td>{{ $attendance->shift->location->name ?? 'N/A' }}</td>
                                                    <td>{{ $attendance->shift->name ?? 'N/A' }}</td>
                                                    <td>
                                                        @if($attendance->status == 'on_time')
                                                            <span class="badge badge-light-success">On Time</span>
                                                        @elseif($attendance->status == 'late')
                                                            <span class="badge badge-light-warning">Late</span>
                                                        @else
                                                            <span class="badge badge-light-danger">Absent</span>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="4" class="text-center text-gray-500">No attendance history
                                                        found.</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
@endsection