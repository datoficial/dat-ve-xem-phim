<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<link rel="apple-touch-icon" sizes="76x76" href="{{ asset('public/backend/img/apple-icon.png')}}">
<link rel="icon" type="image/png" href="{{ asset('public/backend/img/favicon.png')}}">
<title>
   Quản lý đặt vé xem phim
</title>
<!--     Fonts and icons     -->
<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
<!-- Nucleo Icons -->
<link href="{{ asset('public/backend/css/nucleo-icons.css')}}" rel="stylesheet" />
<link href="{{ asset('public/backend/css/nucleo-svg.css')}}" rel="stylesheet" />
<!-- Font Awesome Icons -->
<script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
<!-- Material Icons -->
<link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
<!-- CSS Files -->
<link id="pagestyle" href="{{ asset('public/backend/css/material-dashboard.css?v=3.1.0')}}" rel="stylesheet" />
<!-- Nepcha Analytics (nepcha.com) -->
<!-- Nepcha is a easy-to-use web analytics. No cookies and fully compliant with GDPR, CCPA and PECR. -->
<script defer data-site="YOUR_DOMAIN_HERE" src="https://api.nepcha.com/js/nepcha-analytics.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<style>
    /* CSS áp dụng cho tất cả các thẻ input */
    input {
    border: 1px solid #C0C0C0 !important;
    border-radius: 5px !important;
    padding: 5px !important;
}

</style>
@yield('style')
</head>

 <body class="g-sidenav-show  bg-gray-100">
 
   <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark" id="sidenav-main">

  <div class="sidenav-header">
    <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
    <a class="navbar-brand m-0" href=" https://demos.creative-tim.com/material-dashboard/pages/dashboard " target="_blank">
      <img src="{{ asset('public\assets\images\icon.png')}}" class="navbar-brand-img h-100" alt="main_logo">
      <span class="ms-1 font-weight-bold text-white">Công cụ quản lý MovieElite</span>
    </a>
  </div>
  <hr class="horizontal light mt-0 mb-2">
  @guest
  <ul class="navbar-nav">
  <li class="nav-item mt-3">
			  <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Tài khoản</h6>
			</li>
		<li class="nav-item">
		  <a class="nav-link text-white " href="{{ route('login')}}">
			  <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
				<i class="material-icons opacity-10">login</i>
			  </div>
			<span class="nav-link-text ms-1">Đăng nhập</span>
		  </a>
		</li>
		<li class="nav-item">
		  <a class="nav-link text-white " href="{{ route('register')}}">
			  <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
				<i class="material-icons opacity-10">assignment</i>
			  </div>
			<span class="nav-link-text ms-1">Đăng ký</span>
		  </a>
		</li>
