@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="container-fluid ">
            <!-- Header start -->
            <div class="row">
                <div class="main-header" style="margin-top: 0px;">
                    <h4>Reward Point Setting</h4>
                    <ol class="breadcrumb breadcrumb-title breadcrumb-arrow">
                        <li class="breadcrumb-item"><a href="../index"><i class="icofont icofont-home"></i></a> </li>
                        <li class="breadcrumb-item"><a href="#">Setting</a> </li>
                        <li class="breadcrumb-item">Reward Point Setting</li>
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
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Sold amount per point *</label>
                                            <input type="number" class="form-control form-control-sm" style="height: 28px">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Minimum sold amount to get point * </label>
                                            <input type="number" class="form-control form-control-sm" >
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Point Expiry Duration</label>
                                            <input type="number" class="form-control form-control-sm" >

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Duration Type</label>
                                            <select class="js-example-basic-single form-control form-control-sm">
                                                <option>
                                                Years
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4 " >
                                        <div class="form-group m-t-30" >
                                            <input type="checkbox" name="is_active" value="1" checked="" style="user-select: auto;">
                                            &nbsp;
                                            <label style="user-select: auto;">Active reward point</label>
                                        </div>

                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group m-t-25">
                                            <button class="btn btn-danger">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="col-md-3" style="user-select: auto;">
                                    </div>
                                    <div class="col-md-3 " >
                                    </div>
                                    <div class="col-md-3 " >
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
