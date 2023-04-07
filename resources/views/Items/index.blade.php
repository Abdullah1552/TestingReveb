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
    </style>
    {{--<script src="{{ URL::asset('public/assets/js/editor.js') }}"></script>--}}
    {{--<link type="text/css" rel="stylesheet" href="{{ URL::asset('public/assets/css/editor.css') }}"/>--}}

    <div class="content-wrapper">
        <div class="container-fluid">
            <!-- Header start -->
            <div class="row">
                <div class="main-header" style="margin-top: 0px;">
                    <ol class="breadcrumb breadcrumb-title breadcrumb-arrow">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="icofont icofont-home"></i></a> </li>
                        <li class="breadcrumb-item">Product List </li>
                    </ol>
                </div>
            </div>
            <!-- End start -->
            <div class="row">
                <!-- Form Control starts -->
                <div class="col-md-12">
                    <div class="card">
                        <div class="car-block">
                            <div class="card-header">
                                <form id="form">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Product Name</label>
                                            <input name="pn" class="form-control " placeholder="Search With Product Name" id="search">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Product Code</label>
                                            <input name="pc" class="form-control " placeholder="Search With Product Code">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Select Category</label>
                                            <select name="category_id" class="form-control js-example-basic-single">
                                                <option value="0">Select</option>
                                                {!! \App\Models\Product\Category::dropdown() !!}
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <label>Per Page</label>
                                            <select name="per_page" class="form-control js-example-basic-single">
                                                {!! \App\Helpers\helpers::per_page() !!}
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <label style="visibility: hidden">afafffsfafas</label>
                                            <button type="submit" class="btn btn-info btn-mini"><i class="fa fa-search"></i> </button>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="card-block">
                                        @can('product_create')
                                            <button type="button"onclick="open_import_records_modal()" class="btn btn-mini btn-white">+<i class="fa fa-file" aria-hidden="true"></i> Import</button>
                                        @endcan
                                        <div class="btn-group pull-right">
                                            @can('product_create')
                                                <button type="button" onclick="add_new()" class="btn btn-mini btn-primary pull-right pullBtn">Add New</button>
                                            @endcan
                                            <button type="button" class="btn btn-mini btn-success pull-right exportToExcel"><i class="fa fa-file-excel-o"></i> </button>
                                        </div>
                                        <div class="col-sm-12 table-responsive " style="padding-top: 25px">
                                            <table class="table table-bordered table2excel">
                                                <tr style="background-color: #eeeeee">
                                                    <th>#</th>
                                                    <th>Image</th>
                                                    <th>Name</th>
                                                    <th>Code</th>
                                                    <th>Brand</th>
                                                    <th>Category</th>
                                                    <th>Unit</th>
                                                    <th>Qty</th>
                                                    <th>Cost</th>
                                                    <th>Profit(%)</th>
                                                    <th>Profit</th>
                                                    <th>Price</th>
                                                    <th class="noExl">Action</th>
                                                </tr>
                                                <tbody id="get_data"></tbody>
                                            </table>
                                            <div class="pagination-panel pull-right noExl"></div>

                                        </div>
                                    </div>
                                    <!--card-block-->
                                </form>
                            </div>
                        </div>
                    </div>
                    <!--card-->
                </div>
                <!-- Form Control ends -->
            </div>
        </div>
    </div>
    @include('Items.modal');
    <script>

        $(document).ready(function name(params) {

            $('#import-products-form').submit(function (e) {
                var formData = new FormData(this);
                e.preventDefault();
                $.ajax({
                    url:"/items/import-products",
                    type:"post",
                    data:formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success:function (ajaxResponse) {
                        ajaxSuccessToastr(ajaxResponse);
                        $("#import-modal").modal('hide');
                        get_data();
                        $('.loader-bg').hide();
                        location.reload();
                    },error:function(ajaxcontent) {
                        ajaxErrorToastr(ajaxcontent);
                        $('.loader-bg').hide();
                    },beforeSend:function () {
                        $('.loader-bg').show();
                    }

                });
            });

        });


        $(function () {
            $(".js-example-basic-single").select2();
        });
        function add_new() {
            $("#new").modal();
            $("#item-form input[name~='id']").val(0);
            $("#more-variant").html('' +
                '<tr>\n' +
                '                                            <td>\n' +
                '                                                <select style="height: 35px" type="text" name="type" class="form-control attrbt" id="attribute">\n' +
                '                                                    <option value="0">Select Attribute</option>\n' +
                '                                                    {!! App\Models\Product\Attribute::dropdown() !!}\n' +
                '                                                </select>\n' +
                '                                            </td>\n' +
                '                                            {{--<td><input style="height: 35px" type="text" name="variant_name[]" class="form-control product_var"></td>--}}\n' +
                '                                            <td><select style="height: 35px" name="variant_name[]" class="form-control product_var selected_attribute">\n' +
                '\n' +
                '                                                </select></td>\n' +
                '                                            <td><input type="number" name="item_code[]" class="form-control"></td>\n' +
                '                                            <td><input type="text" style="height: 35px;" name="additional_price[]" class="form-control"></td>\n' +
                '                                            <td><button type="button" class="btn btn-info more_variant"><i class="fa fa-plus"></i> </button></td>\n' +
                '                                        </tr>');
            $("#pp").hide();
            $("#diff-price-loc").hide();
            $("#promotional-price").hide();
            document.getElementById("item-form").reset();
            $(".js-example-basic-single").select2();
        }
        $('#item-form').submit(function (e) {
            $('.loader-bg').show();
            // var att=$("#attribute option:selected").text();
            e.preventDefault();
            var formData = new FormData(this);
            // formData.append('attribute',att);
            //formData.append('detail',detil);
            $.ajax({
                url:"{{ route('items.store') }}",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type:"POST",
                dataType:"JSON",
                data:formData,
                contentType: false,
                cache: false,
                processData: false,
                success:function (data) {
                    $("#item-form input[name~='id']").val(0);
                    document.getElementById("item-form").reset();
                    $('.loader-bg').hide();
                    $("#new").modal('hide');
                    get_data();
                    ajaxSuccessToastr(data);
                },error:function(ajaxcontent) {
                    ajaxErrorToastr(ajaxcontent);
                    $('.loader-bg').hide();
                }
            })
        });
        $(document).ready(function () {
            get_data();
        });
        $(document).ready(function() {
    $('#search').on('keyup', function() {
        get_data(1); // Trigger the search function with the first page number
    });
});

        function get_data(page){
            $('.loader-bg').show();
            var searchKeyword = $('#search').val();
            $.ajax({
                url:"{{ url('get_items') }}?page="+page,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type:"POST",
                data:{
            "pn": searchKeyword // Pass the search keyword as data
        },
                dataType:"JSON",
                success:function (data) {
                    htmlData='';
                    for(i in data.data){
                        if(data.data[i].product_images!=null) {
                            thumbImg = data.data[i].product_images.split(',');
                        }else{
                            thumbImg=[''];
                        }
                        htmlData+='<tr id="'+data.data[i].id+'">';
                        htmlData+='<td>'+(Number(i)+1)+'</td>';
                        htmlData+='<td><img src="'+thumbImg[0]+'" width="50"> </td>';
                        htmlData+='<td>'+data.data[i].name+'</td>';
                        htmlData+='<td>'+data.data[i].product_code+'</td>';
                        htmlData+='<td>'+data.data[i].brand_name+'</td>';
                        htmlData+='<td>'+(data.data[i].cat_name!=undefined?data.data[i].cat_name:'N/A')+'</td>';
                        htmlData += '<td>'+((data.data[i].unit_name!=null)?data.data[i].unit_name:'N/A')+'</td>';
                        htmlData+='<td>'+data.data[i].pq+'</td>';
                        htmlData+='<td>'+data.data[i].product_cost+'</td>';
                        htmlData+='<td>'+data.data[i].profit_per+'</td>';
                        htmlData+='<td>'+data.data[i].profit_val+'</td>';
                        htmlData+='<td>'+data.data[i].product_price+'</td>';
                        htmlData+='<td>';
                        @can('product_edit')
                            htmlData+='<a class="btn btn-mini btn-primary" href="javascript:void(0)" onclick="edit('+data.data[i].id+')"><i class="fa fa-edit"></i></a>';
                        @endcan

                        @can('product_create')
                            htmlData+=' <a class="btn btn-mini btn-primary" href="javascript:void(0)" onclick="edit('+data.data[i].id+', \'clone\')"><i class="fa fa-clone"></i></a>';
                        @endcan

                        @can('product_delete')
                            htmlData+=' <button type="button" onclick="del_rec(\''+data.data[i].id+'\', \'{{ url('/items/') }}/'+data.data[i].id+'\')" class="btn btn-mini btn-danger" style=""><i class="fa fa-trash-o"></i> </button>';
                        @endcan

                        htmlData+='</td>';
                        htmlData+='</tr>';
                    }
                    $("#get_data").html(htmlData);
                    pagination(data.total, data.per_page, data.current_page, data.to ,get_data);
                    $('.loader-bg').hide();
                }
            })
        }
        // $('#search').on('keyup',function(){

        //     $value=$(this).val();
        //     $('.loader-bg').show();
        //     if($value){
        //         $('.alldata').hide();
        //         $('.searchdata').show();
        //     }else{
        //         $('.alldata').hide();
        //         $('.searchdata').show();
        //     }
        //     $.ajax({
        //         url:"{{ url('get_items') }}?page="+page,
        //         headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        //         type:"POST",
        //         data:{"search":$value},
        //         dataType:"JSON",
        //         success:function (data) {
        //             htmlData='';
        //             for(i in data.data){
        //                 if(data.data[i].product_images!=null) {
        //                     thumbImg = data.data[i].product_images.split(',');
        //                 }else{
        //                     thumbImg=[''];
        //                 }
        //                 htmlData+='<tr id="'+data.data[i].id+'">';
        //                 htmlData+='<td>'+(Number(i)+1)+'</td>';
        //                 htmlData+='<td><img src="'+thumbImg[0]+'" width="50"> </td>';
        //                 htmlData+='<td>'+data.data[i].name+'</td>';
        //                 htmlData+='<td>'+data.data[i].product_code+'</td>';
        //                 htmlData+='<td>'+data.data[i].brand_name+'</td>';
        //                 htmlData+='<td>'+(data.data[i].cat_name!=undefined?data.data[i].cat_name:'N/A')+'</td>';
        //                 htmlData += '<td>'+((data.data[i].unit_name!=null)?data.data[i].unit_name:'N/A')+'</td>';
        //                 htmlData+='<td>'+data.data[i].pq+'</td>';
        //                 htmlData+='<td>'+data.data[i].product_cost+'</td>';
        //                 htmlData+='<td>'+data.data[i].profit_per+'</td>';
        //                 htmlData+='<td>'+data.data[i].profit_val+'</td>';
        //                 htmlData+='<td>'+data.data[i].product_price+'</td>';
        //                 htmlData+='<td>';
        //                 @can('product_edit')
        //                     htmlData+='<a class="btn btn-mini btn-primary" href="javascript:void(0)" onclick="edit('+data.data[i].id+')"><i class="fa fa-edit"></i></a>';
        //                 @endcan

        //                 @can('product_create')
        //                     htmlData+=' <a class="btn btn-mini btn-primary" href="javascript:void(0)" onclick="edit('+data.data[i].id+', \'clone\')"><i class="fa fa-clone"></i></a>';
        //                 @endcan

        //                 @can('product_delete')
        //                     htmlData+=' <button type="button" onclick="del_rec(\''+data.data[i].id+'\', \'{{ url('/items/') }}/'+data.data[i].id+'\')" class="btn btn-mini btn-danger" style=""><i class="fa fa-trash-o"></i> </button>';
        //                 @endcan

        //                 htmlData+='</td>';
        //                 htmlData+='</tr>';
        //             }
        //             $("#get_data").html(htmlData);
        //             pagination(data.total, data.per_page, data.current_page, data.to ,get_data);
        //             $('.loader-bg').hide();
        //         }
        //     })
        // }
        function edit(id, type) {
            $('.loader-bg').show();
            $("#item-form input[name~='is_variant']").prop("checked",false);
            $("#promotional-price").hide();
            $(".prev-variant").hide();
            $("#new").modal();
            $.ajax({
                url:"{{ url('items') }}/"+id+"/edit",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success:function (data) {
                    for (i=0; i<Object.keys(data.result).length; i++){
                        if(Object.keys(data.result)[i]!='is_variant' && Object.keys(data.result)[i]!='is_promo' && Object.keys(data.result)[i]!='featured' && Object.keys(data.result)[i]!='is_diffPrice') {
                            $("#item-form input[name~='" + Object.keys(data.result)[i] + "']").val(Object.values(data.result)[i]);
                            $("#item-form select[name~='" + Object.keys(data.result)[i] + "']").val(Object.values(data.result)[i]);
                        }
                    }
                    if(data.result.featured==1){
                        $("#item-form input[name~='featured']").prop("checked",true);
                    }

                    if(data.result.inventory== 1){
                        var selectElement = $("#item-form input[name~='inventory']");
                        selectElement.val('1');
                        selectElement.trigger('change');

                    }else{
                        var selectElement = $("#item-form input[name~='inventory']");
                        selectElement.val('0');
                        selectElement.trigger('change');
					}
                    if(data.result.is_diffPrice==1){
                        $("#is-diffPrice").prop("checked",true);
                        $("#diff-price-loc").toggle();
                        for (j in data.warehouse){
                            $("#item-form input[name~='diff_price[]']").map(function () {
                                return $(this).val(data.warehouse[j].price);
                            }).get();
                            $("#item-form input[name~='warehouse_id[]']").map(function () {
                                return $(this).val(data.warehouse[j].warehouse_id);
                            }).get();
                        }
                    }
                    if(data.result.is_variant==1){
                        $("#item-form input[name~='is_variant']").prop("checked",true);
                        $("#promotional-price").show();
                        $("#more-variant").html(data.variantHtml);
                        $("#get_attribute").val(data.attr);
                    }
                    if(data.result.is_promo==1){
                        $("#item-form input[name~='is_promo']").prop("checked",true);
                        $("#pp").show();
                    }
                    $("#item-form textarea[name~='detail']").val(data.result.detail);
                    //$("#txtEditor").Editor();
                    $(".js-example-basic-single").select2();
                    if(type=='clone'){
                        $("#item-form input[name~='id']").val(0);
                        $("#item-form input[name~='name']").val('');
                        $("#item-form input[name~='product_code']").val('');
                        // $("#more-variant").html('');
                    }
                }
            });
            $('.loader-bg').hide();
        }
        //different product has different locaiton
        function different_price() {
            $("#diff-price-loc").toggle();
        }
        //is_diffPrice
        function var_price() {
            $("#promotional-price").toggle();
        }
        function promo_price() {
            $("#pp").toggle();
        }
        $(document).on("click",".more_variant",function () {
            htmlData=$(this).closest('tr').find('.selected_attribute').html();
            $('#more-variant').append('<tr class="prev-variant">\
                <td><select disabled style="height: 35px" type="text" class="form-control"><option value="">Select Attribute</select></td>\
                <td><select style="height: 35px" name="variant_name[]" class="form-control selected_attribute product_var"></select></td>\
                <td><input type="number" name="item_code[]" class="form-control"></td>\
                <td><input type="text" style="height: 35px;" name="additional_price[]" class="form-control"></td>\
                <td><button type="button" class="btn btn-primary remove"><i class="fa fa-trash"></i> </button></td>\
                </tr>');
            $('.selected_attribute:last').html('<option value="">Select</option>'+htmlData);

        });
        $(document).on("click",".remove",function () {
            $(this).closest('tr').remove();
        });
        //get random key genrate
        function product_code(){
            $.ajax({
                url:"{{ url('product_code') }}",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type:"GET",
                dataType:"JSON",
                success:function (data) {
                    $("#product-code").val(data);
                }
            })
        }
        $(document).on("change",".product_var",function () {
            var var_product_code=$("#product-code").val();
            $(this).closest('td').next().find('.form-control').val(var_product_code)
        });
        //select attribute
        $(document).on("change",".attrbt",function () {
            var arr=$(this).val().split(',');
            var htmlData='';
            htmlData+='<option value="">Select</option>';
            $.each(arr,function (key,value) {
                htmlData+='<option value="'+value+'">'+value+'</option>';
            });
            $(".selected_attribute").html(htmlData);
            var attr=$(this).find("option:selected").text();
            $("#get_attribute").val(attr)
        });
        $(document).on("keyup",".profit_in",function () {
            thisVal=$(this).val();
            pv=$(".product_cost").val();
            profit=Number(thisVal)-Number(pv);
            $(".profit_val").val(profit);
            $(".profit_per").val((Number(profit)/Number(pv)*100).toFixed(2));

        });


        function open_import_records_modal(){
           $("#import-modal").modal();
        }
        function close_import_records_modal(){
            $("#import-modal").modal('hide');
        }

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
                        filename: "product_list" + new Date().toISOString().replace(/[\-\:\.]/g, "") + ".xls",
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
    @include('Items.import-modal')
@endsection
