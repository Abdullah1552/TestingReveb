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
                    <h5>Subhead A/C List</h5>
                    <ol class="breadcrumb breadcrumb-title breadcrumb-arrow">
                        <li class="breadcrumb-item"><a href="../index"><i class="icofont icofont-home"></i></a> </li>
                        <li class="breadcrumb-item"><a href="#">Accounts</a> </li>
                        <li class="breadcrumb-item">Subhead Account List </li>
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
                                <button type="button" onclick="add_new()" class="btn btn-mini btn-primary pull-right">Add New</button>
                                <div class="col-sm-12 table-responsive pad0">
                                    <table class="table table-bordered">
                                        <tr style="background-color: #eeeeee">
                                            <th>#</th>
                                            <th>Sub Head Account Name</th>
                                            <th>Head Account Name</th>
                                            <th>Root Account Name</th>
                                            <th>Action</th>
                                        </tr>
                                        @foreach($result as $key=>$item)
                                        <tr>
                                            <td>{!! $key+1 !!}</td>
                                            <td>{!! $item->Sub_Head_Name !!}</td>
                                            <td>{!! $item->head_acc['Head_Ac_Name'] !!}</td>
                                            <td>{!! $item->root_acc['acc_name'] !!}</td>
                                            <td>
                                                N/A
                                                {{--<a class="btn btn-mini btn-primary" href="javascript:void(0)"><i class="fa fa-edit"></i></a>--}}
                                                    {{--<button type="submit" class="btn btn-mini btn-danger"><i class="fa fa-trash-o"></i> </button>--}}
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
    @include('accounts.Subheads.modal');
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
        })
    </script>
@endsection