@extends('layouts.frontend')
@section('title', 'Hoàn tất đặt vé')

@section('content')
<div class="content-wrapper"> <!-- Wrapper cho nội dung -->
    <div class="container pb-5 mb-sm-4" style="margin-top: 100px;">
        <div class="pt-5">
            <div class="card py-3 mt-sm-3">
                <div class="card-body text-center">
                    <h2 class="h4 pb-3">Cảm ơn bạn đã đặt vé!</h2>
					<p class="fs-sm mb-2">Vé của bạn đã được đặt.</p>
					<p class="fs-sm">Giờ đây bạn có thể đến rạp và tận hưởng những giây phút giải trí!</p>
                    <a class="btn btn-danger mt-3 me-3" href="{{ route('frontend.home') }}"><i class="ci-cart me-2"></i>Tiếp tục đặt vé</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
