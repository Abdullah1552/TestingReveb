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
    </style>
    <div class="content-wrapper">
        <div class="container-fluid">
            <!-- Header start -->
            <div class="row">
                <div class="main-header" style="margin-top: 0px;">
                    <h5>Customer List</h5>
                    <ol class="breadcrumb breadcrumb-title breadcrumb-arrow">
                        <li class="breadcrumb-item"><a href="../index"><i class="icofont icofont-home"></i></a> </li>
                        <li class="breadcrumb-item"><a href="#">Settings</a> </li>
                        <li class="breadcrumb-item">Customers </li>
                    </ol>
                </div>
            </div>
            <!-- End start -->
            <div class="row">
                <!-- Form Control starts -->
                <div class="col-md-12">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if(session()->has('message'))
                        <div class="alert alert-success">
                            {{ session()->get('message') }}
                        </div>
                    @endif
                    <div class="card">
                        <form id="form">
                            <div class="card-block">
                                @can('customer_create')
                                <button type="button" onclick="add_new()" class="btn btn-mini btn-primary pull-right">Add New</button>
                                @endcan
                                <div class="col-sm-12 table-responsive pad0">
                                    <table class="table table-bordered">
                                        <tr style="background-color: #eeeeee">
                                            <th>#</th>
                                            <th>Customer Name</th>
                                            <th>Mobile</th>
                                            <th>Designation</th>
                                            <th>DOB</th>
                                            <th>Credit Limit</th>
                                            <th>Action</th>
                                        </tr>
                                        <tbody id="get_data"></tbody>
                                    </table>

                                </div>
                            </div>
                            <!--card-block-->
                        </form>
                    </div>
                    <!--card-->
                </div>
                <!-- Form Control ends -->
            </div>
        </div>
    </div>
    @include('customers.modal');
    <script>
        function add_new() {
            $("#new-sub_head").modal();
            $(".more-item").html('');
        }
        function save_rec() {
            $('.loader-bg').show();
            $.ajax({
                url:"{{ route('customers.store') }}",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type:"POST",
                dataType:"JSON",
                data:$("#customer-form").serializeArray(),
                success:function (data) {
                    $("#customer-form input[name~='id']").val(0);
                    toastr.success('Operation successfull.');
                    document.getElementById("customer-form").reset();
                    get_data();
                    $('.loader-bg').hide();
                    $("#new-sub_head").modal('hide');
                },error:function(ajaxcontent) {
                    vali=ajaxcontent.responseJSON.errors;
                    var errors='';
                    $.each(vali, function( index, value ) {
                        $("#customer-form input[name~='" + index + "']").css('border', '1px solid red');
                        $("#customer-form select[name~='" + index + "']").parents('.form-group').find('.select2').css('border', '1px solid red');
                        toastr.error(value);
                        $('.loader-bg').hide();
                    });
                }
            })
        }
        $(document).ready(function () {
            get_data();
        });
        function get_data(page){
            $.ajax({
                url:"{{ url('get_customers') }}?page="+page,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type:"POST",
                dataType:"JSON",
                success:function (data) {
                    htmlData='';
                    for(i in data.data){
                        htmlData+='<tr id="'+data.data[i].id+'">';
                        htmlData+='<td>'+(Number(i)+1)+'</td>';
                        htmlData+='<td>'+data.data[i].C_Name+'</td>';
                        htmlData+='<td>'+data.data[i].C_Mobile+'</td>';
                        htmlData+='<td>'+data.data[i].designation.Designation+'</td>';
                        htmlData+='<td>'+data.data[i].C_DOB+'</td>';
                        htmlData+='<td>'+data.data[i].C_Credit_Limit+'</td>';
                        htmlData+='<td>';
                        @can('customer_edit')
                        htmlData+='<a class="btn btn-mini btn-primary" href="javascript:void(0)" onclick="edit('+data.data[i].id+')"><i class="fa fa-edit"></i></a>';
                        @endcan
                        @can('customer_delete')
                        htmlData+=' <button type="button" onclick="del_rec(\''+data.data[i].id+'\', \'{{ url('/zone/') }}/'+data.data[i].id+'\')" class="btn btn-mini btn-danger"><i class="fa fa-trash-o"></i> </button>';
                        @endcan
                        htmlData+='</td>';
                        htmlData+='</tr>';
                    }
                    $("#get_data").html(htmlData);
                    pagination(data.total, data.per_page, data.current_page, data.to ,get_data);
                }
            })
        }
        function edit(id) {
            $('.loader-bg').show();
            $("#new-sub_head").modal();
            $.ajax({
                url:"{{ url('customers') }}/"+id+"/edit",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success:function (data) {
                    $("#customer-form input[name~='id']").val(data[0]['id']);
                    $("#customer-form input[name~='C_Name']").val(data[0]['C_Name']);
                    $("#customer-form input[name~='C_C_Person']").val(data[0]['C_C_Person']);
                    $("#customer-form select[name~='C_Designation']").val(data[0]['C_Designation']);
                    $("#customer-form input[name~='C_DOB']").val(data[0]['C_DOB']);
                    $("#customer-form select[name~='C_Type']").val(data[0]['C_Type']);
                    $("#customer-form input[name~='C_National_Tax_No']").val(data[0]['C_National_Tax_No']);
                    $("#customer-form input[name~='C_STR_Reg_No']").val(data[0]['C_STR_Reg_No']);
                    $("#customer-form input[name~='C_Phone']").val(data[0]['C_Phone']);
                    $("#customer-form input[name~='C_Mobile']").val(data[0]['C_Mobile']);
                    $("#customer-form input[name~='C_Email']").val(data[0]['C_Email']);
                    $("#customer-form input[name~='C_Credit_Limit']").val(data[0]['C_Credit_Limit']);
                    $("#customer-form input[name~='C_Credit_Days']").val(data[0]['C_Credit_Days']);
                    $("#customer-form input[name~='C_Expiry_Date']").val(data[0]['C_Expiry_Date']);
                    $("#customer-form select[name~='C_CYID']").val(data[0]['C_CYID']);
                    $("#customer-form select[name~='C_Cost_CID']").val(data[0]['C_Cost_CID']);
                    $("#customer-form input[name~='C_Adress_1']").val(data[0]['C_Adress_1']);
                    $("#customer-form input[name~='C_Adress_2']").val(data[0]['C_Adress_2']);
                    $("#customer-form input[name~='C_Adress_3']").val(data[0]['C_Adress_3']);
                    $("#customer-form select[name~='PID']").val(data[0]['PID']);
                    $(".more-item").html(data.customer_item);
                    $(".js-example-basic-single").select2();
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
    </script>
@endsection