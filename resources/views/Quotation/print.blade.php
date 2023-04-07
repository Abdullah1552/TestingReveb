
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
    .page-footer,  {
        height: 539px;
    }

    .page-footer {
        position:relative;
        bottom: 0;
        width: 100%;
    }
    .bg-dg{ background-color: silver}
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
    {!! App\Helpers\helpers::a_four_header() !!}
    <table align="center"><tbody><tr><td><h5 align="center"><span style="padding:0px 5px 0px 5px;" class="bg-dg">INVOICE</span></h5></td></tr></tbody></table>
    <div style="width: 60%; float: left;">
        <table width="100%" style="font-family: sans-serif; margin-top: 0px;font-size: 12px;border:1px solid;float: left;" cellpadding="5">
            <tr>
                <td><div style="width: 20%; float: left;text-align: right;">Client Name:</div> &ensp;<strong>{{ $customer->name }}</strong></td>
            </tr>
            <tr>
                <td><div style="width:20%;float: left;text-align: right">User:</div><strong> &ensp; {{ Auth::user()->name }}</strong></td>
            </tr>
        </table>
    </div>
    <div style="width: 38%; float: left; margin-left: 10px">
        <table width="100%" style="font-family: sans-serif; margin-top: 0px;font-size: 12px;border:1px solid;" cellpadding="5">
            <tr>
                <td><div style="width:30%;float: left;text-align: right">Invoice No:</div><strong> &ensp;{{ $so->id }}</strong></td>
            </tr>
            <tr>
                <td><div style="width:30%;float: left;text-align: right">Invoice Date:</div><strong> &ensp; {{ $so->inv_date }}</strong></td>
            </tr>
        </table>
    </div>
    <div class="clearfix"></div>
    <table style="width: 100%; font-family: sans-serif;text-align: center;border-collapse: collapse; margin-top: 10px;font-size: 12px;">
        <thead>
        <tr style="border: 1px solid #000;" class="bg-dg">
            <th style="border: 1px solid #000; padding: 3px;text-align:center">#</th>
            <th style="border: 1px solid #000; padding: 3px;text-align:center">Product</th>
            <th style="border: 1px solid #000; padding: 3px;text-align:center">Quantity</th>
            <th style="border: 1px solid #000; padding: 3px;text-align:center">Unit Price</th>
            <th style="border: 1px solid #000; padding: 3px;text-align:center">Discount</th>
            <th style="border: 1px solid #000; padding: 3px;text-align:center">Tax</th>
            <th style="border: 1px solid #000; padding: 3px;text-align:center">Sub Total</th>
        </tr>
        </thead>
        <tbody>
        @php $sub_total=0;
        $discount=0;
        $order_tax=0;
        @endphp
        @foreach($result as $item)
            <?php
            $sub_total+=$item->sub_total;
            $discount+=$item->tax;
            $order_tax=0;
            ?>
            <tr style="border: 1px solid #000;">
                <td style="border: 1px solid #000; padding: 2px;">1</td>
                <td style="border: 1px solid #000; padding: 2px;text-align:left;">{{ $item->name}} ({{($item->product_code) }})</td>
                <td style="border: 1px solid #000; padding: 2px;">{{ $item->Qty }}</td>
                <td style="border: 1px solid #000; padding: 2px;">{{ $item->Unit_cost }}</td>
                <td style="border: 1px solid #000; padding: 2px;text-align:center;">{{ $item->discount }}</td>
                <td style="border: 1px solid #000; padding: 2px;text-align:center;">{{ $item->tax }}</td>
                <td style="border: 1px solid #000; padding: 2px;text-align:center;">{{ $item->sub_total }}</td>
            </tr>
        @endforeach
        <tr style="border: 1px solid black;" class="">
            <td colspan="4" style="padding:3px;text-align: left;border:1px solid black;">Gross Total</td>
            <td style="border:1px solid black;">{{ $discount }}</td>
            <td style="border:1px solid black;">{{ $order_tax }}</td>
            <td style="border: 1px solid black;">{{ $sub_total }}</td>
        </tr>
        <tr>
            <td colspan="6" align="right" style="padding: 3px;">Shipping Cost </td>
            <td style="border: 1px solid;">{{ $so->shipping_cost }}</td>
        </tr>
        <tr>
            <td colspan="6" align="right" style="padding: 3px;">Discount </td>
            <td style="border: 1px solid;">{{ $so->discount }}</td>
        </tr>
        <tr>
            <td colspan="6" align="right" style="padding: 3px;">Tax </td>
            <td style="border: 1px solid;">{{ $so->order_tax }}</td>
        </tr>
        <tr>
            <td colspan="6" align="right" style="padding: 3px;">Grand Total </td>
            <td style="border: 1px solid;">{{ $so->net_total }}</td>
        </tr>
        </tbody>
    </table>
</div>
<div class="page-footer col-md-12">
    <table style="width: 100%; font-family: sans-serif;text-align: center;border-collapse: collapse; margin-top: 10px;font-size: 12px;">


        <tr style="border: 1px solid #000;" class="bg-dg">
            <td style="padding: 3px;text-align: left;">
            </td>
            <td></td>
            <th style="padding: 3px;text-align: right;border: 1px solid #000">Net Total</th>
            <th style="padding: 3px;text-align: right;">{{ $so->net_total }}</th>
        </tr>
        <tr>
            <td style="border-left: 1px solid #000; border-right: 1px solid #000" colspan="4" align="left">
                <h4 align="center">Revebe Digital Agency</h4>
                <h6 style="font-size: 12px;">_____Prepared By _________________Checked By________________________________</h6>
            </td>
        </tr>
        <tr style="border: 1px solid #000">
            <td colspan="4" align="left">
                <h5>Note:</h5>
                <p></p>
            </td>
        </tr>
    </table>
    <br>


</div>
<div id="btns" class="col-md-12">
    <button class="btn btn-sm btn-outline-danger" type="button" onClick="window.print()"><i class="fa fa-print"></i> Print</button>
</div>


<div class="modal" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="form">
                <input type="hidden" name="inv_id" value="4608">
                <input type="hidden" name="type">

                <div class="modal-header" style="padding:0px 0px 0px 10px;">
                    <h4 class="modal-title">Send Email</h4>
                    <button type="button" class="close" data-dismiss="modal" style="margin-top:-40px;">&times;</button>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" class="form-control" name="subject" placeholder="Subject">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" class="form-control" name="sender_email" placeholder="Type Sender Email">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="text" class="form-control" name="other_det" placeholder="Other Details...">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-success" onClick="send_email()">Send</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>
