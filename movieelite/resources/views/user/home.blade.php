@extends('layouts.frontend')
@section('title', 'Hồ sơ khách hàng')
@section('content')
<div class="page-title-overlap bg-dark pb-8">
			<div class="container d-lg-flex justify-content-between py-2 py-lg-3">
				<div class="order-lg-2 mb-3 mb-lg-0 pt-lg-2">
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb breadcrumb-light flex-lg-nowrap justify-content-center justify-content-lg-start">
							<li class="breadcrumb-item">
								<a class="text-nowrap" href="{{ route('frontend.home') }}">Trang chủ</a>
							</li>
							<li class="breadcrumb-item text-nowrap">
								<a href="{{ route('user.home') }}">Khách hàng</a>
							</li>
							<li class="breadcrumb-item text-nowrap active" aria-current="page">Hồ sơ</li>
						</ol>
					</nav>
				</div>
				<div class="order-lg-1 pe-lg-4 text-center text-lg-start">
					<h1 class="h3 text-light mb-0">Hồ sơ khách hàng</h1>
				</div>
			</div>
		</div>
		<div class="container pb-5 mb-2 mb-md-4">
			<div class="row">
				<aside class="col-lg-4 pt-4 pt-lg-0 pe-xl-5">
					<div class="bg-white rounded-3 shadow-lg pt-1 mb-5 mb-lg-0">
						<div class="d-md-flex justify-content-between align-items-center text-center text-md-start p-4">
							<div class="d-md-flex align-items-center">
								<div class="img-thumbnail rounded-circle position-relative flex-shrink-0 mx-auto mb-2 mx-md-0 mb-md-0" style="width:6.375rem;">
									<img class="rounded-circle" src="{{ asset('public/avatar1.jpg') }}" />
								</div>
								<div class="ps-md-3">
									<h3 class="fs-base mb-0">{{ $nguoidung->name }}</h3>
									<span class="text-accent fs-sm">{{ $nguoidung->email }}</span>
								</div>
							</div>
							<a class="btn btn-primary d-lg-none mb-2 mt-3 mt-md-0" href="#account-menu" data-bs-toggle="collapse" aria-expanded="false">
								Hồ sơ khách hàng
							</a>
						</div>
						<div class="d-lg-block collapse" id="account-menu">
							<div class="bg-secondary px-4 py-3">
								<h3 class="fs-sm mb-0 text-muted">Quản lý</h3>
							</div>
							<ul class="list-unstyled mb-0">
                                @if($nguoidung->Ve->count() > 0)
                                    <li class="border-bottom mb-0">
                                        <a class="nav-link-style d-flex align-items-center px-4 py-3" href="{{ route('user.ve',['id' => $nguoidung->id]) }}">      
                                        Vé của bạn<span class="fs-sm text-muted ms-auto">{{ $nguoidung->Ve->count() }}</span>
                                        </a>
                                    </li>
                                @else
                                    <li class="border-bottom mb-0">
                                    <a class="nav-link-style d-flex align-items-center px-4 py-3" href="{{ route('user.ve', ['id' => $nguoidung->id]) }}">
                                            Vé của bạn<span class="fs-sm text-muted ms-auto">0</span>
                                        </a>
                                    </li>
                                @endif
								<li class="border-bottom mb-0">
									<a class="nav-link-style d-flex align-items-center px-4 py-3" href="#">
										Phim yêu thích<span class="fs-sm text-muted ms-auto">0</span>
									</a>
								</li>
								<li class="mb-0">
									<a class="nav-link-style d-flex align-items-center px-4 py-3" href="#">
										Bình luận bài viết<span class="fs-sm text-muted ms-auto">0</span>
									</a>
								</li>
							</ul>
							<div class="bg-secondary px-4 py-3">
								<h3 class="fs-sm mb-0 text-muted">Thiết lập tài khoản</h3>
							</div>
							<ul class="list-unstyled mb-0">
								<li class="border-bottom mb-0">
									<a class="nav-link-style d-flex align-items-center px-4 py-3 active" href="{{ route('user.hosocanhan') }}">
										Hồ sơ cá nhân
									</a>
								</li>
								<li class="border-bottom mb-0">
									<a class="nav-link-style d-flex align-items-center px-4 py-3" href="#">
										Sổ địa chỉ
									</a>
								</li>
								<li class="mb-0">
									<a class="nav-link-style d-flex align-items-center px-4 py-3" href="#">
										Phương thức thanh toán
									</a>
								</li>
								<li class="d-lg-none border-top mb-0">
									<a class="nav-link-style d-flex align-items-center px-4 py-3" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
										Đăng xuất
									</a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="post" class="d-none">
                                        @csrf
                                    </form>
								</li>
							</ul>
						</div>
					</div>
				</aside>
				<section class="col-lg-8">
                    <div class="d-none d-lg-flex justify-content-between align-items-center pt-lg-3 pb-4 pb-lg-5 mb-lg-3">
                        <h6 class="fs-base text-light mb-0">Cập nhật chi tiết hồ sơ của bạn:</h6>
						<a class="btn btn-primary btn-sm" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
							Đăng xuất
						</a>
                    </div>
                    @if(session('warning'))
                        <div class="alert alert-danger fs-base" role="alert">
                            {{ session('warning') }}
                        </div>
                    @endif
                    @if(session('success'))
                        <div class="alert alert-success fs-base" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    <form action="{{ route('user.hosocanhan') }}" method="post" class="needs-validation" novalidate>
                    @csrf
                    <div class="bg-secondary rounded-3 p-4 mb-4">
                        <div class="d-flex align-items-center">
                        <img class="rounded" src="{{ asset('public/avatar1.jpg') }}" width="90" />
                        <div class="ps-3">
                        <button class="btn btn-light btn-shadow btn-sm mb-2" type="button">
                        Đổi ảnh đại diện
                        </button>
                        <div class="p mb-0 fs-ms text-muted">Tải lên hình ảnh JPG, GIF hoặc PNG. Yêu cầu kích thước 300x300.</div>
                        </div>
                        </div>
                    </div>
                        <div class="row gx-4 gy-3">
                        <div class="col-sm-6">
                        <label class="form-label" for="name">Họ và tên</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ $nguoidung->name }}" required />
                        @error('name')
                        <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                        @enderror
                    </div>
                    <div class="col-sm-6">
                        <label class="form-label" for="email">Địa chỉ email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ $nguoidung->email }}" required />
                        @error('email')
                        <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                        @enderror
                    </div>
                    <div class="col-12">
                        <label class="form-label" for="password">Mật khẩu mới</label>
                        <div class="password-toggle">
                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Bỏ trống nếu muốn giữ nguyên mật khẩu cũ." />
                        <span class="password-toggle-indicator"></span>
                        </label>
                    </div>
                    @error('password')
                        <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                    @enderror
                    </div>
                    <div class="col-12">
                        <label class="form-label" for="password-confirm">Xác nhận mật mới</label><div class="password-toggle">
                        <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="password-confirm" name="password_confirmation" placeholder="Bỏ trống nếu muốn giữ nguyên mật khẩu cũ." />
            
    
                        <span class="password-toggle-indicator"></span>
                        </label>
                    </div>
                    @error('password_confirmation')
                    <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                    @enderror
                    </div>
                    <div class="col-12">
                        <label class="form-label" for="gioitinh">Giới tính</label>
                        <select class="form-select @error('gioitinh') is-invalid @enderror" id="gioitinh" name="gioitinh" value="{{ $nguoidung->gioitinh }}">
                            <option value="nam">Nam</option>
                            <option value="nữ">Nữ</option>
                            <option value="khác">Khác</option>
                        </select>
                        @error('gioitinh')
                            <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                        @enderror
                    </div>
                    <div class="col-6">
                        <label class="form-label" for="namsinh">Năm sinh</label>
                        <input type="text" class="form-control @error('namsinh') is-invalid @enderror" id="namsinh" name="namsinh" value="{{ $nguoidung->namsinh }}">
                        @error('namsinh')
                            <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                        @enderror
                    </div>
                    <div class="col-6">
                        <label class="form-label" for="sodienthoai">Số điện thoại</label>
                        <input type="text" class="form-control @error('sodienthoai') is-invalid @enderror" id="sodienthoai" name="sodienthoai" value="{{ $nguoidung->sodienthoai }}">
                        @error('sodienthoai')
                            <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                        @enderror
                    </div>
                    <div class="col-12">
                        <label class="form-label" for="diachi">Địa chỉ</label>
                        <input type="text" class="form-control @error('diachi') is-invalid @enderror" id="diachi" name="diachi" value="{{ $nguoidung->diachi}}">
                        @error('diachi')
                            <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                        @enderror
                    </div>

                    <div class="col-12">
                        <hr class="mt-2 mb-3">
                        <div class="d-flex flex-wrap justify-content-between align-items-center">
                        <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="subscribe" checked />
                        <label class="form-check-label" for="subscribe">Đăng ký nhận thông báo từ cửa hàng.</label>
                        </div>
                        <button class="btn btn-primary mt-3 mt-sm-0" type="submit">Cập nhật hồ sơ</button>
                        </div>
                        </div>
                    </div>
                    </form>
                </section>
			</div>
		</div>
@endsection
