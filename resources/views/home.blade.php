@extends('layouts.main')
@section('content')
    <main id="main">
        @include('layouts.silder')
        <!-- ======= Culture Category Section ======= -->
        <section class="category-section">
            <div class="container" data-aos="fade-up">
                <div class="row">
                    <div class="col-md-9">
                        @foreach ($posts as $post)
                            <div class="d-lg-flex post-entry-2 mb-5">
                                <a href="{{ route('show.posts', $post->slug) }}"
                                    class="me-4 thumbnail mb-4 mb-lg-0 d-inline-block">
                                    <img src="{{ $post->image_url }}" alt="" style="object-fit: cover" class="img-fluid"/>
                                </a>
                                <div>
                                    <div class="post-meta">
                                        <span class="date">{{ $post->category->name }}</span>
                                        <span class="mx-1">&bullet;</span> <span>{{ $post->format_date }}</span>
                                    </div>
                                    <h3>
                                        <a href="{{ route('show.posts', $post->slug) }}">{{ $post->title }}</a>
                                    </h3>
                                    {{ $post->content_limit }}
                                    <div class="d-flex align-items-center author">
                                        <div class="photo">
                                            <img src="{{ asset($post->user->image_url) }}" alt=""
                                                class="img-fluid" />
                                        </div>
                                        <div class="name">
                                            <h3 class="m-0 p-0">{{ $post->user->name }}</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        {{ $posts->links('vendor.pagination.custom') }}

                    </div>

                    <div class="col-md-3">
                        @foreach ($posts_latest as $post)
                            <div class="post-entry-1 border-bottom">
                                <div class="post-meta">
                                    <span class="date">{{ $post->category->name }}</span>
                                    <span class="mx-1">&bullet;</span> <span>{{ $post->format_date }}</span>
                                </div>
                                <h2 class="mb-2">
                                    <a href="{{ route('show.posts', $post->slug) }}">{{ $post->title }}</a>
                                </h2>
                                <span class="author mb-2 d-block">{{ $post->user->name }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
        <!-- End Culture Category Section -->

    </main><!-- End #main -->
@endsection
