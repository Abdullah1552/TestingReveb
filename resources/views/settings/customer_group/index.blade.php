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
                    <h5>Customer Group</h5>
                    <ol class="breadcrumb breadcrumb-title breadcrumb-arrow">
                        <li class="breadcrumb-item"><a href="../index"><i class="icofont icofont-home"></i></a> </li>
                        <li class="breadcrumb-item"><a href="#">Settings</a> </li>
                        <li class="breadcrumb-item active">Customer Group </li>
                    </ol>
                </div>
            </div>
            <!-- End start -->
            <div class="row">
                <!-- Form Control starts -->
                <div class="col-md-12">
                    <div class="card">
                        <form id="form">
                            <div class="card-block">
                                @can('customer_group_create')
                                <button type="button" onclick="add_new()" class="btn btn-mini btn-primary pull-right">Add New</button>
                                @endcan
                                <div class="col-sm-12 table-responsive pad0">
                                    <table class="table table-bordered">
                                        <tr style="background-color: #eeeeee">
                                            <th><input type="checkbox"></th>
                                            <th>Name</th>
                                            <th>Percentage</th>
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
    @include('settings.customer_group.modal');
    <script>
        function add_new() {
            $("#new-sub_head").modal();
        }
        function save_rec() {
            $('.loader-bg').show();
            $.ajax({
                url:"{{ route('customer_group.store') }}",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type:"POST",
                dataType:"JSON",
                data:$("#customer-group-form").serialize(),
                success:function (data) {
                    $("#customer-group-form input[name~='id']").val(0);
                    toastr.success('Operation successfull.');
                    document.getElementById("customer-group-form").reset();
                    $('.loader-bg').hide();
                    $("#new-sub_head").modal('hide');
                    get_data(1);
                },error:function(ajaxcontent) {
                    vali=ajaxcontent.responseJSON.errors;
                    var errors='';
                    $.each(vali, function( index, value ) {
                        toastr.error(value);
                        $("#supplier-form input[name~='"+index +"']").css('border', '1px solid red');
                        $("#supplier-form select[name~='"+index +"']").parents('.form-group').find('.select2').css('border', '1px solid red');
                    });
                    $('.loader-bg').hide();
                }
            })
        }
       $(document).ready(function () {
           get_data();
       });
        function get_data(page){
            $.ajax({
                url:"{{ url('settings/get_customer_group') }}?page="+page,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type:"POST",
                dataType:"JSON",
                success:function (data) {
                    htmlData='';
                    for(i in data.data){
                        htmlData+='<tr id="'+data.data[i].id+'">';
                        htmlData+='<td>'+(Number(i)+1)+'</td>';
                        htmlData+='<td>'+data.data[i].name+'</td>';
                        htmlData+='<td>'+data.data[i].percentage+'</td>';
                        htmlData+='<td>';
                        @can('customer_group_edit')
                        htmlData+='<a class="btn btn-mini btn-primary" href="javascript:void(0)" onclick="edit('+data.data[i].id+')"><i class="fa fa-edit"></i></a>';
                        @endcan
                            @can('customer_group_delete')
                        htmlData+=' <button type="button" onclick="del_rec(\''+data.data[i].id+'\', \'{{ url('/settings/customer_group/') }}/'+data.data[i].id+'\')" class="btn btn-mini btn-danger"><i class="fa fa-trash-o"></i> </button>';
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
                url:"{{ url('settings/customer_group') }}/"+id+"/edit",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success:function (data) {
                    $("#customer-group-form input[name~='id']").val(data[0]['id']);
                    $("#customer-group-form input[name~='name']").val(data[0]['name']);
                    $("#customer-group-form input[name~='percentage']").val(data[0]['percentage']);
                    $('.loader-bg').hide();
                }
            })
        }
    </script>
@endsection
