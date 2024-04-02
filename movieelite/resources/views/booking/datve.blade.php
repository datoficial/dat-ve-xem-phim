@extends('layouts.frontend')
@section('title', 'Trang chủ')
@section('content')
<!-- Chọn lịch chiếu -->
  <div class="container" id="progress-container-id">
    <div class="row">
      <div class="col">
        <div class="px-0 pt-4 pb-0 mt-3 mb-3">
        <form id="form" method="POST" action="{{ route('booking.datve', ['phim_id' => $phim->id]) }}">
        @csrf
            <ul id="progressbar" class="progressbar-class">
              <li class="active" id="step1">Chọn lịch chiếu</li>
              <li id="step2" class="not_active">Chọn ghế ngồi</li>
              <li id="step3" class="not_active">Thanh Toán</li>
              <li id="step4" class="not_active">Vé của bạn</li>
            </ul>
            <br>
            <fieldset>
              <div id="screen-select-div">
                  <h2>Chọn ngày chiếu</h2>
                      <div class="carousel carousel-nav" data-flickity='{"contain": true, "pageDots": false }'>
                      @php
                            $ngaychieu_da_xuat_hien = []; 
                      @endphp
                      @foreach($suatchieu->sortBy('ngaychieu') as $suat)
                            @php
                                $ngaychieu = $suat->ngaychieu;
                                $giobatdau = $suat->giobatdau;
                                $today = \Carbon\Carbon::today()->toDateString();
                            @endphp
                            @if ($ngaychieu >= $today && !in_array($ngaychieu, $ngaychieu_da_xuat_hien))
                                @php
                                    $ngaychieu_da_xuat_hien[] = $ngaychieu; 
                                @endphp
                                <div class="carousel-cell" id="{{ $suat->id }}" data-ngaychieu="{{ $ngaychieu }}" onclick="myFunction({{ $suat->id }}); selectDate('{{ $ngaychieu }}');">
                                  <div class="date-numeric">{{ $suat->ngaychieu }}</div>
                                </div>
                              @endif
                              @endforeach
                      </div>
                      <ul class="time-ul" id="time-list">
                      
                      </ul>
              </div>
              <input id="screen-next-btn" type="button" name="next-step" class="next-step" value="Tiếp tục đặt vé" disabled />
              <input type="hidden" name="suatchieu_id" id="suatchieu_id">
            </fieldset>

            <!-- Chọn ghế ngồi -->
            <fieldset>
            <div>

        <iframe id="seat-sel-iframe"
            style="box-shadow: 0 14px 12px 0 var(--theme-border), 0 10px 50px 0 var(--theme-border); width: 800px; height: 550px; display: block; margin-left: auto; margin-right: auto;"
            src="{{ route('booking.chonghe') }}"></iframe>
            </div>
            <br>
            <input type="button" name="next-step" class="next-step" value="Thanh Toán" />
            <input type="button" name="previous-step" class="previous-step" value="Trở lại" />
            </fieldset>
            <fieldset>
          <!-- Payment Page -->
          <div id="payment_div">
            <div class="payment-row">
              <div class="col-75">
                  <div class="payment-container">
                      <div class="payment-row">
                          <div class="col-50">
                              <h3 id="payment-h3">Thanh Toán</h3>
                              <div class="payment-row">
                                <div class="col-50">
                                    <label for="total1">Total Amount:</label>
                                    <input type="text" id="total1" name="total1" placeholder="Nhập tài khoản thanh toán" required />
                                </div>
                                <div class="col-50">
                                    <label for="payment-method">Thanh toán qua:</label>
                                    <select id="payment-method" name="payment-method" required>
                                        <option value="credit-card">Credit Card</option>
                                        <option value="paypal">PayPal</option>
                                        <option value="cash">Cash</option>
                                    </select>
                                </div>
                            </div>
                          </div>
                      </div>
                  </div>
              </div>
            </div>
          </div>
              <input type="button" name="next-step" class="next-step pay-btn" value="Xác nhận thanh toán" />
              <input type="button" name="previous-step" class="cancel-pay-btn" value="Hủy thanh toán"
                  onclick="location.href='{{ route('frontend.home') }}';" />
          </fieldset>
          <fieldset>
          <h2>E-Ticket</h2>
          <div class="ticket-body">
            <div class="ticket">
              <div class="holes-top"></div>
              <div class="title">
                <p class="cinema">Movie Elite</p>
                <p class="movie-title">{{$phim->tenphim}}</p>
              </div>
              <div class="poster">
                <img src="{{ env('APP_URL') . '/storage/app/' . $phim->hinhanh }}" alt=""/>
              </div>
              <div class="info">
                <table class="info-table ticket-table">
                  <tr>
                    <th>Ngày chiếu</th>
                    <th>Giờ chiếu</th>
                    <th>Chỗ ngồi</th>
                  </tr>
                  <tr>
                  <td class="bigger" name="ngaychieu_submit" id="ngaychieu_submit"></td>
                    <td class="bigger" name="giobatdau_submit" id="giobatdau_submit"></td>
                    <td class="bigger" name="tenghe1" id="tenghe1"></td>
                  </tr>
                </table>
                <table class="info-table ticket-table">
                  <tr>
                    <th>Phòng</th>
                    <th>Số lượng vé</th>
                    <th>Tổng tiền</th>
                  </tr>
                  <tr>
                    <td name="phongchieu_submit" id="phongchieu_submit"></td>
                    <td name="soluong1" id="soluong1"></td>
                    <td name="giave1" id="giave1"></td>
                  </tr>
                </table>
              </div>
              <!-- mã QR -->
              <div class="holes-lower"></div>
              <br>
              <br>
              <br>
              <div class="barcode" id="barcode"></div>

            </div>
          </div>
          <input type="submit" name="previous-step" class="home-page-btn" value="Hoàn tất đặt hàng"/>
            </fieldset>
            <input type="hidden" name="user_id" value="{{ Auth::id() }}">
            <!-- Các trường input cho thông tin ghế -->
            <input type="hidden" name="giobatdau_submit" id="giobatdau_submit">
            <input type="hidden" name="ngaychieu_submit" id="ngaychieu_submit">
            <input type="hidden" name="tenghe" id="tenghe">
            <input type="hidden" name="soluong" id="soluong">
            <input type="hidden" name="giave" id="giave">
          </form>
                  </div>
                </div>
              </div>
            </div>
