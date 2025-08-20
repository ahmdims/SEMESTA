@extends('layouts.app')

@section('title', 'Shifts')

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
                                        <i class="ki-solid ki-time text-primary fs-1"></i>
                                    </span>
                                </div>

                                <div class="card-title align-items-start flex-column">
                                    <h1
                                        class="page-heading d-flex flex-column justify-content-center text-gray-900 fw-bold fs-3 m-0">
                                        @yield('title')</h1>
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
                                        class="form-control form-control-solid w-250px ps-12" placeholder="Search" />
                                </div>
                            </div>

                            <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                                <a href="{{ route('admin.shifts.create') }}" class="btn btn-primary er fs-6 px-8 py-4">
                                    Add @yield('title')
                                </a>
                            </div>
                        </div>

                        <div class="card-body pt-0">
                            <table class="table align-middle table-row-dashed fs-6 gy-5"
                                id="kt_ecommerce_report_views_table">
                                <thead class="bg-gray-50">
                                    <tr class="text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                                        <th class="min-w-50px text-center">No</th>
                                        <th class="text-start min-w-200px">Name</th>
                                        <th class="text-start min-w-150px">Location</th>
                                        <th class="text-start min-w-100px">Start Time</th>
                                        <th class="text-start min-w-100px">End Time</th>
                                        <th class="text-end min-w-100px">Action</th>
                                    </tr>
                                </thead>

                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($shifts as $key => $shift)
                                        <tr>
                                            <td class="text-center">{{ $key + 1 }}</td>
                                            <td class="text-start pe-0 text-gray-800 font-medium">
                                                {{ $shift->name }}
                                            </td>
                                            <td class="text-start pe-0">{{ $shift->location->name }}</td>
                                            <td class="text-start pe-0">{{ $shift->start_time }}</td>
                                            <td class="text-start pe-0">{{ $shift->end_time }}</td>
                                            <td class="text-end">
                                                <a href="#"
                                                    class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary"
                                                    data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                                    Action
                                                    <i class="ki-duotone ki-down fs-5 ms-1"></i>
                                                </a>

                                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                                    data-kt-menu="true">
                                                    <div class="menu-item px-3">
                                                        <a href="{{ route('admin.shifts.qrcode', $shift) }}"
                                                            class="menu-link px-3">Generate QR</a>
                                                    </div>

                                                    <div class="menu-item px-3">
                                                        <a href="{{ route('admin.shifts.edit', $shift) }}"
                                                            class="menu-link px-3">Edit</a>
                                                    </div>

                                                    <div class="menu-item px-3">
                                                        <a href="#" class="menu-link px-3"
                                                            onclick="location.preventDefault(); if(confirm('Are you sure you want to delete this event?')) { document.getElementById('delete-event-{{ $shift->id }}').submit(); }">Delete</a>
                                                        <form id="delete-event-{{ $shift->id }}"
                                                            action="{{ route('admin.locations.destroy', $shift->id) }}"
                                                            method="POST" style="display: none;">
                                                            @csrf
                                                            @method('DELETE')
                                                        </form>
                                                    </div>
                                                </div>
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
@endsection