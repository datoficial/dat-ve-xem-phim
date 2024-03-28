<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <link rel="stylesheet" href="{{ asset('public/vendor/font-awesome/css/all.min.css') }}" />
    @yield('css')
    <link rel="stylesheet" href="{{ asset('public/css/site.css') }}" />
</head>
<body>
    <div id="app" class="container">
        <nav class="navbar navbar-expand-md navbar-light bg-info shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ route('home') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        
                        <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-bar-chart"></i> Quản lý web 
                                </a>
                            <ul class="dropdown-menu">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('theloaiphim') }}"><i class="bi bi-tags"></i> Thể loại phim</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('phim') }}"><i class="bi bi-film"></i> Phim</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('rapchieu') }}"><i class="bi bi-house-door"></i> Rạp chiếu</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('phongchieu') }}"><i class="bi bi-display"></i> Phòng chiếu</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('suatchieu') }}"><i class="bi bi-calendar"></i> Suất chiếu</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('ve') }}"><i class="bi bi-ticket"></i> Vé</a>
                            </li>                            
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('chitietve') }}"><i class="bi bi-card-checklist"></i>Chi tiết Vé</a>
                            </li>
</ul>
</li>
                    
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-pencil"></i> Quản lý bài viết
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item" href="{{ route('chude') }}">
                                    <i class="bi bi-bookmarks"></i> Chủ đề
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('baiviet') }}">
                                        <i class="bi bi-file-text"></i> Bài viết
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('binhluan') }}">
                                        <i class="bi bi-chat"></i> Bình luận bài viết
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('nguoidung') }}"><i class="bi bi-person"></i> Người dùng</a>
                        </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}"><i class="bi bi-box-arrow-in-right"></i> Đăng nhập</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}"><i class="bi bi-person-plus"></i> Đăng ký</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <i class="bi bi-box-arrow-right"></i> Đăng xuất
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
        <footer>Bản quyền &copy; {{ date('Y') }} bởi {{ config('app.name', 'Laravel') }}.</footer>
    </div>
    <!-- Scripts -->
    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    @yield('javascript')
</body>
</html>
