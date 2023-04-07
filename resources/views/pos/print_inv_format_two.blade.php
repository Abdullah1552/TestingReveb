<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{--<link rel="stylesheet" href="{{ URL::asset('public/print/print.css') }}">--}}
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
        @media print {
            html, body {
                width: 80mm;
                height:100%;
                position:absolute;
            }
        }
    </style>
</head>
<body onLoad="print_data()">
<div class="ticket">
    <img src="{{ $pos->inv_img }}" alt="Logo">
    <h4 class="centered" style="border-bottom: double">INVOICE</h4>
    <p class="">
        <strong>Client Name:</strong>Muhammad Azeem
        <br><strong>#Invoice:</strong> INV-{{ $sinv->id }}
        <br>
        <span>Time:<?php echo date('d-m-Y h:i:s') ?> </span><br>
        <span>Cashier: Azeem</span><br>
        <span>Payment Term: Cash</span><br>
    </p>
    <table>
        <thead>
        <tr>
            <th>Sr#</th>
            <th class="">Description</th>
            <th class="">Q.</th>
            <th class="">Price</th>
            <th>Amt</th>
            <th>Dis</th>
            <th>Net Amt</th>
        </tr>
        </thead>
        <tbody>
        @php $tq=0;
    $sub_total=0;
        @endphp
        @foreach($result as $item)
            @php
                $tq+=$item->Qty;
                $sub_total+=($item->Unit_cost*$item->Qty-$item->discount);
            @endphp
            <tr>
                <td width="5%" align="center" style="border:1px solid #E7E4E4;">1</td>
                <td style="width: 70%; border: 1px solid #E7E4E4">{{ $item->name }}({{ $item->product_code }})</td>
                <td width="5%" align="center" style="border:1px solid lightgray;">{{ $item->Qty }}</td>
                <td width="5%" align="center" style="border:1px solid #E7E4E4;">{{ $item->Unit_cost }}</td>
                <td width="5%" align="center" style="border:1px solid #E7E4E4;">{{ number_format(($item->Unit_cost*$item->Qty),2) }}</td>
                <td width="5%" align="center" style="border:1px solid #E7E4E4;">{{ $item->discount }}</td>
                <td width="5%" align="right" style="border:1px solid #E7E4E4;">{{ number_format(($item->Unit_cost*$item->Qty-$item->discount),2) }}</td>
            </tr>
        @endforeach
        <tr>
            <td colspan="5" align="left">Total Item: {{ $tq }}</td>
            <td width="20%"><strong>Sub Total</strong></td>
            <td align="right"><strong>{{ number_format($sub_total,2) }}</td>
        </tr>
        <tr>
            <td colspan="5"></td>
            <td align="left"><strong>Discount</strong></td>
            <td align="right"><strong>{{ $sinv->discount }}</strong></td>
        </tr>
        <tr>
        <tr>
            <td colspan="5"></td>
            <td align="left" style="border-top: 1px solid"><strong>Total</strong></td>
            <td align="right" style="border-top: 1px solid"><strong>{{ number_format(($sub_total-$sinv->discount),2) }}</td>
        </tr>
        <tr>
            <td colspan="5"></td>
            <td align="left" style="border-top: 1px solid"><strong>Received</strong></td>
            <td align="right" style="border-top: 1px solid">{{ number_format($sinv->received_amount,2) }}</td>
        </tr>
        <tr>
            <td colspan="5"></td>
            <td align="left" style="border-top: 1px solid; border-bottom:double"><strong>Balance</strong></td>
            <td align="right" style="border-top: 1px solid; border-bottom:double">{{ number_format(($sub_total-$sinv->discount-$sinv->received_amount),2) }}</td>
        </tr>
        </tbody>
    </table>
    <p class="centered">
        <img style="width:70px" src="{{ $pos->qr_img }}" alt="Logo">
    </p>
    <div style="clear: both"></div>
    <p class="centered" style="border-top: double;border-bottom: double;">No Sign Required</p>
    <p class="centered">Thank You for Shoping with us.
        <br>parzibyte.me/blog</p>
</div>
</body>
</html>