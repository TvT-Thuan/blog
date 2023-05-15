@extends('layouts.main')
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
                                            {{ $comment->content }}
                                        </div>

                                        {{-- <div class="comment-replies bg-light p-3 mt-3 rounded">
                                            <h6 class="comment-replies-title mb-4 text-muted text-uppercase">2 replies</h6>

                                            <div class="reply d-flex mb-4">
                                                <div class="flex-shrink-0">
                                                    <div class="avatar avatar-sm rounded-circle">
                                                        <img class="avatar-img" src="assets/img/person-4.jpg" alt=""
                                                            class="img-fluid">
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1 ms-2 ms-sm-3">
                                                    <div class="reply-meta d-flex align-items-baseline">
                                                        <h6 class="mb-0 me-2">Brandon Smith</h6>
                                                        <span class="text-muted">2d</span>
                                                    </div>
                                                    <div class="reply-body">
                                                        Lorem ipsum dolor sit, amet consectetur adipisicing elit.
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="reply d-flex">
                                                <div class="flex-shrink-0">
                                                    <div class="avatar avatar-sm rounded-circle">
                                                        <img class="avatar-img" src="assets/img/person-3.jpg" alt=""
                                                            class="img-fluid">
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1 ms-2 ms-sm-3">
                                                    <div class="reply-meta d-flex align-items-baseline">
                                                        <h6 class="mb-0 me-2">James Parsons</h6>
                                                        <span class="text-muted">1d</span>
                                                    </div>
                                                    <div class="reply-body">
                                                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Distinctio
                                                        dolore sed eos sapiente, praesentium.
                                                    </div>
                                                </div>
                                            </div>
                                        </div> --}}
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
                                    <form action="{{ route('comment.posts', $post->slug) }}" method="POST">
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
