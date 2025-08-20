@extends('layouts.app')

@section('title', 'Create Shift')

@section('content')
    <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
        <div class="d-flex flex-column flex-column-fluid">
            <div id="kt_app_content" class="app-content flex-column-fluid">
                <div id="kt_app_content_container" class="app-container container-fluid">
                    <form action="{{ route('admin.shifts.store') }}" method="POST" enctype="multipart/form-data"
                        class="form d-flex flex-column flex-lg-row">
                        @csrf
                        <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
                            <div class="card card-flush py-4">
                                <div class="card-header">
                                    <div class="card-title">
                                        <h2>Create Shift</h2>
                                    </div>
                                </div>
                                <div class="card-body pt-0">
                                    <div class="mb-10 fv-row">
                                        <label class="required form-label">Shift Name</label>
                                        <input type="text" name="name" class="form-control mb-2" placeholder="Shift name"
                                            value="{{ old('name') }}" required />
                                        @error('name')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-10 fv-row">
                                        <label class="required form-label">Location</label>
                                        <select name="location_id" class="form-control mb-2" required>
                                            <option value="">Select a location</option>
                                            @foreach ($locations as $location)
                                                <option value="{{ $location->id }}"
                                                    @selected(old('location_id') == $location->id)>
                                                    {{ $location->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('location_id')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="row row-cols-1 row-cols-md-2 g-6">
                                        <div class="col fv-row">
                                            <label class="form-label">Start Time</label>
                                            <input type="time" name="start_time" class="form-control mb-2"
                                                value="{{ old('start_time') }}" />
                                            @error('start_time')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col fv-row">
                                            <label class="form-label">End Time</label>
                                            <input type="time" name="end_time" class="form-control mb-2"
                                                value="{{ old('end_time') }}" />
                                            @error('end_time')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-end">
                                <a href="{{ route('admin.shifts.index') }}" class="btn btn-light me-5">Cancel</a>
                                <button type="submit" class="btn btn-primary">
                                    <span class="indicator-label">Create Shift</span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection