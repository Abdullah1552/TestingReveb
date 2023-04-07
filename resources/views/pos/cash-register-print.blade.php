
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ URL::asset('public/print/print.css') }}">
    <title>Cash register</title>
    <script type="text/javascript">
        function print_data() {
        window.print();
        setTimeout(function() {window.close();
        window.location.href='{{ url('sale/pos') }}';
        },0);
        };
    </script>
    <style>
        #invoice-POS {
            box-shadow: 0 0 1in -0.25in rgba(0, 0, 0, 0.5);
            padding: 2mm;
            margin: 0 auto;
            width: 80mm;
            background: #FFF;
        }

        ::selection {
            background: #f31544;
            color: black;
        }

        ::moz-selection {
            background: #f31544;
            color: black;
        }

        h1 {
            font-size: 2.9em !important;
            color: #000000;
        }

        h2 {
            font-size: .9em;
        }

        h3 {
            font-size: 1.2em;
            font-weight: 300;
            line-height: 2em;
        }

        p {
            font-size: .7em;
            color: #666;
            line-height: 1.2em;
        }

        #top, #mid, #bot { /* Targets all id with 'col-' */
            border-bottom: 1px solid #EEE;
        }

        /*#top{min-height: 100px;}*/
        /*#mid{min-height: 80px;}*/
        #bot {
            min-height: 50px;
        }

        #top .logo {
        / / float: left;
            height: 60px;
            width: 60px;
            background: url(http://michaeltruong.ca/images/logo1.png) no-repeat;
            background-size: 60px 60px;
        }

        .clientlogo {
            float: left;
            height: 60px;
            width: 60px;
            background: url(http://michaeltruong.ca/images/client.jpg) no-repeat;
            background-size: 60px 60px;
            border-radius: 50px;
        }

        .info {
            display: block;
        / / float: left;
            margin-left: 0;
            font-size: 1.1em;
            color: #000000;
        }

        .title {
            float: right;
        }

        .title p {
            text-align: right;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        td {
        / / padding: 5 px 0 5 px 15 px;
        / / border: 1 px solid #EEE
        }

        .tabletitle {
        / / padding: 5 px;
            font-size: .9em;
            background-color: #EEE !important;
        }

        .service {
            border-bottom: 1px solid #EEE;
        }

        .item {
            width: 24mm;
        }

        .itemtext {
            font-size: 1.1em;
            color: black;
        }

        #legalcopy {
            margin-top: 5mm;
        }

        .tabletitle td {
        }

        .Rate {
            text-align: right !important;
        }


        #table *{

            font-weight: bold !important;
            font-size: 1.2 rem !important;
        }

    </style>
</head>
<body onLoad="print_data()">
    <div id="invoice-POS">

    <center id="top">
        {{--<div class="logo"></div>--}}
        <div class="info">
            <h1><u style="font-size: 0.8em !important;">{{ \App\Models\BusinessSetting::first()->business_name }}</u>            </h1>
        </div><!--End Info-->
    </center><!--End InvoiceTop-->

    <center id="top">
        <div class="info">
            <h3><u style="font-size: 1.5rem !important;text-decoration: none">Cash Register Receipt</u></h3>
        </div>
    </center>

    <div id="mid" style="text-align:left">
        <div class="info">
            <p style="font-size: 1.1em; color:black;">
                {{--<b>Address: </b>  {{ $register->location->WH_Address }}</br>--}}
                {{--<b>Email</b> : {{ $location->WH_Email }}</br>--}}
            </p>
        </div>
    </div>
    <div id="mid" style="text-align:left; color:black; margin-bottom: 15px !important;">
        <div class="info">
            <div><b>Location</b> : {{ $register->location->WH_Name }}</div>
            <div>
                <b>Open by</b>
                : {{ (isset($register->staff->name ) && $register->staff->name )?$register->staff->name :"N/A"}}
            </div>
            <div>
                <b>Closed by</b>
                : {{ (isset($register->closing_staff->name ) && $register->closing_staff->name )?$register->closing_staff->name :"N/A"}}
            </div>
            <div>
                <b>Open At</b>
                : {{ (isset($register->created_at ) && $register->created_at )?$register->created_at :"N/A"}}
            </div>
            <div>
                <b>Closed by</b>
                : {{ (isset($register->updated_at ) && $register->updated_at ) ?   $register->updated_at :"N/A"}}
            </div>

        </div>
    </div>
    <div id="bot">
        <div>
            <table id="table">

                <tr style="border: 1px solid #000;" class="font-weight-bold">
                    <td>Sale Person</td>
                    <td>
                        <span class="sale_person"> {{$register->staff->name}}</span>
                    </td>
                </tr>
                <tr style="border: 1px solid #000;" class="font-weight-bold">
                    <td>Location</td>
                    <td>
                        <span class="location">{{$register->location->WH_Name}}</span>
                    </td>
                </tr>
                <tr style="border: 1px solid #000;" class="font-weight-bold">
                    <td>Date</td>
                    <td>
                        <span class="date">{{  date("d-m-Y H:i:sa", strtotime($register->created_at))}}</span>
                    </td>
                </tr>
                <tr style="border: 1px solid #000;">
                    <td>Cash in Hand</td>
                    <td>
                        <span class="cash_in_hand">{{ $register->cash_in_hand}}</span>
                    </td>
                </tr>
                <tr style="border: 1px solid #000;">
                    <td>Cash Sale</td>
                    <td>
                        <input type="hidden" name="cash_payment" value="0">
                        <span class="cash_payment">{{ $register->cash_payment}}</span>
                    </td>
                </tr>
                <tr style="border: 1px solid #000;">
                    <td>Sale Return</td>
                    <td>
                        <input type="hidden" name="total_sale_return" value="0">
                        <span class="total_sale_return">{{ $register->total_sale_return }}</span>
                    </td>

                </tr>
                <tr style="border: 1px solid #000;">
                    <td>Credit Card Sale</td>
                    <td>
                        <input type="hidden" name="credit_card_payment" value="0">
                        <span class="credit_card_payment">{{ $register->credit_card_payment}}</span>
                    </td>
                </tr>
                <tr style="border: 1px solid #000;">
                    <td>QR Pay Sale</td>
                    <td>
                        <input type="hidden" name="qr_code_payment" value="0">
                        <span class="qr_code_payment">{{ $register->qr_code_payment}}</span>
                    </td>
                </tr>
                <tr style="border: 1px solid #000;">
                    <td>Other Sale</td>
                    <td>
                        <input type="hidden" name="other_payment" value="0">
                        <span class="other_payment">0</span>
                    </td>
                </tr>
                <tr style="border: 1px solid #000;" style="border-bottom: double;border-top: double" class="font-weight-bold">
                    <td>Total Sale</td>
                    <td>
                        <span class="total_sale">{{ $register->total_sale}}</span>
                        <input type="hidden" name="total_sale" value="0">
                    </td>
                </tr>
                <tr style="border: 1px solid #000;" style="border-bottom: double;border-top: double" class="font-weight-bold">
                    <td>Total Cash</td>
                    <td>
                        <span class="total_cash">{{ $register->total_cash}}</span>
                        <input type="hidden" name="total_cash" value="0">
                    </td>
                </tr>
            </table>
        </div>

    </div>
</div>
</body>
</html>





