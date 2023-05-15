@extends('layouts.main')
@section('content')
    <main id="main">
        <section id="contact" class="contact mb-5">
            <div class="container" data-aos="fade-up">

                <div class="row">
                    <div class="col-lg-12 text-center mb-5">
                        <h1 class="page-title">Thông tin của bạn</h1>
                    </div>
                </div>

                <div class="row gy-4">
                    {{-- name --}}
                    <div class="col-md-4">
                        <div class="info-item">
                            <i class="bi bi-person-circle"></i>
                            <h3>Name</h3>
                            <p>{{ Auth::user()->name }}</p>
                        </div>
                    </div>
                    {{-- email --}}
                    <div class="col-md-4">
                        <div class="info-item">
                            <i class="bi bi-envelope"></i>
                            <h3>Email</h3>
                            <p>{{ Auth::user()->email }}</< /p>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="info-item">
                            <h3>Avatar</h3>
                            <img class="img-fluid" style="max-width: 200px" src="{{ asset(Auth::user()->image_url) }}"
                                alt="">
                        </div>
                    </div>
                </div>

                <div class="text-center pt-5">
                    <button class="btn btn-dark"><a class="text-white" href="{{ route('auth.edit.profile') }}">Thay đổi
                            thông tin</a></button>
                    <button class="btn btn-dark"><a class="text-white" href="{{ route('auth.edit_password.profile') }}">Đổi
                            mật khẩu</a></button>
                </div>
            </div>
        </section>

    </main><!-- End #main -->
@endsection
