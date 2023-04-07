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
                    <h5>Sale Person List</h5>
                    <ol class="breadcrumb breadcrumb-title breadcrumb-arrow">
                        <li class="breadcrumb-item"><a href="../index"><i class="icofont icofont-home"></i></a> </li>
                        <li class="breadcrumb-item"><a href="#">People</a> </li>
                        <li class="breadcrumb-item">Sale Person </li>
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
                        <form id="search-form" class="no-report">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>SalePerson</label>
                                    <select name="supplier_id" class="form-control js-example-basic-single">
                                        <option value="">Select </option>
                                        {!! \App\Models\SalePerson::dropdown() !!}
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Location</label>
                                    <select name="WHID" class="form-control js-example-basic-single">
                                        <option value="">Select </option>
                                        {!! \App\Models\WhereHouse::dropdown() !!}
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

                        <form id="form">
                            <div class="card-block">
                                @can('sale_person_create')
                                <button type="button" onclick="add_new()" class="btn btn-mini btn-primary pull-right">Add New</button>
                                @endcan
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
                                            <th>Name</th>
                                            <th>Location</th>
                                            <th>Commission %</th>
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
    @include('people.saleperson.modal');
    <script>
        function add_new() {
            $("#new-sub_head").modal();
            $(".more-item").html('');
        }
        $('#sale-person-form').submit(function(e) {
            e.preventDefault();
            $('.loader-bg').show();
            var formData = new FormData(this);
            $.ajax({
                url:"{{ route('sale_persons.store') }}",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type:"POST",
                dataType:"JSON",
                data:formData,
                contentType: false,
                cache: false,
                processData: false,
                success:function (data) {
                    $("#sale-person-form input[name~='id']").val(0);
                    toastr.success('Operation successfull.');
                    document.getElementById("sale-person-form").reset();
                    get_data();
                    $('.loader-bg').hide();
                    $("#new-sub_head").modal('hide');
                },error:function(ajaxcontent) {
                    vali=ajaxcontent.responseJSON.errors;
                    var errors='';
                    $.each(vali, function( index, value ) {
                        $("#sale-person-form input[name~='" + index + "']").css('border', '1px solid red');
                        $("#sale-person-form select[name~='" + index + "']").parents('.form-group').find('.select2').css('border', '1px solid red');
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
                url:"{{ url('people/get_sale_person') }}?page="+page,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data:$("#search-form").serialize(),
                type:"POST",
                dataType:"JSON",
                success:function (data) {
                    htmlData='';
                    for(i in data.data){
                        htmlData+='<tr id="'+data.data[i].id+'">';
                        htmlData+='<td><input type="checkbox"></td>';
                        htmlData+='<td>'+(Number(i)+1)+'</td>';
                        htmlData+='<td>'+data.data[i].name+'</td>';
                        htmlData+='<td>'+data.data[i].location.WH_Name+'</td>';
                        htmlData+='<td>'+data.data[i].commission_per+'</td>';
                        htmlData+='<td>';
                        @can('sale_person_edit')
                        htmlData+='<a class="btn btn-mini btn-primary" href="javascript:void(0)" onclick="edit('+data.data[i].id+')"><i class="fa fa-edit"></i></a>';
                        @endcan
                            @can('sale_person_delete')
                        htmlData+=' <button type="button" onclick="del_rec(\''+data.data[i].id+'\', \'{{ url('/people/sale_persons/') }}/'+data.data[i].id+'\')" class="btn btn-mini btn-danger"><i class="fa fa-trash-o"></i> </button>';
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
                url:"{{ url('people/sale_persons') }}/"+id+"/edit",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success:function (data) {
                    $("#sale-person-form input[name~='id']").val(data[0]['id']);
                    $("#sale-person-form input[name~='name']").val(data[0]['name']);
                    $("#sale-person-form input[name~='company_name']").val(data[0]['company_name']);
                    $("#sale-person-form input[name~='email']").val(data[0]['email']);
                    $("#sale-person-form input[name~='phone_number']").val(data[0]['phone_number']);
                    $("#sale-person-form input[name~='vat_number']").val(data[0]['vat_number']);
                    $("#sale-person-form input[name~='address']").val(data[0]['address']);
                    $("#sale-person-form select[name~='city_id']").val(data[0]['city_id']);
                    $("#sale-person-form input[name~='state']").val(data[0]['state']);
                    $("#sale-person-form input[name~='postal_code']").val(data[0]['postal_code']);
                    $("#sale-person-form select[name~='country_id']").val(data[0]['country_id']);
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
