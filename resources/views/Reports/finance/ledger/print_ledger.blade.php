<?php

?>

        <!doctype html>

<html style="height: 100%;box-sizing: border-box;">
<head>

    <meta charset="utf-8">

    <link rel="stylesheet" type="text/css" href="{{ URL::asset('public/assets/plugins/bootstrap/css/bootstrap.min.css') }}">

    <link href="{{ URL::asset('public/assets/css/font-awesome.min.css') }}" type="text/css" rel="stylesheet">

    <style>

        .page-footer,

        .page-footer-space {

            height: 39px;

        }

        .page-footer {

            position: absolute;

            bottom: 0;

            width: 100%;

            left:0;

        }



        .headerDiv {

            position: relative;

            width: 33.33%;

            float: left;

            min-height: 1px;

        }



        #btns {

            position: relative;

            bottom: 40px;

        }

        /*.footer{

        position: absolute;bottom: 0;height: 39px;

    }*/

        .new-table{font-size: 12px; color: black;}

        .new-table th{text-align: center;}

        .pcontainer {

            position: relative;

            height: 100%;

        }



        @media print {

            #btns {

                display: none;

            }

            @page {

                margin: 0 0.5cm;

                margin-top: 20px;

            }

            html,

            body {

                padding: 0;

                margin: 0;

            }

            #pnumber:after {

                counter-increment: page;

                content: "Page " counter(page);

            }

            .page-footer {

                position: fixed;

            }

            .table-break {

                page-break-before: always;

            }

            .new-table{font-size: 10px !important;}

            .new-table th{text-align: center;}

        }

    </style>
    <title>Muhammad Azeem-Ledger Report</title>
</head>

<body style="width: 100%;">

<div class="pcontainer col-sm-12">
    <table width="100%" style="font-family: sans-serif; line-height: 1.2">
        <tr>
            <td width="33.33%"><img src="{{ URL::asset('public/assets/images/logo/logo.png') }}" width="150"/></td>
            <td width="33.33%" style="text-align: center;">
                <h4 style="margin-bottom: 10px;margin-top: 5px;font-size: 14px;">
                    Revebe<span style="font-size:12px"> (Head Office)</span>
                </h4>
                <p style="margin-bottom: 2px;font-size: 12px;margin-top: 2px;">Test Address</p>
                <p style="margin-bottom: 2px;font-size: 12px;margin-top: 2px;"> Phone:03244659501</p>
                <p style="margin-bottom: 2px;font-size: 12px;margin-top: 2px;">Email:azeemkhalidg3@gmail.com</p>
            </td>
            <td width="33.33%" style="text-align: right;"></td>
        </tr>
    </table>

    <table class="new-table" style="width: 100%; font-family: sans-serif;text-align: center; border-collapse: collapse;" cellpadding="5">

        <thead>

        <tr>

            <td colspan="7">

                <div class="headerDiv" style="text-align: left;">

                    <p style="margin: 5px 0;font-size: 12px;">Statement of:
                        <strong>Muhammad Azeem Khalid</strong>
                    </p>

                </div>

                <div class="headerDiv">

                    <h4 style="margin-bottom: 0px;margin-top: 5px;font-size: 14px;">Sale Report Ledger</h4>

                    <h5 style="margin-bottom: 10px; margin-top: 2px; font-size: 12px;">From:  | To: </h5>

                </div>

                <div class="headerDiv">
                    <h5 style="margin-bottom: 0px; margin-top: 2px; font-size: 11px;text-align: right;font-weight:100;">Printing Date: <?php echo date('d-m-Y') ?></h5>
                </div>
            </td>
        </tr>

        <tr style="border: 1px solid #000;">

            <th style="border: 1px solid #000;" width="10%">Date</th>

            <th style="border: 1px solid #000;" width="5%">VT</th>

            <th style="border: 1px solid #000;" width="5%">Voucher</th>

            <th style="border: 1px solid #000;">Description</th>

            <th style="border: 1px solid #000;" width="10%">Dr</th>

            <th style="border: 1px solid #000;" width="10%">Cr</th>

            <th style="border: 1px solid #000;" width="14%">Balance</th>

        </tr>

        </thead>
        <tbody>
        {!! $data !!}
        </tbody>

        <tfoot style="border: 0px;">

        <tr>

            <td colspan="12">

                <div class="page-footer-space"></div>

            </td>

        </tr>

        </tfoot>

    </table><br>

    <div id="btns" style="margin-bottom: 10px;">

        <form method="post">
            {{--<button class="btn btn-sm btn-info" formaction="excel/ex_ledger" type="submit"><i class="fa fa-file-excel-o"></i> Excel</button>--}}
            <button class="btn btn-sm btn-outline-danger" type="button" onClick="window.print()"><i class="fa fa-print"></i> Print</button>

        </form>

    </div>
    {{--<div class="page-footer">--}}

        {{--<table class="footer" style="width: 100%; font-family: sans-serif;border-top: 1px solid #000;">--}}

            {{--<tr>--}}

                {{--<td style="padding: 5px;text-align: left;font-size: 12px;"></td>--}}

                {{--<td style="padding: 5px;text-align: center;font-size: 12px;">Website: www.jtmc.com.pk</td>--}}

                {{--<td style="padding: 5px;text-align: right;font-size: 12px;">Contact No: 922132400247</td>--}}

            {{--</tr>--}}

        {{--</table>--}}

    {{--</div>--}}

</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<script src="../../assets/plugins/bootstrap/js/bootstrap.min.js"></script>

</body>

</html>
