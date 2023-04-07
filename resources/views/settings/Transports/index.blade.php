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
                    <h5>Transport List</h5>
                    <ol class="breadcrumb breadcrumb-title breadcrumb-arrow">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="icofont icofont-home"></i></a> </li>
                        <li class="breadcrumb-item"><a href="#">Settings</a> </li>
                        <li class="breadcrumb-item">Transport List </li>
                    </ol>
                </div>
            </div>
            <!-- End start -->
            <div class="col-12">
                    <div class="card">
                        <form id="form">
                            <div class="card-block">
                                <button type="button" onclick="add_new()" class="btn btn-mini btn-primary pull-right">Add New</button>
                                <div class="col-sm-12 table-responsive pad0">
                                    <table class="table table-bordered">
                                        <tr style="background-color: #eeeeee">
                                            <th>#</th>
                                            <th>Transport Name</th>
                                            <th>Sale Tax Reg.No</th>
                                            <th>National Tax No</th>
                                            <th>Mobile</th>
                                            <th>Address</th>
                                            <th>Action</th>
                                        </tr>
                                        <tbody id="get_data"></tbody>
                                    </table>
                                    <div class="pagination-panel pull-right"></div>
                                    {{--<ul class="pagination pull-right">--}}
                                        {{--<li class="page-item"><a class="page-link" href="#">Previous</a></li>--}}
                                        {{--<li class="page-item"><a class="page-link" href="#">1</a></li>--}}
                                        {{--<li class="page-item"><a class="page-link" href="#">2</a></li>--}}
                                        {{--<li class="page-item"><a class="page-link" href="#">3</a></li>--}}
                                        {{--<li class="page-item"><a class="page-link" href="#">Next</a></li>--}}
                                    {{--</ul>--}}
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
    @include('settings.Transports.modal');
    <script>
        function add_new() {
            $("#new-sub_head").modal();
            $("#transport-form input[name~='id']").val(0);
            document.getElementById("charges-form").reset();
        }
        function save_rec() {
            $('.loader-bg').show();
            $.ajax({
                url:"{{ route('transports.store') }}",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type:"POST",
                dataType:"JSON",
                data:$("#transport-form").serialize(),
                success:function (data) {
                    $("#transport-form input[name~='id']").val(0);
                    toastr.success('Operation successfull.');
                    document.getElementById("transport-form").reset();
                    $('.loader-bg').hide();
                    $("#new-sub_head").modal('hide');
                    get_data();
                },error:function(ajaxcontent) {
                    var er=ajaxcontent.responseJSON.success;
                    if(er=="false"){
                        toastr.error('Something Wrong With your Query..');
                        $('.loader-bg').hide();
                    }
                    vali=ajaxcontent.responseJSON.errors;
                    var errors='';
                    $.each(vali, function( index, value ) {
                        $("#transport-form input[name~='" + index + "']").css('border', '1px solid red');
                        toastr.error(value);
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
                url:"{{ url('get_transports') }}?page="+page,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type:"POST",
                dataType:"JSON",
                success:function (data) {
                    htmlData='';
                    for(i in data.data){
                        htmlData+='<tr id="'+data.data[i].id+'">';
                            htmlData+='<td>'+(Number(i)+1)+'</td>';
                            htmlData+='<td>'+data.data[i].TR_Name+'</td>';
                            htmlData+='<td>'+data.data[i].TR_Sale_Tax+'</td>';
                            htmlData+='<td>'+data.data[i].TR_National_Tax+'</td>';
                            htmlData+='<td>'+data.data[i].TR_Mobile+'</td>';
                            htmlData+='<td>'+data.data[i].TR_Adress1+'</td>';
                            htmlData+='<td>';
                                htmlData+='<a class="btn btn-mini btn-primary" href="javascript:void(0)" onclick="edit('+data.data[i].id+')"><i class="fa fa-edit"></i></a>';
                                htmlData+=' <button type="button" onclick="del_rec(\''+data.data[i].id+'\', \'{{ url('/countries/') }}/'+data.data[i].id+'\')" class="btn btn-mini btn-danger"><i class="fa fa-trash-o"></i> </button>';
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
                url:"{{ url('transports') }}/"+id+"/edit",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success:function (data) {
                    $("#transport-form input[name~='id']").val(data.id);
                    $("#transport-form input[name~='TR_Name']").val(data.TR_Name);
                    $("#transport-form input[name~='TR_Mobile']").val(data.TR_Mobile);
                    $("#transport-form input[name~='TR_Phone']").val(data.TR_Phone);
                    $("#transport-form select[name~='CYID']").val(data.CYID);
                    $("#transport-form input[name~='TR_National_Tax']").val(data.TR_National_Tax);
                    $("#transport-form input[name~='TR_Sale_Tax']").val(data.TR_Sale_Tax);
                    $("#transport-form input[name~='AC_Type']").val(data.AC_Type);
                    $("#transport-form input[name~='TR_Adress1']").val(data.TR_Adress1);
                    $("#transport-form input[name~='TR_Adress2']").val(data.TR_Adress2);
                    $("#transport-form select[name~='PID']").val(data.AC_Type);
                    $("#transport-form select[name~='CYID']").val(data.CYID);
                    $(".js-example-basic-single").select2();
                    $('.loader-bg').hide();
                }
            })
        }
    </script>
@endsection