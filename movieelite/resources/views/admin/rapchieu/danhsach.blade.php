@extends('layouts.app')
@section('content')
    <div class="card">
        <div class="card-header">Rạp chiếu</div>
        <div class="card-body table-responsive">
            <p><a href="{{ route('admin.rapchieu.them') }}" class="btn btn-info"><i class="bi bi-plus"></i> Thêm mới</a></p>
            <table class="table table-bordered table-hover table-sm mb-0">
                <thead>
                    <tr>
                        <th width="5%">#</th>
                        <th width="30%">Tên rạp</th>
                        <th width="30%">Tên rạp không dấu</th>
                        <th width="25%">Địa chỉ</th>
                        <th width="5%">Sửa</th>
                        <th width="5%">Xóa</th>
                    </tr>
                </thead>
            <tbody>
            @foreach($rapchieu as $value)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $value->tenrap }}</td>
                    <td>{{ $value->tenrap_slug }}</td>
                    <td>{{ $value->diachi }}</td>
                    <td class="text-center">
                    <a href="{{ route('admin.rapchieu.sua', ['id' => $value->id]) }}"><i class="bi bi-pencil-square"></i>
                    </a>
                    </td>
                    <td class="text-center">
                    <a href="{{ route('admin.rapchieu.xoa', ['id' => $value->id]) }}" onclick="return confirm('Bạn có muốn xóa rạp chiếu {{ $value->tenrap }} không?')">
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