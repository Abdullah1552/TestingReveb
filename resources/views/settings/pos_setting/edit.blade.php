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
                        <li class="breadcrumb-item">Edit POS Setting</li>
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
                            @if(session('success'))
                                <div class="alert alert-success">
                                    <i class="fa fa-check"></i> {{session('success')}}</div>
                            @endif
                            <form action="{{ route('pos_setting.update', $pos->id) }}" method="post" enctype="multipart/form-data">
                                @CSRF
                                @method('PUT')
                                <input type="hidden" name="id" value="{{ $pos->id }}">
                                <!--row-->
                                <br>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Default Location *</label>
                                                <select name="default_location" class="js-example-basic-single form-control ">
                                                    {!! App\Models\WhereHouse::dropdown($pos->default_location) !!}
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Default Customer * </label>
                                                <select name="default_customer" class="js-example-basic-single form-control ">
                                                    {!! App\Models\Customer::dropdown($pos->default_customer) !!}
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Default Sale Person *</label>
                                                <select name="default_saleperson" class="js-example-basic-single form-control ">
                                                    {!! App\Models\SalePerson::dropdown($pos->default_saleperson) !!}
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
                                                {{--<textarea name="invoice_header" class="form-control">{{ $pos->invoice_header }}</textarea>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Invoice Footer</label>
                                                <textarea name="invoice_footer" class="form-control">{{ $pos->invoice_footer }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--row-->
                                <div class="row">
                                    <div class="col-lg-12">
                                        {{--<div class="col-md-3">--}}
                                            {{--<div class="form-group">--}}
                                                {{--<label>A4 Format</label>--}}
                                                {{--<select name="thermal_format" class="js-example-basic-single form-control">--}}
                                                    {{--<option value="1" @if($pos->invoice_footer==1) selected @endif>Format-1</option>--}}
                                                    {{--<option value="2" @if($pos->invoice_footer==2) selected @endif>Format-2</option>--}}
                                                    {{--<option value="3" @if($pos->invoice_footer==3) selected @endif>Format-3</option>--}}
                                                {{--</select>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Thermal Format</label>
                                                <select name="a_format" class="js-example-basic-single form-control">
                                                    <option value="1" @if($pos->invoice_footer==1) selected @endif>Format-1</option>
                                                    <option value="2" @if($pos->invoice_footer==2) selected @endif>Format-2</option>
                                                    <option value="3" @if($pos->invoice_footer==3) selected @endif>Format-3</option>
                                                </select>
                                            </div>
                                        </div>
                                        <!--cl-->
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Invoice Logo @if($pos->inv_img) <img src="{{ $pos->inv_img }}" width="20">@endif</label>
                                                <input type="file" name="inv_img" class="form-control">
                                            </div>
                                        </div>
                                        <!--cl-->
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>QR Image @if($pos->qr_img) <img src="{{ $pos->qr_img }}" width="20">@endif </label>
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
                                            {{--<input type="checkbox" name="purchase_tax" @if($pos->purchase_tax==1) checked @endif value="1">--}}
                                            {{--<label>Purchase Tax</label><br>--}}
                                            {{--<div class="col-md-5 row">--}}
                                                {{--<select class="form-control" name="purchase_taxID">--}}
                                                    {{--<option value="">Select</option>--}}
                                                    {{--{!! App\Models\Tax::dropdown($pos->purchase_taxID) !!}--}}
                                                {{--</select>--}}
                                            {{--</div>--}}
                                            {{--<div class="col-md-7">--}}
                                                {{--<input type="text" name="purchase_tax_label" class="form-control" placeholder="Label" value="{{ $pos->purchase_tax_label }}">--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                        {{--<!--row-->--}}
                                        {{--<div class="form-group col-md-4">--}}
                                            {{--<input type="checkbox" name="sale_tax" value="1" @if($pos->sale_tax==1) checked @endif>--}}
                                            {{--<label>Sale Tax</label><br>--}}
                                            {{--<div class="col-md-5 row">--}}
                                                {{--<select class="form-control" name="sale_taxID">--}}
                                                    {{--<option value="">Select</option>--}}
                                                    {{--{!! App\Models\Tax::dropdown($pos->sale_taxID) !!}--}}
                                                {{--</select>--}}
                                            {{--</div>--}}
                                            {{--<div class="col-md-7">--}}
                                                {{--<input type="text" name="sale_tax_label" class="form-control" placeholder="Label" value="{{ $pos->sale_tax_label }}">--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                        {{--<!--row-->--}}
                                        {{--<div class="form-group col-md-4">--}}
                                            {{--<input type="checkbox" name="wat" value="1" @if($pos->wat==1) checked @endif>--}}
                                            {{--<label>VAT</label><br>--}}
                                            {{--<div class="col-md-5 row">--}}
                                                {{--<select name="watID" class="form-control">--}}
                                                    {{--<option value="">Select</option>--}}
                                                    {{--{!! App\Models\Tax::dropdown($pos->watID) !!}--}}
                                                {{--</select>--}}
                                            {{--</div>--}}
                                            {{--<div class="col-md-7">--}}
                                                {{--<input type="text" name="wat_label" class="form-control" placeholder="Label" value="{{ $pos->wat_label }}">--}}
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
                                                <button type="submit" class="btn btn-primary pull-right">Update</button>
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
