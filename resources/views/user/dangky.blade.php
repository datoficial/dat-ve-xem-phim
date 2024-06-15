@extends('layouts.frontend')
@section('title', 'Hồ sơ khách hàng')
@section('content')
<section class="vh-100 gradient-custom"style="margin-top: 80px;">
  <div class="container py-5 h-100">
    <div class="row justify-content-center align-items-center h-100">
      <div class="col-12 col-lg-9 col-xl-7">
        <div class="card shadow-2-strong card-registration" style="border-radius: 15px;">
          <div class="card-body p-4 p-md-5">
            <h3 class="mb-4 pb-2 pb-md-0 mb-md-5">Đăng ký</h3>
            <form method="post" action="{{ route('register') }}" class="needs-validation" novalidate>
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <div class="form-outline">
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required />
                            @error('name')
                                    <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                            @enderror
                            <label class="form-label" for="name">Họ và tên</label>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="form-outline">
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required />
                            @error('email')
                                    <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                            @enderror
                            <label class="form-label" for="email">Email</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3 d-flex align-items-center">
                        <div class="form-outline datepicker w-100">
                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required />
                        @error('password')
                            <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                         @enderror
                            <label for="password" class="form-label">Mật khẩu</label>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3 d-flex align-items-center">
                        <div class="form-outline datepicker w-100">
                        <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="password-confirm" name="password_confirmation" required />
                            @error('password_confirmation')
                                <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                            @enderror
                            <label for="password-confirm" class="form-label">Xác thực mật khẩu</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                <div class="col-md-6 mb-3">
                    <h6 class="mb-2">Giới tính:</h6>
                    <div class="btn-group" role="group" aria-label="Gender">
                        <button type="button" value="Nam" style="color:black; border-color: #000;" class="btn btn-outline-primary @error('gioitinh') is-invalid @enderror" id="maleBtn" name="gioitinh" required>Nam</button>
                        <button type="button" value="Nữ" style="color:black; border-color: #000;" class="btn btn-outline-primary @error('gioitinh') is-invalid @enderror" id="femaleBtn" name="gioitinh" required>Nữ</button>
                        <button type="button" value="Khác" style="color:black; border-color: #000;" class="btn btn-outline-primary @error('gioitinh') is-invalid @enderror" id="otherBtn" name="gioitinh" required>Khác</button>
                    </div>
                    <input type="hidden" class="form-control @error('gioitinh') is-invalid @enderror" id="gioitinhHidden" name="gioitinh" required />
                </div>
                    <div class="col-md-6 mb-3 pb-1">
                        <div class="form-outline">
                            <input type="date" class="form-control @error('namsinh') is-invalid @enderror" id="namsinh" name="namsinh" required />
                            <label class="form-label" for="namsinh">Năm sinh</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3 pb-1">
                        <div class="form-outline">
                            <input type="tel" class="form-control @error('sodienthoai') is-invalid @enderror" id="sodienthoai" name="sodienthoai"  maxlength="10" required/>
                            @error('sodienthoai')
                                <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                            @enderror
                            <label class="form-label" for="sodienthoai">Số điện thoại</label>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3 pb-1">
                        <div class="form-outline">
                            <input type="text" class="form-control @error('diachi') is-invalid @enderror" id="diachi" name="diachi"  required />
                            <label class="form-label" for="diachi">Địa chỉ</label>
                        </div>
                    </div>
                </div>
                <div class="mt-4 pt-2">
                    <input class="btn btn-primary btn-lg" type="submit" value="Đăng ký" />
                </div>
            </form>

          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
@section('style')
<style>
.gradient-custom {
/* fallback for old browsers */
background: #f093fb;

/* Chrome 10-25, Safari 5.1-6 */
background: -webkit-linear-gradient(to bottom right, rgba(240, 147, 251, 1), rgba(245, 87, 108, 1));

/* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
background: linear-gradient(to bottom right, rgba(240, 147, 251, 1), rgba(245, 87, 108, 1))
}

.card-registration .select-input.form-control[readonly]:not([disabled]) {
font-size: 1rem;
line-height: 2.15;
padding-left: .75em;
padding-right: .75em;
}
.card-registration .select-arrow {
top: 13px;
}
</style>
@endsection
@section('javascript')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var maleBtn = document.getElementById('maleBtn');
        var femaleBtn = document.getElementById('femaleBtn');
        var otherBtn = document.getElementById('otherBtn');
        var gioitinhInput = document.getElementById('gioitinhHidden');

        maleBtn.addEventListener('click', function() {
            gioitinhInput.value = 'Nam';
        });

        femaleBtn.addEventListener('click', function() {
            gioitinhInput.value = 'Nữ';
        });

        otherBtn.addEventListener('click', function() {
            gioitinhInput.value = 'Khác';
        });
    });
</script>

@endsection