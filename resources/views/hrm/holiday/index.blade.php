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
                    <h5>Holiday List</h5>
                    <ol class="breadcrumb breadcrumb-title breadcrumb-arrow">
                        <li class="breadcrumb-item"><a href="../index"><i class="icofont icofont-home"></i></a> </li>
                        <li class="breadcrumb-item"><a href="#">HRM</a> </li>
                        <li class="breadcrumb-item">Holiday </li>
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
                                            <th scope="col"><input type="checkbox" /></th>
                                            <th>#</th>
                                            <th>Date</th>
                                            <th>Employee</th>
                                            <th>From</th>
                                            <th>To</th>
                                            <th>Note</th>
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
    @include('hrm.holiday.modal');
    <script>
        function add_new() {
            $("#new-sub_head").modal();
        }
        function save_rec() {
            $('.loader-bg').show();
            $.ajax({
                url:"{{ route('holiday.store') }}",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type:"POST",
                dataType:"JSON",
                data:$("#holiday-form").serialize(),
                success:function (data) {
                    $("#holiday-form input[name~='id']").val(0);
                    toastr.success('Operation successfull.');
                    document.getElementById("holiday-form").reset();
                    get_data();
                    $('.loader-bg').hide();
                    $("#new-sub_head").modal('hide');
                },error:function(ajaxcontent) {
                    vali=ajaxcontent.responseJSON.errors;
                    var errors='';
                    $.each(vali, function( index, value ) {
                        toastr.error(value);
                        $('.loader-bg').hide();
                        $("#holiday-form input[name~='" + index + "']").css('border', '1px solid red');
                        $("#holiday-form select[name~='" + index + "']").parents('.form-group').find('.select2').css('border', '1px solid red');
                    });
                }
            })
        }
        $(document).ready(function () {
            get_data();
        });
        function get_data(page){
            $.ajax({
                url:"{{ url('hrm/get_holiday') }}?page="+page,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type:"POST",
                dataType:"JSON",
                success:function (data) {
                    htmlData='';
                    for(i in data.data){
                        htmlData+='<tr id="'+data.data[i].id+'">';
                        htmlData+='<td><input type="checkbox"></td>';
                        htmlData+='<td>'+(Number(i)+1)+'</td>';
                        htmlData+='<td>'+data.data[i].created_at+'</td>';
                        htmlData+='<td>Employee</td>';
                        htmlData+='<td>'+data.data[i].from+'</td>';
                        htmlData+='<td>'+data.data[i].to+'</td>';
                        htmlData+='<td>'+data.data[i].note+'</td>';
                        htmlData+='<td>';
                        htmlData+='<a class="btn btn-mini btn-primary" href="javascript:void(0)" onclick="edit('+data.data[i].id+')"><i class="fa fa-edit"></i></a>';
                        htmlData+=' <button type="button" onclick="del_rec(\''+data.data[i].id+'\', \'{{ url('/hrm/holiday/') }}/'+data.data[i].id+'\')" class="btn btn-mini btn-danger"><i class="fa fa-trash-o"></i> </button>';
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
                url:"{{ url('/hrm/holiday') }}/"+id+"/edit",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success:function (data) {
                    $("#holiday-form input[name~='id']").val(data['id']);
                    $("#holiday-form input[name~='to']").val(data['to']);
                    $("#holiday-form input[name~='from']").val(data['from']);
                    $("#holiday-form textarea[name~='note']").val(data['note']);
                    $('.loader-bg').hide();
                }
            })
        }
        function dateFormate(date){
            var formattedDate = new Date(date);
            var d = formattedDate.getDate();
            var m =  formattedDate.getMonth();
            m += 1;  // JavaScript months are 0-11
            var y = formattedDate.getFullYear();
            return d + "." + m + "." + y;
        }
    </script>
@endsection
