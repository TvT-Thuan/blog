@extends('layouts.main')
@push('css')
    <style>
        .btn-outline-primary{
            color: black !important;
            border: 1px solid black !important;
        }
        .btn-outline-primary:hover{
            color: white !important;
            border: 1px solid black !important;
            background-color: black;
        }
    </style>
@endpush
@section('content')
    <main id="main">

        <section class="single-post-content">
            <div class="container">
                <div class="row">
                    <div class="col-md-9 post-content" data-aos="fade-up">

                        <!-- ======= Single Post Content ======= -->
                        <div class="single-post">
                            <div class="post-meta"><span class="date">{{ $post->category->name }}</span> <span
                                    class="mx-1">&bullet;</span>
                                <span>{{ $post->view }} view - {{ $post->format_date }}</span>
                            </div>
                            <h1 class="mb-5">{{ $post->title }}
                                {!! $post->content !!}
                        </div><!-- End Single Post Content -->

                        <!-- ======= Comments ======= -->
                        <div class="comments">
                            <h5 class="comment-title py-4">{{ $post->comments->count() }} Comments</h5>
                            @forelse ($post->comments as $comment)
                                <div class="comment d-flex mb-4">
                                    <div class="flex-shrink-0">
                                        <div class="avatar avatar-sm rounded-circle">
                                            <img class="avatar-img" src="{{ asset($comment->user->image_url) }}"
                                                alt="" class="img-fluid">
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 ms-2 ms-sm-3">
                                        <div class="comment-meta d-flex align-items-baseline">
                                            <h6 class="me-2">{{ $comment->user->name }}</h6>
                                            <span class="text-muted"> {{ $comment->format_date }}</span>
                                        </div>
                                        <div class="comment-body">
                                            <p data-id="{{ $comment->id }}" class="content_comment">{{ $comment->content }}
                                            </p>
                                            @auth
                                                @if ($comment->user_id == auth()->user()->id || auth()->user()->role == 1)
                                                    <div class="option_comment d-flex justify-content-end">
                                                        <a class="me-2 btn btn-sm btn-outline-primary"
                                                            onclick="showFormEdit(event, {{ $comment->id }})"
                                                            href="#">Chỉnh sửa</a>
                                                        <form
                                                            action="{{ route('comments.destroy', ['slug' => $post->slug, 'comment' => $comment->id]) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn btn-sm btn-outline-primary">Xoá</button>
                                                        </form>
                                                    </div>
                                                    <div class="row d-none form_edit" data-id="{{ $comment->id }}">
                                                        <form
                                                            action="{{ route('comments.update', ['slug' => $post->slug, 'comment' => $comment->id]) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="col-12 mb-3">
                                                                <textarea name="content" class="form-control @error('content') is-invalid @enderror" id="comment-message"
                                                                    placeholder="Nhập bình luận">{{ old('content', $comment->content) }}</textarea>
                                                                @error('content')
                                                                    <div class="invalid-feedback">
                                                                        <p class="m-0">{{ $message }}</p>
                                                                    </div>
                                                                @enderror
                                                                @include('layouts.alert')
                                                            </div>
                                                            <div class="col-12">
                                                                <button class="btn btn-primary">Cập nhật</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                @endif
                                            @endauth

                                        </div>
                                    </div>
                                </div>
                            @empty
                                Chưa có bình luận nào
                            @endforelse
                        </div><!-- End Comments -->

                        <!-- ======= Comments Form ======= -->
                        <div class="row justify-content-center mt-5">

                            <div class="col-lg-12">
                                <h5 class="comment-title">Để lại bình luận</h5>
                                <div class="row">
                                    <form action="{{ route('comments.store', $post->slug) }}" method="POST">
                                        @csrf
                                        <div class="col-12 mb-3">
                                            <textarea name="content" class="form-control @error('content') is-invalid @enderror" id="comment-message"
                                                placeholder="Nhập bình luận">{{ old('content') }}</textarea>
                                            @error('content')
                                                <div class="invalid-feedback">
                                                    <p class="m-0">{{ $message }}</p>
                                                </div>
                                            @enderror
                                            @include('layouts.alert')
                                        </div>
                                        <div class="col-12">
                                            <button class="btn btn-primary">Bình luận</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div><!-- End Comments Form -->

                    </div>
                    @include('layouts.sidebar')
                </div>
            </div>
        </section>
    </main><!-- End #main -->
@endsection
@push('js')
    <script src="{{ asset('assets/js/post_details/main.js') }}"></script>
@endpush
