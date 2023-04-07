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
                    <h5>Transaction A/C List</h5>
                    <ol class="breadcrumb breadcrumb-title breadcrumb-arrow">
                        <li class="breadcrumb-item"><a href="../index"><i class="icofont icofont-home"></i></a> </li>
                        <li class="breadcrumb-item"><a href="#">Accounts</a> </li>
                        <li class="breadcrumb-item">Trans Account List </li>
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
                                <button type="button" onclick="add_new()" class="btn btn-mini btn-primary pull-right">Add New</button>
                                <div class="col-sm-12 table-responsive pad0">
                                    <table class="table table-bordered">
                                        <tr style="background-color: #eeeeee">
                                            <th>#</th>
                                            <th>Code</th>
                                            <th>A/C NAME</th>
                                            <th>A/C TYPE</th>
                                            <th>CURRENT BALANCE</th>
                                            <th>LAST ACTIVITY</th>
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
    @include('accounts.account_transactions.modal');
    <script>
        function add_new() {
            $("#new-sub_head").modal();
        }
        $(function() {
            $("#fetch_head_acc").on("change", function () {
                RID=$(this).val();
                $.ajax({
                    url:'{{ route('fetch_head_acc') }}?RID='+RID,
                    success:function (data) {
                        $("#show_head_acc").html(data);
                    }
                })
            })
        });
        function save_rec() {
            $('.loader-bg').show();
            $.ajax({
                url:"{{ route('trans_acc.store') }}",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type:"POST",
                dataType:"JSON",
                data:$("#trans-form").serialize(),
                success:function (data) {
                    $("#trans-form input[name~='id']").val(0);
                    toastr.success('Operation successfull.');
                    document.getElementById("trans-form").reset();
                    $('.loader-bg').hide();
                    $("#new-sub_head").modal('hide');
                    get_data();
                },error:function(ajaxcontent) {
                    vali=ajaxcontent.responseJSON.errors;
                    var errors='';
                    $.each(vali, function( index, value ) {
                        $("#new-form input[name~='" + index + "']").css('border', '1px solid red');
                        toastr.error(''+value+'');
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
                url:"{{ url('get_trans_acc') }}?page="+page,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type:"POST",
                dataType:"JSON",
                success:function (data) {
                    htmlData='';
                    for(i in data.data){
                        htmlData+='<tr id="'+data.data[i].id+'">';
                        htmlData+='<td>'+(Number(i)+1)+'</td>';
                        htmlData+='<td>'+data.data[i].id+'</td>';
                        htmlData+='<td>'+data.data[i].Trans_Acc_Name +'</td>';
                        htmlData+='<td>'+data.data[i].subhead.Sub_Head_Name +'</td>';
                        htmlData+='<td>N/A</td>';
                        htmlData+='<td>N/A</td>';
                        htmlData+='<td>';
                        if(data.data[i].Parent_Type<0) {
                            htmlData += '<a class="btn btn-mini btn-primary" href="javascript:void(0)" onclick="edit(' + data.data[i].id + ')"><i class="fa fa-edit"></i></a>';
                            htmlData += ' <button type="button" onclick="del_rec(\'' + data.data[i].id + '\', \'{{ url('/zone/') }}/' + data.data[i].id + '\')" class="btn btn-mini btn-danger"><i class="fa fa-trash-o"></i> </button>';
                        }else{
                            htmlData+='N/A';
                        }
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
                url:"{{ url('zone') }}/"+id+"/edit",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success:function (data) {
                    $("#zone-form input[name~='id']").val(data[0].id);
                    $("#zone-form input[name~='Z_Name']").val(data[0].Z_Name);
                    $("#zone-form select[name~='CTID']").val(data[0].CTID);
                    $('.loader-bg').hide();
                    $(".js-example-basic-single").select2();
                }
            })
        }
    </script>
@endsection