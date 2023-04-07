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
                    <h5>Location List</h5>
                    <ol class="breadcrumb breadcrumb-title breadcrumb-arrow">
                        <li class="breadcrumb-item"><a href="../index"><i class="icofont icofont-home"></i></a> </li>
                        <li class="breadcrumb-item"><a href="#">Settings</a> </li>
                        <li class="breadcrumb-item">Location </li>
                    </ol>
                </div>
            </div>
            <!-- End start -->
            <div class="row">
                <!-- Form Control starts -->
                <div class="col-md-12">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if(session()->has('message'))
                        <div class="alert alert-success">
                            {{ session()->get('message') }}
                        </div>
                    @endif
                    <div class="card">
                        <form id="form">
                            <div class="card-block">
                                @can('location_create')
                                <button type="button" onclick="add_new()" class="btn btn-mini btn-primary pull-right">Add New</button>
                                @endcan
                                <div class="col-sm-12 table-responsive pad0">
                                    <table class="table table-bordered">
                                        <tr style="background-color: #eeeeee">
                                            <th>#</th>
                                            <th>Warehouse</th>
                                            <th>Phone Number</th>
                                            <th>Email</th>
                                            <th>Address</th>
                                            <th>Action</th>
                                        </tr>
                                        @foreach($result as $key=>$val)
                                            <tr>
                                                <td>{{$key+1}}</td>
                                                <td>{{$val->WH_Name}}</td>
                                                <td>{{$val->WH_Mobile}}</td>
                                                <td>{{$val->WH_Email}}</td>
                                                <td>{{$val->WH_Address}}</td>
                                                <td>
                                                    @can('location_edit')
                                                    <a class="btn btn-mini btn-primary" href="javascript:void(0)" onclick="edit({{ $val->id }})"><i class="fa fa-edit"></i></a>
                                                    @endcan
                                                    @can('location_delete')
                                                    <button class="btn btn-mini btn-danger" onclick="del_rec('{{ $val->id }}', '{{url('where_house',$val->id)}}')"><i class="fa fa-trash-o"></i> </button>
                                                        @endcan

                                                </td>
                                                </td>
                                            </tr>
                                            @endforeach
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
    @include('settings.WhereHouse.modal');
    <script>
        function add_new() {
            $("#new-sub_head").modal();
        }
        function save_rec() {
            $('.loader-bg').show();
            $.ajax({
                url:"{{ route('where_house.store') }}",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type:"POST",
                dataType:"JSON",
                data:$("#wherehouse-form").serialize(),
                success:function (data) {
                    $("#wherehouse-form input[name~='id']").val(0);
                    toastr.success('Operation successfull.');
                    document.getElementById("wherehouse-form").reset();
                    $('.loader-bg').hide();
                    $("#new-sub_head").modal('hide');
                    location.href = "";
                },error:function(ajaxcontent) {
                    vali=ajaxcontent.responseJSON.errors;
                    var errors='';
                    $.each(vali, function( index, value ) {
                        $("#wherehouse-form input[name~='" + index + "']").css('border', '1px solid red');
                        $("#wherehouse-form select[name~='" + index + "']").parents('.form-group').find('.select2').css('border', '1px solid red');
                        toastr.error(value);
                    });
                }
            });
            $('.loader-bg').hide();
        }
        function edit(id) {
            $('.loader-bg').show();
            $("#new-sub_head").modal();
            $.ajax({
                url:"{{ url('where_house') }}/"+id+"/edit",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success:function (data) {
                    $("#wherehouse-form input[name~='id']").val(data[0]['id']);
                    $("#wherehouse-form input[name~='WH_Name']").val(data[0]['WH_Name']);
                    $("#wherehouse-form input[name~='WH_Mobile']").val(data[0]['WH_Mobile']);
                    $("#wherehouse-form input[name~='WH_Phone']").val(data[0]['WH_Phone']);
                    $("#wherehouse-form input[name~='WH_Email']").val(data[0]['WH_Email']);
                    $("#wherehouse-form select[name~='WH_CYID']").val(data[0]['WH_CYID']);
                    $("#wherehouse-form input[name~='WH_Address']").val(data[0]['WH_Address']);
                    $(".js-example-basic-single").select2();
                    $('.loader-bg').hide();
                }
            })
        }
    </script>
@endsection
