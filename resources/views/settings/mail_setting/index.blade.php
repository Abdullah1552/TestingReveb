@extends('layouts.app')
@section('content')

    <!-- Modal -->
    <div class="modal fade" id="sendMailModal" tabindex="-1" role="dialog" aria-labelledby="sendMailModalLabel" aria-hidden="true">

        <div class="modal-dialog" role="document">
            <form id="send-test-mail">

                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <div class="form-group">
                            <label for="mail" class="col-form-label">Mail To:</label>
                            <input type="email" name="mail" id="mail" class="form-control" required  placeholder="user@gmail.com" \>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Send Test Mail</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="content-wrapper">
        <div class="container-fluid ">
            <!-- Header start -->
            <div class="row">
                <div class="main-header" style="margin-top: 0px;">
                    <h4>Mail Setting</h4>
                    <ol class="breadcrumb breadcrumb-title breadcrumb-arrow">
                        <li class="breadcrumb-item"><a href="../index"><i class="icofont icofont-home"></i></a> </li>
                        <li class="breadcrumb-item"><a href="#">Setting</a> </li>
                        <li class="breadcrumb-item">Mail Setting</li>
                    </ol>
                </div>
            </div>
            <!-- End start -->
            <div class="row ">
                <div class="col-md-12">
                    <div class="card-block card">
                        <form id="mail-setting-form">
                            @csrf
                            <input type="hidden" name="id" value="0">
                        <div class="panel panel-default">

                            <!--row-->
                            <br>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Mail Host * </label>
                                            <input type="text" name="mail_host" class="form-control form-control-sm" style="height: 28px">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Mail Port *</label>
                                            <input type="text" name="mail_port" class="form-control form-control-sm" >
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Mail Address *</label>
                                            <input type="text" name="mail_address" class="form-control form-control-sm" >

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Password *</label>
                                            <input type="password" name="password" class="form-control form-control-sm" >

                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Mail From Name *</label>
                                            <input type="text" name="mail_from_name" class="form-control form-control-sm" >

                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Encryption *</label>
                                            <input type="text" name="encryption" class="form-control form-control-sm" placeholder="tls/ssl" >

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="col-md-6" style="user-select: auto; font-size: 9px;">
                                        <a>Watch Tutorial for Email configurations</a>

                                    </div>
                                    <div class="col-md-3 " >
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group m-t-25">
                                            <button type="button" class="btn btn-info" id="test-mail-btn" data-toggle="tooltip" data-placement="top" title="Email configurations should be save befor test mail">Test Mail</button>

                                            <button type="button" class="btn btn-danger" onclick="saveData()">Save</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--row-->

                        </div>
                        </form>
                    </div>
                    <!--panel-default-->
                </div>
                <!--col-->
            </div>
        </div>
        <script>
            function saveData() {
                $('.loader-bg').show();
                $.ajax({
                    url:"{{ route('mail_setting.store') }}",
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    type:"POST",
                    dataType:"JSON",
                    data:$("#mail-setting-form").serialize(),
                    success:function (data) {
                        toastr.success('Operation successfull.');
                        $('.loader-bg').hide();
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
                    url:"{{ route('get_mail_setting') }}",
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    type:"POST",
                    dataType:"JSON",
                    success:function (data) {

                        $("#mail-setting-form input[name~='mail_host']").val(data['data'][0].mail_host);
                        $("#mail-setting-form input[name~='mail_port']").val(data['data'][0].mail_port);
                        $("#mail-setting-form input[name~='mail_address']").val(data['data'][0].mail_address);
                        $("#mail-setting-form input[name~='password']").val(data['data'][0].password);
                        $("#mail-setting-form input[name~='mail_from_name']").val(data['data'][0].mail_from_name);
                        $("#mail-setting-form input[name~='encryption']").val(data['data'][0].encryption);
                        $("#mail-setting-form input[name~='id']").val(data['data'][0].id);
                    }
                })
            }

            $("#send-test-mail").submit(function (e) {
                $('.loader-bg').show();

                e.preventDefault();
                $.ajax({
                    url:"/settings/mail_setting/test-mail",
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    type:"POST",
                    data:$("#send-test-mail").serialize(),
                    dataType:"JSON",
                    success:function (ajaxcontent) {
                        $("#sendMailModal").modal('hide');
                        ajaxSuccessToastr(ajaxcontent);
                        console.log(ajaxcontent);
                        $("#mail").val('');
                        $('.loader-bg').hide();
                    },error:function (ajaxcontent) {
                        ajaxErrorToastr(ajaxcontent);
                        $('.loader-bg').hide();
                    }
                });
            });


            $("#test-mail-btn").click(function () {
                $("#sendMailModal").modal('show');
            });

        </script>
        @endsection


        @section('content')
            <div class="row">
                <div class="col-lg-12 margin-tb">
                    <div class="pull-left">
                        <h2>Create New User</h2>
                    </div>
                    <div class="pull-right">
                        <a class="btn btn-primary" href=""> Back</a>
                    </div>
                </div>
            </div>




@endsection
