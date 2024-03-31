@extends('layouts.frontend')
@section('title', 'Trang chủ')
@section('content')
<!-- Chọn lịch chiếu -->
  <div class="container" id="progress-container-id">
    <div class="row">
      <div class="col">
        <div class="px-0 pt-4 pb-0 mt-3 mb-3">
          <form id="form" method="post" action="{{ route('datve.chonghe', ['phim_id' => $phim_id]) }}" class="needs-validation" novalidate>
            @csrf
            <ul id="progressbar" class="progressbar-class">
              <li class="active" id="step1">Chọn lịch chiếu</li>
              <li id="step2" class="not_active">Chọn ghế ngồi</li>
              <li id="step3" class="not_active">Thanh Toán</li>
              <li id="step4" class="not_active">Xem vé</li>

            </ul>
            <br>
            <fieldset>
                <div id="screen-select-div">
                    <h2>Chọn ngày chiếu</h2>
                    <div class="carousel carousel-nav" data-flickity='{"contain": true, "pageDots": false }'>
                        @php
                            $ngaychieu_da_xuat_hien = []; // Mảng để lưu trữ các ngày chiếu đã xuất hiện
                        @endphp
                        @foreach($suatchieu->sortBy('ngaychieu') as $sc)
                        @php
                            $ngaychieu = $sc->ngaychieu;
                            $today = \Carbon\Carbon::today()->toDateString(); // Lấy ngày hôm nay dưới dạng chuỗi YYYY-MM-DD
                        @endphp

                        @if ($ngaychieu >= $today && !in_array($ngaychieu, $ngaychieu_da_xuat_hien))
                            @php
                                $ngaychieu_da_xuat_hien[] = $ngaychieu; 
                            @endphp
                            <div class="carousel-cell" style="background-color: {{ $ngaychieu == $today ? '#df0e62' : 'rgb(243, 235, 235)' }};" id="{{ $sc->id }}" data-ngaychieu="{{ $ngaychieu }}" onclick="selectDate('{{ $ngaychieu }}')">
                                <div class="date-numeric">{{ $ngaychieu }}</div>
                                <div class="date-day">{{ $ngaychieu == $today ? 'Today' : '' }}</div>
                                <!-- Hiển thị tên phòng chiếu -->
                            </div>
                        @endif
                        <input type="hidden" id="phim_id" name="phim_id" value="{{ $sc->phim_id }}">
                       <input type="hidden" id="ngaychieu" name="ngaychieu" value="">
                    @endforeach
                    </div>
                    <div class="screens">
                        Phòng chiếu
                        {{$sc->PhongChieu->$tenphong}}
                    </div>
                    <div class="screens">
                        Giờ chiếu
                    </div>
                    <ul id="time-list" class="time-ul">
                        <!-- Giờ chiếu sẽ được thêm vào đây sau khi người dùng chọn ngày -->
                    </ul>
                    <input type="hidden" id="giobatdau" name="giobatdau" value="">
                    <input id="screen-next-btn" type="button" name="next-step" class="next-step" value="Tiếp tục" disabled />
                </div>
                </form>
            </fieldset>
            <!-- Chọn ghế ngồi -->
        </div>
      </div>
    </div>
  </div>
@endsection






@section('style')
  <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/css/style-starter.css') }}">
  <link rel="stylesheet" href="https://npmcdn.com/flickity@2/dist/flickity.css">
  <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/css/progress.css') }}">

  <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/css/ticket-booking.css') }}">

  <!-- ..............For progress-bar............... -->
  <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/css/e-ticket.css') }}">

  <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/css/payment.css') }}" />
  <link href="https://fonts.googleapis.com/css?family=Yanone+Kaffeesatz:400,700" rel="stylesheet">
@endsection
@section('javascript')
<script>
  let prevId = "1";

  window.onload = function () {
    document.getElementById("screen-next-btn").disabled = true;
  }

  function timeFunction() {
    document.getElementById("screen-next-btn").disabled = false;
  }

  function myFunction(id) {
    document.getElementById(prevId).style.background = "rgb(243, 235, 235)";
    document.getElementById(id).style.background = "#df0e62";
    prevId = id;
  }
  document.getElementById("form").addEventListener("submit", function(event) {
    event.preventDefault(); 
});

</script>
  <script>
    $(document).ready(function() {
        $('#screen-next-btn').click(function() {
            // Chuyển hướng đến trang datve.chonghe khi nhấn nút "Tiếp tục"
            window.location.href = "{{ route('datve.chonghe', ['phim_id' => $phim_id]) }}";
        });
    });
</script>

<script src="https://npmcdn.com/flickity@2/dist/flickity.pkgd.js"></script>
<script type="text/javascript" src='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js'>
</script>
<script type="text/javascript" src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
<script>
    function selectDate(ngaychieu) {
    var giobatdauFormatted; // Khai báo biến giobatdauFormatted

    document.getElementById('ngaychieu').value = ngaychieu;
    var cells = document.querySelectorAll('.carousel-cell');

    cells.forEach(function(cell) {
        cell.style.backgroundColor = 'rgb(243, 235, 235)';
        if (cell.getAttribute('data-ngaychieu') === ngaychieu) {
            cell.style.backgroundColor = '#df0e62';
        }
    });

    var timeList = document.getElementById('time-list');
    timeList.innerHTML = '';

    var giochieuList = {!! json_encode($suatchieu->toArray()) !!};
    var filteredGiochieu = giochieuList.filter(function(giochieu) {
        return giochieu.ngaychieu === ngaychieu;
    });

    filteredGiochieu.forEach(function(giochieu) {
        var giobatdau = new Date('2000-01-01T' + giochieu.giobatdau);
        var options = { hour: 'numeric', minute: '2-digit', hour12: true, timeZone: 'Asia/Ho_Chi_Minh' };
        giobatdauFormatted = giobatdau.toLocaleTimeString('en-US', options); // Gán giá trị cho biến giobatdauFormatted
        var li = document.createElement('li');
        li.className = 'time-li';
        li.innerHTML = `
            <div class="time-btn">
                <button class="screen-time" onclick="selectTime('${giobatdauFormatted}')">
                    ${giobatdauFormatted}
                </button>
            </div>`;
        timeList.appendChild(li);
    });
function selectTime(giobatdauFormatted) {
    // Gán giá trị của giobatdauFormatted vào trường input có id là giobatdau
    document.getElementById('giobatdau').value = giobatdauFormatted;
    
    // Hiển thị nút Tiếp tục
    var nextBtn = document.getElementById('screen-next-btn');
    nextBtn.disabled = false;
    }

        document.getElementById('ngaychieu').value = ngaychieu;
        document.getElementById('giobatdau').value = giobatdauFormatted;
        var nextBtn = document.getElementById('screen-next-btn');
        nextBtn.disabled = false;
        // Lưu ngày chiếu và giờ chiếu vào session
        sessionStorage.setItem('ngaychieu', ngaychieu);
        sessionStorage.setItem('giobatdau', giobatdauFormatted);
    }
    document.getElementById("screen-next-btn").addEventListener("click", function() {
        window.location.href = "{{ route('datve.chonghe', ['phim_id' => $phim_id]) }}";
    });

</script>

@endsection