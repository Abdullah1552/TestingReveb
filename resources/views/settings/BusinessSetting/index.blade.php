@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="container-fluid ">
            <!-- Header start -->
            <div class="row">
                <div class="main-header" style="margin-top: 0px;">
                    <ol class="breadcrumb breadcrumb-title breadcrumb-arrow">
                        <li class="breadcrumb-item"><a href="../index"><i class="icofont icofont-home"></i></a></li>
                        <li class="breadcrumb-item"><a href="#">Setting</a></li>
                        <li class="breadcrumb-item">Business Setting</li>
                    </ol>
                </div>
            </div>
            <!-- End start -->
            <div class="row ">
                <div class="col-md-12">
                    <div class="card-block card">
                        <form action="{{ route('setting.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="@if($result) {{ $result->id }} @endif">
                            <div class="panel panel-default">
                                @foreach ($errors->all() as $error)
                                    <div class="alert alert-danger alert-dismissible">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×
                                        </button>
                                        <i class="fa fa-exclamation"></i> {{ $error }}
                                    </div>
                                @endforeach
                                @if(session('success'))
                                    <div class="alert alert-success">
                                        <i class="fa fa-check"></i> {{session('success')}}
                                    </div>
                            @endif
                            <!--row-->
                                <br>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Business Name <sup class="text-danger">*</sup></label>
                                                <input type="text" name="business_name" class="form-control"
                                                       value="{{ $result->business_name }}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Business Logo<img
                                                        src="{{ url('storage/app/public/sale_images/'.$result->business_logo) }}"
                                                        width="60"> </label>
                                                <input type="file" name="business_logo" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Default Currency <sup class="text-danger">*</sup></label>
                                                <select name="default_currency" class="form-control ">
                                                    {!! App\Models\Currency::itemList($result->currency_decimal) !!}
                                                </select>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--row-->
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Currency Decimal<sup class="text-danger">*</sup></label>
                                                <input name="currency_decimal" placeholder="100.13" class="form-control"
                                                       value="{{ $result->currency_decimal }}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Document no. operator <sup class="text-danger">*</sup></label>
                                                <input name="code_separator" placeholder="Enter symbol that separates the document no." class="form-control" value="{{ $result->code_separator }}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Document no. format <i class="fa fa-info-circle" aria-hidden="true"  data-toggle="tooltip" data-placement="top" data-html="true"  title="it will define the invoice no. <br> C => DOC-0001 <br> YC => DOC-{{date('y')}}-0001 <br> MYC => DOC-{{date('m-y')}}-0001 <br>C => DOC-{{date('y-m')}}-0001 <br> "></i></label>
                                                <select class="js-example-basic-single form-control " name="code_format">
                                                    {!! \App\Models\BusinessSetting::codeFormats()  !!}
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Time Zone</label>
                                                    <select class="js-example-basic-single form-control " name="time_zone">
                                                        {!! \App\Helpers\helpers::select_Timezone(config('app.timezone'))  !!}
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Corresponding Email </label>
                                                    <input type="email" name="corresponding_email" class="form-control" value="{{ $result->corresponding_email }}">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Company Email </label>
                                                    <input type="email" name="company_email" class="form-control" value="{{ $result->company_email }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="col-md-12 pull-right">
                                        <div class="form-group m-t-25">
                                            <button type="submit" class="btn btn-danger pull-right"
                                                    onclick="saveData()">Submit
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--row-->
                    </form>
                </div>
                <!--panel-default-->
            </div>
            <!--col-->
        </div>
    </div>


@endsection
