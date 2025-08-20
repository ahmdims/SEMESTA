@extends('layouts.auth')

@section('title', 'Sign In')

@section('content')
    <div class="d-flex flex-column-fluid flex-lg-row-auto justify-content-center justify-content-lg-end p-12">
        <div class="bg-body d-flex flex-column flex-center rounded-4 w-md-600px p-10">
            <div class="d-flex flex-center flex-column align-items-stretch h-lg-100 w-md-400px">
                <div class="d-flex flex-center flex-column flex-column-fluid pb-15 pb-lg-20">
                    <form class="form w-100" method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="text-center mb-11">
                            <h1 class="text-gray-900 fw-bolder mb-3">Sign Up</h1>
                            <div class="text-gray-500 fw-semibold fs-6">Sign up today and bring your ideas to life</div>
                        </div>

                        <div class="fv-row mb-3">
                            <label class="form-label fw-semibold fs-6 mb-2">Name</label>
                            <input type="text" id="name" name="name" value="{{ old('name') }}"
                                class="form-control form-control-solid" required />
                            @error('name')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="fv-row mb-3">
                            <label class="form-label fw-semibold fs-6 mb-2">Email</label>
                            <input type="email" id="email" name="email" value="{{ old('email') }}"
                                class="form-control form-control-solid" required />
                            @error('email')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="fv-row mb-6" data-kt-password-meter="true">
                            <label class="form-label fw-semibold fs-6 mb-2">Password</label>
                            <div class="position-relative">
                                <input type="password" id="password" name="password"
                                    class="form-control form-control-lg form-control-solid" autocomplete="off" />

                                <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2"
                                    data-kt-password-meter-control="visibility">
                                    <i class="ki-duotone ki-eye-slash fs-1"><span class="path1"></span><span
                                            class="path2"></span><span class="path3"></span><span class="path4"></span></i>
                                    <i class="ki-duotone ki-eye d-none fs-1"><span class="path1"></span><span
                                            class="path2"></span><span class="path3"></span></i>
                                </span>
                            </div>
                            @error('password')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror

                            <div class="d-flex align-items-center mt-3" data-kt-password-meter-control="highlight">
                                <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                                <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                                <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                                <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px"></div>
                            </div>

                            <div class="text-muted mt-2">
                                Use 8 or more characters with a mix of letters, numbers & symbols.
                            </div>
                        </div>

                        <div class="fv-row mb-6" data-kt-password-meter="true">
                            <label class="form-label fw-semibold fs-6 mb-2">Password Confirmation</label>
                            <div class="position-relative">
                                <input type="password" id="password_confirmation" name="password_confirmation"
                                    class="form-control form-control-lg form-control-solid" autocomplete="new-password"
                                    required />

                                <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2"
                                    data-kt-password-meter-control="visibility">
                                    <i class="ki-duotone ki-eye-slash fs-1"><span class="path1"></span><span
                                            class="path2"></span><span class="path3"></span><span class="path4"></span></i>
                                    <i class="ki-duotone ki-eye d-none fs-1"><span class="path1"></span><span
                                            class="path2"></span><span class="path3"></span></i>
                                </span>
                            </div>
                            @error('password_confirmation')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid mb-10">
                            <button type="submit" class="btn btn-primary">
                                <span class="indicator-label">Sign Up</span>
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection