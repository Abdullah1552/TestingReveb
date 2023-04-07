@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="container-fluid">
            <!-- Header start -->
            <div class="row">
                <div class="main-header" style="margin-top: 0px;">
                    <ol class="breadcrumb breadcrumb-title breadcrumb-arrow">
                        <li class="breadcrumb-item"><a href="{{ url('home') }}"><i class="icofont icofont-home"></i></a> </li>
                        <li class="breadcrumb-item"><a href="#">Reports</a> </li>
                        <li class="breadcrumb-item"><a href="#">Financial Report</a> </li>
                        <li class="breadcrumb-item active">Ledger Report </li>
                    </ol>
                </div>
            </div>
            <!-- End start -->
            <div class="row">
                <!-- Form Control starts -->
                <div class="col-md-12">
                    <div class="card">
                        <form id="form" action="{{ url('reports/finance/print_ledger') }}" method="post" target="_blank">
                            @CSRF
                            <div class="card-block">
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Date From</label>
                                            <input type="text" name="df" class="form-control date" placeholder="Date From" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Date To</label>
                                            <input type="text" name="dt" class="form-control date" placeholder="Date To" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Search Account</label>
                                            <select name="ledger_id" class="form-control select2">
                                                <option value="">Search A/C</option>
                                                {!! App\Models\TransAccount::dropdown() !!}
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <label style="visibility: hidden">sdfdasfafa</label>
                                            <button type="submit" class="btn btn-info"><i class="fa fa-search"></i> </button>
                                        </div>
                                    </div>
                                </div>
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
    <script>
        $( document ).ready(function() {
            $(".select2").select2();
        });
    </script>
@endsection