@endsection

@section('style')
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/css/style-starter.css')}}">
  <link rel="stylesheet" href="https://npmcdn.com/flickity@2/dist/flickity.css">
  <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/css/progress.css')}}">

  <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/css/ticket-booking.css')}}">

  <!-- ..............For progress-bar............... -->
  <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/css/e-ticket.css')}}">

  <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/css/payment.css')}}" />
  <link href="https://fonts.googleapis.com/css?family=Yanone+Kaffeesatz:400,700" rel="stylesheet">
  <style>
        /* Định dạng select box */
    select {
        width: 100%;
        padding: 12px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
        margin-bottom: 10px;
        appearance: none; 
        background-image: url('data:image/svg+xml;utf8,<svg fill="none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>'); /* Thêm mũi tên dropdown tùy chỉnh */
        background-repeat: no-repeat;
        background-position: right 5px center;
        background-size: 20px;
    }

    /* Tùy chỉnh giao diện khi hover */
    select:hover {
        border-color: #999;
    }

    /* Tùy chỉnh giao diện khi focus */
    select:focus {
        border-color: #333;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.3);
    }

      </style>
      <style>
          .barcode {
            display: inline-block;
            height: 50px; /* Chiều cao của mã vạch */
            width:  80%;
            overflow-x: auto;
            white-space: nowrap;
            font-size: 0;
          }
          .barcode-cell {
            display: inline-block;
            width: 5px; /* Độ rộng của mỗi ô */
            height: 100%;
          }
          .black {
            background-color: black;
          }
          .white {
            background-color: white;
          }
        </style>
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
    var prevElement = document.getElementById(prevId);
    if (prevElement) {
        prevElement.style.background = "rgb(243, 235, 235)";
    }

    var currentElement = document.getElementById(id);
    if (currentElement) {
        currentElement.style.background = "#df0e62";
        prevId = id;
    } else {
        console.error("Element with id " + id + " does not exist.");
    }
}

