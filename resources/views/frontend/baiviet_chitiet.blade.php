@extends('layouts.frontend')
@section('title', $baiviet->tieude)
@section('content')
<div class="mt-5 pt-5">
    <div class="bg-secondary py-4">
        <div class="container d-lg-flex justify-content-between">
            <div class="order-lg-2 mb-3 mb-lg-0 pt-lg-2">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb flex-lg-nowrap justify-content-center justify-content-lg-start">
                        <li class="breadcrumb-item" style="margin-right:10px">
                            <a class="text-nowrap" href="{{ route('frontend.home') }}">Trang chủ</a>
                        </li>
                        <i class="bi bi-chevron-double-right"></i>
                        <li style="margin-left:10px; margin-right:10px">
                            <a href="{{ route('frontend.baiviet') }}">Tin tức</a>
                        </li>
                        <i class="bi bi-chevron-double-right"></i>
                        <li style="margin-left:10px" aria-current="page">Chi tiết</li>
                    </ol>
                </nav>
            </div>
            <div class="order-lg-1 pe-lg-4 text-center text-lg-start">
                <h1 class="h3 mb-0">{{ $baiviet->tieude }}</h1>
            </div>
        </div>
    </div>
</div>
    <div class="container pb-5">
        <div class="row justify-content-center pt-3 mt-md-3">
            <div class="col-12">
                <div class="d-flex flex-wrap justify-content-between align-items-center pb-4 mt-n1">
                    <div class="d-flex align-items-center fs-sm mb-2">
                        <a class="blog-entry-meta-link" href="#user">
                            <div class="blog-entry-author-ava">
                                <img src="{{ asset('public/assets/images/avatar.jpg') }}" />
                            </div>
                            {{ $baiviet->User->name }}
                        </a>
                        <span class="blog-entry-meta-divider"></span>
                        <a class="blog-entry-meta-link" href="#date">
                            {{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $baiviet->created_at)->format('d/m/Y') }}
                        </a>
                    </div>
                    <div class="fs-sm mb-2">
                        <a class="blog-entry-meta-link text-nowrap" href="#view" data-scroll>
                            <i class="bi bi-eye"></i>{{ $baiviet->luotxem }}
                        </a>
                    </div>
                </div>
                <p style="text-align:justify" class="fw-bold">{{ $baiviet->tomtat }}</p>
                <p style="text-align:justify">{!! $baiviet->noidung !!}</p>
                <div class="d-flex flex-wrap justify-content-between pt-2 pb-4 mb-1">
                    <div class="mt-3 me-3">
                        <a class="btn-tag mb-2" href="#">#{{ $baiviet->ChuDe->tenchude_slug }}</a>
                    </div>
                </div>
                <!-- Comments-->
                <div class="pt-2 mt-5" id="comments">
                    <h2 class="h4">Bình luận
                        <span class="badge bg-secondary fs-sm text-body align-middle ms-2">{{ $baiviet->BinhLuan->count() }}</span>
                    </h2>
                    @foreach($baiviet->BinhLuan as $value)
                        <div class="d-flex align-items-start py-4">
                            <img class="rounded-circle" src="{{ asset('public/assets/images/avatar.jpg') }}" width="50" />
                            <div class="ps-3">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <h6 class="fs-md mb-0">{{ $value->User->name }}</h6>
                                </div>
                                <p class="fs-md mb-1" style="text-align:justify">{{ $value->noidungbinhluan }}</p>
                                <span class="fs-ms text-muted">
                                    {{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $value->created_at)->format('d/m/Y') }}
                                </span>
                            </div>
                        </div>
                    @endforeach
                    <div class="card border-0 shadow mt-2 mb-4">
                        <div class="card-body">
                            <div class="d-flex align-items-start">
                                <img class="rounded-circle" src="{{ asset('public/assets/images/avatar.jpg') }}" width="50" />
                                <form class="w-100 needs-validation ms-3" method="post" action="{{ route('user.binhluan') }}">
                                    @csrf  
                                    <div class="mb-3">
                                        <input type="hidden" name="baiviet_id" id="baiviet_id" value="{{ $baiviet->id}}">
                                        <textarea class="form-control" rows="3" placeholder="Chia sẻ ý kiến của bạn...(tối thiểu 20 ký tự)" name="noidungbinhluan" id="noidungbinhluan"  ></textarea>
                                        @guest
                                            <div class="invalid-feedback">Bạn phải đăng nhập để chia sẻ bình luận.</div>
                                        @else
                                            <div class="invalid-feedback">Nội dung bình luận không được bỏ trống.</div>
                                        @endguest
                                    </div>
                                    <button class="btn btn-primary btn-sm" type="submit">Đăng bình luận</button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-light">
        <div class="container py-2">
            <h2 class="h4 text-center text-dark mb-3 arial fw-bold">Bài viết cùng chuyên mục</h2>
            <div class="d-flex justify-content-end mb-2">
                <button id="prevButton" class="btn btn-primary rounded-pill text-white py-2 mb-1 mt-3 me-4"><i class="bi bi-arrow-left"></i></button>
                <button id="nextButton" class="btn btn-primary rounded-pill text-white py-2 mb-1 mt-3"><i class="bi bi-arrow-right"></i></button>
            </div>   
            @php
                    function LayHinhDauTien($strNoiDung)
                    {
                        $first_img = '';
                        ob_start();
                        ob_end_clean();
                        $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $strNoiDung, $matches);
                        if(empty($output))
                            return asset('public/frontend/img/baiviet.jpg');
                        else
                            return str_replace('&amp;', '&', $matches[1][0]);
                    }
                @endphp
                <div class="row blog">              
                    @foreach($baivietcungchuyenmuc as $value)
                        <div class="col-md-6 col-lg-6 col-xl-3 " data-wow-delay="0.1s">
                            <div class="blog-item rounded border">
                                <a href="{{ route('frontend.baiviet.chitiet', ['tenchude_slug' => $value->ChuDe->tenchude_slug, 'tieude_slug' => $value->tieude_slug . '-' . $value->id . '.html']) }}">
                                    <div class="blog-img">
                                        <img src="{{ LayHinhDauTien($value->noidung) }}" class="img-fluid w-100" alt="Image">
                                    </div>
                                </a>
                                <div class="blog-centent p-4">
                                    <div class="d-flex justify-content-between mb-4">
                                        <p class="mb-0 text-muted"><i class="fa fa-calendar-alt text-primary"></i> {{ \Illuminate\Support\Carbon::parse($value->created_at)->format('d/m/Y H:i:s') }}</p>
                                        <p><span class="fa fa-comments text-primary"></span> {{ $value->BinhLuan->count() }}</p>
                                    </div>
                                    <a class="text-center" href="{{ route('frontend.baiviet.chude', ['tenchude_slug' => $value->ChuDe->tenchude_slug]) }}">#{{ $value->ChuDe->tenchude }}</a></br>
                                    <a href="{{ route('frontend.baiviet.chitiet', ['tenchude_slug' => $value->ChuDe->tenchude_slug, 'tieude_slug' => $value->tieude_slug . '-' . $value->id . '.html']) }}" class="h4 arial">{{ $value->tieude }}</a>
                                    <hr>
                                    <a href="{{ route('frontend.baiviet.chitiet', ['tenchude_slug' => $value->ChuDe->tenchude_slug, 'tieude_slug' => $value->tieude_slug . '-' . $value->id . '.html']) }}" class="btn btn-primary rounded-pill text-white py-2 mb-1 mt-3">Xem chi tiết</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
