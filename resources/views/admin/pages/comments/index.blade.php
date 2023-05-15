@extends('admin.layouts.main')
@section('content')
    <div class="card mt-4">
        <div class="card-body p-0">
            <table class="table table-hover border">
                <thead>
                    <th>#</th>
                    <th>Content</th>
                    <th>User Name</th>
                    <th>Post Name</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    @foreach ($comments as $key => $comment)
                        <tr>
                            <td>{{ $key }}</td>
                            <td>{{ $comment->content }}</td>
                            <td>{{ $comment->user->name }}</td>
                            <td><a target="_blank" href="{{ route("show.posts", $comment->post->slug) }}">{{ $comment->post->title }}</a></td>
                            <td class="d-flex align-items-center p-1">
                                <a class="btn" href="{{ route('admin.comments.edit', $comment) }}"><i
                                        class="fas fa-edit text-warning"></i></a>
                                |
                                <form id="form" action="{{ route('admin.comments.destroy', $comment) }}" method="comment">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn"><i class="fas fa-trash text-danger"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
@endsection

