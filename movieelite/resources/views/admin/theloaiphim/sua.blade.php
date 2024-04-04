@extends('layouts.app')
@section('content')
    <div class="card">
        <div class="card-header">Sửa thể loại phim</div>
        <div class="card-body">
        <form action="{{ route('admin.theloaiphim.sua', ['id' => $theloaiphim->id]) }}" method="post">
        @csrf
            <div class="mb-3"><label class="form-label" for="tenloai">Tên thể loại</label>
            <input type="text" class="form-control @error('tenloai') is-invalid @enderror" id="tenloai" name="tenloai" value="{{ $theloaiphim->tenloai }}" required />
        @error('tenloai')
            <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
        @enderror
            </div>
            <button type="submit" class="btn btn-primary"><i class="fa-light fa-save"></i> Cập nhật</button>
        </form>
        </div>
    </div>
@endsection