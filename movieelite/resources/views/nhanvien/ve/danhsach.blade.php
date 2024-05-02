@extends('layouts.app')
@section('content')
    <div class="card">
        <div class="card-header">Vé</div>
        <div class="card-body table-responsive">
        {{ $ve -> links() }}
            <table class="table table-bordered table-hover table-sm mb-0">
                <thead>
                    <tr>
                        <th width="5%">#</th>
                        <th width="10%">Tên rạp</th>
                        <th width="10%">Tên phòng</th>
                        <th width="15%">Tên phim</th>
                        <th width="5%">Ngày đặt vé</th>
                        <th width="5%">Tên ghế</th>
                        <th width="5%">Số lượng ghế</th>
                        <th width="5%">Tổng tiền</th>
                        <th width="10%">Tên khách hàng</th>
                        <th width="5%">Số điện thoại</th>
                        <th width="5%">Ngày chiếu</th>
                        <th width="5%">Giờ bắt đầu</th>
                        <th width="5%">QR</th>
                        <th width="5%">Sửa</th>
                        <th width="5%">Xóa</th>
                    </tr>
                </thead>
            <tbody>
            @foreach($ve as $value)
            <tr>
                <td>{{ $loop->index + $ve -> firstItem() }}</td>
                <td>{{ $value->SuatChieu->PhongChieu->RapChieu->tenrap }}</td>
                <td>{{ $value->SuatChieu->PhongChieu->tenphong }}</td>
                <td>{{ $value->SuatChieu->Phim->tenphim }}</td>
                <td>{{ $value->ngayban }}</td>
                <td>{{ $value->tenghe }}</td>
                <td>{{ $value->soluong }}</td>
                <td>{{ $value->giave }}</td>
                <td>{{ $value->User->name}}</td>
                <td>{{ $value->User->sodienthoai}}</td>
                <td>{{ $value->SuatChieu->ngaychieu }}</td>
                <td>{{ $value->SuatChieu->giobatdau }}</td>
                <td>{{ $value->qrcode }}</td>
                    <td class="text-center">
                    <a href="{{ route('nhanvien.ve.sua', ['id' => $value->id]) }}"><i class="bi bi-pencil-square"></i>
                    </a>
                    </td>
                    <td class="text-center">
                    <a href="{{ route('nhanvien.ve.xoa', ['id' => $value->id]) }}" onclick="return confirm('Bạn có muốn xóa vé của {{ $value->User->name }} không?')">
                    <i class="bi bi-trash text-danger"></i>
                    </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
            </table>
{{$ve ->links()}}

<div class="mt-6">
    <form id="dateForm" action="{{ route('nhanvien.ve') }}" method="GET" onsubmit="return validateDates()">
        <label for="ngay_a">Từ ngày:</label>
        <input type="date" id="ngay_a" name="ngay_a">
        <label for="ngay_b">Đến ngày:</label>
        <input type="date" id="ngay_b" name="ngay_b">
        <button type="submit" id="buttondate">Thống kê</button>
    </form>
    <p id="dateError" style="color: red;"></p>
</div>


<div class="card-header">Thống kê vé từ {{ \Carbon\Carbon::parse($ngay_a)->format('d/m/Y') }} đến {{ \Carbon\Carbon::parse($ngay_b)->format('d/m/Y') }}</div>


        <div class="card-body table-responsive">
            <table class="table table-bordered table-hover table-sm mb-0">
                <thead>
                    <tr>
                        <th width="10%">Tên rạp</th>
                        <th width="10%">Số lượng vé</th>
                        <th width="10%">Tổng ghế đã đặt</th>
                        <th width="10%">Doanh thu</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($thongkerapchieu as $rapchieu)
                        <tr>
                            <td>{{ $rapchieu->tenrap }}</td>
                            <td>{{ $rapchieu->so_luong_ve }}</td>
                            <td>{{ $rapchieu->so_luong_ghe }}</td>
                            <td>{{ $rapchieu->doanh_thu }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        
    </div>
@endsection
@section('style')
<style>
    #buttondate {
        -webkit-transition-duration: 0.4s; 
        transition-duration: 0.4s;
        background-color: white; 
        color: crimson; 
        border: 1px solid crimson; 
        padding: 5px 20px; 
        text-align: center; 
        text-decoration: none; 
        display: inline-block; 
        font-size: 16px;
        margin: 4px 2px; 
        cursor: pointer;
        border-radius: 10px; 
    }

    #buttondate:hover {
        background-color: crimson; 
        color: white; 
    }
</style>
@endsection
@section('javascript')
<script>
    function validateDates() {
        var ngay_a = new Date(document.getElementById('ngay_a').value);
        var ngay_b = new Date(document.getElementById('ngay_b').value);
        
        if (ngay_a > ngay_b) {
            document.getElementById('dateError').innerText = "Ngày bắt đầu phải nhỏ hơn ngày kết thúc.";
            return false; 
        } else {
            document.getElementById('dateError').innerText = "";
            return true; 
        }
    }
    </script>
    @endsection