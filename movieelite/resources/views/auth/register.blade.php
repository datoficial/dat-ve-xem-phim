@extends('layouts.app')

@section('content')
<div class="main-panel">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Đăng ký</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Họ tên') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Nhập họ tên">

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Địa chỉ email') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Tài khoản email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Mật khẩu') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Nhập mật khẩu">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Xác nhận mật khẩu') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Nhập lại mật khẩu">
                            </div>
                        </div>
                    <div class="row mb-3">
                    <label for="sodienthoai" class="col-md-4 col-form-label text-md-end">{{ __('Giới Tính') }}</label>
                        <div class="col-md-6">
                        <select id="gioitinh" class="form-control @error('gioitinh') is-invalid @enderror" name="gioitinh" required autocomplete="gioitinh">
                            <option value="nam" @if(old('gioitinh') == 'nam') selected @endif>Nam</option>
                            <option value="nu" @if(old('gioitinh') == 'nu') selected @endif>Nữ</option>
                        </select>
                        @error('gioitinh')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="namsinh" class="col-md-4 col-form-label text-md-end">{{ __('Năm Sinh') }}</label>

                        <div class="col-md-6">
                            <input id="namsinh" type="date" class="form-control @error('namsinh') is-invalid @enderror" name="namsinh" value="{{ old('namsinh') }}" required autocomplete="namsinh">

                            @error('namsinh')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>


                    <div class="row mb-3">
                        <label for="sodienthoai" class="col-md-4 col-form-label text-md-end">{{ __('Số Điện Thoại') }}</label>

                        <div class="col-md-6">
                            <input id="sodienthoai" type="tel" class="form-control @error('sodienthoai') is-invalid @enderror" name="sodienthoai" value="{{ old('sodienthoai') }}" required autocomplete="sodienthoai" placeholder="Nhập số điện thoại">

                            @error('sodienthoai')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                        <div class="row mb-3">
                            <label for="diachi" class="col-md-4 col-form-label text-md-end">{{ __('Địa Chỉ') }}</label>

                            <div class="col-md-6">
                                <input id="diachi" type="text" class="form-control @error('diachi') is-invalid @enderror" name="diachi" value="{{ old('diachi') }}" required autocomplete="diachi" placeholder="Nhập địa chỉ">

                                @error('diachi')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Đăng nhập') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
