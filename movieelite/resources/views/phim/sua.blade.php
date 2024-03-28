@extends('layouts.app')
@section('content')
    <div class="card">
        <div class="card-header">Sửa phim</div>
        <div class="card-body">
        <form action="{{ route('phim.sua', ['id' => $phim->id]) }}" method="post">
        @csrf
            <div class="mb-3"><label class="form-label" for="tenphim">Tên phim</label>
            <input type="text" class="form-control @error('tenphim') is-invalid @enderror" id="tenphim" name="tenphim" value="{{ $theloaiphim->tenphim }}" required />
        @error('tenphim')
            <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
        @enderror
            </div>
            <button type="submit" class="btn btn-primary"><i class="fa-light fa-save"></i> Cập nhật</button>
        </form>
        </div>
    </div>
@endsection