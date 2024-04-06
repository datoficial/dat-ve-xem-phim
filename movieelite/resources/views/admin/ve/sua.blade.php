@extends('layouts.app')
@section('content')
    <div class="card">
        <div class="card-header">Sửa suất chiếu</div>
        <div class="card-body">
        <form action="{{ route('admin.suatchieu.sua', ['id' => $ve->id]) }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">``
        <label class="form-label" for="phongchieu_id">Phòng chiếu</label>
        <select class="form-select @error('phongchieu_id') is-invalid @enderror" id="phongchieu_id" name="phongchieu_id" required>
            <option value="">-- Chọn phòng --</option>
            @foreach($phongchieu as $value)
                <option value="{{ $value->id }}" {{ ($suatchieu->phongchieu_id == $value->id) ? 'selected' : '' }}>{{ $value->tenphong }}</option>
            @endforeach
        </select>
        @error('phongchieu_id')
            <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
        @enderror
    </div>
    <div class="mb-3">
        <label class="form-label" for="phim_id">Phim</label>
        <select class="form-select @error('phim_id') is-invalid @enderror" id="phim_id" name="phim_id" required>
            <option value="">-- Chọn phim --</option>
            @foreach($phim as $value)
                <option value="{{ $value->id }}" {{ ($suatchieu->phim_id == $value->id) ? 'selected' : '' }}>{{ $value->tenphim }}</option>
            @endforeach
        </select>
        @error('phim_id')
            <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
        @enderror
    </div>

    <div class="mb-3">
        <label class="form-label" for="ngaychieu">Ngày chiếu</label>
        <input type="date" class="form-control @error('ngaychieu') is-invalid @enderror" id="ngaychieu" name="ngaychieu" value="{{ $suatchieu->ngaychieu }}" placeholder="yyyy-mm-dd" pattern="\d{4}-\d{2}-\d{2}" required />
        @error('ngaychieu')
            <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
        @enderror
    </div>

    <div class="mb-3">
        <label class="form-label" for="giobatdau">Giờ bắt đầu</label>
        <input type="time" class="form-control @error('giobatdau') is-invalid @enderror" id="giobatdau" name="giobatdau" value="{{ $suatchieu->giobatdau }}"  pattern="\d{2}:\d{2}" required>
        @error('giobatdau')
            <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
        @enderror
    </div>

    <div class="mb-3">
        <label class="form-label" for="gioketthuc">Giờ kết thúc</label>
        <input type="time" class="form-control @error('gioketthuc') is-invalid @enderror" id="gioketthuc" name="gioketthuc" value="{{ $suatchieu->gioketthuc }}" pattern="\d{2}:\d{2}" required>
        @error('gioketthuc')
            <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
        @enderror
    </div>


                <button type="submit" class="btn btn-primary"><i class="fa-light fa-save"></i> Sửa vào CSDL</button>
        </form>
        </div>
    </div>
@endsection