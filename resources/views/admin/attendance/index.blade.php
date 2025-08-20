@extends('layouts.app')

@section('title', 'Attendance Recap')

@section('content')
    <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
        <div class="d-flex flex-column flex-column-fluid">

            <div id="kt_app_toolbar" class="app-toolbar pt-6 pb-2">
                <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex align-items-stretch">
                    <div class="app-toolbar-wrapper d-flex flex-stack flex-wrap gap-4 w-100">
                        <div class="page-title d-flex flex-column justify-content-center gap-1 me-3">
                            <div class="d-flex justify-content-center align-items-center">
                                <div class="symbol symbol-55px me-5">
                                    <span class="symbol-label bg-light-primary">
                                        <i class="ki-solid ki-file text-primary fs-1"></i>
                                    </span>
                                </div>
                                <div class="card-title align-items-start flex-column">
                                    <h1
                                        class="page-heading d-flex flex-column justify-content-center text-gray-900 fw-bold fs-3 m-0">
                                        @yield('title')
                                    </h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="kt_app_content" class="app-content flex-column-fluid">
                <div id="kt_app_content_container" class="app-container container-fluid">
                    <div class="card card-flush">

                        <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                            <div class="card-title">
                                <div class="d-flex align-items-center position-relative my-1">
                                    <i class="ki-outline ki-magnifier fs-2 position-absolute ms-4"></i>
                                    <input type="text" data-kt-ecommerce-order-filter="search"
                                        class="form-control form-control-solid w-250px ps-12"
                                        placeholder="Search employee or shift..." />
                                </div>
                            </div>
                        </div>

                        <div class="card-body pt-0">
                            <table class="table align-middle table-row-dashed fs-6 gy-5" id="attendance_recap_table">
                                <thead class="bg-gray-50">
                                    <tr class="text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                                        <th class="text-center min-w-50px">No</th>
                                        <th class="text-start min-w-200px">Employee</th>
                                        <th class="text-start min-w-150px">Shift</th>
                                        <th class="text-start min-w-200px">Scanned At</th>
                                        <th class="text-start min-w-100px">Status</th>
                                        <th class="text-start min-w-200px">Reason (if late)</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($attendances as $key => $attendance)
                                        <tr>
                                            <td class="text-center">{{ $key + 1 }}</td>
                                            <td>{{ $attendance->user->name }}</td>
                                            <td>{{ $attendance->shift->name }}</td>
                                            <td>{{ $attendance->scanned_at->translatedFormat('l, d F Y H:i') }}</td>
                                            <td>
                                                @if($attendance->status == 'on_time')
                                                    <span class="badge badge-light-success">On Time</span>
                                                @elseif($attendance->status == 'late')
                                                    <span class="badge badge-light-warning">Late</span>
                                                @else
                                                    <span class="badge badge-light-danger">Absent</span>
                                                @endif
                                            </td>
                                            <td>{{ $attendance->late_reason ?? '-' }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection