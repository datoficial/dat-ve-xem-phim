@extends('layouts.app')
@section('content')
    <div class="card">
        <div class="card-header">Thêm phòng chiếu</div>
        <div class="card-body">
        <form action="{{ route('admin.phongchieu.them') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label class="form-label" for="rapchieu_id">Rạp chiếu</label>
                <select class="form-select @error('rapchieu_id') is-invalid @enderror" id="rapchieu_id" name="rapchieu_id" required>
                    <option value="">Chọn rạp chiếu</option>
                    @foreach($rapchieu as $rc)
                        <option value="{{ $rc->id }}" @if(old('rapchieu_id') == $rc->id) selected @endif>{{ $rc->tenrap }}</option>
                    @endforeach
                </select>
                @error('rapchieu_id')
                    <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label" for="tenphong">Tên phòng chiếu</label>
                <input type="text" class="form-control @error('tenphong') is-invalid @enderror" id="tenphong" name="tenphong" value="{{ old('tenphong') }}" required />
            @error('tenphong')
                <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
            @enderror
            </div>
                <button type="submit" class="btn btn-primary"><i class="fa-light fa-save"></i> Thêm vào CSDL</button>
        </form>
        </div>
    </div>
@endsection