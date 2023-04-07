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
        th,td{
            text-align: center;
        }
    </style>
    <div class="content-wrapper">
        <div class="container-fluid">
            <!-- Header start -->
            <div class="row">
                <div class="main-header" style="margin-top: 0px;">
                    <h5>Product Discount</h5>
                    <ol class="breadcrumb breadcrumb-title breadcrumb-arrow">
                        <li class="breadcrumb-item"><a href="../index"><i class="icofont icofont-home"></i></a> </li>
                        <li class="breadcrumb-item"><a href="#">Discount</a> </li>
                        <li class="breadcrumb-item">Product Discount </li>
                    </ol>
                </div>
            </div>
            <!-- End start -->
            <div class="row">
                <!-- Form Control starts -->
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header no-report">
                            <form id="search-form">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" name="name" class="form-control" autocomplete="off">
                                    </div>
                                </div>
                                <!--col-->
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
                                        <button type="button" onclick="get_data(1)" class="btn btn-info btn-mini"><i class="fa fa-search"></i> </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                            <div class="card-block">
                                @can('discount_create')
                                <button type="button" onclick="add_new()" class="btn btn-mini btn-primary pull-right">Add New</button>
                                @endcan
                                <div class="col-sm-12 table-responsive pad0">
                                    <form id="discount-data">
                                    <table class="table table-bordered">
                                        <tr style="background-color: #eeeeee">
                                            <th><input type="checkbox" id="select_all" name="records[]"    /></th>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Discount</th>
                                            <th>Discount By </th>
                                            <th>Validity</th>
                                            <th>Days</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                        <tbody id="get_data"></tbody>
                                        <tr>
                                            <td colspan="9" class="no-report" align="right" style="text-align: right;"> <button type="button" onclick="del_multiple_rec('discount-data','/delete_multiple_discounts')" class="btn btn-mini btn-danger"><i class="fa fa-trash-o"></i> selected</button></td>
                                        </tr>
                                    </table>
                                        </form>
                                    <div class="pagination-panel pull-right no-report"></div><br>
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
    @include('discounts.modal');
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js" ></script>
    <script>

        $('#cat_search').on('change', function (){
            var cat_search = document.getElementById("cat_search");
            if (cat_search.checked) {
                document.getElementsByClassName("discount_products")[0].style.display = "block";
            } else {
                document.getElementsByClassName("discount_products")[0].style.display = "none";
            }
            $('#categories').select2('val', '0');
        });
        $('#discount_by').on('change', function (){
            let value = $(this).val();
            if(value === 'category')
            {
                discountOnAjax(value);
                document.getElementsByClassName("cat_search")[0].style.display = "none";
                $('#discount_on_label').text("Categories");
            }
            if(value === 'product'){
                discountOnAjax(value);
                document.getElementsByClassName("cat_search")[0].style.display = "block";
                $('#discount_on_label').text("Products");

            }else
            {
                $("#discount_on").empty();

            }
        });
        function discountOnAjax(value,select=false)
        {
            $.ajax({
                url:"{{ url('discount_on') }}",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type:"POST",
                dataType:"JSON",
                data:{value:value,product_category: $('#categories').val()},
                success:function (data) {
                    let htmlElement = '';
                    for(var i =0;i < data.length;i++)
                    {
                        htmlElement+="<option value='"+data[i].id+"'>"+data[i].name+"</option>"
                    }
                    $('#discount_on').html(htmlElement);
                    if(select){
                        $('#discount_on').val(select);
                        $('#discount_on').trigger('change');
                    }
                }
            })
        }

        function add_new() {
            $("#discount-form input[name~='id']").val(0);
            $("#discount_on").empty();
            $("#discount_by .select").prop('checked', true);
            document.getElementById("discount-form").reset();
            document.getElementsByClassName("discount_products")[0].style.display = "none";
            $("#new-sub_head").modal();
        }
        
        function save_rec() {
            $('.loader-bg').show();
            $.ajax({
                url:"{{ route('discounts.store') }}",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type:"POST",
                dataType:"JSON",
                data:$("#discount-form").serializeArray(),
                success:function (data) {
                    $("#discount-form input[name~='id']").val(0);
                    toastr.success('Operation successfull.');
                    document.getElementById("discount-form").reset();
                    get_data(1);
                    $('.loader-bg').hide();
                    $("#new-sub_head").modal('hide');
                },error:function(ajaxcontent) {
                    vali=ajaxcontent.responseJSON.errors;
                    if(vali==undefined){
                        toastr.error(ajaxcontent.responseJSON.message);
                        $('.loader-bg').hide();
                        return false;
                    }
                    var errors='';
                    $.each(vali, function( index, value ) {
                        $("#tranfer-form input[name~='" + index + "']").css('border', '1px solid red');
                        toastr.error(value);
                    });
                    $('.loader-bg').hide();
                }
            })
        }
        $(document).ready(function () {
            get_data(1);
        });
        function get_data(page){
            $.ajax({
                url:"{{ url('get_discounts') }}?page="+page,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type:"POST",
                dataType:"JSON",
                data:$("#search-form").serialize(),
                success:function (data) {
                    htmlData='';
                    for(i in data.data){
                        htmlData+='<tr id="'+data.data[i].id+'">';
                        htmlData+='<td><input type="checkbox" class="records" name="records[]" value="'+data.data[i].id+'"></td>';
                        htmlData+='<td>'+(Number(i)+1)+'</td>';
                        htmlData+='<td>'+data.data[i].name+'</td>';
                        htmlData+='<td>'+data.data[i].value+(   (data.data[i].discount_type=="Percentage")?"%":'')+'</td>';
                        htmlData+='<td  class="text-capitalize">'+data.data[i].discount_by+'</td>';
                        htmlData+='<td>'+dateFormat(data.data[i].valid_from, 'dd-MM-yyyy')+' - '+dateFormat(data.data[i].valid_till, 'dd-MM-yyyy')+'</td>';
                        htmlData+='<td>'+date_diff(data.data[i].valid_from,data.data[i].valid_till)+'</td>';


                        htmlData+='<td><input id="id_'+data.data[i].id+'" onclick="change_status('+data.data[i].id+')" type="checkbox" '+(data.data[i].status=='1'?"checked":"")+'></td>';


                        htmlData+='<td>';
                        @can('discount_edit')
                            htmlData+='<a class="btn btn-mini btn-primary" href="javascript:void(0)" onclick="edit('+data.data[i].id+')"><i class="fa fa-edit"></i></a>';
                        @endcan

                        @can('discount_create')
                            htmlData+='<a class="btn btn-mini btn-primary" href="javascript:void(0)" onclick="edit('+data.data[i].id+', \'clone\')"><i class="fa fa-clone"></i></a>';
                        @endcan

                        @can('discount_delete')
                            htmlData+=' <button type="button" onclick="del_rec(\''+data.data[i].id+'\', \'{{ url('/discounts/') }}/'+data.data[i].id+'\')" class="btn btn-mini btn-danger"><i class="fa fa-trash-o"></i> </button>';
                        @endcan

                        htmlData+='</td>';
                        htmlData+='</tr>';
                    }
                    $("#get_data").html(htmlData);
                    pagination(data.total, data.per_page, data.current_page, data.to ,get_data);
                }
            })
        }
        function edit(id,type='') {
            $('.loader-bg').show();
            $("#new-sub_head").modal();
            $.ajax({
                url:"{{ url('discounts') }}/"+id+"/edit",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success:function (data) {
                    let htmlElement = '';
                    if(data['discount_by']=="category"){
                        document.getElementsByClassName("cat_search")[0].style.display = "none";
                        $('#discount_on_label').text("Categories");
                    }else {
                        document.getElementsByClassName("cat_search")[0].style.display = "block";
                        $('#discount_on_label').text("Products");
                    }
                    discountOnAjax(data['discount_by'],data.discount_on.split(","));
                    $('#discount_on').html(htmlElement)
                    if(type =='clone'){
                        $("#discount-form input[name~='id']").val(0);
                    }else{
                        $("#discount-form input[name~='id']").val(data['id']);
                    }
                    $("#discount-form input[name~='name']").val(data['name']);
                    $("#discount-form select[name~='discount_by']").val(data['discount_by']);
                    $("#discount-form input[name~='valid_from']").val(data['valid_from']);
                    $("#discount-form input[name~='valid_till']").val(data['valid_till']);
                    $("#discount-form select[name~='discount_type']").val(data['discount_type']);
                    $("#discount-form input[name~='value']").val(data['value']);
                    $("#discount-form input[name~='min_qty']").val(data['min_qty']);
                    $("#discount-form input[name~='max_qty']").val(data['max_qty']);
                    $('.loader-bg').hide();
                }
            })
        }
        var i=0;
        function more_item() {
            $(".more-item").append('<div class="clearfix"></div> ' +
                '<div class="form-group col-md-3 pf">' +
                '<select class="js-example-basic-single form-control form-control-sm item_name" name="C_ItemID[]">' +
                '<option value="0">Select Item</option>' +
                '{!! App\Models\Item::itemList() !!}'+
                '</select>' +
                '</div>' +
                '<div class="form-group col-md-1 pf">' +
                '<input type="number" class="form-control form-control-sm" id="" name="C_Item_Price[]" placeholder="Price">' +
                '</div>' +
                '<div class="form-group col-md-1 pf">' +
                '<button type="number" class="btn btn-mini btn-danger" name=""><i class="fa fa-trash"></i> </button>' +
                '</div><div class="clearfix"></div>');
            i++;
            $(".js-example-basic-single").select2();
        }
        function change_status(id) {
            $.ajax({
                url:"discounts/change-status",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type:"POST",
                data:{discount_id:id},
                success:function (data) {
                    toastr.success("Status Updated Sucessfully");


                },error:function(ajaxcontent) {
                    vali=ajaxcontent.responseJSON.errors;
                    if(vali==undefined){
                        toastr.error(ajaxcontent.responseJSON.message);
                        $('.loader-bg').hide();
                        return false;
                    }
                    var errors='';
                    $.each(vali, function( index, value ) {
                        $("#tranfer-form input[name~='" + index + "']").css('border', '1px solid red');
                        toastr.error(value);
                    });
                    $('.loader-bg').hide();

                    var checkbox = $("#id_"+id).prop('checked', false);
                }
            })

        }

    </script>
@endsection
