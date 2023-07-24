@extends('layouts.main')
@push('css')
    <style>
        .divider::before,
        .divider::after {
            content: '';
            width: 100%;
            top: 50%;
            height: 1px;
            background-color:#bebebe;
        }

        .divider::before {
            left: -10px;
            right: auto;
        }

        .divider::after {
            right: -10px;
            left: auto;
        }
    </style>
@endpush
@section('content')
    <main id="main">
        <section class="vh-100">
            <div class="container-fluid h-custom">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-md-9 col-lg-6 col-xl-5">
                        <img src="{{ asset('assets/img/logo_login.jpg') }}" class="img-fluid" alt="Sample image">
                    </div>
                    <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                        @include('layouts.alert')
                        <form action="{{ route('auth.store.login') }}" method="POST">
                            @csrf

                            <div class="d-flex flex-row align-items-center justify-content-center justify-content-lg-start">
                                <h2 class="mb-0 me-3">Đăng nhập với </h2>
                                {{-- <a class="h3 m-2" href="{{ route("social.login", "facebook") }}">
                                    <i class="bi bi-facebook"></i>
                                </a> --}}

                                <a class="h3 m-2" href="{{ route("social.login", "google") }}">
                                    <i class="bi bi-google"></i>
                                </a>

                                <a class="h3 m-2" href="{{ route("social.login", "github") }}">
                                    <i class="bi bi-github"></i>
                                </a>
                            </div>

                            <div class="divider d-flex align-items-center my-4">
                                <p class="text-center fw-bold mx-3 mb-0">Hoặc</p>
                            </div>
                            <!-- Email input -->
                            <div class="form-outline mb-4">
                                <label for="">Email</label>
                                <input type="text" id="email" name="email"
                                    class="form-control form-control-lg @error('email') is-invalid @enderror"
                                    value="{{ old('email') }}" placeholder="Nhập địa chỉ email của bạn" />
                                @error('email')
                                    <div class="invalid-feedback">
                                        <p class="m-0">{{ $message }}</p>
                                    </div>
                                @enderror
                            </div>

                            <!-- Password input -->
                            <div class="form-outline mb-3">
                                <label for="">Mât khẩu</label>
                                <input type="password" id="password" name="password"
                                    class="form-control form-control-lg @error('password') is-invalid @enderror"
                                    value="{{ old('password') }}" placeholder="Nhập mật khẩu" />
                                @error('password')
                                    <div class="invalid-feedback">
                                        <p class="m-0">{{ $message }}</p>
                                    </div>
                                @enderror
                            </div>

                            {{-- <div class="d-flex justify-content-between align-items-center">
                                <!-- Checkbox -->
                                <div class="form-check mb-0">
                                    <input class="form-check-input me-2" type="checkbox" value="" id="form2Example3" />
                                    <label class="form-check-label" for="form2Example3">
                                        Remember me
                                    </label>
                                </div>
                                <a href="#!" class="text-body">Forgot password?</a>
                            </div> --}}

                            <div class="text-center text-lg-start mt-4 pt-2">
                                <button class="btn btn-primary btn-lg"
                                    style="padding-left: 2.5rem; padding-right: 2.5rem;">Đăng
                                    nhập</button>

                                <p class="small fw-bold mt-2 pt-1 mb-0">Bạn chưa có tài khoản? <a
                                        href="{{ route('auth.register') }}" class="link-danger">Đăng ký</a>
                                </p>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
