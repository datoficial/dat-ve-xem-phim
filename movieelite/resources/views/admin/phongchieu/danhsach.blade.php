@extends('layouts.app')
@section('content')
    <div class="card">
        <div class="card-header">Phim</div>
        <div class="card-body table-responsive">
            <p><a href="{{ route('admin.phongchieu.them') }}" class="btn btn-info"><i class="bi bi-plus"></i> Thêm mới</a></p>
            <table class="table table-bordered table-hover table-sm mb-0">
                <thead>
                    <tr>
                        <th width="10%">#</th>
                        <th width="20%">Tên rạp chiếu</th>
                        <th width="25%">Tên phòng chiếu</th>
                        <th width="30%">Tên phòng chiếu không dấu</th>
                        <th width="10%">Sửa</th>
                        <th width="10%">Xóa</th>
                    </tr>
                </thead>
            <tbody>
            @foreach($phongchieu as $value)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $value->RapChieu->tenrap }}</td>
                    <td>{{ $value->tenphong }}</td>
                    <td>{{ $value->tenphong_slug }}</td>
                    <td class="text-center">
                    <a href="{{ route('admin.phongchieu.sua', ['id' => $value->id]) }}"><i class="bi bi-pencil-square"></i>
                    </a>
                    </td>
                    <td class="text-center">
                    <a href="{{ route('admin.phongchieu.xoa', ['id' => $value->id]) }}" onclick="return confirm('Bạn có muốn xóa phòng chiếu {{ $value->tenphong }} không?')">
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