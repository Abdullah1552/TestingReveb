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
                    <h5>Employee List</h5>
                    <ol class="breadcrumb breadcrumb-title breadcrumb-arrow">
                        <li class="breadcrumb-item"><a href="../index"><i class="icofont icofont-home"></i></a> </li>
                        <li class="breadcrumb-item"><a href="#">HRM</a> </li>
                        <li class="breadcrumb-item">Employee List </li>
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
                                @can('employee_create')
                                <button type="button" onclick="add_new()" class="btn btn-mini btn-primary pull-right">Add New</button>
                                @endcan
                                <div class="col-sm-12 table-responsive pad0">
                                    <table class="table table-bordered">
                                        <tr style="background-color: #eeeeee">
                                            <th scope="col"><input type="checkbox" /></th>
                                            <th>#</th>
                                            <th>Image</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone Number</th>
                                            <th>Department</th>
                                            <th>Address</th>
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
    @include('hrm.employee.modal');
    <script>
        $('#add-user').on('click', function (){
            var value = $(this).val();
            if( $( this ).attr( 'type' ) === 'checkbox' ) {
                value = +$(this).is( ':checked' );
            }
           if(value ===  1)
           {
               $('#user-login').show()
           }else{
               $('#user-login').hide()
           }
        })
        var finalData = '';
        function add_new() {
            $("#new-sub_head").modal();
        }
        $('#employee-form').submit(function(e) {
            e.preventDefault();
            $('.loader-bg').show();
            var formData = new FormData(this);
            $.ajax({
                url:"{{ route('employee.store') }}",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type:"POST",
                dataType:"JSON",
                contentType: false,
                cache: false,
                processData: false,
                data:formData,
                success:function (data) {
                    $("#employee-form input[name~='id']").val(0);
                    toastr.success('Operation successfully.');
                    document.getElementById("employee-form").reset();
                    $('.loader-bg').hide();
                    $("#new-sub_head").modal('hide');
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
        });
        $(document).ready(function () {
            get_data();
            $('#user-login').hide()
        });
        function get_data(page){

            $.ajax({
                url:"{{ url('hrm/get_employee') }}?page="+page,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type:"POST",
                dataType:"JSON",
                success:function (data) {
                  var  htmlData='';
                    for(i in data.data){

                        htmlData+='<tr id="'+data.data[i].id+'">';
                        htmlData+='<td><input type="checkbox"></td>';
                        htmlData+='<td>'+(Number(i)+1)+'</td>';
                        htmlData+='<td><img style="user-select: auto;height: 50px;width: 50px;" src="{{asset('/public/assets/images/')}}/'+data.data[i].emp_photo+'"></td>';
                        htmlData+='<td>'+data.data[i].name+'</td>';
                        htmlData+='<td>'+data.data[i].email+'</td>';
                        htmlData+='<td>'+data.data[i].phone+'</td>';
                        htmlData+='<td>'+data.data[i].departments.department_name+'</td>';
                        htmlData+='<td>'+data.data[i].emp_address+'</td>';
                        htmlData+='<td>';
                        @can('employee_edit')
                        htmlData+='<a class="btn btn-mini btn-primary" href="javascript:void(0)" onclick="edit('+data.data[i].id+')"><i class="fa fa-edit"></i></a>';
                        @endcan
                            @can('employee_delete')
                        htmlData+=' <button type="button" onclick="del_rec(\''+data.data[i].id+'\', \'{{ url('hrm/employee/') }}/'+data.data[i].id+'\')" class="btn btn-mini btn-danger"><i class="fa fa-trash-o"></i> </button>';
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
                url:"{{ url('/hrm/employee') }}/"+id+"/edit",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success:function (data) {
                    $("#employee-form input[name~='id']").val(data['id']);
                    $("#employee-form input[name~='name']").val(data['name']);
                    $("#employee-form input[name~='email']").val(data['email']);
                    $("#employee-form input[name~='phone']").val(data['phone']);
                    $("#employee-form input[name~='emp_address']").val(data['emp_address']);
                    $(".js-example-basic-single").select2();
                    $('.loader-bg').hide();
                }
            })
        }
    </script>
@endsection
