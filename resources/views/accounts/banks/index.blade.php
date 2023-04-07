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
                    <h5>Bank List</h5>
                    <ol class="breadcrumb breadcrumb-title breadcrumb-arrow">
                        <li class="breadcrumb-item"><a href="../index"><i class="icofont icofont-home"></i></a> </li>
                        <li class="breadcrumb-item"><a href="#">Accounts</a> </li>
                        <li class="breadcrumb-item">Bank List </li>
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
                                            <th>Bank Name</th>
                                            <th>Bank Contact</th>
                                            <th>Bank Account</th>
                                            <th>DOB</th>
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
    @include('Employees.modal');
    <script>
        function add_new() {
            $("#new-sub_head").modal();
        }
        function save_rec() {
            $('.loader-bg').show();
            $.ajax({
                url:"{{ route('employees.store') }}",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type:"POST",
                dataType:"JSON",
                data:$("#employee-form").serialize(),
                success:function (data) {
                    $("#employee-form input[name~='id']").val(0);
                    toastr.success('Operation successfull.');
                    document.getElementById("employee-form").reset();
                    $('.loader-bg').hide();
                    $("#new-sub_head").modal('hide');
                    location.href = "";
                },error:function(ajaxcontent) {
                    vali=ajaxcontent.responseJSON.errors;
                    var errors='';
                    $.each(vali, function( index, value ) {
                        toastr.error(value);
                        $('.loader-bg').hide();
                        $("#employee-form input[name~='" + index + "']").css('border', '1px solid red');
                        $("#employee-form select[name~='" + index + "']").parents('.form-group').find('.select2').css('border', '1px solid red');
                    });
                }
            })
        }
        $(document).ready(function () {
            get_data();
        });
        function get_data(page){
            $.ajax({
                url:"{{ url('get_employees') }}?page="+page,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type:"POST",
                dataType:"JSON",
                success:function (data) {
                    htmlData='';
                    for(i in data.data){
                        htmlData+='<tr id="'+data.data[i].id+'">';
                        htmlData+='<td>'+(Number(i)+1)+'</td>';
                        htmlData+='<td>'+data.data[i].EMP_Name+'</td>';
                        htmlData+='<td>'+data.data[i].EMP_Mobile+'</td>';
                        htmlData+='<td>'+data.data[i].EMP_DOB+'</td>';
                        htmlData+='<td>N/A</td>';
                        htmlData+='<td>';
                        htmlData+='<a class="btn btn-mini btn-primary" href="javascript:void(0)" onclick="edit('+data.data[i].id+')"><i class="fa fa-edit"></i></a>';
                        htmlData+=' <button type="button" onclick="del_rec(\''+data.data[i].id+'\', \'{{ url('/items/') }}/'+data.data[i].id+'\')" class="btn btn-mini btn-danger"><i class="fa fa-trash-o"></i> </button>';
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
                url:"{{ url('employees') }}/"+id+"/edit",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success:function (data) {
                    $("#employee-form input[name~='id']").val(data['id']);
                    $("#employee-form input[name~='EMP_Name']").val(data['EMP_Name']);
                    $("#employee-form input[name~='EMP_Contact_Person']").val(data['EMP_Contact_Person']);
                    $("#employee-form input[name~='EMP_Designation']").val(data['EMP_Designation']);
                    $("#employee-form input[name~='EMP_DOB']").val(data['EMP_DOB']);
                    $("#employee-form select[name~='EMP_Phone']").val(data['EMP_Phone']);
                    $("#employee-form input[name~='EMP_Mobile']").val(data['EMP_Mobile']);
                    $("#employee-form input[name~='EMP_Email']").val(data['EMP_Email']);
                    $("#employee-form select[name~='EMP_CYID']").val(data['EMP_CYID']);
                    $("#employee-form input[name~='EMP_Address_1']").val(data['EMP_Address_1']);
                    $("#employee-form input[name~='EMP_Address_2']").val(data['EMP_Address_2']);
                    $("#employee-form input[name~='EMP_Address_3']").val(data['EMP_Address_3']);
                    $(".js-example-basic-single").select2();
                    $('.loader-bg').hide();
                }
            })
        }
    </script>
@endsection