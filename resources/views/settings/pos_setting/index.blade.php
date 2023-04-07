@extends('layouts.app')
@section('content')
    <style type="text/css">
        .select2-selection--single {
            border: 0px !important;
            border-radius: 0px !important;
            border-bottom: 1px solid #aaa !important;
            width: 100% !important;
        }
        .select2 {
            width: 100% !important;
        }
    </style>
    <div class="content-wrapper">
        <div class="container-fluid">
            <!-- Header start -->
            <div class="row">
                <div class="main-header" style="margin-top: 0px;">
                    <ol class="breadcrumb breadcrumb-title breadcrumb-arrow">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="icofont icofont-home"></i></a> </li>
                        <li class="breadcrumb-item">POS Settings</li>
                        <li class="breadcrumb-item active">POS Settings List </li>
                    </ol>
                </div>
            </div>
            <!-- End start -->
            <div class="row">
                <!-- Form Control starts -->
                <div class="col-md-12">
                    <div class="card">
                        @if(session('success'))
                            <div class="alert alert-success">
                                <i class="fa fa-check"></i> {{session('success')}}
                            </div>
                        @endif
                        <form id="form">
                            <div class="card-block">
                                <a href="{{ route('pos_setting.create') }}" class="btn btn-mini btn-primary pull-right">Add New</a>
                                <div class="col-sm-12 table-responsive pad0">
                                    <table class="table table-bordered">
                                        <tr style="background-color: #eeeeee">
                                            <th>Location</th>
                                            <th>Default Customer</th>
                                            <th>Default Sale Person</th>
                                            <th>Invoice Footer</th>
                                            {{--<th>A4 Format</th>--}}
                                            <th>Thermal Format</th>
                                            <th>Logo</th>
                                            <th>QR Img</th>
                                            <th>Action</th>
                                        </tr>
                                        <tbody>
                                        @foreach($pos as $po)
                                            <tr>
                                                <td>{{ $po['wh']['WH_Name'] }}</td>
                                                <td>{{ $po['customer']['name'] }}</td>
                                                <td>{{ $po['sale_person']['name'] }}</td>
                                                <td>{{ $po->invoice_footer }}</td>
                                                {{--<td>{{ $po->a_format }}</td>--}}
                                                <td>{{ $po->thermal_format }}</td>
                                                <td><img src="{{ $po->inv_img }}" width="30"> </td>
                                                <td><img src="{{ $po->qr_img }}" width="30"> </td>
                                                <td>
                                                    <a class="btn btn-mini btn-primary" href="{{ route('pos_setting.edit',$po->id) }}"><i class="fa fa-edit"></i></a>
                                                    <button type="button" onclick="del_rec('2', 'http://localhost/revebe/discounts/2')" class="btn btn-mini btn-danger"><i class="fa fa-trash-o"></i> </button>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <div class="pagination-panel pull-right"></div>

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
@endsection