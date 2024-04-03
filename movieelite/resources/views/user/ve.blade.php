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
        <div class="info">
            <table>
                <tr>
                    <th>SCREEN</th>
                    <th>ROW</th>
                    <th>SEAT</th>
                </tr>
                <tr>
                    <td class="bigger">18</td>
                    <td class="bigger">H</td>
                    <td class="bigger">24</td>
                </tr>
            </table>
            <table>
                <tr>
                    <th>PRICE</th>
                    <th>DATE</th>
                    <th>TIME</th>
                </tr>
                <tr>
                    <td>Rs. 12.00</td>
                    <td>4/13/21</td>
                    <td>19:30</td>
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

@endsection