@extends('admin.layouts.main')
@section('content')
    <div class="card card-primary mt-5">
        <h2 class="m-4">Edit comment</h2>

        <form action="{{ route('admin.comments.update', $comment) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="form-group">
                    <label for="content">Content comment</label>
                    <input name="content" type="text" class="form-control @error('content') is-invalid @enderror"
                        id="content" value="{{ old('content', $comment->content) }}" placeholder="Enter content comment">
                    @error('content')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Update comment</button>
                <a class="btn btn-white ml-4" href="{{ route('admin.categories.index') }}">Back</a>
            </div>
        </form>
    </div>
@endsection
