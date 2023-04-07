
<!doctype html>
<html style="height: 100%;box-sizing: border-box;">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="https://erp.jtmc.com.pk/assets/plugins/bootstrap/css/bootstrap.min.css">
    <link href="https://erp.jtmc.com.pk/assets/css/font-awesome.min.css" type="text/css" rel="stylesheet">
    <style>
        .page-footer, .page-footer-space {
            height: 34px;
        }

        .page-footer {
            position: absolute;
            bottom: 0;
            width: 100%;
            left: 0px;
        }
        .headerDiv{position: relative;width: 33.33%;float: left;min-height: 1px;}
        #btns{position: relative;bottom: 0px;}
        /*.footer{
            position: absolute;bottom: 0;height: 39px;
        }*/
        .pcontainer{
            position: relative;height: 100%; margin-bottom: 15px;padding-bottom: 39px;
        }
        .new-table{font-size: 12px;}
        .new-table th{text-align: center;}
        @media print{
            #btns{ display:none;}
            @page { margin: 0 0.5cm; margin-top: 20px}
            html, body {
                padding: 0;
                margin: 0;
            }
            #pnumber:after{
                counter-increment: page;
                content:"Page " counter(page);
            }
            .page-footer{position: fixed; margin-top: 10px;}
            /*.pcontainer{position: relative;padding-bottom: 50px}*/
            .table-break{page-break-before: always;}
            .new-table{font-size: 10px;}
        }
    </style>
    <title>Cash Register Report</title>
</head>
<body>
<div class="pcontainer col-sm-12 canvas_div_pdf table2excel">
    <table width="100%" style="font-family: sans-serif;">
        <tr>
            {{--<td width="33.33%"><img src="../../comp_logo/journies.png" width="150" /></td>--}}
            <td width="66.66%"><h4 style="margin-bottom: 10px;margin-top: 5px;font-size: 14px;"><b>Revebe Digital Agency</h4>
                <p style="margin-bottom: 2px;font-size: 12px;margin-top: 2px;">office no 509 Road Karachi Pakistan</p>
                <p style="margin-bottom: 2px;font-size: 12px;margin-top: 2px;"> Phone: 922132400247</p>
                <p style="margin-bottom: 2px;font-size: 12px;margin-top: 2px;">Email: info@revebe.com</p>
            <td width="33.33%" style="text-align: right;"><img src="{{ URL::asset('public/assets/images/logo/logo.png') }}" width="100" /></td>
        </tr>
        <tr style="text-align: center;"><td style="font-size: 12px;text-align: left;"></td><td></td><td></td></tr>
    </table>
    <table class="new-table" style="width: 100%; font-family: sans-serif;text-align: center; border-collapse: collapse;">
        <thead>
        <tr>
            <td colspan="8">
                <div class="headerDiv" style="font-size: 12px;text-align: left;">
                </div>
                <div class="headerDiv">
                    <h4 style="margin-bottom: 0px;margin-top: 5px;font-size: 14px;">Cash Register Report</h4>
                </div>
                <div class="headerDiv">
                    <h5 style="margin-bottom: 0px; margin-top: 2px; font-size: 11px;text-align: right;font-weight:100;">Printing Date: 2022-08-07 09:50:48</h5>

                </div>
            </td>
        </tr>
        <tr style="border: 1px solid #000;font-size: 12px;">
            <th class="smallText" style="border: 1px solid #000; padding:3px; text-align: center">Staff</th>
            <th class="smallText" style="border: 1px solid #000; padding:3px;text-align: center">Location</th>
            <th class="smallText" style="border: 1px solid #000; padding:3px;text-align: center">Cash in Hand</th>
            <th class="smallText" style="border: 1px solid #000; padding:3px;text-align: center">Opened at</th>
            <th class="smallText" style="border: 1px solid #000; padding:3px;text-align: center">Closed at</th>
        </tr>
        </thead>
        <tbody>
        @foreach($result as $item)
        <tr style="border-top: 1px solid #ccc;">
            <td>{{ $item->staff->name }}</td>
            <td>{{ $item->location->WH_Name }}</td>
            <td>{{ $item->cash_in_hand }}</td>
            <td style="text-align:center;">{{ $item->created_at }}</td>
            <td style="text-align:center;">{{ $item->updated_at }}</td>
        </tr>
            @endforeach
        </tbody>
        <tfoot style="border: 0px;">
        <tr>
            <td colspan="12"><div class="page-footer-space"></div></td>
        </tr>
        </tfoot>
    </table>
    <div id="btns">
        <form method="post">
            <button class="btn btn-sm btn-info exportToExcel" type="button"><i class="fa fa-file-excel-o"></i> Excel</button>
            <button class="btn btn-sm btn-outline-danger" type="button" onClick="window.print()"><i class="fa fa-print"></i> Print</button>
        </form>
    </div>
</div>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="{{ URL::asset('public/export_excel/jquery.table2excel.js') }}"></script>
<script>
    $(function() {
        $(".exportToExcel").click(function(e){
            $(".excel-heading").show();
            var table = $('.table2excel');
            if(table && table.length){
                var preserveColors = (table.hasClass('table2excel_with_colors') ? true : false);
                $('.table2excel').table2excel({
                    exclude: ".noExl",
                    name: "Excel Document Name",
                    filename: "asset_component" + new Date().toISOString().replace(/[\-\:\.]/g, "") + ".xls",
                    fileext: ".xls",
                    exclude_img: true,
                    exclude_links: true,
                    exclude_inputs: true,
                    preserveColors: true,
                });
            }
            $(".excel-heading").hide();
        });

    });
</script>
</body>
</html>