</ul>
  @else
  <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
    <ul class="navbar-nav">
		<li class="nav-item">
		  <a class="nav-link text-white " href="{{ route('admin.theloaiphim')}}">
			
			  <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
				<i class="material-icons opacity-10">dashboard</i>
			  </div>
			
			<span class="nav-link-text ms-1">Quản lý thể loại phim</span>
		  </a>
		</li>

		  
		<li class="nav-item">
		  <a class="nav-link text-white " href="{{ route('admin.phim')}}">
			
			  <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
				<i class="material-icons opacity-10">table_view</i>
			  </div>
			
			<span class="nav-link-text ms-1">Quản lý phim</span>
		  </a>
		</li>

		  
		<li class="nav-item">
		  <a class="nav-link text-white " href="{{ route('admin.rapchieu')}}">
			
			  <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
				<i class="material-icons opacity-10">receipt_long</i>
			  </div>
			
			<span class="nav-link-text ms-1">Quản lý rạp chiếu</span>
		  </a>
		</li>

		  
		<li class="nav-item">
		  <a class="nav-link text-white " href="{{ route('admin.phongchieu')}}">
			
			  <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
				<i class="material-icons opacity-10">view_in_ar</i>
			  </div>
			
			<span class="nav-link-text ms-1">Quản lý phòng chiếu</span>
		  </a>
		</li>

		  
		<li class="nav-item">
		  <a class="nav-link text-white " href="{{ route('admin.suatchieu')}}">
			
			  <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
				<i class="material-icons opacity-10">format_textdirection_r_to_l</i>
			  </div>
			
			<span class="nav-link-text ms-1">Quản lý suất chiếu</span>
		  </a>
		</li>

		  
		<li class="nav-item">
		  <a class="nav-link text-white " href="{{ route('admin.nguoidung')}}">
			
			  <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
        <i class="bi bi-person-fill"></i>
			  </div>
			
			<span class="nav-link-text ms-1">Quản lý người dùng</span>
		  </a>
		</li>
		<li class="nav-item">
		  <a class="nav-link text-white " href="{{ route('nhanvien.ve')}}">
			
			  <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
				<i class="bi bi-ticket-perforated"></i>
			  </div>
			
			<span class="nav-link-text ms-1">Quản lý vé</span>
		  </a>
		</li>
    <li class="nav-item mt-3">
			  <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Tin trên web</h6>
			</li>
    <li class="nav-item">
		  <a class="nav-link text-white " href="{{ route('nhanvien.chude')}}">
			
			  <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
				<i class="bi bi-bookmark"></i>
			  </div>
			
			<span class="nav-link-text ms-1">Quản lý chủ đề</span>
		  </a>
		</li>
    <li class="nav-item">
		  <a class="nav-link text-white " href="{{ route('nhanvien.baiviet')}}">
			
			  <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
				<i class="bi bi-newspaper"></i>
			  </div>
			
			<span class="nav-link-text ms-1">Quản lý bài viết</span>
		  </a>
		</li>
    <li class="nav-item">
		  <a class="nav-link text-white " href="{{ route('nhanvien.binhluan')}}">
			
			  <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
				<i class="bi bi-chat-left-dots"></i>
			  </div>
			
			<span class="nav-link-text ms-1">Quản lý bình luận</span>
		  </a>
		</li>
    </ul>
  </div>
  @endguest
</aside>

<main class="main-content border-radius-lg ">
        <!-- Navbar -->
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
  <div class="container-fluid py-1 px-3">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">MovieElite</a></li>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Admin</li>
      </ol>
      <h6 class="font-weight-bolder mb-0">Trang quản lý</h6>
    </nav>
    <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
      <div class="ms-md-auto pe-md-3 d-flex align-items-center">
      </div>
      <ul class="navbar-nav  justify-content-end">
      @guest
      <li class="nav-item d-flex align-items-center">
          <a class="btn btn-outline-primary btn-sm mb-0 me-3" target="_blank" href="javascript:void(0)">Xin chào</a>
        </li>
        @else
        <li class="nav-item px-3 d-flex align-items-center">
          <a href="javascript:;" class="nav-link text-body p-0">
            <i class="fa fa-cog fixed-plugin-button-nav cursor-pointer"></i>
          </a>
        </li>
        <li class="nav-item dropdown pe-2 d-flex align-items-center">
          <a href="javascript:;" class="nav-link text-body p-0" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
          <i class="bi bi-person-fill"></i>
          </a>

        <ul class="dropdown-menu  dropdown-menu-end  px-2 py-3 me-sm-n4" aria-labelledby="dropdownMenuButton">
        <li class="nav-item d-flex align-items-center">
        <a class="dropdown-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                            <i class="bi bi-box-arrow-right" style="margin-left:10px"></i> Đăng xuất
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
        </li>
      </ul>
        <li class="nav-item d-flex align-items-center">
          <a class="btn btn-outline-primary btn-sm mb-0 me-3" target="_blank" href="javascript:void(0)">Xin chào {{ Auth::user()->name }}</a>
        </li>
        <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
          <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
            <div class="sidenav-toggler-inner">
              <i class="sidenav-toggler-line"></i>
              <i class="sidenav-toggler-line"></i>
              <i class="sidenav-toggler-line"></i>
            </div>
          </a>
        </li>
      @endguest
    </div>
  </div>
