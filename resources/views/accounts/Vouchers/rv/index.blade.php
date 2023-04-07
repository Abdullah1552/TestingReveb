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
                    <h5>Receipt Vouchers</h5>
                    <ol class="breadcrumb breadcrumb-title breadcrumb-arrow">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="icofont icofont-home"></i></a> </li>
                        <li class="breadcrumb-item">Accounts </li>
                        <li class="breadcrumb-item">Vouchers </li>
                        <li class="breadcrumb-item active">Receipt List </li>
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
                                @can('receipt_vouhcer_create')
                                <button type="button" onclick="add_new()" class="btn btn-mini btn-primary pull-right">Add New</button>
                                @endcan
                                <div class="col-sm-12 table-responsive pad0">
                                    <table class="table table-bordered">
                                        <tr>
                                            <th>#</th>
                                            <th>V.N</th>
                                            <th width="12%">Trans Date</th>
                                            <th>Description</th>
                                            <th>Amount</th>
                                            <th width="25%">Action</th>
                                        </tr>
                                        <tbody id="get_data"></tbody>
                                    </table>
                                    <div class="pagination-panel pull-right"></div>

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
    @include('accounts.Vouchers.rv.modal');
    <script>
        function add_new() {
            $("#new").modal();
            $("#receipt-form input[name~='id']").val(0);
            document.getElementById("item-form").reset();
        }
        function save_rec() {
            $('.loader-bg').show();
            $.ajax({
                url:"{{ route('rv.store') }}",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type:"POST",
                dataType:"JSON",
                data:$("#receipt-form").serializeArray(),
                success:function (data) {
                    $("#receipt-form input[name~='id']").val(0);
                    toastr.success('Operation successfull.');
                    document.getElementById("receipt-form").reset();
                    $('.loader-bg').hide();
                    $("#new").modal('hide');
                    get_data();
                },error:function(ajaxcontent) {
                    toastr.error('Something Wrong with your request....');
                    vali=ajaxcontent.responseJSON.errors;
                    var errors='';
                    $.each(vali, function( index, value ) {
                        $("#receipt-form input[name~='" + index + "']").css('border', '1px solid red');
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
                url:"{{ url('get_rv') }}?page="+page,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type:"POST",
                dataType:"JSON",
                success:function (data) {
                    let htmlData='';
                    for(i in data.data){
                        htmlData+='<tr id="'+data.data[i].id+'">';
                        htmlData+='<td>'+(Number(i)+1)+'</td>';
                        htmlData+='<td>'+data.data[i].trans_code+'</td>';
                        htmlData+='<td>'+data.data[i].trans_date+'</td>';
                        htmlData+='<td>'+data.data[i].narration+'</td>';
                        htmlData+='<td>'+data.data[i].amount+'</td>';
                        htmlData+='<td>';
                        @can('receipt_vouhcer_edit')
                        htmlData+='<a class="btn btn-mini btn-primary" href="javascript:void(0)" onclick="edit('+data.data[i].id+')"><i class="fa fa-edit"></i></a>';
                        @endcan
                            @can('receipt_vouhcer_delete')
                        htmlData+=' <button type="button" onclick="del_rec(\''+data.data[i].id+'\', \'{{ url('/countries/') }}/'+data.data[i].id+'\')" class="btn btn-mini btn-danger"><i class="fa fa-trash-o"></i> </button>';
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
                url:"{{ url('countries') }}/"+id+"/edit",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success:function (data) {
                    $("#country-form input[name~='id']").val(data.id);
                    $("#country-form input[name~='CT_Name']").val(data.CT_Name);
                    $('.loader-bg').hide();
                }
            })
        }
        //fetch invoices against client id
        function get_client_inv_list(g) {
            CLID=$(g).val();
            $.ajax({
                url:"{{ url('get_client_inv_list') }}/"+CLID,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success:function (data) {
                    htmlData='';
                    htmlData+='<option value="">Select Invoice</option>';
                    for(i in data){
                        htmlData+='<option value="'+data[i].SID+'" data-bal="'+data[i].balance+'">'+data[i].SID+'</option>';
                    }
                    $(g).closest('.multi_rv').find('.invoice_list').html(htmlData);
                }
            })
        }
    </script>
@endsection