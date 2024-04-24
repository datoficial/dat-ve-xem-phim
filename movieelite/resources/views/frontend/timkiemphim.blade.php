@extends('layouts.frontend')
@section('title', 'Trang chủ')
@section('content')
	<section class="w3l-grids">
		<div class="grids-main py-5">
        <div class="container py-lg-5 pt-12">
                <div id='nz-div'>
                <h3 class="tde"><span class="null">Danh sách phim của từ khóa "{{$searchTerm}}"</span></h3>
                </div>
        @if ($phim->isEmpty())
        <div class="row justify-content-center pt-lg-4 text-center">
				<div class="col-lg-5 col-md-7 col-sm-9">
                <img src="{{ asset('public/assets/images/khongtimthay.png')}}" width="600px" height="350px"/>
					<h2 class="h3 mb-4"></h2>
					<h2 class="h3 mb-4"></h2>
					<h3 class="h5 fw-normal mb-4"></h3>
					<p class="fs-md mb-4">
						<u>Dưới đây là một số liên kết gợi ý:</u>
					</p>
				</div>
		</div>
        <div class="row justify-content-center">
				<div class="col-xl-8 col-lg-10">
					<div class="row">
						<div class="col-md-4 mb-3">
							<a class="card h-100 border-0 shadow-sm" href="{{ route('frontend.home') }}">
								<div class="card-body">
									<div class="d-flex align-items-center">
										<div class="ps-3">
											<h5 class="fs-sm mb-0">Trang chủ</h5>
											<span class="text-muted fs-ms">Quay lại trang chủ</span>
										</div>
									</div>
								</div>
							</a>
						</div>
						<div class="col-md-4 mb-3">
							<a class="card h-100 border-0 shadow-sm" href="{{route('frontend.baiviet')}}">
								<div class="card-body">
									<div class="d-flex align-items-center">
										<div class="ps-3">
											<h5 class="fs-sm mb-0">Tin tức</h5>
											<span class="text-muted fs-ms">Truy cập trang tin phim</span>
										</div>
									</div>
								</div>
							</a>
						</div>
                        <div class="col-md-4 mb-3">
						<a class="card h-100 border-0 shadow-sm" href="{{route('frontend.lienhe')}}">
								<div class="card-body">
									<div class="d-flex align-items-center">
										<div class="ps-3">
											<h5 class="fs-sm mb-0">Liên hệ</h5>
											<span class="text-muted fs-ms">Truy cập trang liên hệ</span>
										</div>
									</div>
								</div>
							</a>
						</div>
					</div>
				</div>
			</div>
        @else
	    <div class="product-grid">
        @foreach ($phim as $p)
                @php
                    $thoiluong = ''; // Reset thời lượng cho mỗi bộ phim
                    if(count($p->SuatChieu) > 0) { // Kiểm tra nếu có suất chiếu của bộ phim
                        $sc = $p->SuatChieu[0];
                        $batdau = \Carbon\Carbon::createFromTimeString($sc->giobatdau);
                        $ketthuc = \Carbon\Carbon::createFromTimeString($sc->gioketthuc);
                        $thoiluong = $batdau->diffInMinutes($ketthuc) . ' phút'; 
                    }
                @endphp
                <div class="product-item">
                    <a href="{{ route('booking.datve', ['phim_id' => $p->id]) }}">
                        <div class="product-image">
                            <img class="product-image" src="{{ env('APP_URL') . '/storage/app/' . $p->hinhanh }}" alt="{{ $p->tenphim }}">
                        </div>
                        <div class="product-details">
                            <h3 class="product-title">{{ $p->tenphim }}</h3>
                            <div class="showtimes">
                                @if(!empty($thoiluong))
                                    <div class="showtime">
                                        <span class="start-time">
                                            <i class="fa fa-clock-o"></i>       
                                            {{ $thoiluong }}
                                        </span>
                                        <span class="like-icon">
                                            <a href="{{ route('frontend.baiviet.phim', ['phim_id' => $p->id]) }}"> Chi tiết</a>
                                        </span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
            @endif
            </div>
			</div>
		</div>
	</section>
@endsection
@section('style')
<style>
            div#nz-div {
                border-bottom: 2px solid red;
                margin-bottom: 40px;
                display: block;
                position: relative;
            }

            #nz-div h3.tde {
                margin: 0;
                font-size: 16px;
                line-height: 20px;
                display: inline-block;
                position: relative;
                margin-right: 200px; 
            }

            #nz-div h3.tde:after {
                content: "";
                width: 0;
                height: 0;
                border-top: 40px solid transparent;
                border-left: 20px solid #EA3A3C;
                border-bottom: 0px solid transparent;
                border-right: 0 solid transparent;
                position: absolute;
                top: 0px;
                right: -20px;
            }

            #nz-div h3.tde span {
                background: #EA3A3C;
                padding: 10px 20px 8px 20px;
                color: white;
                position: relative;
                display: inline-block;
                margin: 0;
            }

            #nz-div h3.tde cite {
                position: absolute;
                top: 0;
                right: 0;
                margin: 0;
                color: white;
                line-height: 20px;
            }
        </style>
@endsection
