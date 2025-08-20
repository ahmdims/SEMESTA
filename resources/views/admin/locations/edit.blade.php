@extends('layouts.app')

@section('title', 'Update Location')

@section('content')
    <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
        <div class="d-flex flex-column flex-column-fluid">
            <div id="kt_app_content" class="app-content flex-column-fluid">
                <div id="kt_app_content_container" class="app-container container-fluid">
                    <form action="{{ route('admin.locations.update', $location->id) }}" method="POST"
                        enctype="multipart/form-data" class="form d-flex flex-column flex-lg-row">
                        @csrf
                        @method('PUT')
                        <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
                            <div class="card card-flush py-4">
                                <div class="card-header">
                                    <div class="card-title">
                                        <h2>Update Location: {{ $location->name }}</h2>
                                    </div>
                                </div>
                                <div class="card-body pt-0">
                                    <div class="mb-10 fv-row">
                                        <label class="required form-label">Location Name</label>
                                        <input type="text" name="name" class="form-control mb-2"
                                            placeholder="Enter location name"
                                            value="{{ old('name', $location->name ?? '') }}" required>
                                        @error('name')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="row g-6 mb-10">
                                        <div class="col fv-row">
                                            <label class="required form-label">Latitude</label>
                                            <input type="text" name="latitude" class="form-control mb-2"
                                                placeholder="Example: -7.2575"
                                                value="{{ old('latitude', $location->latitude ?? '') }}" required>
                                            @error('latitude')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col fv-row">
                                            <label class="required form-label">Longitude</label>
                                            <input type="text" name="longitude" class="form-control mb-2"
                                                placeholder="Example: 112.7521"
                                                value="{{ old('longitude', $location->longitude ?? '') }}" required>
                                            @error('longitude')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="mb-10 fv-row">
                                        <label class="required form-label">Tolerance Radius (meters)</label>
                                        <input type="number" name="radius" class="form-control mb-2"
                                            placeholder="Example: 30" value="{{ old('radius', $location->radius ?? 30) }}"
                                            required>
                                        <p class="mt-1 text-xs text-gray-500">
                                            Radius from the location's center point within which attendance is considered
                                            valid.
                                        </p>
                                        @error('radius')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-end">
                                <a href="{{ route('admin.locations.index') }}" class="btn btn-light me-5">Cancel</a>
                                <button type="submit" class="btn btn-primary">
                                    <span class="indicator-label">Update Location</span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection