@extends('layouts.app')

@section('content')
<section class="container pt-3 pb-5">
  <div class="container-fluid h-custom">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-md-9 col-lg-6 col-xl-5">
        <img src="{{asset('public/backend/images/login.png')}}"
          class="img-fluid" alt="Sample image">
      </div>
      <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
            <form method="post" action="{{ route('login') }}" class="needs-validation" novalidate>
            @csrf
            @if(session('warning'))
            <div class="alert alert-danger fs-base" role="alert">
                <i class="ci-close-circle me-2"></i>{{ session('warning') }}
            </div>
            @endif
          @if($errors->has('email') || $errors->has('username'))
            <div class="alert alert-danger fs-base" role="alert">
              <i class="ci-close-circle me-2"></i>{{ empty($errors->first('email')) ? $errors->first('username') : $errors->first('email') }}
            </div>
          @endif
          <!-- Email input -->
          <div class="form-outline mb-4">
          <input type="text" class="form-control form-control-lg rounded-start {{ ($errors->has('email') || $errors->has('username')) ? 'is-invalid' : '' }}" id="email" name="email" value="{{ old('email') }}" placeholder="Email, Tên đăng nhập hoặc Điện thoại" required />
          </div>

          <!-- Password input -->
          <div class="form-outline mb-3">
          <input type="password" class="form-control form-control-lg @error('password') is-invalid @enderror" id="password" name="password" placeholder="Mật khẩu" required />
          </div>
          <div class="text-center text-lg-start mt-4 pt-2">
            <button type="submit" class="btn btn-primary btn-lg"
              style="padding-left: 2.5rem; padding-right: 2.5rem;">Đăng nhập</button>
            <p class="small fw-bold mt-2 pt-1 mb-0">Bạn chưa có tài khoản? <a href="{{ route('register') }}"
                class="link-danger">Đăng ký</a></p>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>
@endsection
