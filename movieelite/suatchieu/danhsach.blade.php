@extends('layouts.app')
@section('content')
    <div class="card">
        <div class="card-header">Suất chiếu</div>
        <div class="card-body table-responsive">
            <p><a href="{{ route('admin.suatchieu.them') }}" class="btn btn-info"><i class="bi bi-plus"></i> Thêm mới</a></p>
            <table class="table table-bordered table-hover table-sm mb-0">
                <thead>
                    <tr>
                        <th width="5%">#</th>
                        <th width="15%">Tên phòng chiếu</th>
                        <th width="25%">Tên phim</th>
                        <th width="15%">Ngày chiếu</th>
                        <th width="15%">Giờ bắt đầu</th>
                        <th width="15%">Giờ kết thúc</th>
                        <th width="5%">Sửa</th>
                        <th width="5%">Xóa</th>
                    </tr>
                </thead>
            <tbody>
            @foreach($suatchieu as $value)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $value->PhongChieu->tenphong }}</td>
                    <td>{{ $value->Phim->tenphim }}</td>
                    <td>{{ $value->ngaychieu }}</td>
                    <td>{{ $value->giobatdau }}</td>
                    <td>{{ $value->gioketthuc }}</td>
                    <td class="text-center">
                    <a href="{{ route('admin.suatchieu.sua', ['id' => $value->id]) }}"><i class="bi bi-pencil-square"></i>
                    </a>
                    </td>
                    <td class="text-center">
                    <a href="{{ route('admin.suatchieu.xoa', ['id' => $value->id]) }}" onclick="return confirm('Bạn có muốn xóa suất chiếu của phim {{ $value->Phim->tenphim }} không?')">
                    <i class="bi bi-trash text-danger"></i>
                    </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
            </table>
        </div>
    </div>
@endsection