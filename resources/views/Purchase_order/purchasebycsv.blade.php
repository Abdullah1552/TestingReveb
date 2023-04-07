@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="container-fluid ">
            <!-- Header start -->
            <div class="row">
                <div class="main-header" style="margin-top: 0px;">
                    <h4>Import Purchase</h4>
                    <ol class="breadcrumb breadcrumb-title breadcrumb-arrow">
                        <li class="breadcrumb-item"><a href="../index"><i class="icofont icofont-home"></i></a> </li>
                        <li class="breadcrumb-item"><a href="#">Purchase</a> </li>
                        <li class="breadcrumb-item">Add Purchase csv</li>
                    </ol>
                </div>
            </div>
            <!-- End start -->
            <div class="row ">
                <div class="col-md-12">
                    <div class="card-block card">

                    <div class="panel panel-default">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Location *</label>
                                        <select class="js-example-basic-single form-control form-control-sm">
                                            <option>Select Location</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Supplier</label>
                                        <select class="js-example-basic-single form-control form-control-sm">
                                            <option>Test1</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Purchase Status</label>
                                        <select class="js-example-basic-single form-control form-control-sm">
                                            <option>Test1</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Attach Document </label>
                                        <input type="file" class="form-control form-control-sm" style="height: 28px">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--row--><br>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Upload CSV File * </label>
                                        <input type="file" class="form-control form-control-sm" style="height: 28px">
                                    </div>
                                    <div class="form-group">
                                        <label>Order Tax</label>
                                        <select class="js-example-basic-single form-control form-control-sm">
                                            <option>No Tax</option>
                                        </select>

                                        <div class="form-group">
                                            <label>Note</label>
                                            <textarea class="form-control" style="height: 80px"></textarea>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Shipping Cost</label>
                                        <input type="number" class="form-control form-control-sm">
                                    </div>
                                    <!--col-->
                                    <div class="form-group">
                                        <label>Discount</label>
                                        <input type="number" class="form-control form-control-sm">
                                    </div>
                                    <div class="form-group">
                                        <button type="button" class="btn btn-primary waves-effect waves-light form-control" data-toggle="tooltip" data-placement="top" title="" data-original-title=".icofont-bubble-left">
                                            <i class="icofont icofont-bubble-down"></i><span class="m-l-10">Download Sample File</span>
                                        </button>
                                    </div>
                                    <button type="button"  class="btn btn-mini btn-primary m-t-10">Submit</button>

                                </div>

                            </div>
                            <!--col-12-->
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
