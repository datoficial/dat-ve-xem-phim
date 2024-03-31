@extends('layouts.frontend')
@section('title', 'Trang chủ')
@section('content')
	<section class="w3l-main-slider position-relative" id="home">
		<div class="companies20-content">
			<div class="owl-one owl-carousel owl-theme">
				@php $index = 1 @endphp 
				@foreach($theloaiphim as $value)
					@foreach($value->Phim->take(3) as $p)
						@php 
							$banner_url = env('APP_URL') . '/storage/app/' . $p->hinhanh; 
						@endphp
						<div class="item">
							<div class="slider-info banner-view bg bg2" style="background-image: url('{{ $banner_url }}');">
								<div class="banner-info">
									<h3>Trailer {{ $p->tenphim }}</h3>
									<p><span class="over-para">{{ $p->mota }}</span></p>
										<a href="#small-dialog{{$index}}" class="popup-with-zoom-anim play-view1">
											<span class="video-play-icon">
												<span class="fa fa-play"></span>
											</span>
											<h6>Xem Trailer</h6>
										</a>
										<div id="small-dialog{{$index}}" class="zoom-anim-dialog mfp-hide">
											<iframe src="{{ $p->trailler }}" allow="autoplay; fullscreen" allowfullscreen=""></iframe>
										</div>
								</div>
							</div>
						</div>
						@php 
							$index++; 
							if ($index > 3) break 2; 
						@endphp 
					@endforeach
				@endforeach
			</div>
		</div>
</section>

@foreach($theloaiphim as $value)
    @if($value->tenloai_slug == 'phim-hot')
        <section class="w3l-grids">
            <div class="grids-main py-5">
                <div class="container py-lg-3">
                    <div class="headerhny-title">
                        <div class="w3l-title-grids">
                            <div class="headerhny-left">
                                <h3 class="hny-title">{{ $value->tenloai }}</h3>
                            </div>
                            <div class="headerhny-right text-lg-right">
                                <h4><a class="show-title" href="{{ route('frontend.home') }}">Xem tất cả</a></h4>
                            </div>
                        </div>
                    </div>
                    <div class="owl-three owl-carousel owl-theme">
                        <div class="item vhny-grid">
							@foreach($value->Phim as $p)
                            <div class="box16 mb-0">
                                    <a href="{{ route('datve.chonsuatchieu',['phim_id' => $p->id]) }}">
                                        <figure>
                                            <img class="img-fluid" src="{{ env('APP_URL') . '/storage/app/' . $p->hinhanh }}" alt="">
                                        </figure>
                                        <div class="box-content">
                                            @foreach($p->SuatChieu as $sc)
                                                <h4>
                                                    <span class="post">
                                                        <span class="fa fa-clock-o"></span>
                                                        @php
                                                            $batdau = \Carbon\Carbon::createFromTimeString($sc->giobatdau);
                                                            $ketthuc = \Carbon\Carbon::createFromTimeString($sc->gioketthuc);
                                                            $thoiluong = $batdau->diffInMinutes($ketthuc);
                                                        @endphp
                                                        {{ $thoiluong }} phút
                                                    </span>
                                                    <span class="post fa fa-heart text-right"></span>
                                                </h4>
                                            @endforeach
                                        </div>
                                        <span class="fa fa-play video-icon" aria-hidden="true"></span>
                                    </a>
                                </div>
                                <h3><a class="title-gd" href="{{ route('datve.chonsuatchieu',['phim_id' => $p->id]) }}">{{ $p->tenphim }}</a></h3>
								@php
								if (!function_exists('str_limit_words')) {
									function str_limit_words($string, $limit = 20, $end = '...') {
										$words = explode(' ', $string);
										if (count($words) <= $limit) {
											return $string;
										}
										return implode(' ', array_slice($words, 0, $limit)) . $end;
									}
								}
								@endphp
                                <p>{{ str_limit_words($p->mota, 20) }}</p>
                                <div class="button-center text-center mt-4">
                                    <a href="{{ route('datve.chonsuatchieu',['phim_id' => $p->id]) }}" class="btn watch-button">Đặt vé ngay</a>
                                </div>
                            </div>
						@endforeach
                    </div>
                </div>
            </div>
        </section>
    @endif
@endforeach

	<!-- main-slider -->
	<!--grids-sec1-->
	@foreach($theloaiphim as $value)
	@if($value->tenloai_slug !== 'phim-hot')
	<section class="w3l-grids">
		<div class="grids-main py-5">
			<div class="container py-lg-3">
				<div class="headerhny-title">
					<div class="w3l-title-grids">
						<div class="headerhny-left">
							<h3 class="hny-title">{{ $value->tenloai }}</h3>
						</div>
						<div class="headerhny-right text-lg-right">
							<h4><a class="show-title" href="{{ route('datve.chonsuatchieu',['phim_id' => $p->id]) }}">Xem tất cả</a></h4>
						</div>
					</div>
				</div>
	    <div class="product-grid">

            @foreach($value->Phim->take(6) as $p)
                @php
                    $thoiluong = ''; // Reset thời lượng cho mỗi bộ phim
                    if(count($p->SuatChieu) > 0) { // Kiểm tra nếu có suất chiếu của bộ phim
                        $sc = $p->SuatChieu[0];
                        $batdau = \Carbon\Carbon::createFromTimeString($sc->giobatdau);
                        $ketthuc = \Carbon\Carbon::createFromTimeString($sc->gioketthuc);
                        $thoiluong = $batdau->diffInMinutes($ketthuc) . ' phút'; // Lưu trữ thời lượng của bộ phim
                    }
                @endphp

                <div class="product-item">
                    <a href="{{ route('datve.chonsuatchieu',['phim_id' => $p->id]) }}">
                        <div class="product-image">
                            <img class="product-image" src="{{ env('APP_URL') . '/storage/app/' . $p->hinhanh }}" alt="{{ $p->tenphim }}">
                        </div>
                        <div class="product-details">
                            <h3 class="product-title">{{ $p->tenphim }}</h3>
                            <div class="showtimes">
                                @if(!empty($thoiluong)) <!-- Kiểm tra nếu có thời lượng -->
                                    <div class="showtime">
                                        <span class="start-time">
                                            <i class="fa fa-clock-o"></i>       
                                            {{ $thoiluong }}
                                        </span>
                                        <span class="like-icon">
                                            <i class="fa fa-heart"></i>
                                        </span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach



            </div>
			</div>
		</div>
	</section>
	@endif
@endforeach


@endsection