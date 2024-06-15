@extends('layouts.frontend')
@section('title', 'Bài viết')
@section('content')
    <div class="container mt-2 py-5">
        <div id='nz-div-4'>
            <h3 class="tde"> 
                <span>Bài viết</span> 
            </h3>
        </div>
    </div>
    <div class="container pb-5 mb-2 mb-md-4 wow fadeInUp" data-wow-delay="0.1s">
        <div class="pt-3 md-3">
            <div class="masonry-grid" data-columns="3">
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
                <div class="d-flex">    
                <div class="d-flex flex-wrap col-xl-8 mb">
                    @foreach($baiviet as $value)
                    @if($value->kiemduyet == 1)
                        <article class="fw-bold mb-3">
                            <div class="card" style="width: 850px; border: thin solid #ccc; border-radius: 10px; display: flex; flex-direction: row;">
                                <a class="blog-entry-thumb" href="{{ route('frontend.baiviet.chitiet', ['tenchude_slug' => $value->ChuDe->tenchude_slug, 'tieude_slug' => $value->tieude_slug . '-' . $value->id . '.html']) }}" style="flex-shrink: 0;">
                                    <img class="card-img-top" src="{{ LayHinhDauTien($value->noidung) }}" style="width: 250px; height: 250px; object-fit: cover; display: block;" />
                                </a>
                                <div class="card-body" style="padding: 15px; display: flex; flex-direction: column; justify-content: space-between;">
                                    <h2 class="h6 blog-entry-title fw-bold fs-5 arial">
                                        <a href="{{ route('frontend.baiviet.chitiet', ['tenchude_slug' => $value->ChuDe->tenchude_slug, 'tieude_slug' => $value->tieude_slug . '-' . $value->id . '.html']) }}">
                                            {{ $value->tieude }}
                                        </a>
                                    </h2>
                                    <p class="fs-sm" style="text-align: justify; font-size: 14px;">{{ $value->tomtat }}</p>
                                    <a class="btn-tag me-2 mb-2 fw-bold p-1" style="border: thin solid #ccc; border-radius: 10px; align-self: flex-start;" href="{{ route('frontend.baiviet.chude', ['tenchude_slug' => $value->ChuDe->tenchude_slug]) }}">#{{ $value->ChuDe->tenchude }}</a>
                                </div>
                            </div>
                        </article>
                    @endif
                    @endforeach
                    <div class="container mt-2"> {{$baiviet->links()}} </div>
                </div>

                    <div class="ms-4 col-xl-3">
                        <div class="row g-4 fruite">
                            <div class=" mx-5" style="border:thin solid #ccc; border-radius:10px">
                                <h4 class="text-center fw-bold mt-2 arial">Danh mục bài viết</h4>
                                <ul class="list-unstyled fruite-categorie">
                                <hr>
                                    <li>
                                        <div class="d-flex justify-content-between fruite-name">
                                            <a href="{{ route('frontend.baiviet.chude', ['tenchude_slug' => 'khuyen-mai' ]) }}"><i class="bi bi-newspaper me-2"></i>Khuyến mãi</a>  
                                        </div>
                                    </li>
                                    <li>
                                        <div class="d-flex justify-content-between fruite-name">
                                            <a href="{{ route('frontend.baiviet.chude', ['tenchude_slug' => 'su-kien' ]) }}"><i class="bi bi-newspaper me-2"></i>Sự kiện</a>    
                                        </div>
                                    </li>  
                                    <li>
                                        <div class="d-flex justify-content-between fruite-name">
                                            <a href="{{ route('frontend.baiviet.chude', ['tenchude_slug' => 'thong-cao-bao-chi' ]) }}"><i class="bi bi-newspaper me-2"></i>Thông cáo báo chí</a>    
                                        </div>
                                    </li>  
                                </ul>
                            </div>
                            <div class="mb-4 mx-5">
                                <img src="{{ asset('public/assets/images/datve.webp') }}" class="">
                            </div>
                        </div>        
                    </div>
                </div>
            </div>
        </div>  
        <hr class="mb-4">
        
    </div>

@endsection
@section('style')
<style>
#nz-div-4 h3.tde :after {
    content: "";
    width: 0;
    height: 0;
    border-top: 40px solid transparent;
    border-left: 20px solid #df0e62;
    border-bottom: 0px solid transparent;
    border-right: 0 solid transparent;
    position: absolute;
    top: 0px;
    right: -20px;
}
 
 
#nz-div-4 h3.tde :before {
    content: "";
    width: 0;
    height: 0;
    border-width: 40px 20px 0px 0px;
    border-style: solid;
    border-color: transparent;
    border-right-color: #df0e62;
    position: absolute;  
    top: 0px;
    left: -20px;
}
 
#nz-div-4 h3.tde span {
    background: #df0e62;
    padding: 10px 20px 8px 20px;
    color: white;
    position: relative;
    display: inline-block;
    margin: 0;
  
}
 
#nz-div-4 h3.tde {
    text-align: center;
    margin: 45px 0;
    border-bottom: 2px solid #df0e62;
    font-size: 16px;
    line-height: 20px;
    text-transform: uppercase;
}
</style>
@endsection