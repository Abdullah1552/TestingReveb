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
    <div class="content-wrapper">
        <div class="container-fluid">
            <!-- Header start -->
            <div class="row">
                <div class="main-header" style="margin-top: 0px;">
                    <h5>Customer List</h5>
                    <ol class="breadcrumb breadcrumb-title breadcrumb-arrow">
                        <li class="breadcrumb-item"><a href="../index"><i class="icofont icofont-home"></i></a> </li>
                        <li class="breadcrumb-item"><a href="#">People</a> </li>
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

                        <form id="search-form" class="no-report">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Customer</label>
                                    <select name="customer_id" class="form-control js-example-basic-single">
                                        <option value="">Select </option>
                                        {!! \App\Models\Customer::dropdown() !!}
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Phone Number </label>
                                    <input type="text" name="phone_number" class="form-control " placeholder="Reference">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Email </label>
                                    <input type="text" name="email" class="form-control " placeholder="Reference">
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
                                <div class=" pull-right" style="margin-right: 5px">
                                    <button type="button" onclick="add_new()" style="margin-right: 4px;" class="btn btn-mini btn-primary pull-left">Add New</button>
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
                                            <th>#</th>
                                            <th>Customer Group</th>
                                            <th>Name</th>
{{--                                            <th>Company Name</th>--}}
                                            <th>Email</th>
                                            <th>Phone Number</th>
{{--                                            <th>Tax Number</th>--}}
                                            <th>Address</th>
                                            <th>Reward Points</th>
                                            <th>Balance</th>
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
    @include('people.customer.modal');
    <script>
        $( document ).ready(function() {
            $('.user-fields').hide();
        });
        $('#add-user').on('change', function (){
           this.value = this.checked ? 1 : 0;
           let htmlElement = '';
           if($('#add-user').val() === '1' || $('#add-user').val() === 1){
               $('.user-fields').show();
           }else{
               $('.user-fields').hide();
           }
        });
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
                url:"{{ url('people/get_customers') }}?page="+page,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type:"POST",
                data:$("#search-form").serialize(),
                dataType:"JSON",
                success:function (data) {
                    htmlData='';
                    for(i in data.data){
                        htmlData+='<tr id="'+data.data[i].id+'">';
                        htmlData+='<td>'+(Number(i)+1)+'</td>';
                        htmlData+='<td>'+(data.data[i].customer_group!=null ? data.data[i].customer_group.name:'')+'</td>';
                        htmlData+='<td>'+data.data[i].name+'</td>';
                        // htmlData+='<td>'+data.data[i].company_name+'</td>';
                        htmlData+='<td>'+data.data[i].email+'</td>';
                        htmlData+='<td>'+data.data[i].phone_number+'</td>';
                        // htmlData+='<td>'+data.data[i].tax_number+'</td>';
                        htmlData+='<td>'+data.data[i].address+'</td>';
                        htmlData+='<td></td>';
                        htmlData+='<td></td>';
                        htmlData+='<td>';
                        htmlData+='<a class="btn btn-mini btn-primary" href="javascript:void(0)" onclick="edit('+data.data[i].id+')"><i class="fa fa-edit"></i></a>';
                        htmlData+=' <button type="button" onclick="del_rec(\''+data.data[i].id+'\', \'{{ url('/people/customers/') }}/'+data.data[i].id+'\')" class="btn btn-mini btn-danger"><i class="fa fa-trash-o"></i> </button>';
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
                url:"{{ url('people/customers') }}/"+id+"/edit",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success:function (data) {

                    $("#customer-form input[name~='id']").val(data[0]['id']);
                    $("#customer-form select[name~='customer_group_id']").val(data[0].customer_group_id);
                    $("#customer-form input[name~='name']").val(data[0]['name']);
                    $("#customer-form input[name~='company_name']").val(data[0]['company_name']);
                    $("#customer-form input[name~='email']").val(data[0]['email']);
                    $("#customer-form input[name~='phone_number']").val(data[0]['phone_number']);
                    $("#customer-form input[name~='tax_number']").val(data[0]['tax_number']);
                    $("#customer-form input[name~='address']").val(data[0]['address']);
                    $("#customer-form select[name~='city_id']").val(data[0]['city_id']);
                    $("#customer-form select[name~='country_id']").val(data[0].country_id);
                    $("#customer-form input[name~='state']").val(data[0]['state']);
                    $("#customer-form input[name~='postal_code']").val(data[0].postal_code);
                    $('.loader-bg').hide();
                }
            })
        }

    </script>
@endsection
