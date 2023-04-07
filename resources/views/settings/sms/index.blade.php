@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="container-fluid ">
            <!-- Header start -->
            <div class="row">
                <div class="main-header" style="margin-top: 0px;">
                    <h4>Create SMS</h4>
                    <ol class="breadcrumb breadcrumb-title breadcrumb-arrow">
                        <li class="breadcrumb-item"><a href="../index"><i class="icofont icofont-home"></i></a> </li>
                        <li class="breadcrumb-item"><a href="#">Setting</a> </li>
                        <li class="breadcrumb-item">SMS</li>
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
                                            <input type="text" class="form-control form-control-sm m-t-30" placeholder="Please type customer name or mobile number">
                                        </div>
                                        <div class="form-group">
                                            <label>Message *</label>
                                            <textarea class="form-control"  style="height: 100px"></textarea>
                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Mobile *</label>
                                            <input type="text" class="form-control form-control-sm" placeholder="example:+8801**********,+8801******">
                                        </div>

                                        <div class="form-group">
                                            <button class="btn btn-danger m-t-50">Send SMS</button>
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
