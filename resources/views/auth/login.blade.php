@extends('layouts.auth')

@section('title', 'Sign In')

@section('content')
    <div class="d-flex flex-column-fluid flex-lg-row-auto justify-content-center justify-content-lg-end p-12">
        <div class="bg-body d-flex flex-column flex-center rounded-4 w-md-600px p-10">
            <div class="d-flex flex-center flex-column align-items-stretch h-lg-100 w-md-400px">
                <div class="d-flex flex-center flex-column flex-column-fluid pb-15 pb-lg-20">
                    <form method="POST" action="{{ route('login') }}" class="form w-100">
                        @csrf

                        <div class="text-center mb-11">
                            <h1 class="text-gray-900 fw-bolder mb-3">Sign In</h1>
                            <div class="text-gray-500 fw-semibold fs-6">Login with your email and password</div>
                        </div>

                        <div class="fv-row mb-8">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" id="email" name="email" value="{{ old('email') }}" autocomplete="username"
                                class="form-control form-control-solid" />
                            @error('email')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="fv-row mb-3" data-kt-password-meter="true">
                            <label for="password" class="form-label">Password</label>
                            <div class="position-relative mb-3">
                                <input type="password" id="password" name="password" class="form-control form-control-solid"
                                    autocomplete="off" />

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
                        </div>

                        <div class="d-flex flex-stack flex-wrap gap-3 fs-base fw-semibold mb-8">
                            <div></div>
                            <div class="form-check form-switch mt-4">
                                <input class="form-check-input" type="checkbox" id="remember_me" name="remember" />
                                <label class="form-check-label" for="remember_me">Remember me</label>
                            </div>
                        </div>

                        <div class="d-grid mb-10">
                            <button type="submit" class="btn btn-primary">
                                Sign in
                            </button>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection