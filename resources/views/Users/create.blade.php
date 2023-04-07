@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="container-fluid">
            <!-- Header start -->
            <div class="row">
                <div class="main-header" style="margin-top: 0px;">
                    <ol class="breadcrumb breadcrumb-title breadcrumb-arrow">
                        <li class="breadcrumb-item"><a href="../index"><i class="icofont icofont-home"></i></a> </li>
                        <li class="breadcrumb-item"><a href="#">User Management</a> </li>
                        <li class="breadcrumb-item">Add New User </li>
                    </ol>
                </div>
            </div>
            <!-- End start -->
            <div class="row">
                <!-- Form Control starts -->
                <div class="col-md-12">
                    @foreach ($errors->all() as $error)
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <i class="fa fa-exclamation"></i> {{ $error }}
                    </div>
                    @endforeach
                    <div class="card">
                        <form id="save_user_form" action="{{ route('users.store') }}" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="id" id="user_id" value="">
                            @CSRF
                            <div class="card-block">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Default Location</label>
                                            <select class="form-control" name="WHID">
                                                <option value="">Select</option>
                                                {!! App\Models\WhereHouse::dropdown() !!}
                                            </select>
                                        </div>
                                    </div>
                                    <!--col-->
                                    <div class="col-xs-12 col-sm-12 col-md-3">
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input placeholder="Name" class="form-control" name="name" type="text">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-3">
                                        <div class="form-group">
                                            <label>Email</label>
                                            {!! Form::text('email', null, array('placeholder' => 'Email','class' => 'form-control')) !!}
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Image </label>
                                            <input type="file" name="profile_photo_path" class="form-control" accept="image/*" >
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-3">
                                        <div class="form-group">
                                            <label>Password:</label>
                                            <input placeholder="Password" class="form-control" name="password" type="password">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-3">
                                        <div class="form-group">
                                            <label>Confirm Password:</label>
                                            <input placeholder="Confirm Password" class="form-control" name="confirm-password" type="password" value="" style="background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-3">
                                        <div class="form-group">
                                            <label>Rights:</label>
                                            <select class="form-control js-example-basic-single select2-hidden-accessible" name="roles[]">
                                                @foreach($roles as $role)
                                                    <option value="{{ $role}}">{{ $role }}</option>
                                                @endforeach
                                            </select>
                                            {{--{!! Form::select('roles[]', $roles,[], array('class' => 'form-control','multiple')) !!}--}}
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Location Access</label>
                                            <select class="form-control js-example-basic-single select2-hidden-accessible" name="warehouses[]" multiple>
                                                <option value="">Select</option>
                                                {!! App\Models\WhereHouse::dropdown() !!}
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-xs-12 col-sm-12 col-md-3" style="padding-top: 30px;">
                                        <div class="form-group">
                                            <input type="checkbox" value="admin" id="type" name="type">
                                            <label for="type">Is_Admin</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="clearfix"></div>
                                <br>
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
@endsection
