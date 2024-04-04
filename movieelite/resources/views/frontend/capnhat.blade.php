@extends('layouts.frontend')
@section('title', '404 NOT Fourch')
@section('content')
	<main class="page-wrapper">
		<div class="container py-5 mb-lg-3">
			<div class="row justify-content-center pt-lg-4 text-center">
				<div class="col-lg-5 col-md-7 col-sm-9">
				<img src="{{ asset('public/web-maintenance.webp') }}" />
					<p class="fs-md mb-4">
						<u>Dưới đây là một số liên kết gợi ý:</u>
					</p>
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-xl-8 col-lg-10">
					<div class="row">
						<div class="col-md-4 mb-3">
							<a class="card h-100 border-0 shadow-sm" href="{{ route('frontend.home')}}">
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
							<a class="card h-100 border-0 shadow-sm" href="javascript:void(0)">
								<div class="card-body">
									<div class="d-flex align-items-center">
										<div class="ps-3">
											<h5 class="fs-sm mb-0">Tìm kiếm</h5>
											<span class="text-muted fs-ms">Tìm trong cửa hàng</span>
										</div>
									</div>
								</div>
							</a>
						</div>
						<div class="col-md-4 mb-3">
							<a class="card h-100 border-0 shadow-sm" href="javascript:void(0)">
								<div class="card-body">
									<div class="d-flex align-items-center">
										<div class="ps-3">
											<h5 class="fs-sm mb-0">Tin tức</h5>
											<span class="text-muted fs-ms">Truy cập trang tin phim</span>
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