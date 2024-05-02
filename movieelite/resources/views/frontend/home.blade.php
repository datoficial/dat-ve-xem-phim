@extends('layouts.frontend')
@section('title', 'Trang chủ')
@section('content')
<section class="w3l-main-slider position-relative" id="home">
		<div class="companies20-content">
			<div class="owl-one owl-carousel owl-theme">
				@php $index = 1 @endphp 
				@foreach($theloaiphim as $value)
					@foreach($value->Phim as $p)
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
							if ($index > 4) break 2; 
						@endphp 
					@endforeach
				@endforeach
			</div>
		</div>
</section>


	<!-- main-slider -->
	<!--grids-sec1-->
	@foreach($theloaiphim as $value)

	<section class="w3l-grids">
		<div class="grids-main py-5">
			<div class="container py-lg-3">
				<div class="headerhny-title">
					<div class="w3l-title-grids">
						<div class="headerhny-left">
							<h3 class="hny-title">{{ $value->tenloai }}</h3>
						</div>
						<div class="headerhny-right text-lg-right">
							<h4><a class="show-title" href="{{ route('frontend.phim.theoloai', ['tenloai_slug' => $value->tenloai_slug]) }}">Xem tất cả</a></h4>
						</div>
					</div>
				</div>
	    <div class="product-grid">

            @foreach($value->Phim->take(5) as $p)
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
            </div>
			</div>
		</div>
	</section>

@endforeach
@endsection
@section('javascript')
<script type="text/javascript">
        $(document).ready(function () {
            //Horizontal Tab
            $('#parentHorizontalTab').easyResponsiveTabs({
                type: 'default', //Types: default, vertical, accordion
                width: 'auto', //auto or any width like 600px
                fit: true, // 100% fit in a container
                tabidentify: 'hor_1', // The tab groups identifier
                activate: function (event) { // Callback function if tab is switched
                    var $tab = $(this);
                    var $info = $('#nested-tabInfo');
                    var $name = $('span', $info);
                    $name.text($tab.text());
                    $info.show();
                }
            });
        });
    </script>
    <!--/theme-change-->
    <script src="{{ asset('public/assets/js/theme-change.js') }}"></script>
    <script src="{{ asset('public/assets/js/owl.carousel.js') }}"></script>
    <!-- script for banner slider-->
    <script>
        $(document).ready(function () {
            $('.owl-one').owlCarousel({
                stagePadding: 280,
                loop: true,
                margin: 20,
                nav: true,
                responsiveClass: true,
                autoplay: true,
                autoplayTimeout: 5000,
                autoplaySpeed: 1000,
                autoplayHoverPause: false,
                responsive: {
                    0: {
                        items: 1,
                        stagePadding: 40,
                        nav: false
                    },
                    480: {
                        items: 1,
                        stagePadding: 60,
                        nav: true
                    },
                    667: {
                        items: 1,
                        stagePadding: 80,
                        nav: true
                    },
                    1000: {
                        items: 1,
                        nav: true
                    }
                }
            })
        })
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
                        items: 5,
                        nav: true
                    }
                }
            })
        })
    </script>
    <script>
        $(document).ready(function () {
            $('.owl-mid').owlCarousel({
                loop: true,
                margin: 0,
                nav: false,
                responsiveClass: true,
                autoplay: true,
                autoplayTimeout: 5000,
                autoplaySpeed: 1000,
                autoplayHoverPause: false,
                responsive: {
                    0: {
                        items: 1,
                        nav: false
                    },
                    480: {
                        items: 1,
                        nav: false
                    },
                    667: {
                        items: 1,
                        nav: true
                    },
                    1000: {
                        items: 1,
                        nav: true
                    }
                }
            })
        })
    </script>
    <!-- script for owlcarousel -->
    <script src="{{ asset('public/assets/js/jquery.magnific-popup.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('.popup-with-zoom-anim').magnificPopup({
                type: 'inline',

                fixedContentPos: false,
                fixedBgPos: true,

                overflowY: 'auto',

                closeBtnInside: true,
                preloader: false,

                midClick: true,
                removalDelay: 300,
                mainClass: 'my-mfp-zoom-in'
            });

            $('.popup-with-move-anim').magnificPopup({
                type: 'inline',

                fixedContentPos: false,
                fixedBgPos: true,

                overflowY: 'auto',

                closeBtnInside: true,
                preloader: false,

                midClick: true,
                removalDelay: 300,
                mainClass: 'my-mfp-slide-bottom'
            });
        });
    </script>
    <!-- disable body scroll which navbar is in active -->
    <script>
        $(function () {
            $('.navbar-toggler').click(function () {
                $('body').toggleClass('noscroll');
            })
        });
    </script>
    <!-- disable body scroll which navbar is in active -->

    <!--/MENU-JS-->
    <script>
        $(window).on("scroll", function () {
            var scroll = $(window).scrollTop();

            if (scroll >= 80) {
                $("#site-header").addClass("nav-fixed");
            } else {
                $("#site-header").removeClass("nav-fixed");
            }
        });

        //Main navigation Active Class Add Remove
        $(".navbar-toggler").on("click", function () {
            $("header").toggleClass("active");
        });
        $(document).on("ready", function () {
            if ($(window).width() > 991) {
                $("header").removeClass("active");
            }
            $(window).on("resize", function () {
                if ($(window).width() > 991) {
                    $("header").removeClass("active");
                }
            });
        });
    </script>
@endsection