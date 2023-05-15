@extends('layouts.main')
@section('content')
    <main id="main">
        <section class="vh-100">
            <div class="container-fluid h-custom">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-md-9 col-lg-6 col-xl-5">
                        <img src="{{ asset('assets/img/logo_login.jpg') }}" class="img-fluid" alt="Sample image">
                    </div>
                    <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                        <h1>Đăng nhập</h1>
                        @include('layouts.alert')
                        <form action="{{ route('auth.store.login') }}" method="POST">
                            @csrf
                            <!-- Email input -->
                            <div class="form-outline mb-4">
                                <label class="form-label" for="email">Email</label>
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
                                <label class="form-label" for="password">Mật khẩu</label>
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
                                    style="padding-left: 2.5rem; padding-right: 2.5rem;">Đăng nhập</button>
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
