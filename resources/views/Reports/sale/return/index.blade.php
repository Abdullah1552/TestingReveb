@extends('layouts.app')
@section('css_files')
    <link rel="stylesheet" href="{{ URL::asset('public/assets/css/reports.css') }}" />
@endsection
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
            .table-print {
                display: block !important;
            }

            .page-title, #search-form, .panel-heading, hr {
                display: none;
            }

            @page {
                size: auto;
                margin: 0 auto
            }

            html, body {
                padding: 0;
                margin: 0;
            }

            th, td {
                font-size: 10px
            }

            #chartContainer {
                margin-top: -50px !important;
            }

            .col-md-6 {
                width: 50% !important;
                float: left
            }

            .no-report {
                display: none;
            }

            .report-show {
                display: block !important;
            }
        }
    </style>
    <div class="content-wrapper">
        <div class="container-fluid">
            <!-- Header start -->
            <div class="row no-report">
                <div class="main-header" style="margin-top: 0px;">
                    <h5>Sale Return Report</h5>
                    <ol class="breadcrumb breadcrumb-title breadcrumb-arrow">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}"><i
                                    class="icofont icofont-home"></i></a></li>
                        <li class="breadcrumb-item">Reports</li>
                        <li class="breadcrumb-item">Sale</li>
                        <li class="breadcrumb-item active">Return</li>
                    </ol>
                </div>
            </div>

            <!-- End start -->
            <div class="row">
                <!-- Form Control starts -->
                <div class="col-md-12">
                    <div class="card">
                        @include('Reports.components.sale-filters')
                        <div class="card-block">
                            <div class="col-sm-12 table-responsive" style="overflow: auto;">
                                <div id="report">
                                    @include('Reports.sale.return.report')
                                </div>
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


    <script>function get_reports() {

            $.ajax({
                url: "{{ url('/reports/sale/return') }}",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type: "POST",
                data: $("#report-filters").serialize(),
                success: function (data) {
                    $("#report").html(data);
                    $('.loader-bg').hide();

                },
                error: function (data) {
                    $('.loader-bg').hide();
                    alert('error');
                }, beforeSend: function (data) {
                    $('.loader-bg').show();

                }
            });
        }
    </script>

    <script src="{{ URL::asset('public/export_excel/jquery.table2excel.js') }}"></script>
    <script>
        $(function () {
            $(".exportToExcel").click(function (e) {
                //$(".excel-heading").show();
                var table = $('.table2excel');
                if (table && table.length) {
                    var preserveColors = (table.hasClass('table2excel_with_colors') ? true : false);
                    $('.table2excel').table2excel({
                        exclude: ".noExl",
                        name: "Excel Document Name",
                        filename: "Available_Stock_report{{date('d-m-Y')}}" + new Date().toISOString().replace(/[\-\:\.]/g, "") + ".xls",
                        fileext: ".xls",
                        exclude_img: true,
                        exclude_links: true,
                        exclude_inputs: true,
                        preserveColors: true,
                    });
                }
            });

        });
    </script>
    <script type="text/javascript">
        $('#printDiv').on('click', function (event) {
            window.print();
        });
    </script>
@endsection
