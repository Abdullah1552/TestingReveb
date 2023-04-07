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
                    <h5>Supplier List</h5>
                    <ol class="breadcrumb breadcrumb-title breadcrumb-arrow">
                        <li class="breadcrumb-item"><a href="../index"><i class="icofont icofont-home"></i></a> </li>
                        <li class="breadcrumb-item"><a href="#">People</a> </li>
                        <li class="breadcrumb-item">Supplier </li>
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
                                <button type="button" onclick="add_new()" class="btn btn-mini btn-primary pull-right">Add New</button>
                                <div class=" pull-right" style="margin-right: 5px">
                                    <button class="btn btn-mini btn-primary"  type="button">
                                        <span><i title="export to pdf" class="fa fa-file-pdf-o" ></i></span>
                                    </button>
                                    <button class="btn btn-mini btn-warning"  type="button" >
                                        <span ><i title="export to csv" class="fa fa-file-text-o" ></i></span>
                                    </button>
                                    <button class="btn btn-mini btn-info"  type="button" >
                                        <span ><i title="print" class="fa fa-print" ></i></span>
                                    </button>
                                    <button class="btn btn-mini btn-primary" type="button" >
                                        <span ><i title="column visibility" class="fa fa-eye" ></i></span>
                                    </button>
                                </div>
                                <div class="col-sm-12 table-responsive pad0">
                                    <table class="table table-bordered">
                                        <tr style="background-color: #eeeeee">
                                            <th></th>
                                            <th>#</th>
                                            <th>Image</th>
                                            <th>Name</th>
                                            <th>Company Name</th>
                                            <th>VAT Number</th>
                                            <th>Email</th>
                                            <th>Phone Number</th>
                                            <th>Address</th>
                                            <th>Action</th>
                                        </tr>
                                        <tbody id="get_data">

                                        </tbody>
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
    @include('people.supplier.modal');
    <script>
        function add_new() {
            $("#new-sub_head").modal();
            $(".more-item").html('');
        }
        $('#supplier-form').submit(function(e) {
            e.preventDefault();
            $('.loader-bg').show();
            var formData = new FormData(this);
            $.ajax({
                url:"{{ route('suppliers.store') }}",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type:"POST",
                dataType:"JSON",
                data:formData,
                contentType: false,
                cache: false,
                processData: false,
                success:function (data) {
                    $("#customer-form input[name~='id']").val(0);
                    toastr.success('Operation successfull.');
                    document.getElementById("supplier-form").reset();
                    get_data();
                    $('.loader-bg').hide();
                    $("#new-sub_head").modal('hide');
                },error:function(ajaxcontent) {
                    vali=ajaxcontent.responseJSON.errors;
                    var errors='';
                    $.each(vali, function( index, value ) {
                        $("#supplier-form input[name~='" + index + "']").css('border', '1px solid red');
                        $("#supplier-form select[name~='" + index + "']").parents('.form-group').find('.select2').css('border', '1px solid red');
                        toastr.error(value);
                        $('.loader-bg').hide();
                    });
                }
            })
        });
        $(document).ready(function () {
            get_data();
        });
        function get_data(page){
            $.ajax({
                url:"{{ url('get_suppliers') }}?page="+page,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type:"POST",
                dataType:"JSON",
                success:function (data) {
                    htmlData='';
                    for(i in data.data){
                        htmlData+='<tr id="'+data.data[i].id+'">';
                        htmlData+='<td><input type="checkbox"></td>';
                        htmlData+='<td>'+(Number(i)+1)+'</td>';
                        htmlData+='<td><img style="user-select: auto;height: 50px;width: 50px;" src="{{asset('/public/assets/images/')}}/'+data.data[i].image+'"></td>';
                        htmlData+='<td>'+data.data[i].name+'</td>';
                        htmlData+='<td>'+data.data[i].company_name+'</td>';
                        htmlData+='<td>'+data.data[i].vat_number+'</td>';
                        htmlData+='<td>'+data.data[i].email+'</td>';
                        htmlData+='<td>'+data.data[i].phone_number+'</td>';
                        htmlData+='<td>'+data.data[i].address+'</td>';
                        htmlData+='<td>';
                        htmlData+='<a class="btn btn-mini btn-primary" href="javascript:void(0)" onclick="edit('+data.data[i].id+')"><i class="fa fa-edit"></i></a>';
                        htmlData+=' <button type="button" onclick="del_rec(\''+data.data[i].id+'\', \'{{ url('/people/suppliers/') }}/'+data.data[i].id+'\')" class="btn btn-mini btn-danger"><i class="fa fa-trash-o"></i> </button>';
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
                url:"{{ url('people/suppliers') }}/"+id+"/edit",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success:function (data) {
                    $("#supplier-form input[name~='id']").val(data[0]['id']);
                    $("#supplier-form input[name~='name']").val(data[0]['name']);
                    $("#supplier-form input[name~='company_name']").val(data[0]['company_name']);
                    $("#supplier-form input[name~='vat_number']").val(data[0]['vat_number']);
                    $("#supplier-form input[name~='email']").val(data[0]['email']);
                    $("#supplier-form input[name~='phone_number']").val(data[0]['phone_number']);
                    $("#supplier-form input[name~='address']").val(data[0]['address']);
                    $("#supplier-form input[name~='state']").val(data[0]['state']);
                    $("#supplier-form input[name~='postal_code']").val(data[0]['postal_code']);
                    $("#supplier-form select[name~='country']").val(data[0]['country']);
                    $("#supplier-form select[name~='city']").val(data[0]['city']);
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
