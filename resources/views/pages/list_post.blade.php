@extends('layouts.main')
@section('content')
    <main id="main">

        <!-- ======= Search Results ======= -->
        <section id="search-result" class="search-result">
            <div class="container">
                <div class="row">
                    <div class="col-md-9">
                        @if (isset($category))
                            <h3 class="category-title">{{ $category->name }}</h3>
                            @foreach ($category->postsPagination() as $post)
                                <div class="d-md-flex post-entry-2 small-img">
                                    <a href="{{ route('show.posts', $post->slug) }}" class="me-4 thumbnail">
                                        <img class="img-fluid" src="{{ asset($post->image_url) }}" alt=""
                                            style="object-fit: cover">
                                    </a>
                                    <div>
                                        <div class="post-meta">
                                            <span class="date">{{ $category->name }}</span>
                                            <span class="mx-1">&bullet;</span>
                                            <span>{{ $post->view }} view - {{ $post->format_date }} </span>
                                        </div>
                                        <h3>
                                            <a href="{{ route('show.posts', $post->slug) }}">{{ $post->title }}
                                            </a>
                                        </h3>
                                        <p>{{ $post->content_limit2 }}</p>
                                        <div class="d-flex align-items-center author">
                                            <div class="photo">
                                                <img src="{{ asset($post->user->image_url) }}" alt="" height="40px"
                                                    style="object-fit: cover">
                                            </div>
                                            <div class="name">
                                                <h3 class="m-0 p-0">{{ $post->user->name }}</h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            {{ $category->postsPagination()->links('vendor.pagination.custom') }}
                        @else
                            Chưa có bài viết nào của danh mục này
                        @endif



                    </div>

                    @include('layouts.sidebar')
                </div>
            </div>
        </section> <!-- End Search Result -->

    </main><!-- End #main -->
@endsection
