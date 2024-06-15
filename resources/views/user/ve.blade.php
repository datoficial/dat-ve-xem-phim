@extends('layouts.frontend')
@section('title', 'Vé của bạn')
@section('content')
@foreach($ve as $value)
<div class="ticket">
        <div class="holes-top"></div>
        <div class="title">
            <p class="cinema">Movie Elite</p>
            <p class="movie-title">{{$value->SuatChieu->Phim->tenphim}}</p>
        </div>
        <div class="poster">
        <img src="{{ env('APP_URL') . '/storage/app/' . $value->SuatChieu->Phim->hinhanh }}" alt=""/>
        </div>
        <div class="info" >
            <table>
                <tr>
                    <th>Ngày chiếu</th>
                    <th>Giờ chiếu</th>
                    <th>Chỗ ngồi</th>
                </tr>
                <tr>
                    <td>{{$value->SuatChieu->ngaychieu}}</td>
                    <td>{{$value->SuatChieu->giobatdau}}</td>
                    <td>{{$value->tenghe}}</td>
                </tr>
            </table>
            <table>
                <tr>
                    <th>Phòng</th>
                    <th>Số lượng vé</th>
                    <th>Tổng tiền</th>
                </tr>
                <tr>
                    <td>{{$value->SuatChieu->PhongChieu->tenphong}}</td>
                    <td>{{$value->soluong}}</td>
                    <td>{{$value->giave}}</td>
                </tr>
            </table>
        </div>
        <!-- <div style="background-color: white;"> -->
        <div class="holes-lower"></div>
        <div class="serial">
            <br>
            <br>
            <br>
            <p class="fs-sm mb-2"style="text-align: center"> <img src="{{ env('APP_URL') . '/public/' . 'qrcodes'. $value->id . '.png' }}" alt="QR Code"></p>
        </div>
    </div>
    @endforeach
@endsection

@section('style')
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/css/e-ticket.css')}}">
    <link href="https://fonts.googleapis.com/css?family=Yanone+Kaffeesatz:400,700" rel="stylesheet">
    <style>
        .info {
    width: 100%; /* Đặt chiều rộng của phần tử .info */
    margin: 0 50px 20px; /* Đặt margin top và bottom là 0, left và right là auto để căn giữa phần tử */
}
.info table {
    margin-bottom: 20px; /* Khoảng cách dưới cùng giữa các bảng */
}
.info td,
.info th {
    padding-left: 10px; /* Khoảng cách dưới cùng giữa các hàng */
}

        </style>

@endsection