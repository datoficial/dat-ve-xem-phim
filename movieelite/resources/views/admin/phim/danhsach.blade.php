@extends('layouts.app')
@section('content')
    <div class="card">
        <div class="card-header">Phim</div>
        <div class="card-body table-responsive">
            <p><a href="{{ route('admin.phim.them') }}" class="btn btn-info"><i class="bi bi-plus"></i> Thêm mới</a></p>
            {{ $phim -> links() }}
            <table class="table table-bordered table-hover table-sm mb-0">
                <thead>
                    <tr>
                        <th width="5%">#</th>
                        <th width="10%">Tên thể loại phim</th>
                        <th width="10%">Tên phim</th>
                        <th width="10%">Tên phim không dấu</th>
                        <th width="5%">Giới hạn tuổi</th>
                        <th width="10%">Quốc gia</th>
                        <th width="10%">Mô tả</th>
                        <th width="10%">Traiiler</th>
                        <th width="10%">Trạng thái</th>
                        <th width="10%">Hình ảnh</th>
                        <th width="5%">Sửa</th>
                        <th width="5%">Xóa</th>
                    </tr>
                </thead>
            <tbody>
            @foreach($phim as $value)
                <tr>
                    <td>{{ $loop->index + $phim -> firstItem() }}</td>
                    <td>{{ $value->TheLoaiPhim->tenloai }}</td>
                    <td>{{ $value->tenphim }}</td>
                    <td>{{ $value->tenphim_slug }}</td>
                    <td>{{ $value->gioihantuoi }}</td>
                    <td>{{ $value->quocgia }}</td>
                    <td>{{ $value->mota }}</td>
                    <td>{{ $value->trailler }}</td>
                    <td>{{ $value->trangthai }}</td>
                    <td class="text-center"><img src="{{ env('APP_URL') . '/storage/app/' . $value->hinhanh }}" width="100" class="img-thumbnail" /></td>
                    <td class="text-center">
                    <a href="{{ route('admin.phim.sua', ['id' => $value->id]) }}"><i class="bi bi-pencil-square"></i>
                    </a>
                    </td>
                    <td class="text-center">
                    <a href="{{ route('admin.phim.xoa', ['id' => $value->id]) }}" onclick="return confirm('Bạn có muốn xóa phim {{ $value->tenphim }} không?')">
                    <i class="bi bi-trash text-danger"></i>
                    </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
            </table>
            {{ $phim -> links() }}
        </div>
    </div>
@endsection