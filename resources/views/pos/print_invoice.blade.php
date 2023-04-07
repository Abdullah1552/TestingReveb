@if(isset($sinv) && isset($sinv->id) && $sinv->id)
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ URL::asset('public/print/print.css') }}">
    <title>Receipt</title>
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

    <div id="mid" style="text-align:left">
        <div class="info">
            <p style="font-size: 1.1em; color:black;">
               <b>Address: </b>  {{ $location->WH_Address }}</br>
                <b>Email</b>   : {{ $location->WH_Email }}</br>
                {{--Phone   : {{ $location->WH_Mobile }}</br>--}}
            </p>
        </div>
    </div><!--End Invoice Mid-->
    <div id="mid" style="text-align:left; color:black; margin-bottom: 15px !important;">
        <div class="info">
            <div> <b>Client</b>   : {{isset($customer->name ) && $customer->name !="" ?$customer->name :"N/A" }}</div>
            <div><b>Cashier</b>   : {{ (isset($sinv->sale_created_by->name ) && $sinv->sale_created_by->name )?$sinv->sale_created_by->name :"N/A"}}</div>
            <div><b>Date</b>   : {{ date('d-m-Y',strtotime($sinv->inv_date)) }}</div>
            <div><b>Invoice No.</b>   : {{ $sinv->si }}</div>
        </div>
    </div><!--End Invoice Mid-->
    <div id="bot">
        <div id="table">
            <table>
                <tr class="tabletitle f-15">
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

                        @foreach($result as $items)
                        @php
                        $tq+=$items->Qty;
                        $sub_total+=($items->Unit_cost*$items->Qty-$items->discount);
                        @endphp
                    <tr class="service">
                        <td>1</td>
                        <td class="tableitem"><p class="itemtext">{{ $items->name }} ({{ $items->product_code }})</p></td>
                        <td class="tableitem"><p class="itemtext">{{ $items->Qty }}</p></td>
                        <td class="tableitem"><p class="itemtext">{{ $items->Unit_cost }}</p></td>
                        <td class="tableitem"><p class="itemtext">{{ $items->discount }}</p></td>
                        <td class="tableitem"><p class="itemtext">{{ $items->tax }}</p></td>
                        <td align="right"><p class="itemtext">{{ $items->sub_total }}</p></td>
                    </tr>
                    @endforeach

                <tr class="tabletitle" style="border-top:double">
                    <td></td>
                    <td></td>
                    {{-- <td class="">{{$result[0]->total_QTY}}</td> --}}
                    <td class="Rate f-15" colspan="3">Total:</td>
                    <td class="payment" align="right">{{ $sub_total }}</td>
                </tr>
                @if(isset($sinv->shipping_cost) && $sinv->shipping_cost!="0")
                <tr class="tabletitle" style="border-top:double">
                    <td></td>
                    <td colspan="5" class="Rate f-15">Shipping Cost:</td>
                    <td class="payment" align="right">{{ $sinv->shipping_cost }}</td>
                </tr>
                @endif

                @if(isset($sinv->discount) && $sinv->discount!="0")
                <tr class="tabletitle" style="border-top:double">
                    <td></td>
                    <td colspan="5" class="Rate f-15">Discount:</td>
                    <td class="payment" align="right">{{ $sinv->discount }}</td>
                </tr>
                @endif
                @if(isset($sinv->additional_discount) && $sinv->additional_discount!="0")
                <tr class="tabletitle" style="border-top:double">
                    <td></td>
                    <td colspan="5" class="Rate f-15">Additional Discount:</td>
                    <td class="payment" align="right">{{ $sinv->additional_discount }}</td>
                </tr>
                @endif
                @if(isset($sinv->promotional_discount) && $sinv->promotional_discount!="0")
                <tr class="tabletitle" style="border-top:double">
                    <td></td>
                    <td colspan="5" class="Rate f-15">Promotional Discount:</td>
                    <td class="payment" align="right">{{ $sinv->promotional_discount }}</td>
                </tr>
                @endif

                @if(isset($sinv->order_tax) && $sinv->order_tax!="0")
                <tr class="tabletitle" style="border-top:double">
                    <td></td>
                    <td colspan="5" class="Rate f-15">Order Tax:</td>
                    <td class="payment" align="right">{{ $sinv->order_tax }}</td>
                </tr>
                @endif

                <tr class="tabletitle" style="border-top:double">
                    <td></td>
                    <td colspan="5" class="Rate f-15">Paid:</td>
                    <td class="payment" align="right">{{ $sinv->received_amount }}</td>
                </tr>
                {{--<tr class="tabletitle" style="border-top:double">--}}
                    {{--<td></td>--}}
                    {{--<td colspan="5" class="Rate">Received Amount:</td>--}}
                    {{--<td class="payment" align="right">{{ $sinv->change_cash }}</td>--}}
                {{--</tr>--}}
                <tr class="tabletitle" style="border-top:double;border-bottom:double">
                    <td></td>
                    <td colspan="5" class="Rate f-15">Change return:</td>
                    <td class="payment" align="right">{{ $sinv->write_off }}</td>
                </tr>

            </table>
        </div><!--End Table-->
        <div style="width: 100%; text-align: center;margin-top:20px ; ">
            <img src="{{ $pos->qr_img }}" style="width: 100px">
        </div>
        <div id="legalcopy">
            <p class="legal" style="color:black;text-align: center;font-size: 1.1em">{!! nl2br($pos->invoice_footer)  !!} </p>
        </div>

    </div><!--End InvoiceBot-->
</div><!--End Invoice-->
</body>
</html>
@else
    <div style="margin: auto;
    color: #6e786e;
    padding: 10px;
    text-align: center;
    padding-top: 20%;
    font-family: 'Helvetica';">
        <h2 style="font-weight: 400;">No invoice Generated Today ({{date('Y-m-d ')}})</h2>
    </div>
@endif
