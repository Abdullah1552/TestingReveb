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
                    <h5>Journal Vouchers</h5>
                    <ol class="breadcrumb breadcrumb-title breadcrumb-arrow">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="icofont icofont-home"></i></a> </li>
                        <li class="breadcrumb-item">Accounts </li>
                        <li class="breadcrumb-item"> Vouchers</li>
                        <li class="breadcrumb-item ative"> Journal List</li>
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
                                @can('journal_voucher_edit')
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
                                        <tbody id=""></tbody>
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
    @include('accounts.Vouchers.jv.modal');
    <script>
        function add_new() {
            $("#new").modal();
            $("#item-form input[name~='id']").val(0);
            document.getElementById("item-form").reset();
        }
        function save_rec() {
            $('.loader-bg').show();
            $.ajax({
                url:"{{ route('countries.store') }}",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type:"POST",
                dataType:"JSON",
                data:$("#country-form").serialize(),
                success:function (data) {
                    $("#country-form input[name~='id']").val(0);
                    toastr.success('Operation successfull.');
                    document.getElementById("country-form").reset();
                    $('.loader-bg').hide();
                    $("#new-sub_head").modal('hide');
                    get_data();
                },error:function(ajaxcontent) {
                    toastr.error('Something Wrong with your request....');
                    vali=ajaxcontent.responseJSON.errors;
                    var errors='';
                    $.each(vali, function( index, value ) {
                        $("#country-form input[name~='" + index + "']").css('border', '1px solid red');
                    });
                    $('.loader-bg').hide();
                }
            })
        }
        $(document).ready(function () {
            //get_data();
        });
        function get_data(page){
            $.ajax({
                url:"{{ url('get_countries') }}?page="+page,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type:"POST",
                dataType:"JSON",
                success:function (data) {
                    htmlData='';
                    for(i in data.data){
                        htmlData+='<tr id="'+data.data[i].id+'">';
                        htmlData+='<td>'+(Number(i)+1)+'</td>';
                        htmlData+='<td>'+data.data[i].CT_Name+'</td>';
                        htmlData+='<td>';
                        @can('journal_voucher_edit')
                        htmlData+='<a class="btn btn-mini btn-primary" href="javascript:void(0)" onclick="edit('+data.data[i].id+')"><i class="fa fa-edit"></i></a>';
                        @endcan
                            @can('journal_voucher_delete')
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
    </script>
@endsection