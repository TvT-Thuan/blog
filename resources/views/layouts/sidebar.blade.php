<div class="col-md-3">
    <!-- ======= Sidebar ======= -->
    <div class="aside-block">
        <ul class="nav nav-pills custom-tab-nav mb-4" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="pills-popular-tab" data-bs-toggle="pill"
                    data-bs-target="#pills-popular" type="button" role="tab" aria-controls="pills-popular"
                    aria-selected="true">Phổ biến</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-trending-tab" data-bs-toggle="pill" data-bs-target="#pills-trending"
                    type="button" role="tab" aria-controls="pills-trending" aria-selected="false">Hót</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-latest-tab" data-bs-toggle="pill" data-bs-target="#pills-latest"
                    type="button" role="tab" aria-controls="pills-latest" aria-selected="false">Mới nhất</button>
            </li>
        </ul>

        <div class="tab-content" id="pills-tabContent">

            <!-- Popular -->
            <div class="tab-pane fade show active" id="pills-popular" role="tabpanel"
                aria-labelledby="pills-popular-tab">
                @foreach ($posts_popular as $post)
                    <div class="post-entry-1 border-bottom">
                        <div class="post-meta">
                            <span class="date">{{ $post->category->name }}</span>
                            <span class="mx-1">&bullet;</span>
                            <span>{{ $post->format_date }}</span>
                        </div>
                        <h2 class="mb-2"><a href="{{ route('show.posts', $post->slug) }}">{{ $post->title }}</a></h2>
                        <span class="author mb-3 d-block">{{ $post->user->name }}</span>
                    </div>
                @endforeach
            </div> <!-- End Popular -->

            <!-- Trending -->
            <div class="tab-pane fade" id="pills-trending" role="tabpanel" aria-labelledby="pills-trending-tab">
                @foreach ($posts_trending as $post)
                    <div class="post-entry-1 border-bottom">
                        <div class="post-meta">
                            <span class="date">{{ $post->category->name }}</span>
                            <span class="mx-1">&bullet;</span>
                            <span>{{ $post->format_date }}</span>
                        </div>
                        <h2 class="mb-2"><a href="{{ route('show.posts', $post->slug) }}">{{ $post->title }}</a></h2>
                        <span class="author mb-3 d-block">{{ $post->user->name }}</span>
                    </div>
                @endforeach
            </div> <!-- End Trending -->

            <!-- Latest -->
            <div class="tab-pane fade" id="pills-latest" role="tabpanel" aria-labelledby="pills-latest-tab">
                @foreach ($posts_latest as $post)
                    <div class="post-entry-1 border-bottom">
                        <div class="post-meta">
                            <span class="date">{{ $post->category->name }}</span>
                            <span class="mx-1">&bullet;</span>
                            <span>{{ $post->format_date }}</span>
                        </div>
                        <h2 class="mb-2"><a href="{{ route('show.posts', $post->slug) }}">{{ $post->title }}</a>
                        </h2>
                        <span class="author mb-3 d-block">{{ $post->user->name }}</span>
                    </div>
                @endforeach

            </div> <!-- End Latest -->

        </div>
    </div>
</div>
