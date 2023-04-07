@extends('layouts.app')


@section('content')
    <div class="content-wrapper">
        <div class="container-fluid">
            <!-- Header start -->
            <div class="row">
                <div class="main-header" style="margin-top: 0px;">
                    <h4>Create New Role</h4>
                    <ol class="breadcrumb breadcrumb-title breadcrumb-arrow">
                        <li class="breadcrumb-item"><a href="../index"><i class="icofont icofont-home"></i></a> </li>
                        <li class="breadcrumb-item"><a href="#">Administrator</a> </li>
                        <li class="breadcrumb-item">Add New Role </li>
                    </ol>
                </div>
            </div>
            <!-- End start -->
            <div class="row">
                <!-- Form Control starts -->
                <div class="col-md-12">
                    <div class="card">
                        <form action="{{ route('roles.store') }}" method="post">
                            <input type="hidden" name="id" id="user_id" value="">
                            @CSRF
                            <div class="card-block">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="md-input-wrapper">
                                            <input type="text" class="md-form-control md-input-sm" id="user_acc_name" name="name" required="" style="background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);">
                                            <label>Role Name <sup class="text-danger">*</sup></label>
                                            <span class="md-line"></span></div>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <input type="checkbox" name="">
                                        <label>Check All</label>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-block">
                                        <div class="col-sm-12 table-responsive pad0">
                                            <table class="table ">
                                                <tr style="background-color: #eeeeee">
                                                    <th>#</th>
                                                    <th>Menu Name</th>
                                                    <th>View</th>
                                                    <th>Create</th>
                                                    <th>Edit</th>
                                                    <th>Delete</th>
                                                    <th>Approve</th>
                                                    <th>Send</th>
                                                    <th>Upload</th>
                                                </tr>
                                                <tbody id="get_data"></tbody>
                                            </table>
                                            <div class="pagination-panel pull-right"></div>

                                        </div>
                                    </div>
                                    <!--card-block-->
                                </div>
                                <!--card-->
                                <button type="submit" class="btn btn-primary waves-effect waves-light m-r-30 pull-right"><i class="fa fa-save"></i>
                                    Submit</button>
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        get_data();
        function get_data(page){
            $.ajax({
                url:"{{ url('get_menu') }}?page="+page,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type:"POST",
                dataType:"JSON",
                success:function (data) {
                    $("#get_data").html(data.htmlData);
                }
            })
        }
    </script>
@endsection