@extends('admin.layouts.main')
@section('content')
    <a href="{{ route('admin.posts.create') }}" class="btn btn-primary mt-5">Add Post</a>

    <div class="card mt-4">
        <div class="card-body p-0">
            <table class="table table-hover border">
                <thead>
                    <th>#</th>
                    <th>Title</th>
                    <th>Image</th>
                    <th>View</th>
                    <th>Check</th>
                    <th>Active</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    @foreach ($posts as $key => $post)
                        <tr>
                            <td>{{ $key }}</td>
                            <td><a target="_blank" href="{{ route("show.posts", $post->slug) }}">{{ $post->title }}</a></td>
                            <td><img width="25px" src="{{ asset($post->image_url) }}" alt=""></td>
                            <td>{{ $post->view }}</td>
                            <td class="p-1">
                                <div class="dropdown">
                                    <button class="btn border dropdown-toggle" type="button" id="dropdownMenuButton"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        @if ($post->is_check)
                                            <i class="fas fa-check text-success"></i>
                                        @else
                                            <i class="fas fa-times text-danger pr-1"></i>
                                        @endif
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        @if (!$post->is_check)
                                            <a class="dropdown-item"
                                                href="{{ route('admin.posts.is_check', ['post' => $post, 'is_check' => 1]) }}"><i
                                                    class="fas fa-check text-success"></i></a>
                                        @else
                                            <a class="dropdown-item"
                                                href="{{ route('admin.posts.is_check', ['post' => $post, 'is_check' => 0]) }}"><i
                                                    class="fas fa-times text-danger"></i></a>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td class="p-1">
                                <div class="dropdown">
                                    <button class="btn border dropdown-toggle" type="button" id="dropdownMenuButton"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        @if ($post->is_active)
                                            <i class="fas fa-check text-success"></i>
                                        @else
                                            <i class="fas fa-times text-danger pr-1"></i>
                                        @endif
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        @if (!$post->is_active)
                                            <a class="dropdown-item"
                                                href="{{ route('admin.posts.is_active', ['post' => $post, 'is_active' => 1]) }}"><i
                                                    class="fas fa-check text-success"></i></a>
                                        @else
                                            <a class="dropdown-item"
                                                href="{{ route('admin.posts.is_active', ['post' => $post, 'is_active' => 0]) }}"><i
                                                    class="fas fa-times text-danger"></i></a>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td class="d-flex align-items-center p-1">
                                <a class="btn" href="{{ route('admin.posts.edit', $post) }}"><i
                                        class="fas fa-edit text-warning"></i></a>
                                |
                                <form id="form" action="{{ route('admin.posts.destroy', $post) }}" method="POST">
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