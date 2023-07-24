@extends('layouts.main')
@section('content')
    <main id="main">
        <section class="">
            <div class="container-fluid h-custom">
                <div class="row d-flex justify-content-center align-items-center">
                    <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                        <h1 class="text-center pt-5">Thay đổi thông tin</h1>
                        @include('layouts.alert')
                        <form action="{{ route('auth.update.profile') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <!-- Name input -->
                            <div class="form-outline mb-4">
                                <label class="form-label" for="name">Tên</label>
                                <input type="text" id="name" name="name"
                                    class="form-control form-control-lg @error('name') is-invalid @enderror"
                                    value="{{ old('name', auth()->user()->name) }}" placeholder="Nhập tên của bạn" />
                                @error('name')
                                    <div class="invalid-feedback">
                                        <p class="m-0">{{ $message }}</p>
                                    </div>
                                @enderror
                            </div>
                            <!-- Email input -->
                            <div class="form-outline mb-4">
                                <label class="form-label" for="email">Email</label>
                                <input type="text" id="email" name="email"
                                    class="form-control form-control-lg @error('email') is-invalid @enderror"
                                    value="{{ old('email', auth()->user()->email) }}"
                                    placeholder="Nhập địa chỉ Email của bạn" />
                                @error('email')
                                    <div class="invalid-feedback">
                                        <p class="m-0">{{ $message }}</p>
                                    </div>
                                @enderror
                            </div>
                            <div class="form-outline">
                                <div class="form-group">
                                    <label for="form-label">Image</label>
                                    <input name="image" type="file"
                                        class="form-control @error('image') is-invalid @enderror"
                                        placeholder="Enter image category" id="customFile"
                                        accept="image/gif, image/jpeg, image/png" onchange="loadFile(event)">
                                    @error('image')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    <div class="text-center mt-3">
                                        <img src="{{ asset(auth()->user()->image_url) }}" id="output" class="img-fluid" width="100%" height="100%" />
                                    </div>
                                </div>
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

@push('js')
    <script>
        var loadFile = function(event) {
            var output = document.getElementById('output');
            output.src = URL.createObjectURL(event.target.files[0]);
        };
    </script>
@endpush
