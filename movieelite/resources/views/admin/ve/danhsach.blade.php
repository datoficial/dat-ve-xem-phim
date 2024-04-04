@extends('layouts.app')
@section('content')
    <div class="card">
        <div class="card-header">Vé</div>
        <div class="card-body table-responsive">
            <table class="table table-bordered table-hover table-sm mb-0">
                <thead>
                    <tr>
                        <th width="5%">#</th>
                        <th width="15%">Tên khách hàng</th>
                        <th width="15%">Tên phòng</th>
                        <th width="15%">Tên phim</th>
                        <th width="5%">Ngày chiếu</th>
                        <th width="5%">Giờ bắt đầu</th>
                        <th width="15%">Tên ghế</th>
                        <th width="5%">Số lượng</th>
                        <th width="5%">Ngày đặt</th>
                        <th width="5%">Tổng tiền</th>
                        <th width="5%">Sửa</th>
                        <th width="5%">Xóa</th>
                    </tr>
                </thead>
            <tbody>
            @foreach($ve as $value)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $value->User->name}}</td>
                <td>{{ $value->SuatChieu->PhongChieu->tenphong }}</td>
                <td>{{ $value->SuatChieu->Phim->tenphim }}</td>
                <td>{{ $value->SuatChieu->ngaychieu }}</td>
                <td>{{ $value->SuatChieu->giobatdau }}</td>
                <td>{{ $value->tenghe }}</td>
                <td>{{ $value->soluong }}</td>
                <td>{{ $value->ngayban }}</td>
                <td>{{ $value->giave }}</td>
                    <td class="text-center">
                    <a href="{{ route('admin.ve.sua', ['id' => $value->id]) }}"><i class="bi bi-pencil-square"></i>
                    </a>
                    </td>
                    <td class="text-center">
                    <a href="{{ route('admin.ve.xoa', ['id' => $value->id]) }}" onclick="return confirm('Bạn có muốn xóa vé của {{ $value->User->name }} không?')">
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