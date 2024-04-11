@extends('layouts.app')
@section('content')
    <div class="card">
        <div class="card-header">Thêm tài khoản</div>
        <div class="card-body">
            <form action="{{ route('admin.nguoidung.them') }}" method="post">
                @csrf
                <div class="mb-3">
                    <label class="form-label" for="name">Họ và tên</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required />@error('name')
                    <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label" for="email">Địa chỉ email</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required />
                    @error('email')
                        <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                    @enderror
                </div>
                <div class="mb-3">
                <label class="form-label" for="password">Mật khẩu mới</label>
                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required />
                @error('password')
                <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                @enderror
                </div>
                <div class="mb-3">
                <label class="form-label" for="password_confirmation">Xác nhận mật khẩu mới</label>
                <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" name="password_confirmation" required />
                @error('password_confirmation')
                <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label" for="gioitinh">Giới tính</label>
                    <input type="text" class="form-control @error('gioitinh') is-invalid @enderror" id="gioitinh" name="gioitinh" value="{{ old('gioitinh') }}" required />
                @error('gioitinh')
                    <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label" for="namsinh">Năm sinh</label>
                    <input type="text" class="form-control @error('namsinh') is-invalid @enderror" id="namsinh" name="namsinh" value="{{ old('namsinh') }}" required />
                @error('namsinh')
                    <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label" for="sodienthoai">Số điện thoại</label>
                    <input type="text" class="form-control @error('sodienthoai') is-invalid @enderror" id="sodienthoai" name="sodienthoai" value="{{ old('sodienthoai') }}" required />
                @error('sodienthoai')
                    <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label" for="diachi">Địa chỉ</label>
                    <input type="text" class="form-control @error('diachi') is-invalid @enderror" id="diachi" name="diachi" value="{{ old('diachi') }}" required />
                @error('diachi')
                    <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                @enderror
                </div>
                <div class="mb-3">
                <label class="form-label" for="role">Quyền hạn</label>
                <select class="form-select @error('role') is-invalid @enderror" id="role" name="role" required>
                <option value="">-- Chọn --</option>
                <option value="admin">Quản trị viên</option>
                <option value="nhanvien" selected>Nhân viên</option>
                <option value="user" selected>Khách hàng</option>
                </select>
                @error('role')
                <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                @enderror
                </div>
                <button type="submit" class="btn btn-primary"><i class="bi bi-person-plus"></i> Thêm người dùng</button>
            </form>
        </div>
    </div>
@endsection