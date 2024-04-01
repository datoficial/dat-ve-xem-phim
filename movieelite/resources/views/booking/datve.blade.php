@extends('layouts.frontend')
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
@section('content')
  <div class="container" id="progress-container-id">
    <div class="row">
      <div class="col">
        <div class="px-0 pt-4 pb-0 mt-3 mb-3">
         <form id="form"> 
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
                                <div class="carousel-cell" id="{{ $suat->id }}" data-ngaychieu="{{ $ngaychieu }}" onclick="myFunction({{ $suat->id }}); selectDate('{{ $ngaychieu }}')">
                                  <div class="date-numeric">{{ $suat->ngaychieu }}</div>
                                </div>
                              @endif
                              @endforeach
                      </div>
                      <ul class="time-ul" id="time-ul">
                      
                      </ul>
              </div>
              <input id="screen-next-btn" type="button" name="next-step" class="next-step" value="Continue Booking" disabled />
            </fieldset>

            <fieldset>
              <div>
                <iframe id="seat-sel-iframe"
                  style="  box-shadow: 0 14px 12px 0 var(--theme-border), 0 10px 50px 0 var(--theme-border); width: 800px; height: 550px; display: block; margin-left: auto; margin-right: auto;"
                  src="{{ route('booking.chonghe')}}"></iframe>
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
                          <h3 id="payment-h3">Thanh Toán</h3>
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
                              <input type="text" id="cname" name="cardname" placeholder="Firstname Lastname" required />
                            </div>
                            <div class="col-50">
                              <label for="ccnum">Credit card number</label>
                              <input type="text" id="ccnum" name="cardnumber" placeholder="xxxx-xxxx-xxxx-xxxx"
                                required />
                            </div>
                          </div>
                          <div class="payment-row">
                            <div class="col-50">
                              <label for="expmonth">Exp Month</label>
                              <input type="text" id="expmonth" name="expmonth" placeholder="September" required />
                            </div>
                            <div class="col-50">
                              <div class="payment-row">
                                <div class="col-50">
                                  <label for="expyear">Exp Year</label>
                                  <input type="text" id="expyear" name="expyear" placeholder="yyyy" required />
                                </div>
                                <div class="col-50">
                                  <label for="cvv">CVV</label>
                                  <input type="text" id="cvv" name="cvv" placeholder="xxx" required />
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
                onclick="location.href='index.html';" />
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
              <input type="button" name="previous-step" class="home-page-btn" value="Browse to Home Page"
              onclick="window.location.href = '{{ route('frontend.home') }}'" />
            </fieldset>
          </form>
        </div>
      </div>
    </div>
  </div>
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
</script>

<script src="https://npmcdn.com/flickity@2/dist/flickity.pkgd.js"></script>
<script type="text/javascript" src='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js'>
</script>
<script type="text/javascript" src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
<script src="{{ asset('public/assets/js/theme-change.js')}}"></script>

<script type="text/javascript" src="{{ asset('public/assets/js/ticket-booking.js')}}"></script>
<script>
   function selectDate(ngaychieu) {
    var timeList = document.getElementById('time-ul');
    timeList.innerHTML = '';

    var giochieuList = {!! json_encode($suatchieu->toArray()) !!};
    var filteredGiochieu = giochieuList.filter(function(giochieu) {
        return giochieu.ngaychieu === ngaychieu;
    });

    filteredGiochieu.forEach(function(giochieu) {
        var giobatdau = new Date('2000-01-01T' + giochieu.giobatdau);
        var options = { hour: 'numeric', minute: '2-digit', hour12: true, timeZone: 'Asia/Ho_Chi_Minh' };
        giobatdau = giobatdau.toLocaleTimeString('en-US', options);
        var li = document.createElement('li');
        li.className = 'time-li';
        li.innerHTML = `
            <div class="screens">
                ${giochieu.phongchieu.tenphong}
            </div>
            <div class="time-btn">
                <button class="screen-time" onclick="timeFunction('${giobatdau}')">
                    ${giobatdau}
                </button>
            </div>`;
        timeList.appendChild(li);
    });
}
</script>
<script>
        document.addEventListener("DOMContentLoaded", function() {

            var firstNgaychieu = document.querySelector('.carousel-cell').dataset.ngaychieu;

            selectDate(firstNgaychieu);
        });
    </script>
@endsection