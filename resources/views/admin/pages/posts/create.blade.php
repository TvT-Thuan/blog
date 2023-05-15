@extends('admin.layouts.main')
@push('css')
    <link rel="stylesheet" href="{{ asset('admin/plugins/summernote/summernote-bs4.min.css') }}">
@endpush
@section('content')
    <div class="card card-primary">
        <form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="name">Title post</label>
                    <input name="title" type="text" class="form-control @error('title') is-invalid @enderror"
                        id="title" value="{{ old('title') }}" placeholder="Enter title category">
                    @error('title')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="slug">Slug post</label>
                    <input name="slug" type="text" class="form-control @error('slug') is-invalid @enderror"
                        id="slug" value="{{ old('slug') }}" placeholder="Enter slug category">
                    @error('slug')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <div class="form-group">
                        <label for="customFile">Image</label>
                        <div class="custom-file">
                            <input name="image" type="file"
                                class="custom-file-input @error('image') is-invalid @enderror"
                                placeholder="Enter image category" id="customFile" accept="image/gif, image/jpeg, image/png"
                                onchange="loadFile(event)">
                            <label class="custom-file-label" for="customFile">Choose file</label>
                        </div>
                        @error('image')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                        <div class="text-center mt-3">
                            <img id="output" class="col-6 col-md-4 col-lg-2" width="100%" height="100%" />
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="summernote">Content</label>
                    <textarea id="summernote" class="@error('content') is-invalid @enderror" name="content">{{ old('content') }}</textarea>
                    @error('content')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label>User</label>
                    <select name="user_id" class="form-control @error('user_id') is-invalid @enderror">
                        @foreach ($users as $user)
                            <option @if (old('user_id') == $user->id) selected @endif value="{{ $user->id }}">
                                {{ $user->name . ' - ' . $user->role_name }}
                            </option>
                        @endforeach
                    </select>
                    @error('user_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Category</label>
                    <select name="category_id" class="form-control @error('category_id') is-invalid @enderror">
                        @foreach ($categories as $category)
                            <option @if (old('category_id') == $category->id) selected @endif value="{{ $category->id }}">
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

                <div class="form-group">
                    <label>Check</label>
                    <select name="is_check" class="form-control @error('is_check') is-invalid @enderror">
                        <option @if (old('is_check') === '0') selected @endif value="0">Not check</option>
                        <option @if (old('is_check') === '1') selected @endif value="1">Check</option>
                    </select>
                    @error('is_check')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Active</label>
                    <select name="is_active" class="form-control @error('is_active') is-invalid @enderror">
                        <option @if (old('is_active') === '1') selected @endif value="1">Active</option>
                        <option @if (old('is_active') === '0') selected @endif value="0">Not active</option>
                    </select>
                    @error('is_active')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Add Post</button>
                <a class="btn btn-white ml-4" href="{{ route('admin.posts.index') }}">Back</a>
            </div>
        </form>
    </div>
@endsection
@push('js')
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

        // $('#summernote').summernote();
        $('#summernote').summernote({
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
