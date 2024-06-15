@extends('layouts.app')
@section('content')
<div class="card">
<div class="card-header">Sửa bình luận bài viết</div>
<div class="card-body">
<form action="{{ route('nhanvien.binhluan.sua', ['id' => $binhluan->id]) }}" method="post">
@csrf
<div class="mb-3">
<label class="form-label" for="baiviet_id">Bài viết</label>
<select class="form-select @error('baiviet_id') is-invalid @enderror" id="baiviet_id" name="baiviet_id" required>
<option value="">-- Chọn --</option>
@foreach($baiviet as $value)
<option value="{{ $value->id }}" {{ ($binhluan->baiviet_id == $value->id) ? 'selected' : '' }}>{{ $value->tieude }}</option>
@endforeach
</select>
@error('baiviet_id')
<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
@enderror
</div>
<div class="mb-3">
<label class="form-label" for="noidungbinhluan">Nội dung bình luận</label>
<textarea class="form-control" id="noidungbinhluan" name="noidungbinhluan" required>{{ $binhluan->noidungbinhluan }}</textarea>
@error('noidungbinhluan')
<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
@enderror
</div>
<button type="submit" class="btn btn-primary"><i class="bi bi-pencil-square"></i>Cập nhật</button>
</form>
</div>
</div>
@endsection