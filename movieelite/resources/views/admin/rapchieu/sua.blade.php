@extends('layouts.app')
@section('content')
    <div class="card">
        <div class="card-header">Sửa rạp chiếu</div>
        <div class="card-body">
        <form action="{{ route('admin.rapchieu.sua', ['id' => $rapchieu->id]) }}" method="post" enctype="multipart/form-data">
            @csrf
                <div class="mb-3">
                    <label class="form-label" for="tenrap">Tên rạp chiếu</label>
                    <input type="text" class="form-control @error('tenrap') is-invalid @enderror" id="tenrap" name="tenrap" value="{{ $rapchieu->tenrap }}" required />
                    @error('tenrap')
                        <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                    @enderror
                </div>

            <div class="mb-3">
                <label class="form-label" for="diachi">Địa chỉ</label>
                <input type="text" class="form-control @error('diachi') is-invalid @enderror" id="diachi" name="diachi" value="{{ $rapchieu->diachi }}" required>
                @error('diachi')
                    <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                @enderror
            </div>

                <button type="submit" class="btn btn-primary"><i class="fa-light fa-save"></i> Sửa vào CSDL</button>
        </form>
        </div>
    </div>
@endsection