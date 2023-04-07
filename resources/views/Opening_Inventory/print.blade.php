
<!doctype html>
<html style="height: 100%;box-sizing: border-box;">
<head>
    <meta charset="utf-8">
    <link href="https://erp.jtmc.com.pk/assets/css/font-awesome.min.css" type="text/css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://erp.jtmc.com.pk/assets/plugins/bootstrap/css/bootstrap.min.css">
    <title>Head Office-Invoice Print</title>
</head>
<body>
<style>
    .page-footer  {
        height: 539px;
    }

    .page-footer {
        position:relative;
        bottom: 0;
        width: 100%;
    }
    .bg-dg{ background-color: silver}
    .report-show{ display: block !important;}
    @media print{
        #btns{ display:none;}
        @page {margin: 0 0.5cm; margin-top: 20px;}
        html, body {
            margin: 0;
            padding: 0;
        }
        .col-md-12{ margin-top: 20px !important;}
        .page-footer{ display: block; position: absolute}
        table td,th{font-size: 10px !important; -webkit-print-color-adjust: exact; }
    }
</style>
<div class="col-md-12" style="position: relative;min-height: 100%;height: 100%; float: left;">
    {!! \App\Helpers\helpers::a_four_header() !!}
    <table align="center"><tbody><tr><td>
                <h5 align="center"><span style="padding:0px 5px 0px 5px;" class="bg-dg">OPENING INVENTORY</span></h5>
            </td>
        </tr>
        </tbody>
    </table>

    <div style="width: 60%; float: left;">

        <table width="100%" style="font-family: sans-serif; margin-top: 0px;font-size: 12px;float: left;" cellpadding="5">

            <tr>

                <td><div style="width: 20%; float: left;padding-left: 12%;">Location:</div> &ensp;<strong>{{ $opening_inv['location']->WH_Name }}</strong></td>

            </tr>
            <tr>

                <td><div style="width: 20%; float: left;padding-left: 12%   ;">User:</div> &ensp;<strong>{{ $opening_inv['user_create']->name }}</strong></td>

            </tr>


        </table>

    </div>

    <div style="width: 38%; float: left; margin-left: 10px">

        <table width="100%" style="font-family: sans-serif; margin-top: 0px;font-size: 12px;" cellpadding="5">

            <tr>

                <td><div style="width:30%;float: left;padding-right: 3%;">Ref No:</div><strong> &ensp;{{ $opening_inv->id }}</strong></td>

            </tr>

            <tr>

                <td><div style="width:30%;float: left;padding-right: 3%;">Date:</div><strong> &ensp; {{ date('d-m-Y h:i'),strtotime($opening_inv->created_at) }}</strong></td>

            </tr>

        </table>

    </div>

    <div class="clearfix"></div>
    <table style="width: 100%; font-family: sans-serif;text-align: center;border-collapse: collapse; margin-top: 10px;font-size: 12px;">
        <thead>
        <tr style="border: 1px solid #000;" class="bg-dg">
            <th style="border: 1px solid #000; padding: 3px;text-align:center">Sr#</th>
            <th style="border: 1px solid #000; padding: 3px;text-align:center">Product Category</th>
            <th style="border: 1px solid #000; padding: 3px;text-align:center">Product Name</th>
            <th style="border: 1px solid #000; padding: 3px;text-align:center">Product Code</th>
            <th style="border: 1px solid #000; padding: 3px;text-align:center">Quantity</th>
        </tr>
        </thead>
        <tbody>
        @php
        $i=0;
        $total_qty=0;
        @endphp
        @foreach($result as $item)
            <?php
            $total_qty+=$item->Qty;
            ?>
            <tr style="border: 1px solid #000;">
                <td style="border: 1px solid #000; padding: 2px;width:5%;">{{ $i+1 }}</td>
                <td style="border: 1px solid #000; padding: 2px;text-align:center;">{{ \App\Models\Product::find($item->product_id)->category->name  }} </td>
                <td style="border: 1px solid #000; padding: 2px;text-align:center;">{{ \App\Models\Product::find($item->product_id)->name  }}</td>
                <td style="border: 1px solid #000; padding: 2px;text-align:center;">{{($item->product_code) }}</td>
                <td style="border: 1px solid #000; padding: 2px;width:5%;">{{ $item->Qty }}</td>
            </tr>
            @php $i++ @endphp
        @endforeach
        <tr style="border: 1px solid black;" class="">
            <td colspan="4" style="padding:3px;text-align: right;font-weight:bold;border:1px solid black;"><b>Total Qty</b></td>
            <td style="padding:3px;text-align: center;font-weight:bold;border:1px solid black;"><b>{{ $total_qty }}</b></td>
        </tr>
        </tbody>
    </table>
</div>
</body>
</html>
