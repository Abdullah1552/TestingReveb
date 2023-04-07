<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ URL::asset('public/print/print.css') }}">
    <title>Return</title>
    <script type="text/javascript">
        function print_data() {
        window.print();
        setTimeout(function() {window.close();
        window.location.href='{{ url('sale/pos') }}';
        },0);
        };
    </script>
    <style>
        #invoice-POS{
            box-shadow: 0 0 1in -0.25in rgba(0, 0, 0, 0.5);
            padding:2mm;
            margin: 0 auto;
            width: 80mm;
            background: #FFF;
        }

        ::selection {background: #f31544; color: black;}
        ::moz-selection {background: #f31544; color: black;}
        h1{
            font-size: 2.9em !important;
            color: #000000;
        }
        h2{font-size: .9em;}
        h3{
            font-size: 1.2em;
            font-weight: 300;
            line-height: 2em;
        }
        p{
            font-size: .7em;
            color: #666;
            line-height: 1.2em;
        }

        #top, #mid,#bot{ /* Targets all id with 'col-' */
            border-bottom: 1px solid #EEE;
        }

        /*#top{min-height: 100px;}*/
        /*#mid{min-height: 80px;}*/
        #bot{ min-height: 50px;}

        #top .logo{
        //float: left;
            height: 60px;
            width: 60px;
            background: url(http://michaeltruong.ca/images/logo1.png) no-repeat;
            background-size: 60px 60px;
        }
        .clientlogo{
            float: left;
            height: 60px;
            width: 60px;
            background: url(http://michaeltruong.ca/images/client.jpg) no-repeat;
            background-size: 60px 60px;
            border-radius: 50px;
        }
        .info{
            display: block;
        //float:left;
            margin-left: 0;
            font-size: 1.1em;
            color: #000000;
        }
        .title{
            float: right;
        }
        .title p{text-align: right;}
        table{
            width: 100%;
            border-collapse: collapse;
        }
        td{
        //padding: 5px 0 5px 15px;
        //border: 1px solid #EEE
        }
        .tabletitle{
        //padding: 5px;
            font-size: .9em;
            background-color: #EEE !important;
        }
        .service{border-bottom: 1px solid #EEE;}
        .item{width: 24mm;}
        .itemtext{font-size: 1.1em; color:black;}

        #legalcopy{
            margin-top: 5mm;
        }
        .tabletitle td{
        }
        .Rate { text-align: right !important;}
    </style>
</head>
<body onLoad="print_data()">
<div id="invoice-POS">

    <center id="top">
        {{--<div class="logo"></div>--}}
        <div class="info">
            <h1><u style="font-size: 0.8em !important;">{{ \App\Models\BusinessSetting::first()->business_name }}</u></h1>
        </div><!--End Info-->
    </center><!--End InvoiceTop-->

    <div id="mid" style="text-align:center">
        <div class="info">
            <p style="font-size: 1.1em; color:black; font-weight: bold">
                Address:  {{ App\Models\WhereHouse::find(Auth::user()->WHID)->WH_Address }}</br>
                Email   : {{ $location->WH_Email }}</br>
                Phone   : {{ $location->WH_Mobile }}</br>
            </p>
        </div>
    </div><!--End Invoice Mid-->
    <div id="mid" style="text-align:center; color:black;">
        <div class="info">
            <div>Client   : {{ $customer->name }}</div>
            <div>Cashier   : {{ Auth::user()->name }}</div>
            <div>Date   : {{ date('d-m-Y',strtotime($sinv->date)) }}</div>
            <div>SR#   : {{ $sinv->sr }}</div>
        </div>
    </div><!--End Invoice Mid-->
    <div id="bot">
        <div id="table">
            <table>
                <tr class="tabletitle">
                    <td>#</td>
                    <td class="item">Item</td>
                    <td class="Hours">Qty</td>
                    <td class="Hours">Price</td>
                    <td>Disc</td>
                    <td>Tax</td>
                    <td align="right">Sub Total</td>
                </tr>
                @php $tq=0;
                $sub_total=0;
                @endphp
                @foreach($result as $item)
                    @php
                        $tq+=$item->Qty;
                        $sub_total+=($item->Unit_cost*$item->Qty-$item->discount);
                    @endphp
                    <tr class="service">
                        <td>1</td>
                        <td class="tableitem"><p class="itemtext">{{ $item->name }} ({{ $item->product_code }})</p></td>
                        <td class="tableitem"><p class="itemtext">{{ $item->Qty }}</p></td>
                        <td class="tableitem"><p class="itemtext">{{ $item->Unit_cost }}</p></td>
                        <td class="tableitem"><p class="itemtext">{{ $item->discount }}</p></td>
                        <td class="tableitem"><p class="itemtext">{{ $item->tax }}</p></td>
                        <td align="right"><p class="itemtext">-{{ $item->sub_total }}</p></td>
                    </tr>
                @endforeach
                <tr class="tabletitle" style="border-top:double">
                    <td></td>
                    <td></td>
                    <td class="">{{ $tq }}</td>
                    <td class="Rate" colspan="3">Total:</td>
                    <td class="payment" align="right">{{ $sub_total }}</td>
                </tr>
                <tr class="tabletitle" style="border-top:double">
                    <td></td>
                    <td colspan="5" class="Rate">Shipping Cost:</td>
                    <td class="payment" align="right">{{ $sinv->shipping_cost }}</td>
                </tr>
                <tr class="tabletitle" style="border-top:double">
                    <td></td>
                    <td colspan="5" class="Rate">Discount:</td>
                    <td class="payment" align="right">{{ $sinv->discount }}</td>
                </tr>
                <tr class="tabletitle" style="border-top:double">
                    <td></td>
                    <td colspan="5" class="Rate">Order Tax:</td>
                    <td class="payment" align="right">{{ $sinv->order_tax }}</td>
                </tr>
                <tr class="tabletitle" style="border-top:double">
                    <td></td>
                    <td colspan="5" class="Rate">Refund Amount:</td>
                    <td class="payment" align="right">-{{ $sinv->net_total }}</td>
                </tr>
            </table>
        </div><!--End Table-->
        <br><br><br>
        <div style="width: 100%; text-align: center">
            <img src="{{ $pos->qr_img }}" style="width: 100px">
        </div>
        <div id="legalcopy">
            <p class="legal" style="color:black;text-align: center;font-size: 1.1em">{!! nl2br($pos->invoice_footer)  !!} </p>
        </div>

    </div><!--End InvoiceBot-->
</div><!--End Invoice-->
</body>
</html>