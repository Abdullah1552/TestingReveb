@extends('layouts.app')
@section('content')
    <style type="text/css">
        .select2-selection--single {
            border: 0px !important;
            border-radius: 0px !important;
            border-bottom: 1px solid #aaa !important;
            width: 100% !important;
        }
        .select2 {
            width: 100% !important;
        }
        @media print {
            .page-title, #search-form, .panel-heading, hr{
                display: none;}
            @page { size: auto;  margin: 0 auto}
            html, body {
                padding: 0;
                margin: 0;
            }
            th, td{ font-size: 10px}
            #chartContainer{
                margin-top: -50px !important;
            }
            .col-md-6{ width: 50% !important; float: left}
            .no-report{ display: none;}
            .report-show{
                display: block !important;
            }
        }
    </style>
    <div class="content-wrapper">
        <div class="container-fluid">
            <!-- Header start -->
            <div class="row no-report">
                <div class="main-header" style="margin-top: 0px;">
                    <ol class="breadcrumb breadcrumb-title breadcrumb-arrow">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="icofont icofont-home"></i></a> </li>
                        <li class="breadcrumb-item">Accounts </li>
                        <li class="breadcrumb-item"> Reports</li>
                        <li class="breadcrumb-item ative"> Day Book</li>
                    </ol>
                </div>
            </div>
            <!-- End start -->
            <div class="row">
                <!-- Form Control starts -->
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-block">
                            <div class="col-md-12 no-report">
                                <button class="btn btn-mini btn-success exportToExcel pull-right"  type="button" >
                                    <span ><i title="export to csv" class="fa fa-file-text-o" ></i></span>
                                </button>
                                <button class="btn btn-mini btn-info pull-right" id="printDiv"  type="button" >
                                    <span > <i title="print" class="fa fa-print" ></i></span>
                                </button>
                            </div>
                            <table width="100%" style="font-family: sans-serif; display: none" class="report-show">
                                <tr>
                                    {{--<td width="33.33%"><img src="../../comp_logo/journies.png" width="150" /></td>--}}
                                    <td width="66.66%"><h4 style="margin-bottom: 10px;margin-top: 5px;font-size: 14px;"><b>Revebe Digital Agency</h4>
                                        <p style="margin-bottom: 2px;font-size: 12px;margin-top: 2px;">office no 509 Road Karachi Pakistan</p>
                                        <p style="margin-bottom: 2px;font-size: 12px;margin-top: 2px;"> Phone: 922132400247</p>
                                        <p style="margin-bottom: 2px;font-size: 12px;margin-top: 2px;">Email: info@revebe.com</p>
                                    <td width="33.33%" style="text-align: right;"><img src="{{ URL::asset('public/assets/images/logo/logo.png') }}" width="100" /></td>
                                </tr>
                                <tr style="text-align: center;"><td style="font-size: 12px;text-align: left;"></td><td></td><td></td></tr>
                                <tr>
                                    <td colspan="8">
                                        <div class="headerDiv" style="font-size: 12px;text-align: left;">
                                        </div>
                                        <div class="headerDiv">
                                            <h5 style="margin-bottom: 0px; margin-top: 2px; font-size: 11px;text-align: right;font-weight:100;">Printing Date: 2022-08-07 09:50:48</h5>

                                        </div>
                                    </td>
                                </tr>
                            </table>
                            <h5 align="center"><span style="border-bottom: double">Day Book</span></h5>
                            <div class="col-sm-12 table-responsive pad0">
                                <table id="table2excel" class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>#Entry ID</th>
                                        <th>Transaction Date</th>
                                        <th>Entry Type</th>
                                        <th>Amount</th>
                                        <th>Entry By</th>
                                        <th>Entry Time</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($res as $item)
                                        <tr>
                                            <td>{{ \App\Helpers\helpers::dsn($item->trans_code) }}</td>
                                            <td>{{ $item->trans_date }}</td>
                                            <td>{{ \App\Helpers\helpers::vt($item->vt) }}</td>
                                            <td>{{ $item->total }}</td>
                                            <td>Admin</td>
                                            <td>{{ $item->created_at }}</td>
                                            <td><button onclick="view({{ $item->trans_code }})" class="btn btn-primary btn-xs"><i class="fa fa-eye"></i> </button> </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>

                            </div>
                        </div>
                        <!--card-block-->
                    </div>
                    <!--card-->
                </div>
                <!-- Form Control ends -->
            </div>
        </div>
    </div>
    @include('accounts.reports.day_book.modal')
    <script type="text/javascript">
        $('#printDiv').on('click', function(event) {
            window.print();
        });
    </script>
    <script src="{{ URL::asset('public/export_excel/jquery.table2excel.js') }}"></script>
    <script>
        function view(tc) {
            $("#new").modal();
            $("#loader").show();
            $.ajax({
                url:"{{ url('accounts/reports/view_account_day_book') }}/"+tc,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type:"GET",
                dataType:"JSON",
                success:function (data) {
                    var htmlData='';
                    var dr=0;
                    var cr=0;
                    for(i in data){
                        if(data[i].dr_cr==1){
                            dr+=Number(data[i].amount);
                        }
                        if(data[i].dr_cr==2){
                            cr+=Number(data[i].amount);
                        }
                        htmlData+='<tr>';
                        htmlData+='<td>'+(Number(i)+1)+'</td>';
                        htmlData+='<td>'+data[i].trans_acc.Trans_Acc_Name+'</td>';
                        htmlData+='<td>'+data[i].narration+'</td>';
                        htmlData+='<td>'+(data[i].dr_cr==1?data[i].amount:'')+'</td>';
                        htmlData+='<td>'+(data[i].dr_cr==2?data[i].amount:'')+'</td>';
                        htmlData+='</tr>';
                    }
                    htmlData+='<tr>';
                    htmlData+='<th style="text-align: right" colspan="3">Total</th>';
                    htmlData+='<th>'+dr+'</th>';
                    htmlData+='<th>'+cr+'</th>';
                    htmlData+='</tr>';
                    $("#vd").html(htmlData);
                    $("#loader").hide();
                }
            })
        }
        var jq = $.noConflict();
        jq(document).ready(function(){
            $(".exportToExcel").click(function () {
                jq("#table2excel").table2excel({
                    filename: "Employees.xls",
                    exclude: ".noExl",
                    name: "Excel Document Name",
                    filename: "incomeStatement" + new Date().toISOString().replace(/[\-\:\.]/g, "") + ".xls",
                    fileext: ".xls",
                    exclude_img: true,
                    exclude_links: true,
                    exclude_inputs: true,
                    preserveColors: true,
                });
            });
        });
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
@endsection