</script>
<script>
  // Function to generate a random barcode
  function generateBarcode() {
    var barcodeContainer = document.getElementById("barcode");
    barcodeContainer.innerHTML = ""; // Clear previous barcode
    
    var barcodeNumbers = []; // Array to store random numbers for barcode
    var barcodeLength = 60; // Số lượng ô trong mã vạch
    
    // Generate random numbers for the barcode
    for (var i = 0; i < barcodeLength; i++) {
      var randomNumber = Math.round(Math.random());
      barcodeNumbers.push(randomNumber);
    }
    
    // Create barcode cells based on the random numbers
    for (var i = 0; i < barcodeNumbers.length; i++) {
      var cell = document.createElement("div");
      cell.classList.add("barcode-cell");
      if (barcodeNumbers[i] === 1) {
        cell.classList.add("black");
      } else {
        cell.classList.add("white");
      }
      barcodeContainer.appendChild(cell);
    }
  }
 
  // Generate barcode when the page loads
  generateBarcode();
</script>
<script src="https://npmcdn.com/flickity@2/dist/flickity.pkgd.js"></script>
<script type="text/javascript" src='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js'>
</script>
<script type="text/javascript" src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
<script src="{{ asset('public/assets/js/theme-change.js')}}"></script>

<script type="text/javascript" src="{{ asset('public/assets/js/ticket-booking.js')}}"></script>
<script>
      function selectTime(suatchieu_id) {
        sessionStorage.setItem('suatchieu_id', suatchieu_id);
    }
  </script>

<script>
function selectDate(ngaychieu) {
    var giobatdauFormatted;

    // Kiểm tra xem phần tử 'time-list' có tồn tại không
    var timeList = document.getElementById('time-list');
    if (!timeList) {
        console.error("Element with id 'time-list' does not exist.");
        return;
    }

    timeList.innerHTML = '';

    var giochieuList = {!! json_encode($suatchieu->toArray()) !!};
    var filteredGiochieu = giochieuList.filter(function(giochieu) {
        return giochieu.ngaychieu === ngaychieu;
    });

    filteredGiochieu.forEach(function(giochieu) {
        var giobatdau = new Date('2000-01-01T' + giochieu.giobatdau);
        var options = { hour: 'numeric', minute: '2-digit', hour12: true, timeZone: 'Asia/Ho_Chi_Minh' };
        giobatdauFormatted = giobatdau.toLocaleTimeString('en-US', options);
        var li = document.createElement('li');
        li.className = 'time-li';
        li.innerHTML = `
            <div class="time-btn">
            <div class="screens">
                ${giochieu.phongchieu.tenphong}
            </div>
                <button class="screen-time" onclick="timeFunction(); selectTime(${giochieu.id})">
                    ${giobatdauFormatted}
                </button>
            </div>`;
        timeList.appendChild(li);
        document.getElementById('giobatdau_submit').value = giobatdau;
        document.getElementById('ngaychieu_submit').value = ngaychieu;
        document.getElementById('suatchieu_id').value = giochieu.id;
        document.getElementById('giobatdau_submit').innerText = giobatdauFormatted;
        document.getElementById('ngaychieu_submit').innerText = ngaychieu;
        document.getElementById('phongchieu_submit').innerText = giochieu.phongchieu.tenphong;
    
    });
}
</script>
<script>
        document.addEventListener("DOMContentLoaded", function() {

            var firstNgaychieu = document.querySelector('.carousel-cell').dataset.ngaychieu;

            selectDate(firstNgaychieu);
        });
</script>
<script>
    window.addEventListener('message', function(event) {
        var data = event.data;
        var tenghe = data.tenghe;
        var soluong = data.soluong;
        var giave = data.giave;
        
        // Update form fields or perform other actions
        document.getElementById('tenghe').value = tenghe;
        document.getElementById('soluong').value = soluong;
        document.getElementById('giave').value = giave;



        document.getElementById('tenghe1').innerText = tenghe;
        document.getElementById('soluong1').innerText = soluong;
        document.getElementById('giave1').innerText = giave;
    });
</script>

@endsection