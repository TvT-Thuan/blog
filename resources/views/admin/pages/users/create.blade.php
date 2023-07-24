@extends('admin.layouts.main')
{{-- @push('css')
    <link rel="stylesheet" href="{{ asset('admin/plugins/summernote/summernote-bs4.min.css') }}">
@endpush --}}
@section('content')
    <div class="card card-primary mt-5">
        <h2 class="m-4">Add user</h2>
        <form action="{{ route('admin.users.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="name">Name user</label>
                    <input name="name" type="text" class="form-control @error('name') is-invalid @enderror"
                        id="name" value="{{ old('name') }}" placeholder="Enter name user">
                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input name="email" type="text" class="form-control @error('email') is-invalid @enderror"
                        id="email" value="{{ old('email') }}" placeholder="Enter email user">
                    @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input name="password" type="text" class="form-control @error('password') is-invalid @enderror"
                        id="password" value="{{ old('password') }}" placeholder="Enter password user">
                    @error('password')
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

                <div class="form-group">
                    <label>Role</label>
                    <select name="role" class="form-control @error('role') is-invalid @enderror">
                        <option @if (old('role') === '0') selected @endif value="0">User</option>
                        <option @if (old('role') === '1') selected @endif value="1">Admin</option>
                    </select>
                    @error('role')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Add User</button>
                <a class="btn btn-white ml-4" href="{{ route('admin.users.index') }}">Back</a>
            </div>
        </form>
    </div>
@endsection
{{-- @push('js')
    <script src="{{ asset('admin/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
    <script>
        var loadFile = function(event) {
            var output = document.getElementById('output');
            output.src = URL.createObjectURL(event.target.files[0]);
        };
    </script>
@endpush --}}
