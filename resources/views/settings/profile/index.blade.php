@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="container-fluid ">
            <!-- Header start -->
            <div class="row">
                <div class="main-header" style="margin-top: 0px;">
                    <h4>Update Profile</h4>
                    <ol class="breadcrumb breadcrumb-title breadcrumb-arrow">
                        <li class="breadcrumb-item"><a href="../index"><i class="icofont icofont-home"></i></a> </li>
                        <li class="breadcrumb-item"><a href="#">Setting</a> </li>
                        <li class="breadcrumb-item">User Profile</li>
                    </ol>
                </div>
            </div>
            <!-- End start -->
            <div class="row ">
                <div class="col-md-12">
                    <div class="card-block card">

                        <div class="panel panel-default">

                            <!--row--><br>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>UserName * </label>
                                            <input type="text" class="form-control form-control-sm" style="height: 28px">
                                        </div>
                                        <div class="form-group">
                                            <label>Email *</label>
                                            <input type="email" class="form-control form-control-sm" >
                                        </div>
                                        <div class="form-group">
                                            <label>Phone Number *</label>
                                            <input type="number" class="form-control form-control-sm" >


                                        </div>
                                        <div class="form-group">
                                            <label>Company Name</label>
                                            <input type="text" class="form-control form-control-sm" >

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Current Password *</label>
                                            <input type="password" class="form-control form-control-sm" >
                                        </div>
                                        <div class="form-group">
                                            <label>New Password *</label>
                                            <input type="password" class="form-control form-control-sm" >                                        </div>
                                        <div class="form-group">
                                            <label>Confirm Password *</label>
                                            <input type="password" class="form-control form-control-sm" >                                        </div>
                                        <div class="form-group">
                                            <button class="btn btn-danger m-t-30">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--row-->

                        </div>

                    </div>
                    <!--panel-default-->
                </div>
                <!--col-->
            </div>
        </div>
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


            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    <ul>
                        <li></li>
                    </ul>
                </div>
    @endif

@endsection
