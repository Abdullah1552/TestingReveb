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
        .pf {
            padding-left: 5px !important;
            padding-right: 5px !important;
        }
        label {
            display: contents !important;
            color: #050505;
        }
        .form-group {
            margin-bottom: 0.3rem !important;
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
                    <h5>Stock Count</h5>
                    <ol class="breadcrumb breadcrumb-title breadcrumb-arrow">
                        <li class="breadcrumb-item"><a href="../index"><i class="icofont icofont-home"></i></a> </li>
                        <li class="breadcrumb-item"><a href="#">Product</a> </li>
                        <li class="breadcrumb-item">Stock Count </li>
                    </ol>
                </div>
            </div>
            <!-- End start -->
            <div class="row">
                <!-- Form Control starts -->
                <div class="col-md-12">
                    <div class="card">
                        <form id="form">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Product Name</label>
                                    <input name="pn" class="form-control " placeholder="Search With Product Name">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Product Code</label>
                                    <input name="pc" class="form-control " placeholder="Search With Product Code">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Select Category</label>
                                    <select name="category_id" class="form-control ">
                                        <option value="0">Select</option>
                                        {!! App\Models\Product\Category::dropdown() !!}
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Select Location</label>
                                    <select name="wherehouse_id" class="form-control ">
                                        <option value="0">Select</option>
                                        {!! App\Models\WhereHouse::dropdown() !!}
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="form-group">
                                    <label style="visibility: hidden">afafffsfafas</label>
                                    <button type="button" onclick="get_data(1)" class="btn btn-info btn-mini"><i class="fa fa-search"></i> </button>
                                </div>
                            </div>
                      <div></div>
            <div class="row">
                <!-- Form Control starts -->
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-block">
                        <div class="card-header">
                            <form id="form">
                                <div class=" pull-right no-report" style="margin-right: 5px">
                                    {{--<button class="btn btn-mini btn-primary"  type="button">--}}
                                        {{--<span><i title="export to pdf" class="fa fa-file-pdf-o" ></i></span>--}}
                                    {{--</button>--}}
                                    <button class="btn btn-mini btn-success exportToExcel"  type="button" >
                                        <span ><i title="export to csv" class="fa fa-file-text-o" ></i></span>
                                    </button>
                                    <button class="btn btn-mini btn-info" id="printDiv"  type="button" >
                                        <span ><i title="print" class="fa fa-print" ></i></span>
                                    </button>
                                    {{--<button class="btn btn-mini btn-primary" type="button" >--}}
                                        {{--<span ><i title="column visibility" class="fa fa-eye" ></i></span>--}}
                                    {{--</button>--}}
                                </div>
                                </form>
                        </div>
                        </div>
                            <div class="card-block">
                                <div class="col-sm-12 table-responsive pad0">
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
                                                    <h4 style="margin-bottom: 0px;margin-top: 5px;font-size: 14px;">Stock Count Report</h4>
                                                </div>
                                                <div class="headerDiv">
                                                    <h5 style="margin-bottom: 0px; margin-top: 2px; font-size: 11px;text-align: right;font-weight:100;">Printing Date: 2022-08-07 09:50:48</h5>

                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                    <table class="table table-bordered table2excel">
                                        <tr style="background-color: #eeeeee">
                                            <th>#</th>
                                            <th>Product</th>
                                            <th>Product Code</th>
                                            <th>Category</th>
                                            <th>Location</th>
                                            <th>Availabe Qty</th>
                                            <th>Physical Qty</th>
                                        </tr>
                                        <tbody id="get_data"></tbody>
                                    </table>
                                    <div class="pagination-panel pull-right no-report"></div>
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
    @include('Product.stock_count.modal');
    <script>
       $(document).ready(function () {
           get_data();
       });
        function get_data(page){
            $.ajax({
                url:"{{ url('product/get_stock_count') }}?page="+page,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type:"POST",
                data:$("#form").serialize(),
                dataType:"JSON",
                success:function (data) {
                    htmlData='';
                    for(i in data.data){
                        let rq=(Number(data.data[i].pq)-Number(data.data[i].sq));
                        htmlData+='<tr id="'+data.data[i].id+'">';
                        htmlData+='<td>'+(Number(i)+1)+'</td>';
                        htmlData+='<td>'+data.data[i].name+'</td>';
                        htmlData+='<td>'+data.data[i].item_code+'</td>';
                        htmlData+='<td>'+data.data[i].cat_name+'</td>';
                        htmlData+='<td>'+data.data[i].WH_Name+'</td>';
                        htmlData+='<td>'+(rq>0?rq:'0')+'</td>';
                        htmlData+='<td>';
                        // htmlData+='<a class="btn btn-mini btn-primary" href="javascript:void(0)" onclick="edit('+data.data[i].id+')"><i class="fa fa-edit"></i></a>';
                        {{--htmlData+=' <button type="button" onclick="del_rec(\''+data.data[i].id+'\', \'{{ url('/zone/') }}/'+data.data[i].id+'\')" class="btn btn-mini btn-danger"><i class="fa fa-trash-o"></i> </button>';--}}
                        htmlData+='</td>';
                        htmlData+='</tr>';
                    }
                    $("#get_data").html(htmlData);
                    pagination(data.total, data.per_page, data.current_page, data.to ,get_data);
                }
            })
        }
    </script>
    <script type="text/javascript">
        $('#printDiv').on('click', function(event) {
            window.print();
        });
    </script>
    <script src="{{ URL::asset('public/export_excel/jquery.table2excel.js') }}"></script>
    <script>
        $(function() {
            $(".exportToExcel").click(function(e){
                //$(".excel-heading").show();
                var table = $('.table2excel');
                if(table && table.length){
                    var preserveColors = (table.hasClass('table2excel_with_colors') ? true : false);
                    $('.table2excel').table2excel({
                        exclude: ".noExl",
                        name: "Excel Document Name",
                        filename: "stock_count" + new Date().toISOString().replace(/[\-\:\.]/g, "") + ".xls",
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
@endsection
