@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
        <div class="d-flex flex-column flex-column-fluid">

            <div id="kt_app_content" class="app-content flex-column-fluid">

                <div id="kt_app_content_container" class="app-container container-fluid">
                    <div class="row gx-5 gx-xl-10 mb-xl-10">
                        <div class="col-12 col-lg-6 mb-10">
                            <div class="card card-flush h-md-50 mb-5 mb-xl-10">
                                <div class="card-body d-flex justify-content-between flex-column px-0 pb-0">
                                    <div class="mb-4 px-9">
                                        <div class="d-flex align-items-center mb-2">
                                            <span class="fs-2hx fw-bold text-gray-800 me-2 lh-1">
                                                {{ $dailyAttendancePercentage }}%
                                            </span>
                                        </div>
                                        <span class="fs-6 fw-semibold text-gray-500">Daily Attendance Percentage</span>
                                    </div>
                                </div>
                            </div>

                            <div class="card card-flush h-md-50 mb-5 mb-xl-10">
                                <div class="card-body d-flex justify-content-between flex-column px-0 pb-0">
                                    <div class="mb-4 px-9">
                                        <div class="d-flex flex-column mb-2">
                                            @forelse ($atRiskGuards as $guard)
                                                <div class="d-flex justify-content-between py-1 w-100">
                                                    <p class="text-gray-900 mb-0">{{ $guard->name }}</p>
                                                    <span class="text-sm text-red-600">{{ $guard->lates_last_7_days }} late
                                                        arrivals in the last 7 days</span>
                                                </div>
                                            @empty
                                                <p class="text-gray-500 mb-0">No risk data detected.</p>
                                            @endforelse
                                        </div>
                                        <span class="fs-6 fw-semibold text-gray-500">AI Prediction: Guards at Risk of Being
                                            Late</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-lg-6 mb-5 mb-xl-0">
                            <div class="card card-flush overflow-hidden h-md-100">
                                <div class="card-header py-5">
                                    <h3 class="card-title align-items-start flex-column">
                                        <span class="card-label fw-bold text-gray-900">This Month's Attendance Chart</span>
                                        <span class="text-gray-500 mt-1 fw-semibold fs-6">Daily attendance of guards</span>
                                    </h3>
                                </div>
                                <div class="card-body d-flex justify-content-between flex-column pb-1 px-0">
                                    <div class="min-h-auto ps-4 pe-6" style="height: 300px; min-height: 315px;">
                                        <canvas id="attendanceChart" class="h-100 w-100"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row gy-5 g-xl-10">
                        <div class="col-xl-4 mb-xl-10">
                            <div class="card h-md-100" dir="ltr">
                                <div class="card-body d-flex flex-column flex-center">
                                    <div class="mb-4 text-center">
                                        <h1 class="fw-semibold text-gray-800 lh-lg">
                                            Check <br>
                                            <span class="fw-bolder">Attendance History</span>
                                        </h1>
                                    </div>

                                    <div class="text-center">
                                        <a class="btn btn-sm btn-primary me-2"
                                            href="{{ route('admin.attendances.index') }}">
                                            View History
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-8 mb-5 mb-xl-10">
                            <div class="card card-flush h-xl-100">
                                <div class="card-body pt-2">
                                    <div id="kt_table_widget_4_table_wrapper"
                                        class="dt-container dt-bootstrap5 dt-empty-footer">
                                        <div class="table-responsive">
                                            <table class="table align-middle table-row-dashed fs-6 gy-3 dataTable"
                                                id="kt_table_widget_4_table" style="width: 100%;">
                                                <thead>
                                                    <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                                                        <th class="min-w-150px">Name</th>
                                                        <th class="min-w-150px">Email</th>
                                                        <th class="min-w-125px text-end">Times Late</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="fw-bold text-gray-600">
                                                    @foreach ($topLateEmployees as $employee)
                                                        <tr>
                                                            <td>
                                                                <a href="#" class="text-gray-800 text-hover-primary">
                                                                    {{ $employee->name }}
                                                                </a>
                                                            </td>
                                                            <td class="text-end">
                                                                {{ $employee->email }}
                                                            </td>
                                                            <td class="text-end">
                                                                {{ $employee->attendances_count }}
                                                            </td>
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

                </div>
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const ctx = document.getElementById('attendanceChart').getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: @json($chartLabels),
                    datasets: [{
                        label: 'On Time',
                        data: @json($chartOnTimeData),
                        backgroundColor: 'rgba(54, 162, 235, 0.5)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }, {
                        label: 'Late',
                        data: @json($chartLateData),
                        backgroundColor: 'rgba(255, 99, 132, 0.5)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: { y: { beginAtZero: true } },
                    responsive: true,
                    plugins: {
                        legend: { position: 'top' },
                        title: { display: true, text: "This Month's Daily Attendance" }
                    }
                }
            });
        });
    </script>
@endsection