</nav>

<!-- End Navbar -->

<div class="container-fluid py-4">
  <div class="row">
            @yield('content')
  </div>
</div>


<footer class="footer py-4  ">
  <div class="container-fluid">
    <div class="row align-items-center justify-content-lg-between">
      <div class="col-lg-6 mb-lg-0 mb-4">
        <div class="copyright text-center text-sm text-muted text-lg-start">
          © <script>
            document.write(new Date().getFullYear())
          </script>,
          MovieElite <i class="fa fa-heart"></i> bởi
          <a href="https://www.creative-tim.com" class="font-weight-bold" target="_blank">Nguyễn Phát Đạt</a>
          
        </div>
      </div>
    </div>
  </div>
</footer>
</div>

         
</main>
    
<div class="fixed-plugin">
    <a class="fixed-plugin-button text-dark position-fixed px-3 py-2">
      <i class="material-icons py-2">settings</i>
    </a>
    <div class="card shadow-lg">
      <div class="card-header pb-0 pt-3">
        <div class="float-start">
          <h5 class="mt-3 mb-0">Thiết lập giao diện</h5>
          <p>Xem các tùy chọn bảng điều khiển</p>
        </div>
        <div class="float-end mt-4">
          <button class="btn btn-link text-dark p-0 fixed-plugin-close-button">
            <i class="material-icons">clear</i>
          </button>
        </div>
        <!-- End Toggle Button -->
      </div>
      <hr class="horizontal dark my-1">
      <div class="card-body pt-sm-3 pt-0">
        <div class="mt-3">
          <h6 class="mb-0">Kiểu thanh bên</h6>
          <p class="text-sm"></p>
        </div>

        <div class="d-flex">
          <button class="btn bg-gradient-dark px-3 mb-2 active" data-class="bg-gradient-dark" onclick="sidebarType(this)">Tối</button>
          <button class="btn bg-gradient-dark px-3 mb-2 ms-2" data-class="bg-transparent" onclick="sidebarType(this)">Trong suốt</button>
          <button class="btn bg-gradient-dark px-3 mb-2 ms-2" data-class="bg-white" onclick="sidebarType(this)">Trắng</button>
        </div>
       
        <!-- Navbar Fixed -->
        
        <div class="mt-3 d-flex">
          <h6 class="mb-0">Navbar Fixed</h6>
          <div class="form-check form-switch ps-0 ms-auto my-auto">
            <input class="form-check-input mt-1 ms-auto" type="checkbox" id="navbarFixed" onclick="navbarFixed(this)">
          </div>
        </div>
        

        
        <hr class="horizontal dark my-3">
        <div class="mt-2 d-flex">
          <h6 class="mb-0">Light / Dark</h6>
          <div class="form-check form-switch ps-0 ms-auto my-auto">
            <input class="form-check-input mt-1 ms-auto" type="checkbox" id="dark-version" onclick="darkMode(this)">
          </div>
        </div>
        <hr class="horizontal dark my-sm-4">
 
      </div>
    </div>
</div>


<!--   Core JS Files   -->
<script src="{{ asset('public/backend/js/core/popper.min.js')}}" ></script>
<script src="{{ asset('public/backend/js/core/bootstrap.min.js')}}" ></script>
<script src="{{ asset('public/backend/js/plugins/perfect-scrollbar.min.js')}}" ></script>
<script src="{{ asset('public/backend/js/plugins/smooth-scrollbar.min.js')}}" ></script>



<script>
  var win = navigator.platform.indexOf('Win') > -1;
  if (win && document.querySelector('#sidenav-scrollbar')) {
    var options = {
      damping: '0.5'
    }
    Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
  }
</script>

<!-- Github buttons -->
<script async defer src="https://buttons.github.io/buttons.js"></script>
@yield('javascript')

<!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc --><script src="{{ asset('public/backend/js/material-dashboard.min.js?v=3.1.0')}}"></script>
  </body>

</html>
