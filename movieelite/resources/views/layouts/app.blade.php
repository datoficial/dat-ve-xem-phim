<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Quản lý đặt vé xem phim</title>

  <link rel="stylesheet" href="{{ asset('public/backend/vendors/mdi/css/materialdesignicons.min.css')}}">
  <link rel="stylesheet" href="{{ asset('public/backend/vendors/css/vendor.bundle.base.css')}}">

  <link rel="stylesheet" href="{{ asset('public/backend/css/style.css')}}">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  @yield('style')
  <!-- endinject -->


</head>


<body>
  <div class="container-scroller d-flex">
    <!-- partial:./partials/_sidebar.html -->
    <nav class="sidebar sidebar-offcanvas" id="sidebar">
      <ul class="nav">

        <li class="nav-item">
          <a class="nav-link" href="{{ route('frontend.home')}}">
            <i class="mdi mdi-view-quilt menu-icon"></i>
            <span class="menu-title">Trang chủ</span>
          </a>
        </li>
        
        <li class="nav-item sidebar-category">
          <p>Chức năng quản lý</p>
          <span></span>
        </li>
        @guest
        @else
        <li class="nav-item">
          <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
            <i class="mdi mdi-palette menu-icon"></i>
            <span class="menu-title">Quản lý xem phim</span>
            <i class="menu-arrow"></i>
          </a>
          <div class="collapse" id="ui-basic">
            <ul class="nav flex-column sub-menu">
              <li class="nav-item"> <a class="nav-link" href="{{ route('admin.phim')}}">Phim</a></li>
              <li class="nav-item"> <a class="nav-link" href="{{ route('admin.theloaiphim')}}">Thể loại phim</a></li>
			  <li class="nav-item"> <a class="nav-link" href="{{ route('admin.rapchieu')}}">Rạp chiếu</a></li>
			  <li class="nav-item"> <a class="nav-link" href="{{ route('admin.phongchieu')}}">Phòng chiếu</a></li>
			  <li class="nav-item"> <a class="nav-link" href="{{ route('admin.suatchieu')}}">Suất chiếu</a></li>
			  <li class="nav-item"> <a class="nav-link" href="{{ route('admin.nguoidung')}}">Người dùng</a></li>
			  <li class="nav-item"> <a class="nav-link" href="{{ route('nhanvien.ve')}}">Vé</a></li>
            </ul>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-toggle="collapse" href="#news" aria-expanded="false" aria-controls="news">
            <i class="mdi mdi-palette menu-icon"></i>
            <span class="menu-title">Quản lý tin tức</span>
            <i class="menu-arrow"></i>
          </a>
          <div class="collapse" id="news">
            <ul class="nav flex-column sub-menu">
              <li class="nav-item"> <a class="nav-link" href="{{ route('nhanvien.chude')}}">Chủ đề</a></li>
              <li class="nav-item"> <a class="nav-link" href="{{ route('nhanvien.baiviet')}}">Bài viết</a></li>
			        <li class="nav-item"> <a class="nav-link" href="{{ route('nhanvien.binhluan')}}">Bình luận</a></li>
            </ul>
          </div>
        </li>
        @endguest
        @guest
        <li class="nav-item">
          <a class="nav-link" data-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
            <i class="mdi mdi-account menu-icon"></i>
            <span class="menu-title">Tài khoản</span>
            <i class="menu-arrow"></i>
          </a>
          <div class="collapse" id="auth">
            <ul class="nav flex-column sub-menu">
            
            @if (Route::has('login'))
              <li class="nav-item"> <a class="nav-link" href="{{ route('login')}}"> Đăng nhập </a></li>
              @endif
            @if (Route::has('register'))
              <li class="nav-item"> <a class="nav-link" href="{{ route('register')}}"> Đăng ký </a></li>
            @endif            
            
            </ul>
          </div>
        </li>
        @endguest
      </ul>
    </nav>
	
	
	
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:./partials/_navbar.html -->
      <nav class="navbar col-lg-12 col-12 px-0 py-0 py-lg-4 d-flex flex-row">
        <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
          <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="mdi mdi-menu"></span>
          </button>
          <div class="navbar-brand-wrapper">
            <a class="navbar-brand brand-logo" href="{{ route('frontend.home')}}"><img src="{{ asset('public/assets/images/icon.png')}}" alt="logo"/></a>
            <a class="navbar-brand brand-logo-mini" href="{{ route('frontend.home')}}"><img src="{{ asset('public/assets/images/icon.png')}}" alt="logo"/></a>
          </div>
		  @guest
		  <h4 class="font-weight-bold mb-0 d-none d-md-block mt-1">Xin chào</h4>
          <ul class="navbar-nav navbar-nav-right">
          </ul>
		  @else
          <h4 class="font-weight-bold mb-0 d-none d-md-block mt-1">Chào mừng trở lại,  {{ Auth::user()->name }}</h4>
      <ul class="navbar-nav navbar-nav-right">
			<div class="navbar-menu-wrapper navbar-search-wrapper d-none d-lg-flex align-items-center">
			<ul class="navbar-nav navbar-nav-right">
            <li class="nav-item nav-profile dropdown">
              <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
                <img src="{{ asset('public/assets/images/avatar.jpg')}}" alt="profile"/>
                <span class="nav-profile-name">{{ Auth::user()->name }}</span>
              </a>
              <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                    <a class="dropdown-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                            <i class="mdi mdi-logout text-primary"></i> Đăng xuất
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
              </div>
            </li>
          </ul>
          @endguest
        </div>
      </nav>
      <!-- partial -->
     
      <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
		<main>
            @yield('content')
        </main>
</div>
</div>
</div>
</div>
		

        <footer class="footer">
          <div class="card">
            <div class="card-body">
              <div class="d-sm-flex justify-content-center justify-content-sm-between">
                <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © MovieElite</span>
              </div>
            </div>
          </div>
        </footer>

      </div>

    </div>

  </div>



  <script src="{{ asset('public/backend/vendors/js/vendor.bundle.base.js')}}"></script>

  <script src="{{ asset('public/backend/vendors/chart.js/Chart.min.js')}}"></script>

  <script src="{{ asset('public/backend/js/off-canvas.js')}}"></script>
  <script src="{{ asset('public/backend/js/hoverable-collapse.js')}}"></script>
  <script src="{{ asset('public/backend/js/template.js')}}"></script>

  <script src="{{ asset('public/backend/js/dashboard.js')}}"></script>
  @yield('javascript')
</body>

</html>