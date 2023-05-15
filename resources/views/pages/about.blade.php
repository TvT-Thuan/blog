@extends('layouts.main')
@section('content')
    <main id="main">
        <section>
            <div class="container" data-aos="fade-up">
                <div class="row">
                    <div class="col-lg-12 text-center mb-5">
                        <h1 class="page-title">Giới thiệu</h1>
                    </div>
                </div>
            </div>
        </section>

        <section>
            <div class="container" data-aos="fade-up">
                <div class="row">
                    <div class="col-12 text-center mb-5">
                        <div class="row justify-content-center">
                            <div class="col-lg-6">
                                <h2 class="display-4">Thành viên nhóm</h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 text-center mb-5">
                        <img src="{{ asset("assets/img/tuna.jpg") }}" alt="" class="img-fluid rounded-circle w-50 mb-4">
                        <h4>Trần Văn Thuận</h4>
                        <span class="d-block mb-3 text-uppercase">Trưởng nhóm</span>
                    </div>
                    <div class="col-lg-4 text-center mb-5">
                        <img src="{{ asset("assets/img/hung.png") }}" alt="" class="img-fluid rounded-circle w-50 mb-4">
                        <h4>Đào Đức Hưng</h4>
                        <span class="d-block mb-3 text-uppercase">Thành viên</span>
                        <p>Người sáng tạo nội dung. Người viết mã khủng nhất thiết kế website khoá 12</p>
                    </div>
                    <div class="col-lg-4 text-center mb-5">
                        <img src="{{ asset("assets/img/dung.png") }}" alt="" class="img-fluid rounded-circle w-50 mb-4">
                        <h4>Nguyễn Văn Dũng</h4>
                        <span class="d-block mb-3 text-uppercase">Thành viên</span>
                        <p>Người sáng tạo nội dung. Bậc thầy html-css</p>
                    </div>
                </div>
            </div>
        </section>

    </main><!-- End #main -->
@endsection
