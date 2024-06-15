@extends('layouts.app')
@section('content')
    <div class="card">
        <div class="card-header">Sửa phòng chiếu</div>
        <div class="card-body">
        <form action="{{ route('admin.phongchieu.sua', ['id' => $phongchieu->id]) }}" method="post" enctype="multipart/form-data">
            @csrf
                <div class="mb-3">
                    <label class="form-label" for="rapchieu_id">Rạp chiếu</label>
                    <select class="form-select @error('rapchieu_id') is-invalid @enderror" id="rapchieu_id" name="rapchieu_id" required>
                        <option value="">-- Chọn loại --</option>
                            @foreach($rapchieu as $value)
                                <option value="{{ $value->id }}" {{ ($phongchieu->rapchieu_id == $value->id) ? 'selected' : '' }}>{{ $value->tenrap }}</option>
                            @endforeach
                    </select>
                    @error('rapchieu_id')
                        <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label" for="tenphong">Tên phòng chiếu</label>
                    <input type="text" class="form-control @error('tenphong') is-invalid @enderror" id="tenphong" name="tenphong" value="{{ $phongchieu->tenphong }}" required />
                    @error('tenphong')
                        <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary"><i class="bi bi-pencil-square"></i> Sửa vào CSDL</button>
        </form>
        </div>
    </div>
@endsection