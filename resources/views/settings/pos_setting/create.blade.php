@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="container-fluid ">
            <!-- Header start -->
            <div class="row">
                <div class="main-header" style="margin-top: 0px;">
                    <ol class="breadcrumb breadcrumb-title breadcrumb-arrow">
                        <li class="breadcrumb-item"><a href="../index"><i class="icofont icofont-home"></i></a> </li>
                        <li class="breadcrumb-item"><a href="#">Setting</a> </li>
                        <li class="breadcrumb-item">POS Setting</li>
                        <li class="breadcrumb-item active">New POS Setting</li>
                    </ol>
                </div>
            </div>
            <!-- End start -->
            <div class="row ">
                <div class="col-md-12">
                    <div class="card-block card">
                        <div class="panel panel-default">
                            @if($errors->all())
                                <div class="alert alert-danger alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    @foreach ($errors->all() as $error)
                                        <i class="fa fa-exclamation"></i> {{ $error }}<br>
                                    @endforeach
                                </div>
                            @endif
                            @if(session()->has('error'))
                                <div class="alert alert-danger">
                                    <i class="fa fa-check"></i> {{session()->get('error')}}
                                </div>
                            @endif
                            <form action="{{ route('pos_setting.store') }}" method="post" enctype="multipart/form-data">
                                @CSRF
                                <input type="hidden" name="id" value="">
                                <!--row-->
                                <br>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Default Location <sup class="text-danger">*</sup></label>
                                                <select name="default_location" class="js-example-basic-single form-control ">
                                                    {!! App\Models\WhereHouse::dropdown() !!}
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Default Customer <sup class="text-danger">*</sup> </label>
                                                <select name="default_customer" class="js-example-basic-single form-control ">
                                                    {!! App\Models\Customer::dropdown() !!}
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Default Sale Person <sup class="text-danger">*</sup></label>
                                                <select name="default_saleperson" class="js-example-basic-single form-control ">
                                                    {!! App\Models\SalePerson::dropdown() !!}
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        {{--<div class="col-md-6">--}}
                                            {{--<div class="form-group">--}}
                                                {{--<label>Invoice Header</label>--}}
                                                {{--<textarea name="invoice_header" class="form-control"></textarea>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Invoice Footer</label>
                                                <textarea name="invoice_footer" class="form-control"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--row-->
                                <div class="row">
                                    <div class="col-lg-12">

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Invoice Header <sup class="text-danger">*</sup></label><br>
                                                <div style="padding-left: 5px;">
                                                    <input type="radio" name="invoice_header" id="business_name" value="business_name" checked>
                                                    <label for="business_name">Business name</label> <br>
                                                    <input type="radio" name="invoice_header" id="business_logo" value="business_logo">
                                                    <label for="business_logo">Business Logo</label>
                                                </div>

                                            </div>
                                        </div>
                                        <!--cl-->

                                        {{--<div class="col-md-3">--}}
                                            {{--<div class="form-group">--}}
                                                {{--<label>A4 Format</label>--}}
                                                {{--<select name="thermal_format" class="js-example-basic-single form-control">--}}
                                                    {{--<option value="1">Format-1</option>--}}
                                                    {{--<option value="2">Format-2</option>--}}
                                                    {{--<option value="3">Format-3</option>--}}
                                                {{--</select>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Thermal Format</label>
                                                <select name="a_format" class="js-example-basic-single form-control">
                                                    <option value="1">Format-1</option>
                                                    <option value="2">Format-2</option>
                                                    <option value="3">Format-3</option>
                                                </select>
                                            </div>
                                        </div>
                                        <!--cl-->
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Invoice Logo</label>
                                                <input type="file" name="inv_logo" class="form-control">
                                            </div>
                                        </div>
                                        <!--cl-->
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>QR Image</label>
                                                <input type="file" name="qr_img" class="form-control">
                                            </div>
                                        </div>
                                        <!--cl-->

                                    </div>
                                </div>
                                <!--row-->
                                {{--<div class="row">--}}
                                    {{--<div class="col-md-12">--}}
                                        {{--<div class="form-group col-md-4">--}}
                                            {{--<input type="checkbox" name="purchase_tax" value="">--}}
                                            {{--<label>Purchase Tax</label><br>--}}
                                            {{--<div class="col-md-5 row">--}}
                                                {{--<select class="form-control" name="purchase_taxID">--}}
                                                    {{--<option value="">Select</option>--}}
                                                    {{--{!! App\Models\Tax::dropdown() !!}--}}
                                                {{--</select>--}}
                                            {{--</div>--}}
                                            {{--<div class="col-md-7">--}}
                                                {{--<input type="text" name="purchase_tax_label" class="form-control" placeholder="Label">--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                        {{--<!--row-->--}}
                                        {{--<div class="form-group col-md-4">--}}
                                            {{--<input type="checkbox" name="sale_tax" value="1">--}}
                                            {{--<label>Sale Tax</label><br>--}}
                                            {{--<div class="col-md-5 row">--}}
                                                {{--<select class="form-control" name="sale_taxID">--}}
                                                    {{--<option value="">Select</option>--}}
                                                    {{--{!! App\Models\Tax::dropdown() !!}--}}
                                                {{--</select>--}}
                                            {{--</div>--}}
                                            {{--<div class="col-md-7">--}}
                                                {{--<input type="text" name="sale_tax_label" class="form-control" placeholder="Label">--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                        {{--<!--row-->--}}
                                        {{--<div class="form-group col-md-4">--}}
                                            {{--<input type="checkbox" name="wat" value="">--}}
                                            {{--<label>VAT</label><br>--}}
                                            {{--<div class="col-md-5 row">--}}
                                                {{--<select name="watID" class="form-control">--}}
                                                    {{--<option value="">Select</option>--}}
                                                    {{--{!! App\Models\Tax::dropdown() !!}--}}
                                                {{--</select>--}}
                                            {{--</div>--}}
                                            {{--<div class="col-md-7">--}}
                                                {{--<input type="text" name="wat_label" class="form-control" placeholder="Label">--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                        {{--<!--row-->--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                <!--row-->
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary pull-right">Submit</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!--panel-default-->
                    </div>
                </div>
                <!--col-->
            </div>
            <!--row-->
        </div>
    </div>
@endsection
