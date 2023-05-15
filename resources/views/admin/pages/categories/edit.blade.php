@extends('admin.layouts.main')
@section('content')
    <div class="card card-primary mt-5">
        <h2 class="m-4">Edit category</h2>

        <form action="{{ route('admin.categories.update', $category) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="form-group">
                    <label for="name">Name category</label>
                    <input name="name" type="text" class="form-control @error('name') is-invalid @enderror"
                        id="name" value="{{ old('name', $category->name) }}" placeholder="Enter name category">
                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="slug">Slug category</label>
                    <input name="slug" type="text" class="form-control @error('slug') is-invalid @enderror"
                        id="slug" value="{{ old('slug', $category->slug) }}" placeholder="Enter slug category">
                    @error('slug')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Active</label>
                    <select name="is_active" class="form-control @error('is_active') is-invalid @enderror">
                        <option @if (old('is_active', $category->is_active) === '1') selected @endif value="1">Active</option>
                        <option @if (old('is_active', $category->is_active) === '0') selected @endif value="0">Not active</option>
                    </select>
                    @error('is_active')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Update Category</button>
                <a class="btn btn-white ml-4" href="{{ route('admin.categories.index') }}">Back</a>
            </div>
        </form>
    </div>
@endsection
@push('js')
    <script>
        $("#name").keyup(function() {
            $("#slug")[0].value = removeAccents($("#name")[0].value.toLowerCase().replaceAll(" ", "-"));
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
    </script>
@endpush
