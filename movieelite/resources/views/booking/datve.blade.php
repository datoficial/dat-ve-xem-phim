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
              <input id="screen-next-btn" type="button" name="next-step" class="next-step" value="Continue Booking" disabled />
            </fieldset>

            <!-- Chọn ghế ngồi -->
            <fieldset>
            <div>

        <iframe id="seat-sel-iframe"
            style="box-shadow: 0 14px 12px 0 var(--theme-border), 0 10px 50px 0 var(--theme-border); width: 800px; height: 550px; display: block; margin-left: auto; margin-right: auto;"
            src="{{ route('booking.chonghe') }}"></iframe>

            </div>
            <br>
            <input type="button" name="next-step" class="next-step" value="Proceed to Payment" />
            <input type="button" name="previous-step" class="previous-step" value="Back" />
            </fieldset>
            <fieldset>
          <!-- Payment Page -->
          <div id="payment_div">
            <div class="payment-row">
              <div class="col-75">
                <div class="payment-container">
                  <div class="payment-row">
                    <div class="col-50">
                      <h3 id="payment-h3">Payment</h3>
                      <div class="payment-row payment">
                        <div class="col-50 payment">
                          <label for="card" class="method card">
                            <div class="icon-container">
                              <i class="fa fa-cc-visa" style="color: navy"></i>
                              <i class="fa fa-cc-amex" style="color: blue"></i>
                              <i class="fa fa-cc-mastercard" style="color: red"></i>
                              <i class="fa fa-cc-discover" style="color: orange"></i>
                            </div>
                            <div class="radio-input">
                              <input type="radio" id="card" />
                              Pay RS.200.00 with credit card
                            </div>
                          </label>
                        </div>
                        <div class="col-50 payment">
                          <label for="paypal" class="method paypal">
                            <div class="icon-container">
                              <i class="fa fa-paypal" style="color: navy"></i>
                            </div>
                            <div class="radio-input">
                              <input id="paypal" type="radio" checked>
                              Pay $30.00 with PayPal
                            </div>
                          </label>
                        </div>
                      </div>

                      <div class="payment-row">
                        <div class="col-50">
                          <label for="cname">Cardholder's Name</label>
                          <input type="text" id="cname" name="cardname" placeholder="Firstname Lastname"  />
                        </div>
                        <div class="col-50">
                          <label for="ccnum">Credit card number</label>
                          <input type="text" id="ccnum" name="cardnumber" placeholder="xxxx-xxxx-xxxx-xxxx"
                            />
                        </div>
                      </div>
                      <div class="payment-row">
                        <div class="col-50">
                          <label for="expmonth">Exp Month</label>
                          <input type="text" id="expmonth" name="expmonth" placeholder="September"  />
                        </div>
                        <div class="col-50">
                          <div class="payment-row">
                            <div class="col-50">
                              <label for="expyear">Exp Year</label>
                              <input type="text" id="expyear" name="expyear" placeholder="yyyy"  />
                            </div>
                            <div class="col-50">
                              <label for="cvv">CVV</label>
                              <input type="text" id="cvv" name="cvv" placeholder="xxx"  />
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <input type="button" name="next-step" class="next-step pay-btn" value="Confirm Payment" />
              <input type="button" name="previous-step" class="cancel-pay-btn" value="Cancel Payment"
                onclick="location.href='"(route('fontend.home')"';" />
          </fieldset>
          <fieldset>
          <h2>E-Ticket</h2>
          <div class="ticket-body">
            <div class="ticket">
              <div class="holes-top"></div>
              <div class="title">
                <p class="cinema">MyShowz Entertainment</p>
                <p class="movie-title">Movie Name</p>
              </div>
              <div class="poster">
                <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/25240/only-god-forgives.jpg"
                  alt="Movie: Only God Forgives" />
              </div>
              <div class="info">
                <table class="info-table ticket-table">
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
                <table class="info-table ticket-table">
                  <tr>
                    <th>PRICE</th>
                    <th>DATE</th>
                    <th>TIME</th>
                  </tr>
                  <tr>
                    <td>RS.12.00</td>
                    <td>4/13/21</td>
                    <td>19:30</td>
                  </tr>
                </table>
              </div>
              <div class="holes-lower"></div>
              <div class="serial">
                <table class="barcode ticket-table">
                  <tr>
                    <td style="background-color:black;"></td>
                    <td style="background-color:black;"></td>
                    <td style="background-color:white;"></td>
                    <td style="background-color:black;"></td>
                    <td style="background-color:white;"></td>
                    <td style="background-color:white;"></td>
                    <td style="background-color:black;"></td>
                    <td style="background-color:black;"></td>
                    <td style="background-color:white;"></td>
                    <td style="background-color:black;"></td>
                    <td style="background-color:white;"></td>
                    <td style="background-color:white;"></td>
                    <td style="background-color:black;"></td>
                    <td style="background-color:white;"></td>
                    <td style="background-color:black;"></td>
                    <td style="background-color:white;"></td>
                    <td style="background-color:white;"></td>
                    <td style="background-color:black;"></td>
                    <td style="background-color:black;"></td>
                    <td style="background-color:white;"></td>
                    <td style="background-color:black;"></td>
                    <td style="background-color:black;"></td>
                    <td style="background-color:white;"></td>
                    <td style="background-color:white;"></td>
                    <td style="background-color:black;"></td>
                    <td style="background-color:white;"></td>
                    <td style="background-color:white;"></td>
                    <td style="background-color:black;"></td>
                    <td style="background-color:white;"></td>
                    <td style="background-color:black;"></td>
                    <td style="background-color:white;"></td>
                    <td style="background-color:white;"></td>
                    <td style="background-color:black;"></td>
                    <td style="background-color:white;"></td>
                    <td style="background-color:black;"></td>
                    <td style="background-color:black;"></td>
                    <td style="background-color:white;"></td>
                    <td style="background-color:white;"></td>
                    <td style="background-color:black;"></td>
                    <td style="background-color:white;"></td>
                    <td style="background-color:black;"></td>
                    <td style="background-color:white;"></td>
                    <td style="background-color:white;"></td>
                    <td style="background-color:black;"></td>
                    <td style="background-color:white;"></td>
                    <td style="background-color:black;"></td>
                    <td style="background-color:black;"></td>
                    <td style="background-color:white;"></td>
                    <td style="background-color:white;"></td>
                    <td style="background-color:black;"></td>
                    <td style="background-color:black;"></td>
                    <td style="background-color:black;"></td>
                    <td style="background-color:black;"></td>
                    <td style="background-color:white;"></td>
                    <td style="background-color:black;"></td>
                    <td style="background-color:white;"></td>
                    <td style="background-color:black;"></td>
                    <td style="background-color:black;"></td>
                    <td style="background-color:white;"></td>
                    <td style="background-color:white;"></td>
                    <td style="background-color:black;"></td>
                    <td style="background-color:white;"></td>
                    <td style="background-color:black;"></td>
                    <td style="background-color:white;"></td>
                    <td style="background-color:black;"></td>
                    <td style="background-color:black;"></td>
                    <td style="background-color:white;"></td>
                    <td style="background-color:black;"></td>
                    <td style="background-color:black;"></td>
                    <td style="background-color:white;"></td>
                    <td style="background-color:white;"></td>
                    <td style="background-color:black;"></td>
                    <td style="background-color:white;"></td>
                    <td style="background-color:white;"></td>
                    <td style="background-color:white;"></td>
                    <td style="background-color:black;"></td>
                    <td style="background-color:white;"></td>
                    <td style="background-color:black;"></td>
                    <td style="background-color:black;"></td>
                    <td style="background-color:black;"></td>
                    <td style="background-color:white;"></td>
                    <td style="background-color:black;"></td>
                    <td style="background-color:white;"></td>
                    <td style="background-color:black;"></td>
                    <td style="background-color:white;"></td>
                    <td style="background-color:white;"></td>
                    <td style="background-color:black;"></td>
                    <td style="background-color:black;"></td>
                    <td style="background-color:black;"></td>
                    <td style="background-color:white;"></td>
                    <td style="background-color:black;"></td>
                    <td style="background-color:white;"></td>
                    <td style="background-color:black;"></td>
                    <td style="background-color:white;"></td>
                    <td style="background-color:black;"></td>
                    <td style="background-color:black;"></td>
                    <td style="background-color:white;"></td>
                    <td style="background-color:black;"></td>
                    <td style="background-color:white;"></td>
                    <td style="background-color:black;"></td>
                    <td style="background-color:white;"></td>
                    <td style="background-color:white;"></td>
                    <td style="background-color:white;"></td>
                    <td style="background-color:black;"></td>
                    <td style="background-color:white;"></td>
                    <td style="background-color:black;"></td>
                    <td style="background-color:black;"></td>
                    <td style="background-color:white;"></td>
                    <td style="background-color:black;"></td>
                    <td style="background-color:white;"></td>
                    <td style="background-color:white;"></td>
                    <td style="background-color:white;"></td>
                    <td style="background-color:black;"></td>
                    <td style="background-color:white;"></td>
                    <td style="background-color:black;"></td>
                    <td style="background-color:white;"></td>
                  </tr>
                </table>
                <table class="numbers ticket-table">
                  <tr>
                    <td>9</td>
                    <td>1</td>
                    <td>7</td>
                    <td>3</td>
                    <td>7</td>
                    <td>5</td>
                    <td>4</td>
                    <td>4</td>
                    <td>4</td>
                    <td>5</td>
                    <td>4</td>
                    <td>1</td>
                    <td>4</td>
                    <td>7</td>
                    <td>8</td>
                    <td>7</td>
                    <td>3</td>
                    <td>4</td>
                    <td>1</td>
                    <td>4</td>
                    <td>5</td>
                    <td>2</td>
                  </tr>
                </table>
              </div>
            </div>
          </div>
          <input type="submit" name="previous-step" class="home-page-btn" value="Browse to Home Page"/>
            </fieldset>
            <input type="hidden" name="suatchieu_id" id="suatchieu_id">
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

<script src="https://npmcdn.com/flickity@2/dist/flickity.pkgd.js"></script>
<script type="text/javascript" src='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js'>
</script>
<script type="text/javascript" src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
<script src="{{ asset('public/assets/js/theme-change.js')}}"></script>

<script type="text/javascript" src="{{ asset('public/assets/js/ticket-booking.js')}}"></script>
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
                <button class="screen-time" onclick="timeFunction()">
                    ${giobatdauFormatted}
                </button>
            </div>`;
        timeList.appendChild(li);
        document.getElementById('giobatdau_submit').value = giobatdau;
        document.getElementById('ngaychieu_submit').value = ngaychieu;
        document.getElementById('suatchieu_id').value = giochieu.id;
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
    });
</script>
<script>
    // Lấy phần tử cha của bước thanh toán hiện tại
    var paymentDiv = document.getElementById('payment_div');
    // Thay thế nội dung của phần tử cha bằng nội dung mới
    paymentDiv.innerHTML = `
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
    `;
</script>

@endsection