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
                        <li class="breadcrumb-item">What's App Setting</li>
                    </ol>
                </div>
            </div>
            <!-- End start -->
            <div class="row ">
                <div class="col-md-12">
                    <div class="card-block card">
                        <form action="{{ route('whatsapp_seetings.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="@if($result) {{ $result->id }} @endif">
                            <div class="panel panel-default">
                                @foreach ($errors->all() as $error)
                                    <div class="alert alert-danger alert-dismissible">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        <i class="fa fa-exclamation"></i> {{ $error }}
                                    </div>
                                @endforeach
                                @if(session('success'))
                                    <div class="alert alert-success">
                                        <i class="fa fa-check"></i> {{session('success')}}</div>
                            @endif
                            <!--row-->
                                <br>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>What's App ID*</label>
                                                <input type="text" name="whatsapp_id" class="form-control" placeholder="110519325"
                                                 value="{{ $result->whatsapp_id }}">
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label>What's App Permenent Token</label>
                                                <input type="text" name="whatsapp_token" class="form-control" placeholder="TJ5xoUy6u0qySNCCcRmUmTF"
                                                       value="{{ $result->whatsapp_token }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--row-->
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="col-md-12 pull-right">
                                        <div class="form-group m-t-25">
                                            <button type="submit" class="btn btn-danger pull-right" onclick="saveData()">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--row-->

                    </div>
                    </form>
                </div>
                <!--panel-default-->
            </div>
            <!--col-->
        </div>
    </div>


@endsection
