<!DOCTYPE html>
<html>
<head>
    <!-- for-mobile-apps -->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords"
        content="Movie Ticket Booking Widget Responsive, Login form web template, Sign up Web Templates, Flat Web Templates, Login signup Responsive web template, Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
    <link href="{{ asset('public/seat_selection/css/style.css') }}" rel="stylesheet" type="text/css" media="all" />
    <script src="{{ asset('public/seat_selection/js/jquery-1.11.0.min.js') }}"></script>
    <script src="{{ asset('public/seat_selection/js/jquery.seat-charts.js') }}"></script>
</head>
<body>
    <div class="content">
    <h2>Chọn ghế ngồi</h2>
    <div class="main">
        <div class="demo">
            <div id="seat-map">
                <div class="front">Màn hình</div>      
            </div>
            <div class="booking-details">
                <ul class="book-left">
                    <li>Suất chiếu</li>
                    <li>Số lượng vé</li>
                    <li>Tổng</li>
                    <li>Ghế đã chọn</li>
                </ul>
                <ul class="book-right">
                    <li>: <span id="received-suatchieuId">{{ old('suatchieu_id') }}</span></li>
                    <li>: <span id="counter">0</span></li>
                    <li>: <b><span id="total">0</span> <i>VNĐ</i></b></li>
                </ul>
                <div class="clear"></div>
                <ul id="selected-seats" class="scrollbar scrollbar1"></ul>
                <div id="legend"></div>
            </div>

    <script>
        var suatchieuId = sessionStorage.getItem('suatchieu_id');
        // Hiển thị suatchieu_id trong div có id là 'received-suatchieuId'
        document.getElementById('received-suatchieuId').textContent = suatchieuId;

                var price = 85000; 
                $(document).ready(function () {
                    var $cart = $('#selected-seats'), //Sitting Area
                        $counter = $('#counter'), //Votes
                        $total = $('#total'); //Total money

                    var sc = $('#seat-map').seatCharts({
                        map: [ //Seating chart
                            'aaaaaaaaaa',
                            'aaaaaaaaaa',
                            '__________',
                            'aaaaaaaa__',
                            'aaaaaaaaaa',
                            'aaaaaaaaaa',
                            'aaaaaaaaaa',
                            'aaaaaaaaaa',
                            'aaaaaaaaaa',
                            '__aaaaaa__'
                        ],
                        naming: {
                            top: false,
                            getLabel: function (character, row, column) {
                                return column;
                            }
                        },
                        legend: { //Definition legend
                            node: $('#legend'),
                            items: [
                                ['a', 'available', 'Ghế trống'],
                                ['a', 'unavailable', 'Đã chọn'],
                                ['a', 'selected', 'Ghế bạn chọn']
                            ]
                        },
                        click: function () { //Click event
                            if (this.status() == 'available') {
                                $('<li>' + (this.settings.row + 1) + '_'+ this.settings.label +','+'</li>')
                                    .attr('id', 'cart-item-' + this.settings.id)
                                    .data('seatId', this.settings.id)
                                    .appendTo($cart);

                                $counter.text(sc.find('selected').length + 1);
                                $total.text(recalculateTotal(sc) + price);

                                sendDataToParent($cart, $counter, $total);

                                return 'selected';
                            } else if (this.status() == 'selected') { 
                                $counter.text(sc.find('selected').length - 1);
                                $total.text(recalculateTotal(sc) - price);
                                $('#cart-item-' + this.settings.id).remove();
                                sendDataToParent($cart, $counter, $total);
                                return 'available';
                            } else if (this.status() == 'unavailable') { //sold
                                return 'unavailable';
                            } else {
                                return this.style();
                            }
                        }
                    });
                    //sold seat
                    sc.get(['1_2', '4_4', '4_5', '6_6', '6_7', '8_5', '8_6', '8_7', '8_8', '10_1', '10_2']).status(
                        'unavailable');
                });

                function recalculateTotal(sc) {
                    var total = 0;
                    sc.find('selected').each(function () {
                        total += price;
                    });

                    return total;
                }

                function sendDataToParent($cart, $counter, $total) {
                    var data = {
                        tenghe: $cart.text(),
                        soluong: $counter.text(),
                        giave: $total.text()
                    };
                    window.parent.postMessage(data, '*');
                }
            </script>

        </div>
    </div>
    <script src="{{ asset('public/seat_selection/js/jquery.nicescroll.js') }}"></script>
    <script src="{{ asset('public/seat_selection/js/scripts.js') }}"></script>
</body>
</html>
