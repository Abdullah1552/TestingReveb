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
                        <li class="breadcrumb-item ative"> Balance Sheet</li>
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
                            <h5 align="center"><span style="border-bottom: double">Balance Sheet</span></h5>
                            <p style="font-size: 12px;text-align: center">As on {{ date('d-m-Y') }}</p>
                            <div class="col-sm-12 table-responsive pad0">
                                <table id="table2excel" class="table table-striped table-hover">
                                    <tbody>
                                    {!! $htmlData !!}
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
    <script type="text/javascript">
        $('#printDiv').on('click', function(event) {
            window.print();
        });
    </script>
    <script src="{{ URL::asset('public/export_excel/jquery.table2excel.js') }}"></script>
    <script>
        var jq = $.noConflict();
        jq(document).ready(function(){
            $(".exportToExcel").click(function () {
                jq("#table2excel").table2excel({
                    filename: "Employees.xls",
                    exclude: ".noExl",
                    name: "Excel Document Name",
                    filename: "balanceSheet" + new Date().toISOString().replace(/[\-\:\.]/g, "") + ".xls",
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