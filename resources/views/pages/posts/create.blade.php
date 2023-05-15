@extends('layouts.main')
@push('css')
    <link rel="stylesheet" href="{{ asset('admin/plugins/summernote/summernote-bs4.min.css') }}">
@endpush
@section('content')
    <main id="main">
        <section class="">
            <div class="container-fluid h-custom">
                <div class="row d-flex justify-content-center align-items-center">
                    <div class="col-md-10 col-lg-8 col-xl-6 offset-xl-1">
                        <h1 class="text-center">Thêm bài viết</h1>
                        @include('layouts.alert')
                        <form action="{{ route('my-posts.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <!-- title input -->
                            <div class="form-outline mb-3">
                                <label class="form-label" for="name">Tiêu đề bài viết</label>
                                <input name="title" type="text"
                                    class="form-control form-control-lg @error('title') is-invalid @enderror" id="title"
                                    value="{{ old('title') }}" placeholder="Nhập tiêu đề bài viết">
                                @error('name')
                                    <div class="invalid-feedback">
                                        <p class="m-0">{{ $message }}</p>
                                    </div>
                                @enderror
                            </div>

                            <div class="form-outline mb-3">
                                <label class="form-label" for="slug">Slug bài viết</label>
                                <input name="slug" type="text"
                                    class="form-control form-control-lg  @error('slug') is-invalid @enderror" id="slug"
                                    value="{{ old('slug') }}" placeholder="Enter slug category">
                                @error('slug')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-outline mb-3">
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
                                        <img id="output" class="img-fluid" width="100%" height="100%" />
                                    </div>
                                </div>
                            </div>

                            <div class="form-outline mb-3">
                                <label class="form-label" for="content">Content</label>
                                <textarea id="content" class="@error('content') is-invalid @enderror" name="content">{{ old('content') }}</textarea>
                                @error('content')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-outline mb-3">
                                <label class="form-label">Category</label>
                                <select name="category_id"
                                    class="form-control form-control-lg  @error('category_id') is-invalid @enderror">
                                    @foreach ($categories as $category)
                                        <option @if (old('category_id') == $category->id) selected @endif
                                            value="{{ $category->id }}">
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-outline mb-3">
                                <label class="form-label">Active</label>
                                <select name="is_active"
                                    class="form-control form-control-lg  @error('is_active') is-invalid @enderror">
                                    <option @if (old('is_active') === '1') selected @endif value="1">Active</option>
                                    <option @if (old('is_active') === '0') selected @endif value="0">Not active
                                    </option>
                                </select>
                                @error('is_active')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="text-center mt-4 pt-2">
                                <button class="btn btn-primary btn-lg"
                                    style="padding-left: 2.5rem; padding-right: 2.5rem;">Thêm bài viết</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
@push('js')
    <script src="{{ asset('admin/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('admin/plugins/summernote/summernote-bs4.min.js') }}"></script>
    <script>
        $("#title").keyup(function() {
            $("#slug")[0].value = removeAccents($("#title")[0].value.toLowerCase().replaceAll(" ", "-"));
        });

        function removeAccents(str) {
            var AccentsMap = [
                "aàảãáạăằẳẵắặâầẩẫấậ",
                "AÀẢÃÁẠĂẰẲẴẮẶÂẦẨẪẤẬ",
                "dđ", "DĐ",
                "eèẻẽéẹêềểễếệ",
                "EÈẺẼÉẸÊỀỂỄẾỆ",
                "iìỉĩíị",
                "IÌỈĨÍỊ",
                "oòỏõóọôồổỗốộơờởỡớợ",
                "OÒỎÕÓỌÔỒỔỖỐỘƠỜỞỠỚỢ",
                "uùủũúụưừửữứự",
                "UÙỦŨÚỤƯỪỬỮỨỰ",
                "yỳỷỹýỵ",
                "YỲỶỸÝỴ"
            ];
            for (var i = 0; i < AccentsMap.length; i++) {
                var re = new RegExp('[' + AccentsMap[i].substr(1) + ']', 'g');
                var char = AccentsMap[i][0];
                str = str.replace(re, char);
            }
            return str;
        }

        var loadFile = function(event) {
            var output = document.getElementById('output');
            output.src = URL.createObjectURL(event.target.files[0]);
        };
        $('#content').summernote({
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                // ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ]
        });
    </script>
@endpush
