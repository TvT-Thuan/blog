<!-- ======= Hero Slider Section ======= -->
<section id="hero-slider" class="hero-slider">
    <div class="container-md" data-aos="fade-in">
        <div class="row">
            <div class="col-12">
                <div class="swiper sliderFeaturedPosts">
                    <div class="swiper-wrapper">
                        @forelse ($posts_hilight as $post)
                            <div class="swiper-slide">
                                <a href="{{ route('show.posts', $post->slug) }}" class="img-bg d-flex align-items-end"
                                    style="background-image: url({{ asset($post->image_url) }});">
                                    <div class="img-bg-inner">
                                        <h2>{{ $post->title }}</h2>
                                        <p class="text-white">{{ $post->content_limit }}</p>
                                    </div>
                                </a>
                            </div>
                        @empty
                            <div class="swiper-slide">
                                <a href="#" class="img-bg d-flex align-items-end"
                                    style="background-image: url('assets/img/logo_login.jpg'); ">
                                    <div class="img-bg-inner">
                                        <h2>
                                            Cập nhật tin tức nhanh và chính xác nhất
                                        </h2>
                                    </div>
                                </a>
                            </div>

                            <div class="swiper-slide">
                                <a href="#" class="img-bg d-flex align-items-end"
                                    style="background-image: url('assets/img/logo_login.jpg');">
                                    <div class="img-bg-inner">
                                        <h2>
                                            Nơi chia sẻ những kiến thức bổ ích
                                        </h2>
                                    </div>
                                </a>
                            </div>
                        @endforelse
                    </div>
                    <div class="custom-swiper-button-next">
                        <span class="bi-chevron-right"></span>
                    </div>
                    <div class="custom-swiper-button-prev">
                        <span class="bi-chevron-left"></span>
                    </div>

                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </div>
    </div>
</section><!-- End Hero Slider Section -->
