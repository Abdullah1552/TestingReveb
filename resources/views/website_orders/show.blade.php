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
                    <h5>Website Orders </h5>
                    <ol class="breadcrumb breadcrumb-title breadcrumb-arrow">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="icofont icofont-home"></i></a> </li>
                        <li class="breadcrumb-item">Sale</li>
                        <li class="breadcrumb-item">Website Orders </li>
                        <li class="breadcrumb-item active">#{{ $result['id'] }} Order Details </li>
                    </ol>
                </div>
            </div>
            <!-- End start -->
            <div class="row">
                <!-- Form Control starts -->
                <div class="col-md-12">
                    <div class="card">
                        <form action="{{ route('website_order.update',$result['id']) }}" method="post">
                            <div class="card-block">
                                <div class="col-sm-12 table-responsive pad0">
                                    <table class="table ">
                                        <tr style="background-color: #eeeeee">
                                            <th>#Order</th>
                                            <th>Date</th>
                                            <th>Payment</th>
                                            <th>Discount</th>
                                            <th>Shipping</th>
                                            <th>Total</th>
                                            <th>Order Status</th>
                                        </tr>
                                        <tbody>
                                        <tr>
                                            <td>{{ $result['id'] }}</td>
                                            <td>{{ date('d-m-Y h:i:s',strtotime($result['date_created'])) }}</td>
                                            <td>{{ $result['payment_method_title'] }}</td>
                                            <td>{{ $result['discount_total'] }}</td>
                                            <td>{{ $result['shipping_total'] }}</td>
                                            <td>{{ $result['total'] }}</td>
                                            <td>{{ $result['status'] }}</td>
                                        </tr>
                                        <tr>
                                            <th>Billing Details</th>
                                        </tr>
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th colspan="4">Address</th>
                                        </tr>
                                        <tr>
                                            <td>{{ $result['billing']->first_name }} {{ $result['billing']->last_name }}</td>
                                            <td>{{ $result['billing']->email }}</td>
                                            <td>{{ $result['billing']->phone }}</td>
                                            <td colspan="4">{{ $result['billing']->address_1 }}</td>
                                        </tr>
                                        <tr>
                                            <th>Products:</th>
                                        </tr>
                                        <tr>
                                            <th>Product Name</th>
                                            <th>Qty</th>
                                            <th>Sub Total</th>
                                            <th>Tax</th>
                                            <th>Total</th>
                                        </tr>
                                        @foreach($result['line_items'] as $item)
                                            <tr>
                                                <td>{{ $item->name }}({{ $item->sku }})</td>
                                                <td>{{ $item->quantity }}</td>
                                                <td>{{ $item->subtotal }}</td>
                                                <td>{{ $item->subtotal_tax }}</td>
                                                <td>{{ $item->total }}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                @if($result['status']=='processing')
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Location</label>
                                            <select class="form-control form-control-sm select2" name="WHID">
                                                {!! App\Models\WhereHouse::dropdown() !!}
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Sale Person</label>
                                            <select class="form-control form-control-sm select2" name="sale_person">
                                                {!! App\Models\SalePerson::dropdown() !!}
                                            </select>
                                        </div>
                                    </div>
                                    <!--col-->
                                </div>
                                @endif
                                <!--row-->
                                @CSRF
                                @method('PUT')
                                <div class="col-md-12">
                                    <div class="btn-group pull-right">
                                        @if($result['status']=='pending' || $result['status']=='on-hold')
                                            <button type="submit" name="order_status" value="processing" class="btn btn-warning pull-right">Process to Order</button>
                                        @endif
                                        @if($result['status']=='processing')
                                            <button type="submit" name="order_status" value="completed" class="btn btn-success pull-right">Complete</button>
                                        @endif
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
        $(function () {
            $(".select2").select2();
        })
    </script>
@endsection
