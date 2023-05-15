<nav id="navbar" class="navbar">
    <ul>
        <li><a href="{{ route('home') }}">Trang chủ</a></li>
        {{-- <li><a href="single-post.html">Single Post</a></li> --}}
        <li class="dropdown">
            <a href="#">
                <span>Danh mục</span>
                <i class="bi bi-chevron-down dropdown-indicator"></i>
            </a>
            <ul>
                @foreach ($categories as $category)
                    <li><a href="{{ route('show.categories', $category->slug) }}">{{ $category->name }}</a></li>
                @endforeach
            </ul>
        </li>

        <li><a href="{{ route('about') }}">Giới thiệu</a></li>
        <li><a href="{{ route('contact') }}">Liên hệ</a></li>

        @auth
            <li class="dropdown">
                <a href="#">
                    <span>Chức năng</span>
                    <i class="bi bi-chevron-down dropdown-indicator"></i>
                </a>
                <ul>
                    @if (Auth::user()->role == 2)
                        <li><a target="_blank" href="{{ route("admin.dashboard") }}">Trang quản trị</a></li>
                    @endif
                    <li><a href="{{ route("my-posts.index") }}">Bài viết của tôi</a></li>
                    <li><a href="{{ route('auth.profile') }}">Thông tin</a></li>
                    <li><a href="{{ route('auth.edit_password.profile') }}">Đổi mật khẩu</a></li>
                </ul>
            </li>
        @endauth
    </ul>
</nav><!-- .navbar -->
