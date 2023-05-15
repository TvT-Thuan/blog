@extends('layouts.main')
@section('content')
    <main id="main">
        <section class="">
            <div class="container-fluid h-custom">
                <div class="row d-flex justify-content-center align-items-center">
                    <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                        <h1 class="text-center">Đổi mật khẩu</h1>
                        @include('layouts.alert')
                        <form action="{{ route('auth.update_password.profile') }}" method="POST">
                            @csrf
                            @method('PUT')
                            <!-- Password old input -->
                            <div class="form-outline mb-3">
                                <label class="form-label" for="password_old">Mật khẩu cũ</label>
                                <input type="password" id="password_old" name="password_old"
                                    class="form-control form-control-lg @error('password_old') is-invalid @enderror"
                                    value="{{ old('password_old') }}" placeholder="Nhập mật khẩu" />
                                @error('password_old')
                                    <div class="invalid-feedback">
                                        <p class="m-0">{{ $message }}</p>
                                    </div>
                                @enderror
                            </div>

                            <!-- Password new input -->
                            <div class="form-outline mb-3">
                                <label class="form-label" for="password">Mật khẩu mới</label>
                                <input type="password" id="password" name="password"
                                    class="form-control form-control-lg @error('password') is-invalid @enderror"
                                    value="{{ old('password') }}" placeholder="Nhập mật khẩu" />
                                @error('password')
                                    <div class="invalid-feedback">
                                        <p class="m-0">{{ $message }}</p>
                                    </div>
                                @enderror
                            </div>

                            <!-- Password confirm input -->
                            <div class="form-outline mb-3">
                                <label class="form-label" for="confirm_password">Xác nhận mật khẩu mới</label>
                                <input type="password" id="confirm_password" name="confirm_password"
                                    class="form-control form-control-lg @error('confirm_password') is-invalid @enderror"
                                    value="{{ old('confirm_password') }}" placeholder="Nhập lại mật khẩu" />
                                @error('confirm_password')
                                    <div class="invalid-feedback">
                                        <p class="m-0">{{ $message }}</p>
                                    </div>
                                @enderror
                            </div>
                            <div class="text-center mt-4 pt-2">
                                <button class="btn btn-primary btn-lg"
                                    style="padding-left: 2.5rem; padding-right: 2.5rem;">Thay đổi</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
