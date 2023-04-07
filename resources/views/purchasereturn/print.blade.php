<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{--<link rel="stylesheet" href="{{ URL::asset('public/print/print.css') }}">--}}
    <title>Return</title>
    <script type="text/javascript">
        {{--function print_data() {--}}
        {{--window.print();--}}
        {{--setTimeout(function() {window.close();--}}
        {{--window.location.href='{{ url('sale/pos') }}';--}}
        {{--},0);--}}
        {{--};--}}
    </script>
    <style>
        #invoice-POS{
            /*box-shadow: 0 0 1in -0.25in rgba(0, 0, 0, 0.5);*/
            padding:2mm;
            margin: 0 auto;
            background: #FFF;
        }
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
        .report-show{ display: block !important;}
    </style>
</head>
<body onLoad="print_data()">
{!! \App\Helpers\helpers::a_four_header() !!}
<div id="invoice-POS">
    <div id="mid" style="text-align:left; color:black;">
        <div class="info">
            <div>Supplier   : {{ $customer->name }}</div>
            <div>User   : {{ Auth::user()->name }}</div>
            <div>Date   : {{ date('d-m-Y',strtotime($sinv->date)) }}</div>
            <div>PR#   : {{ $sinv->pr }}</div>
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
                        <td align="right"><p class="itemtext">{{ $item->sub_total }}</p></td>
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
                    <td colspan="5" class="Rate">Discount:</td>
                    <td class="payment" align="right">{{ $sinv->discount }}</td>
                </tr>
                {{--<tr class="tabletitle" style="border-top:double">--}}
                    {{--<td></td>--}}
                    {{--<td colspan="5" class="Rate">Order Tax:</td>--}}
                    {{--<td class="payment" align="right">{{ $sinv->order_tax }}</td>--}}
                {{--</tr>--}}
                <tr class="tabletitle" style="border-top:double">
                    <td></td>
                    <td colspan="5" class="Rate">Receivable Amount:</td>
                    <td class="payment" align="right">{{ $sinv->net_total }}</td>
                </tr>
            </table>
        </div><!--End Table-->
        <br><br><br>
        {{--<div style="width: 100%; text-align: center">--}}
            {{--<img src="{{ $pos->qr_img }}" style="width: 100px">--}}
        {{--</div>--}}

    </div><!--End InvoiceBot-->
</div><!--End Invoice-->
</body>
</html>