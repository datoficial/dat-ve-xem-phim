@extends('layouts.app')
@section('content')
    <div class="main-panel">
        <div class="card-header">Thêm phim</div>
        <div class="card-body">
        <form action="{{ route('admin.phim.them') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label class="form-label" for="theloaiphim_id">Thể loại phim</label>
                <select class="form-select @error('theloaiphim_id') is-invalid @enderror" id="theloaiphim_id" name="theloaiphim_id" required>
                    <option>                           Chọn thể loại</option>
                    @foreach($theloaiphim as $theloai)
                        <option value="{{ $theloai->id }}" @if(old('theloaiphim_id') == $theloai->id) selected @endif>{{ $theloai->tenloai }}</option>
                    @endforeach
                </select>
                @error('theloaiphim_id')
                    <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label" for="tenphim">Tên phim</label>
                <input type="text" class="form-control @error('tenphim') is-invalid @enderror" id="tenphim" name="tenphim" value="{{ old('tenphim') }}" required />
            @error('tenphim')
                <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
            @enderror
            </div>

            <div class="mb-3">
                <label class="form-label" for="gioihantuoi">Giới Hạn Tuổi</label>
                <input type="number" class="form-control @error('gioihantuoi') is-invalid @enderror" id="gioihantuoi" name="gioihantuoi" value="{{ old('gioihantuoi') }}" required>
                @error('gioihantuoi')
                    <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label" for="quocgia">Quốc Gia</label>
                <input type="text" class="form-control @error('quocgia') is-invalid @enderror" id="quocgia" name="quocgia" value="{{ old('quocgia') }}" required>
                @error('quocgia')
                    <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label" for="mota">Mô Tả</label>
                <input type="text" class="form-control @error('mota') is-invalid @enderror" id="mota" name="mota" value="{{ old('mota') }}"></input>
                @error('mota')
                    <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                @enderror
            </div>


            <div class="mb-3">
                <label class="form-label" for="trailler">Trailer</label>
                <input type="text" class="form-control @error('trailler') is-invalid @enderror" id="trailler" name="trailler" value="{{ old('trailler') }}">
                @error('trailler')
                    <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label" for="trangthai">Trạng Thái</label>
                <select class="form-select @error('trangthai') is-invalid @enderror" id="trangthai" name="trangthai" required>
                    <option value="">Chọn trạng thái</option>
                    <option value="Đang Chiếu" @if(old('trangthai') == 'Đang Chiếu') selected @endif>Đang Chiếu</option>
                    <option value="Sắp Chiếu" @if(old('trangthai') == 'Sắp Chiếu') selected @endif>Sắp Chiếu</option>
                    <option value="Ngưng Chiếu" @if(old('trangthai') == 'Ngưng Chiếu') selected @endif>Ngưng Chiếu</option>
                </select>
                @error('trangthai')
                    <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                @enderror
            </div>


            <div class="mb-3">
                <label class="form-label" for="hinhanh">Hình ảnh sản phẩm</label>
                <input type="file" class="form-control @error('hinhanh') is-invalid @enderror" id="hinhanh" name="hinhanh" value="{{ old('hinhanh') }}" />
                @error('hinhanh')
                    <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                @enderror
            </div>

                <button type="submit" class="btn btn-primary"><i class="bi bi-plus"></i> Thêm vào CSDL</button>
        </form>
        </div>
    </div>
@endsection