@extends('layouts.frontend')
@section('title', '403 NOT Fourch')
@section('content')
	<main class="page-wrapper">
		
		<div class="container py-5 mb-lg-3">
			<div class="row justify-content-center pt-lg-4 text-center">
				<div class="col-lg-5 col-md-7 col-sm-9">
					<img width="800px" height="450px" src="{{ asset('public/assets/images/403.png') }}">
					<h2 class="h3 mb-4"></h2>
					<h2 class="h3 mb-4">Không được phép</h2>
					<h3 class="h5 fw-normal mb-4">Tài khoản không đủ quyền truy cập chức năng này.</h3>
					<p class="fs-md mb-4">
						<u>Dưới đây là một số liên kết gợi ý:</u>
					</p>
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-xl-8 col-lg-10">
					<div class="row">
						<div class="col-md-4 mb-3">
							<a class="card h-100 border-0 shadow-sm" href="{{ route('frontend.home') }}">
								<div class="card-body">
									<div class="d-flex align-items-center">
										<div class="ps-3">
											<h5 class="fs-sm mb-0">Trang chủ</h5>
											<span class="text-muted fs-ms">Quay lại trang chủ</span>
										</div>
									</div>
								</div>
							</a>
						</div>
						<div class="col-md-4 mb-3">
							<a class="card h-100 border-0 shadow-sm" href="{{route('frontend.baiviet')}}">
								<div class="card-body">
									<div class="d-flex align-items-center">
										<div class="ps-3">
											<h5 class="fs-sm mb-0">Tin tức & Trợ giúp</h5>
											<span class="text-muted fs-ms">Truy cập trang tin phim</span>
										</div>
									</div>
								</div>
							</a>
						</div>
						<div class="col-md-4 mb-3">
						<a class="card h-100 border-0 shadow-sm" href="{{route('frontend.lienhe')}}">
								<div class="card-body">
									<div class="d-flex align-items-center">
										<div class="ps-3">
											<h5 class="fs-sm mb-0">Liên hệ</h5>
											<span class="text-muted fs-ms">Truy cập trang liên hệ</span>
										</div>
									</div>
								</div>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</main>
@endsection
@section('styles')
    @parent 
    <link rel="stylesheet" media="screen" href="{{ asset('public/frontend/css/theme.css') }}" />
@endsection