<script>
    // Khai báo biến để theo dõi vị trí hiện tại của danh sách bài viết
    var currentIndex = 0;
    
    // Lấy danh sách các bài viết
    var blogItems = $(".blog-item");
    var numItems = blogItems.length;

    // Ẩn tất cả các bài viết ngoại trừ 4 cái đầu tiên
    blogItems.slice(4).hide();

    // Xử lý sự kiện khi nhấn nút "Next"
    $("#nextButton").click(function() {
        // Ẩn tất cả các bài viết hiện tại
        blogItems.slice(currentIndex, currentIndex + 4).hide();

        // Tăng vị trí hiện tại
        currentIndex += 4;

        // Nếu vị trí hiện tại vượt quá số lượng bài viết, quay lại bài viết đầu tiên
        if (currentIndex >= numItems) {
            currentIndex = 0;
        }

        // Hiển thị 4 bài viết tiếp theo
        blogItems.slice(currentIndex, currentIndex + 4).show();
    });

    // Xử lý sự kiện khi nhấn nút "Previous"
    $("#prevButton").click(function() {
    // Kiểm tra nếu vị trí hiện tại không phải là 0
    if (currentIndex > 0) {
        // Giảm vị trí hiện tại
        currentIndex -= 4;

        // Ẩn tất cả các bài viết hiện tại
        blogItems.hide();

        // Hiển thị 4 bài viết trước đó
        blogItems.slice(currentIndex, currentIndex + 4).show();
    }
});
</script>
@endsection
