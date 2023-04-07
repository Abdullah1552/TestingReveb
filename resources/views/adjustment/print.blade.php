

<!doctype html>

<html style="height: 100%;box-sizing: border-box;">

<head>

    <meta charset="utf-8">

    <link rel="stylesheet" type="text/css" href="https://erp.jtmc.com.pk/assets/plugins/bootstrap/css/bootstrap.min.css">

    <title>Adjustment Print</title>

</head>

<body>

<style>

    .report-show{ display: block !important;}

    .page-footer{

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

        @page {margin: 0 0.5cm; margin-top: 50px !important;}

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

    <table align="center"><tbody><tr><td><h5 align="center"><span style="padding:0px 5px 0px 5px;" class="bg-dg">ADJUSTMENT INVOICE</span></h5></td></tr></tbody></table>

    <div style="width: 60%; float: left;">

        <table width="100%" style="font-family: sans-serif; margin-top: 0px;font-size: 12px;float: left;" cellpadding="5">

            <tr>

                <td><div style="width: 20%; float: left;padding-left: 12%;">Location:</div> &ensp;<strong>{{ $po['location']->WH_Name }}</strong></td>

            </tr>
            <tr>

                <td><div style="width: 20%; float: left;padding-left: 12%   ;">User:</div> &ensp;<strong>{{ $po->user_create->name }}</strong></td>

            </tr>


        </table>

    </div>

    <div style="width: 38%; float: left; margin-left: 10px">

        <table width="100%" style="font-family: sans-serif; margin-top: 0px;font-size: 12px;" cellpadding="5">

            <tr>

                <td><div style="width:30%;float: left;padding-right: 3%;">Ref No:</div><strong> &ensp;{{ $po->id }}</strong></td>

            </tr>

            <tr>

                <td><div style="width:30%;float: left;padding-right: 3%;">Date:</div><strong> &ensp; {{ date('d-m-Y h:i'),strtotime($po->created_at) }}</strong></td>

            </tr>

        </table>

    </div>

    <div class="clearfix"></div>

    <table style="width: 100%; font-family: sans-serif;text-align: center;border-collapse: collapse; margin-top: 10px;font-size: 12px;">

        <thead>

        <tr style="border: 1px solid #000;" class="bg-dg">

            <th style="border: 1px solid #000; padding: 3px;text-align:center;width:5%">Sr#</th>

            <th style="border: 1px solid #000; padding: 3px;text-align:center">Product Category</th>
            <th style="border: 1px solid #000; padding: 3px;text-align:center">Product Name</th>
            <th style="border: 1px solid #000; padding: 3px;text-align:center">Product Code</th>

            <th style="text-align: center;width:10%">Plus/Minus</th>

            <th style="border: 1px solid #000; padding: 3px;text-align:center;width:5%;">Quantity</th>

        </tr>

        </thead>

        <tbody>

        @php $sub_total=0;

        $discount=0;

        $order_tax=0;

        $i=0;

        $total_qty=0;

        @endphp

        @foreach($result as $item)

            <?php

            $sub_total+=$item->sub_total;

            $discount+=$item->tax;

            $order_tax=0;

            $total_qty+=$item->Qty;

            ?>

            <tr style="border: 1px solid #000;">

                <td style="border: 1px solid #000; padding: 2px;">{{ $i+1 }}</td>

                <td style="border: 1px solid #000; padding: 2px;text-align:center;">{{ \App\Models\Product::find($item->product_id)->category->name  }} </td>
                <td style="border: 1px solid #000; padding: 2px;text-align:center;">{{ \App\Models\Product::find($item->product_id)->name  }}</td>
                <td style="border: 1px solid #000; padding: 2px;text-align:center;">{{($item->product_code) }}</td>

                <td style="border: 1px solid #000; padding: 2px;">@if($item->in_out==1) Plus @else Minus @endif</td>

                <td style="border: 1px solid #000; padding: 2px;">{{ $item->Qty }}</td>

            </tr>

            @php $i++ @endphp

        @endforeach

        <tr>

            <td colspan="5" style="text-align: right;font-weight: bolder;"><b>Total:</b></td>

            <td>{{ $total_qty }}</td>

        </tr>
        @if(isset($po->notes)&& $po->notes!="")
        <tr>
            <td   style="margin-top:100px;text-align: left;font-weight: bolder;"><b>Note:</b></td>
        </tr>
        <tr>
            <td colspan="5">{{ $po->notes }}</td>
        </tr>
            @endif

        </tbody>

    </table>

</div>

<div class="page-footer col-md-12">

    <table style="width: 100%; font-family: sans-serif;text-align: center;border-collapse: collapse; margin-top: 10px;font-size: 12px;">

       {{-- <tr>

            <td style="" colspan="4" align="left">

                <br><br>

                <h6 style="font-size: 12px;padding:100px;">Prepared By: <u>{{ Auth::user()->name }}</u>  Checked By________________________________</h6>

            </td>

        </tr>--}}

    </table>    <br>





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

<script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script><script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<script src="../assets/plugins/bootstrap/js/bootstrap.min.js"></script>

<script>

    function show_modal(thisVal){

        $("#myModal").modal({ backdrop: 'static' });

        $("#form input[name~='type']").val(thisVal);

    }

    function send_email(){

        $(".btn-success").attr("disabled","disabled").html('<i class="fa fa-refresh fa-spin"></i>');

        $.ajax({

            url:"email_script/sinv_email_ticket",

            type:"POST",

            data:$("#form").serialize(),

            success: function(data){

                if(data==2){

                    alert('Email Sent Successfully...');

                    document.getElementById("form").reset();

                    $("#myModal").modal('hide');

                }

                else{

                    alert("Something Wrong...");

                }

                $(".btn-success").removeAttr("disabled","disabled").text('Send');

            }

        });

    }

</script>

</body>

</html>

