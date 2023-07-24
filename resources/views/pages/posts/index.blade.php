@extends('layouts.main')
@push('css')
    <style>
        .text-transform-none {
            text-transform: none;
            font-family: var(--font-primary);
        }
    </style>
@endpush
@section('content')
    <main id="main">
        <section id="search-result" class="search-result">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <button class="btn btn-dark my-2"><a class="text-white" href="{{ route('my-posts.create') }}">Thêm bài
                                viết</a></button>
                        <br>
                        <h3>Bài viết chưa được duyệt</h3>
                        @forelse ($posts_not_active as $post)
                            <div class="d-md-flex post-entry-2 small-img">
                                <a href="{{ route('show.posts', $post->slug) }}" class="me-4 thumbnail">
                                    <img width="400px" height="200px" src="{{ asset($post->image_url) }}" alt=""
                                        style="object-fit: cover">
                                </a>
                                <div>
                                    <div class="post-meta">
                                        <span class="date">{{ $post->category->name }}</span>
                                        <span class="mx-1">&bullet;</span>
                                        <span>{{ $post->view }} view - {{ $post->format_date }} </span>
                                        <span class="btn-group float-end">
                                            <button type="button" class="border border-0 bg-white"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="bi bi-three-dots fs-5"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <a class="dropdown-item text-transform-none"
                                                        href="{{ route('my-posts.edit', $post->slug) }}">Chỉnh sửa bài
                                                        viết</a>
                                                </li>
                                                <li>
                                                    <form action="{{ route('my-posts.destroy', $post->slug) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button
                                                            class="border border-0 bg-white w-100 text-start dropdown-item text-transform-none">Xoá
                                                            bài viết
                                                        </button>
                                                    </form>
                                                </li>
                                            </ul>
                                        </span>
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
                        @empty
                           Không có bài viết nào đang phải chờ duyệt
                        @endforelse

                        {{ $posts_not_active->links('vendor.pagination.custom') }}

                        <h3 class="pt-5">Bài viết đã được duyệt</h3>
                        @forelse ($posts as $post)
                            <div class="d-md-flex post-entry-2 small-img">
                                <a href="{{ route('show.posts', $post->slug) }}" class="me-4 thumbnail">
                                    <img width="400px" height="200px" src="{{ asset($post->image_url) }}" alt=""
                                        style="object-fit: cover">
                                </a>
                                <div>
                                    <div class="post-meta">
                                        <span class="date">{{ $post->category->name }}</span>
                                        <span class="mx-1">&bullet;</span>
                                        <span>{{ $post->view }} view - {{ $post->format_date }} </span>
                                        <span class="btn-group float-end">
                                            <button type="button" class="border border-0 bg-white"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="bi bi-three-dots fs-5"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <a class="dropdown-item text-transform-none"
                                                        href="{{ route('my-posts.edit', $post->slug) }}">Chỉnh sửa bài
                                                        viết</a>
                                                </li>
                                                <li>
                                                    <form action="{{ route('my-posts.destroy', $post->slug) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button
                                                            class="border border-0 bg-white w-100 text-start dropdown-item text-transform-none">Xoá
                                                            bài viết
                                                        </button>
                                                    </form>
                                                </li>
                                            </ul>
                                        </span>
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
                        @empty
                            Bạn chưa có bài viết nào
                        @endforelse

                        {{ $posts->links('vendor.pagination.custom') }}

                    </div>
                </div>
            </div>
        </section> <!-- End Search Result -->

    </main><!-- End #main -->
@endsection
