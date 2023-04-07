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
                    <h5>Customer Types</h5>
                    <ol class="breadcrumb breadcrumb-title breadcrumb-arrow">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="icofont icofont-home"></i></a> </li>
                        <li class="breadcrumb-item"><a href="#">Settings</a> </li>
                        <li class="breadcrumb-item active">Customer Type List </li>
                    </ol>
                </div>
            </div>
            <!-- End start -->
            <div class="row col-md-12">
                <div class="card">
                    <div class="card-block">
                        <button type="button" onclick="add_new()" class="btn btn-mini btn-primary pull-right">Add New</button>
                        <div class="col-sm-12 table-responsive pad0">
                            <table class="table table-bordered">
                                <tr style="background-color: #eeeeee">
                                    <th>#</th>
                                    <th>Customer Type</th>
                                    <th>Action</th>
                                </tr>
                                <tbody id="get_data"></tbody>
                            </table>
                            <div class="pagination-panel pull-right"></div>
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
    @include('customer_types.modal');
    <script>
        function add_new() {
            $("#new-sub_head").modal();
            $("#country-form input[name~='id']").val(0);
            document.getElementById("charges-form").reset();
        }
        function save_rec() {
            $('.loader-bg').show();
            $.ajax({
                url:"{{ route('customer_types.store') }}",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type:"POST",
                dataType:"JSON",
                data:$("#cost_center-form").serialize(),
                success:function (data) {
                    $("#cost_center-form input[name~='id']").val(0);
                    toastr.success('Operation successfull.');
                    document.getElementById("cost_center-form").reset();
                    $('.loader-bg').hide();
                    $("#new-sub_head").modal('hide');
                    get_data();
                },error:function(ajaxcontent) {
                    vali=ajaxcontent.responseJSON.errors;
                    var errors='';
                    $.each(vali, function( index, value ) {
                        $("#cost_center-form input[name~='" + index + "']").css('border', '1px solid red');
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
                url:"{{ url('get_customer_types') }}?page="+page,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type:"POST",
                dataType:"JSON",
                success:function (data) {
                    htmlData='';
                    for(i in data.data){
                        htmlData+='<tr id="'+data.data[i].id+'">';
                        htmlData+='<td>'+(Number(i)+1)+'</td>';
                        htmlData+='<td>'+data.data[i].Customer_Type+'</td>';
                        htmlData+='<td>';
                        htmlData+='<a class="btn btn-mini btn-primary" href="javascript:void(0)" onclick="edit('+data.data[i].id+')"><i class="fa fa-edit"></i></a>';
                        htmlData+=' <button type="button" onclick="del_rec(\''+data.data[i].id+'\', \'{{ url('/customer_types/') }}/'+data.data[i].id+'\')" class="btn btn-mini btn-danger"><i class="fa fa-trash-o"></i> </button>';
                        htmlData+='</td>';
                        htmlData+='</tr>';
                    }
                    $("#get_data").html(htmlData);
                }
            })
        }
        function edit(id) {
            $('.loader-bg').show();
            $("#new-sub_head").modal();
            $.ajax({
                url:"{{ url('customer_types') }}/"+id+"/edit",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success:function (data) {
                    $("#cost_center-form input[name~='id']").val(data.id);
                    $("#cost_center-form input[name~='Customer_Type']").val(data.Customer_Type);
                    $('.loader-bg').hide();
                }
            })
        }
    </script>
@endsection