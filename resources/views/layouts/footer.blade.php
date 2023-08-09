  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">

      <div class="footer-content">
          <div class="container">

              <div class="row g-5">
                  <div class="col-lg-4">
                      <h3 class="footer-heading">Về trang Blog</h3>
                      <p>Đây là trang được tạo bởi framework của php Laravel</p>
                      <p><a href="{{ route('about') }}" class="footer-link-more">Xem thêm</a></p>
                  </div>
                  <div class="col-6 col-lg-2">
                      <h3 class="footer-heading">Thanh điều hướng</h3>
                      <ul class="footer-links list-unstyled">
                          <li><a href="{{ route('home') }}">Trang chủ</a></li>
                          <li><a href="#">Danh mục</a></li>
                          <li><a href="{{ route('about') }}">Giới thiệu</a></li>
                          <li><a href="{{ route('contact') }}">Liên hệ</a></li>
                      </ul>
                  </div>
                  <div class="col-6 col-lg-2">
                      <h3 class="footer-heading">Danh mục</h3>
                      <ul class="footer-links list-unstyled">
                          @foreach ($categories as $category)
                              <li>
                                  <a href="{{ route('show.categories', $category->slug) }}">{{ $category->name }}</a>
                              </li>
                          @endforeach
                      </ul>
                  </div>

                  <div class="col-lg-4">
                      <h3 class="footer-heading">Bài viết gần đây</h3>

                      <ul class="footer-links footer-blog-entry list-unstyled">
                          @foreach ($posts_latest as $post)
                              <li>
                                  <a href="{{ route('show.posts', $post->slug) }}" class="d-flex align-items-center">
                                      <img src="{{ asset($post->image_url) }}" alt="" class="img-fluid me-3">
                                      <div>
                                          <div class="post-meta d-block"><span
                                                  class="date">{{ $post->category->name }}</span> <span
                                                  class="mx-1">&bullet;</span> <span>{{ $post->format_date }}</span>
                                          </div>
                                          <span>{{ $post->title }}</span>
                                      </div>
                                  </a>
                              </li>
                          @endforeach
                      </ul>

                  </div>
              </div>
          </div>
      </div>

      <div class="footer-legal">
          <div class="container">

              <div class="row justify-content-between">
                  <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                      <div class="copyright">
                          Trường Cao Đẳng Công Nghệ Cao Hà Nội
                      </div>

                      <div class="credits">
                          Web k12
                      </div>

                  </div>

                  <div class="col-md-6">
                      <div class="social-links mb-3 mb-lg-0 text-center text-md-end">
                          {{-- <a href="#" class="twitter"><i class="bi bi-twitter"></i></a> --}}
                          <a href="https://www.facebook.com/tvt241" class="facebook"><i class="bi bi-facebook"></i></a>
                          <a href="mailto:tvt.thuan241@gmail.com" class="facebook"><i
                                  class="bi bi-envelope-at-fill"></i></i></a>
                          {{-- <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                          <a href="#" class="google-plus"><i class="bi bi-skype"></i></a>
                          <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a> --}}
                      </div>

                  </div>

              </div>

          </div>
      </div>

  </footer>

  <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i
          class="bi bi-arrow-up-short"></i></a>

  <script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/aos/aos.js') }}"></script>
  <script src="{{ asset('assets/plugins/toastr/toastr.min.js') }}"></script>

  <script src="{{ asset('js/app.js') }}"></script>

  <script src="{{ asset('assets/js/main.js') }}"></script>
  @auth
      <script>
          window.Echo.private('notification.{{ auth()->id() }}').listen("PostChangeActive", (e) => {
              if (e.status == 1) {
                  toastr.success(e.notification.content);
              }
              if (e.status == 0) {
                  toastr.error(e.notification.content);
              }
              if (e.status == 2) {
                  toastr.info(e.notification.content);
              }
          });
      </script>
  @endauth
  {{-- <script>
      window.Echo.channel('channel_test').listen("TestEvent", (e) => {
          console.log(e);
      });
  </script> --}}

  @stack('js')
  </body>

  </html>
