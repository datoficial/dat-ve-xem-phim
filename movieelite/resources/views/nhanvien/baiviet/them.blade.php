@extends('layouts.app')
@section('content')
    <div class="card">
        <div class="card-header">Thêm bài viết</div>
        <div class="card-body">
        <form action="{{ route('nhanvien.baiviet.them') }}" method="post">
            @csrf
                <div class="mb-3">
                <label class="form-label" for="chude_id">Chủ đề</label>
                <select class="form-select @error('chude_id') is-invalid @enderror" id="chude_id" name="chude_id" required>
                <option value="">-- Chọn --</option>
            @foreach($chude as $value)
                <option value="{{ $value->id }}">{{ $value->tenchude }}</option>
            @endforeach
                </select>
            @error('chude_id')
                <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
            @enderror
                </div>
                <div class="mb-3">
                <label class="form-label" for="phim_id">Phim</label>
                <select class="form-select @error('phim_id') is-invalid @enderror" id="phim_id" name="phim_id">
                <option value="">-- Chọn --</option>
            @foreach($phim as $value)
                <option value="{{ $value->id }}">{{ $value->tenphim }}</option>
            @endforeach
                </select>
            @error('phim_id')
                <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
            @enderror
                </div>
                <div class="mb-3">
                <label class="form-label" for="tieude">Tiêu đề</label>
                <input type="text" class="form-control @error('tieude') is-invalid @enderror" id="tieude" name="tieude" value="{{ old('tieude') }}" required />@error('tieude')
                <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
            @enderror
                </div>
                <div class="mb-3">
                <label class="form-label" for="tomtat">Tóm tắt</label>
                <textarea class="form-control" id="tomtat" name="tomtat">{{ old('tomtat') }}</textarea>
            @error('tomtat')
                <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
            @enderror
                </div>
                <div class="mb-3">
                <label class="form-label" for="noidung">Nội dung bài viết</label>
                <textarea class="form-control" id="noidung" name="noidung" >{{ old('noidung') }}</textarea>
            @error('noidung')
                <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
            @enderror
                </div>
                <button type="submit" class="btn btn-primary"><i class="fa-light fa-save"></i> Thêm vào CSDL</button>
            </form>
        </div>
    </div>
    @endsection
    @section('javascript')
    <script src="{{ asset('public/vendor/ckeditor5/ckeditor.js') }}"></script>
    <script>
        ClassicEditor.create(document.querySelector('#noidung'), {
            licenseKey: '',
            removePlugins: [ 'MediaEmbedToolbar' ]
        }).then(editor => {
            window.editor = editor;
        }).catch(error => {
            console.error(error);
        });
    </script>
@endsection
