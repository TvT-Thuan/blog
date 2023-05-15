@extends('layouts.main')
@section('content')
    <main id="main">
        <section id="contact" class="contact mb-5">
            <div class="container" data-aos="fade-up">

                <div class="row">
                    <div class="col-lg-12 text-center mb-5">
                        <h1 class="page-title">Giới thiệu</h1>
                    </div>
                </div>

                <div class="row gy-4">

                    <div class="col-md-4">
                        <div class="info-item">
                            <i class="bi bi-geo-alt"></i>
                            <h3>Địa chỉ</h3>
                            <address>Trường Cao Đẳng Công Nghệ Cao Hà Nội</address>
                        </div>
                    </div><!-- End Info Item -->

                    <div class="col-md-4">
                        <div class="info-item info-item-borders">
                            <i class="bi bi-phone"></i>
                            <h3>Số điện thoại</h3>
                            <p><a href="tel:0123456789">0123456789</a></p>
                        </div>
                    </div><!-- End Info Item -->

                    <div class="col-md-4">
                        <div class="info-item">
                            <i class="bi bi-envelope"></i>
                            <h3>Email</h3>
                            <p><a href="mailto:tvt.thuan241@gmail.com">tvt.thuan241@gmail.com</a></p>
                        </div>
                    </div><!-- End Info Item -->
                </div>

                <div class="form mt-5">
                    <form action="{{ route('store.contact') }}" method="post" class="php-email-form">
                        @csrf
                        <div class="row">
                            <div class="form-group col-md-6">
                                <input type="text" name="name"
                                    class="form-control @error('name') is-invalid @enderror" id="name"
                                    value="{{ old('name', Auth::user()->name ?? "") }}" placeholder="Nhập tên của bạn">
                                @error('name')
                                    <div class="invalid-feedback">
                                        <p class="m-0">{{ $message }}</p>
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    value="{{ old('email',Auth::user()->email ?? "") }}" name="email" id="email" placeholder="Nhập email của bạn">
                                @error('email')
                                    <div class="invalid-feedback">
                                        <p class="m-0">{{ $message }}</p>
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control @error('subject') is-invalid @enderror" name="subject"
                                value="{{ old('subject') }}" id="subject" placeholder="Chủ dề">
                            @error('subject')
                                <div class="invalid-feedback">
                                    <p class="m-0">{{ $message }}</p>
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <textarea class="form-control @error('message') is-invalid @enderror" name="message" rows="5"
                                placeholder="Nội dung">{{ old('message') }}</textarea>
                            @error('message')
                                <div class="invalid-feedback">
                                    <p class="m-0">{{ $message }}</p>
                                </div>
                            @enderror
                        </div>
                        @include('layouts.alert')
                        <div class="text-center">
                            <button type="submit">Gửi</button>
                        </div>
                    </form>
                </div><!-- End Contact Form -->

            </div>
        </section>

    </main><!-- End #main -->
@endsection
