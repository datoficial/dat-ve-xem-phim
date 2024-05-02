@extends('layouts.app')
@section('content')
    <div class="card">
        <div class="card-header">Thêm Suất Chiếu</div>
        <div class="card-body">
        <form action="{{ route('admin.suatchieu.them') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label class="form-label" for="phongchieu_id">Phòng chiếu</label>
                <select class="form-select @error('phongchieu_id') is-invalid @enderror" id="phongchieu_id" name="phongchieu_id" required>
                    <option value="">Chọn phòng chiếu</option>
                    @foreach($phongchieu as $pc)
                        <option value="{{ $pc->id }}" @if(old('phongchieu_id') == $pc->id) selected @endif>{{ $pc->tenphong }}</option>
                    @endforeach
                </select>
                @error('phongchieu_id')
                    <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label" for="phim_id">Phim</label>
                <select class="form-select @error('phim_id') is-invalid @enderror" id="phim_id" name="phim_id" required>
                    <option value="">Chọn phim</option>
                    @foreach($phim as $p)
                        <option value="{{ $p->id }}" @if(old('phim_id') == $p->id) selected @endif>{{ $p->tenphim }}</option>
                    @endforeach
                </select>
                @error('phim_id')
                    <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label" for="ngaychieu">Ngày chiếu</label>
                <input type="date" class="form-control @error('ngaychieu') is-invalid @enderror" id="ngaychieu" name="ngaychieu" placeholder="yyyy-mm-dd" value="{{ old('ngaychieu') }}" required />
            @error('ngaychieu')
                <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
            @enderror
            </div>

            <div class="mb-3">
                <label class="form-label" for="giobatdau">Giờ bắt đầu</label>
                <input type="time" class="form-control @error('giobatdau') is-invalid @enderror" id="giobatdau" name="giobatdau" value="{{ old('giobatdau') }}" required>
                @error('giobatdau')
                    <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label" for="gioketthuc">Giờ kết thúc</label>
                <input type="time" class="form-control @error('gioketthuc') is-invalid @enderror" id="gioketthuc" name="gioketthuc"  value="{{ old('gioketthuc') }}" required>
                @error('gioketthuc')
                    <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                @enderror
            </div>

                <button type="submit" class="btn btn-primary"><i class="bi bi-plus"></i> Thêm vào CSDL</button>
        </form>
        </div>
    </div>
@endsection