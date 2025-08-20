@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="app-main flex-column flex-row-fluid " id="kt_app_main">
        <div class="d-flex flex-column flex-column-fluid">

            <div id="kt_app_content" class="app-content  flex-column-fluid ">

                <div id="kt_app_content_container" class="app-container  container-fluid ">
                    <div class="row g-5 gx-xl-10">
                        <div class="row g-5 g-xl-10">

                            <div class="col-md-6 col-xl-6 mb-xxl-10">
                                <div class="card overflow-hidden h-md-50 mb-5 mb-xl-10">
                                    <div class="card-body d-flex justify-content-between flex-column px-0 pb-0">
                                        <div class="mb-4 px-9">
                                            <div class="d-flex align-items-center mb-2">
                                                <span class="fs-2hx fw-bold text-gray-800 me-2 lh-1">
                                                    {{ $summary['on_time'] ?? 0 }}
                                                </span>
                                            </div>

                                            <span class="fs-6 fw-semibold text-gray-500">On Time</span>
                                        </div>

                                        <div id="kt_card_widget_8_chart" class="min-h-auto" style="height: 125px"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 col-xl-6 mb-xxl-10">
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

                                        <div id="kt_card_widget_8_chart" class="min-h-auto" style="height: 125px"></div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection