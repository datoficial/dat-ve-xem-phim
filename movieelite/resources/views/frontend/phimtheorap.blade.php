@extends('layouts.frontend')
@section('title', 'Trang chủ')
@section('content')
<div class="container" id="progress-container-id">
    <div class="row">
        <div class="col">
            <div class="px-0 pt-4 pb-0 mt-3 mb-3">
            <br>
            <br>
            <br>
            <div id='nz-div'>
                <h3 class="tde"><span class="null">Danh sách phim của rạp {{$rapchieu->tenrap}}</span></h3>
                <cite><i class="bi bi-geo-alt"></i> {{$rapchieu->diachi}}</cite>
            </div>
            <br>
                <div class="product-grid">
                @foreach($phim as $p)
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
                                        @if (!empty($thoiluong))
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
                </div>
            </div>
        </div>
    </div>
<div class="swiper-container" style="background-color: var(--theme-bg);">
	<h1 id="swiper-container-h1">Danh sách rạp chiếu nổi bật</h1>
	<div class="swiper-wrapper">
		<div class="swiper-slide">
			<div class="imgBx">
				<img src="{{ asset('public/assets/images/galaxy.jpg')}}" style="width :100%; height: 100%">
			</div>
			<div class="details">
				<h3 id="details-h3-1">Galaxy Long Xuyên<br></h3>
				<div class="p-sm">
                <a href="https://www.facebook.com/galaxylongxuyen/"><i class="fa fa-facebook"></i></a>
                <a href="https://www.instagram.com/sharvil551/"><i class="fa fa-instagram"></i></a>
                <a href="https://www.galaxycine.vn/rap-gia-ve/galaxy-long-xuyen/"><i class="fa fa-google-plus"> </i></a>
				</div>
			</div>
		</div>
		<div class="swiper-slide">
			<div class="imgBx">
				<img src="{{ asset('public/assets/images/lottelx.jpg')}}" style="width :100%; height: 100%">
			</div>
			<div class="details">
				<h3 id="details-h3-2">Lotte Long Xuyên<br></h3>
				<div class="p-sm">
                <a href="https://www.facebook.com/lottecinemalongxuyen"><i class="fa fa-facebook"></i></a>
                <a href="#"><i class="fa fa-instagram"></i></a>
                <a href="#google"><i class="fa fa-google-plus"> </i></a>
				</div>
			</div>
		</div>
		<div class="swiper-slide">
			<div class="imgBx">
				<img src="{{ asset('public/assets/images/cgv.jpg')}}" style="width :100%; height: 100%">
			</div>
			<div class="details">
				<h3 id="details-h3-3">CGV Cao Lãnh<br></h3>
				<div class="p-sm">
                <a href="https://www.facebook.com/cgvcinemadongthap"><i class="fa fa-facebook"></i></a>
                <a href="#"><i class="fa fa-instagram"></i></a>
                <a href="#google"><i class="fa fa-google-plus"> </i></a>
				</div>
			</div>
		</div>
		<div class="swiper-slide">
			<div class="imgBx">
				<img src="{{ asset('public/assets/images/lottect.jpg')}}" style="width :100%; height: 100%">
			</div>
			<div class="details">
				<h3 id="details-h3-4">Lotte Cinema Ninh Kiều<br></h3>
				<div class="p-sm">
                <a href="https://www.facebook.com/LotteCinemaNinhKieu"><i class="fa fa-facebook"></i></a>
                <a href="#"><i class="fa fa-instagram"></i></a>
                <a href="#google"><i class="fa fa-google-plus"> </i></a>
				</div>
			</div>
		</div>

	</div>
	<!-- Add Pagination -->
	<div class="swiper-pagination"></div>
</div>
</div>
@endsection

@section('style')
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://npmcdn.com/flickity@2/dist/flickity.css">
  <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/css/progress.css')}}">

  <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/css/ticket-booking.css')}}">

  <!-- ..............For progress-bar............... -->
  <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/css/e-ticket.css')}}">

  <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/css/payment.css')}}" />
  <link href="https://fonts.googleapis.com/css?family=Yanone+Kaffeesatz:400,700" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/css/swiper.min.css')}}">

<link href="//fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,600;0,700;1,600&display=swap"
    rel="stylesheet">

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
                text-transform: uppercase;
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
@section('javascript')
<script src="{{asset('public/assets/js/jquery-3.3.1.min.js')}}"></script>
<!-- stats -->
<script src="{{asset('public/assets/js/jquery.waypoints.min.js')}}"></script>
<script src="{{asset('public/assets/js/jquery.countup.js')}}"></script>
<script src="{{asset('public/assets/js/swiper.min.js')}}"></script>
<script>
	const toggleSwitch = document.querySelector('.theme-switch input[type="checkbox"]');
	const currentTheme = localStorage.getItem('theme');

	if (currentTheme) {
		document.documentElement.setAttribute('data-theme', currentTheme);

		switchTextColor(currentTheme);

		if (currentTheme === 'dark') {
			toggleSwitch.checked = true;
		}
	}

	function switchTextColor(currTheme) {

		if (currTheme === 'light') {
			document.getElementById("swiper-container-h1").style.color = 'black';
			document.getElementById("details-h3-1").style.color = 'black';
			document.getElementById("details-h3-2").style.color = 'black';
			document.getElementById("details-h3-3").style.color = 'black';
			document.getElementById("details-h3-4").style.color = 'black';
			document.getElementById("details-h3-5").style.color = 'black';
			document.getElementById("details-h3-6").style.color = 'black';
		} else {
			document.getElementById("swiper-container-h1").style.color = 'white';
			document.getElementById("details-h3-1").style.color = 'white';
			document.getElementById("details-h3-2").style.color = 'white';
			document.getElementById("details-h3-3").style.color = 'white';
			document.getElementById("details-h3-4").style.color = 'white';
			document.getElementById("details-h3-5").style.color = 'white';
			document.getElementById("details-h3-6").style.color = 'white';
		}
	}
	toggleSwitch.addEventListener('change', switchTheme, false);
</script>

<script>
	var swiper = new Swiper('.swiper-container', {
		effect: 'coverflow',
		grabCursor: true,
		centeredSlides: true,
		slidesPerView: 'auto',
		coverflowEffect: {
			rotate: 50,
			stretch: 0,
			depth: 100,
			modifier: 1,
			slideShadows: true,
		},
		pagination: {
			el: '.swiper-pagination',
		},
	});
</script>
<script>
	$(document).ready(function () {
		$('.owl-three').owlCarousel({
			loop: true,
			margin: 20,
			nav: false,
			responsiveClass: true,
			autoplay: true,
			autoplayTimeout: 5000,
			autoplaySpeed: 1000,
			autoplayHoverPause: false,
			responsive: {
				0: {
					items: 2,
					nav: false
				},
				480: {
					items: 2,
					nav: true
				},
				667: {
					items: 3,
					nav: true
				},
				1000: {
					items: 6,
					nav: true
				}
			}
		})
	})
</script>
<!-- for tesimonials carousel slider -->
<script>
	$(document).ready(function () {
		$(".owl-clients").owlCarousel({
			loop: true,
			margin: 40,
			responsiveClass: true,
			responsive: {
				0: {
					items: 1,
					nav: true
				},
				736: {
					items: 2,
					nav: false
				},
				1000: {
					items: 3,
					nav: true,
					loop: false
				}
			}
		})
	})
</script>
@endsection