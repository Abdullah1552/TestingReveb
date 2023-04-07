@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="container-fluid ">
            <!-- Header start -->
            <div class="row">
                <div class="main-header" style="margin-top: 0px;">
                    <h4>General Setting</h4>
                    <ol class="breadcrumb breadcrumb-title breadcrumb-arrow">
                        <li class="breadcrumb-item"><a href="../index"><i class="icofont icofont-home"></i></a> </li>
                        <li class="breadcrumb-item"><a href="#">Setting</a> </li>
                        <li class="breadcrumb-item">General Setting</li>
                    </ol>
                </div>
            </div>
            <!-- End start -->
            <div class="row ">
                <div class="col-md-12">
                    <div class="card-block card">

                        <div class="panel panel-default">

                            <!--row-->
                            <br>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>System Title * </label>
                                            <input type="text" class="form-control form-control-sm" style="height: 28px">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                    <div class="form-group">
                                            <label>System Logo *</label>
                                            <input type="file" class="form-control form-control-sm" >
                                        </div>
                                    </div>
                                        <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Time Zone</label>
                                            <select class="js-example-basic-single form-control form-control-sm">
                                                <option>Test</option>
                                            </select>
                                        </div>
                                        </div>
                                    <div class="col-md-3">
                                    <div class="form-group">
                                            <label>Currency *</label>
                                        <select class="js-example-basic-single form-control form-control-sm">
                                            <option>US Dollar</option>
                                        </select>
                                    </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Staff Access * </label>
                                            <select class="js-example-basic-single form-control form-control-sm">
                                                <option>All Records</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Invoice Format *</label>
                                            <select class="js-example-basic-single form-control form-control-sm">
                                                <option>Stander</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Date Format *</label>
                                            <select class="js-example-basic-single form-control form-control-sm">
                                                <option>dd-mm-yyy</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Developed By</label>
                                            <select class="js-example-basic-single form-control form-control-sm">
                                                <option>Azeem</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="col-md-3" style="user-select: auto;">
                                        <div class="form-group" style="user-select: auto;">
                                            <label style="user-select: auto;">Currency Position *</label><br>
                                            <label class="radio-inline" style="user-select: auto;">
                                                <input type="radio" name="" value="prefix" checked=""> Prefix
                                            </label>
                                            <label class="radio-inline" >
                                                <input type="radio" name="" value="suffix"> Suffix
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-3 " >
                                        <div class="form-group m-t-25" >
                                            <input type="checkbox" name="is_rtl" value="1" >
                                            &nbsp;
                                            <label>RTL Layout</label>

                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group m-t-25">
                                            <button class="btn btn-danger">Submit</button>
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
