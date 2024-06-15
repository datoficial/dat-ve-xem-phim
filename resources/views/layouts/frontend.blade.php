<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>

<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>MovieElite</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('public/assets/images/icon.png') }}" />
	<link rel="stylesheet" href="{{ asset('public/assets/css/style-starter.css') }}">
	<link href="//fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,600;0,700;1,600&display=swap"
		rel="stylesheet">
		
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
		@yield('style')

		<link rel="stylesheet" href="{{ asset('public/theme.min.css') }}" />
</head>

<body class="handheld-toolbar-enabled">
	<header id="site-header" class="w3l-header fixed-top">
		<!--/nav-->
		<nav class="navbar navbar-expand-lg navbar-light fill px-lg-0 py-0 px-3">
			<div class="container">
				<h1><a class="navbar-brand" href="{{ route('frontend.home') }}"><img src="{{ asset('public/assets/images/icon.png') }}"/>
						</a></h1>
				<!-- if logo is image enable this   
						<a class="navbar-brand" href="#{{ route('frontend.home') }}">
							<img src="image-path" alt="Your logo" title="Your logo" style="height:35px;" />
						</a> -->
				<button class="navbar-toggler collapsed" type="button" data-toggle="collapse"
					data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
					aria-label="Toggle navigation">
					<!-- <span class="navbar-toggler-icon"></span> -->
					<span class="fa icon-expand fa-bars"></span>
					<span class="fa icon-close fa-times"></span>
				</button>

				<div class="collapse navbar-collapse" id="navbarSupportedContent">
					<ul class="navbar-nav ml-auto">
						<li class="nav-item active">
							<a class="nav-link" href="{{ route('frontend.home') }}">Trang chủ</a>
						</li>
						<li class="nav-item dropdown">
							<a class="nav-link" data-bs-toggle="dropdown" data-bs-auto-close="outside">Rạp chiếu</a>
							<ul class="dropdown-menu">
								<li class="dropdown-item dropdown">
									<a class="nav-link" data-bs-toggle="dropdown" data-bs-auto-close="outside">An Giang</a>
									<ul class="dropdown-menu">
										<li><a class="dropdown-item" href="{{ route('frontend.phim.theorap', ['tenrap_slug' => 'galaxy-long-xuyen']) }}">Galaxy Long Xuyên</a></li>
										<li><a class="dropdown-item" href="{{ route('frontend.phim.theorap', ['tenrap_slug' => 'lotte-long-xuyen']) }}">Lotte Long Xuyên</a></li>
									</ul>
								</li>
								<li class="dropdown-item dropdown">
									<a class="nav-link " data-bs-toggle="dropdown" data-bs-auto-close="outside">Đồng Tháp</a>
									<ul class="dropdown-menu">
										<li><a class="dropdown-item" href="{{ route('frontend.phim.theorap', ['tenrap_slug' => 'cgv-vincom-cao-lanh']) }}">CGV Vincom Cao Lãnh</a></li>
									</ul>
								</li>
								<li class="dropdown-item dropdown">
									<a class="nav-link " data-bs-toggle="dropdown" data-bs-auto-close="outside">Cần Thơ</a>
									<ul class="dropdown-menu">
										<li><a class="dropdown-item" href="{{ route('frontend.phim.theorap', ['tenrap_slug' => 'lotte-cinema-ninh-kieu']) }}">Lotte Cinema Ninh Kiều</a></li>
									</ul>
								</li>
							</ul>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="{{ route('frontend.baiviet') }}">Tin phim</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="{{ route('frontend.lienhe') }}">Liên hệ</a>
						</li>
					</ul>
					<!--/search-right-->
					<!--/search-right-->
					<div class="search-right">
						<a href="#search" class="btn search-hny mr-lg-3 mt-lg-0 mt-4" title="search">Tìm kiếm <span
								class="fa fa-search ml-3" aria-hidden="true"></span></a>
						<!-- search popup -->
						<div id="search" class="pop-overlay">
							<div class="popup">
								<form action="{{route('frontend.timkiem')}}" method="get" class="search-box">
									<input type="search" placeholder="Nhập từ khóa" name="search"
										required="required" autofocus="">
									<button type="submit" class="btn"><span class="fa fa-search"
											aria-hidden="true"></span></button>
								</form>
							</div>
							<a class="close" href="#close">×</a>
						</div>
						<!-- /search popup -->
						<!--/search-right-->
					</div>


					@guest
					<div class="Login_SignUp" id="login"
						style="font-size: 2rem ; display: inline-block; position: relative;">
						<!-- <li class="nav-item"> -->
						<a class="nav-link" href="{{route('user.dangnhap')}}"><i class="fa fa-user-circle-o"></i></a>
						<!-- </li> -->
					</div>
					@else
					<div class="Login_SignUp" id="login"
						style="font-size: 2rem ; display: inline-block; position: relative;">
						<!-- <li class="nav-item"> -->
						<a class="nav-link" href="{{route('user.hosocanhan')}}"><p>Xin chào {{ Auth::user()->name }}</p> </a>
					</div>
					@endguest
				</div>

				<!-- toggle switch for light and dark theme -->
				<div class="mobile-position">
					<nav class="navigation">
						<div class="theme-switch-wrapper">
							<label class="theme-switch" for="checkbox">
								<input type="checkbox" id="checkbox">

							</label>
						</div>
					</nav>
				</div>
			</div>
		</nav>
	</header>

	<main>
		@yield('content')
	</main>

	<!-- footer-66 -->
		<footer class="w3l-footer">
			<section class="footer-inner-main">
				<div class="footer-hny-grids py-5">
					<div class="container py-lg-4">
						<div class="text-txt">
							<div class="right-side">
								<div class="row footer-about">
									<div class="col-md-3 col-6 footer-img mb-lg-0 mb-4">
										<a href="javascript:void(0)"><img class="img-fluid" src="{{ asset('public/assets/images/banner1.jpg') }}"
												alt=""></a>
									</div>
									<div class="col-md-3 col-6 footer-img mb-lg-0 mb-4">
										<a href="javascript:void(0)"><img class="img-fluid" src="{{ asset('public/assets/images/banner2.jpg') }}"
												alt=""></a>
									</div>
									<div class="col-md-3 col-6 footer-img mb-lg-0 mb-4">
										<a href="javascript:void(0)"><img class="img-fluid" src="{{ asset('public/assets/images/banner3.jpg') }}"
												alt=""></a>
									</div>
									<div class="col-md-3 col-6 footer-img mb-lg-0 mb-4">
										<a href="javascript:void(0)"><img class="img-fluid" src="{{ asset('public/assets/images/banner4.jpg') }}"
												alt=""></a>
									</div>
								</div>
								<div class="row footer-links">


									<div class="col-md-3 col-sm-6 sub-two-right mt-5">
										<h6>Phim</h6>
										<ul>
											<li><a href="javascript:void(0)">Phim</a></li>
											<li><a href="javascript:void(0)">Video</a></li>
											<li><a href="javascript:void(0)">Phim tiếng Anh</a></li>
											<li><a href="javascript:void(0)">Đoạt giải</a></li>
											<li><a href="javascript:void(0)">Phim sắp ra mắt</a></li>
											<li><a href="{{ route('frontend.lienhe') }}">Liên hệ</a></li>
										</ul>
									</div>
									<div class="col-md-3 col-sm-6 sub-two-right mt-5">
										<h6>Thông tin</h6>
										<ul>
											<li><a href="{{ route('frontend.home') }}">Trang chủ</a> </li>
											<li><a href="{{ route('frontend.lienhe') }}">Liên hệ</a> </li>
											<li><a href="javascript:void(0)">Phim truyền hình</a> </li>
											<li><a href="javascript:void(0)">Blog</a> </li>
											<li><a href="sign_in.html">Đăng nhập</a></li>
											<li><a href="Contact_Us.html">Liên hệ</a></li>
										</ul>
									</div>
									<div class="col-md-3 col-sm-6 sub-two-right mt-5">
										<h6>Địa điểm</h6>
										<ul>
											<li><a href="javascript:void(0)">An Giang</a></li>
											<li><a href="javascript:void(0)">Đồng Tháp</a></li>
											<li><a href="javascript:void(0)">Cần Thơ</a></li>
										</ul>
									</div>
									<div class="col-md-3 col-sm-6 sub-two-right mt-5">
										<h6>Thông báo</h6>
										<form action="#" class="subscribe mb-3" method="post">
											<input type="email" name="email" placeholder="Địa chỉ Email của bạn" required="">
											<button><span class="fa fa-envelope-o"></span></button>
										</form>
										<p>Nhập email của bạn và nhận tin tức, cập nhật và ưu đãi đặc biệt mới nhất từ chúng tôi.
										</p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				</div>
				<div class="below-section">
					<div class="container">
						<div class="copyright-footer">
							<div class="columns text-lg-left">
								<p>&copy; 2024 MovieElite. Bản quyền thuộc về Nguyễn Phát Đạt</p>
						</div>

							<ul class="social text-lg-right">
								<li><a href="#facebook"><span class="fa fa-facebook" aria-hidden="true"></span></a>
								</li>
								<li><a href="#linkedin"><span class="fa fa-linkedin" aria-hidden="true"></span></a>
								</li>
								<li><a href="#twitter"><span class="fa fa-twitter" aria-hidden="true"></span></a>
								</li>
								<li><a href="#google"><span class="fa fa-google-plus" aria-hidden="true"></span></a>
								</li>

							</ul>
						</div>
					</div>
				</div>
				<!-- move top -->
				<button onclick="topFunction()" id="movetop" title="Đi đến đầu trang">
					<span class="fa fa-arrow-up" aria-hidden="true"></span>
				</button>
	<script>
					// Khi người dùng cuộn xuống 20px từ đầu trang, hiển thị nút
					window.onscroll = function () {
						scrollFunction()
					};

					function scrollFunction() {
						if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
							document.getElementById("movetop").style.display = "block";
						} else {
							document.getElementById("movetop").style.display = "none";
						}
					}

					// Khi người dùng nhấp vào nút, cuộn lên đầu trang
					function topFunction() {
						document.body.scrollTop = 0;
						document.documentElement.scrollTop = 0;
					}
	</script>

			</section>
		</footer>


</body>
</html>
<!-- responsive tabs -->
<script src="{{ asset('public/assets/js/jquery-1.9.1.min.js') }}"></script>
<script src="{{ asset('public/assets/js/easyResponsiveTabs.js') }}"></script>
    

<script src="{{ asset('public/assets/js/bootstrap.min.js') }}"></script>
@yield('javascript')