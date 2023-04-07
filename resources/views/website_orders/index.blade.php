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
        td,th{
            text-align: center;
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
                        <li class="breadcrumb-item active">Sale Order List </li>
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
                        @if(session('danger'))
                            <div class="alert alert-danger">
                                <i class="fa fa-close"></i> {{session('danger')}}
                            </div>
                        @endif
                        <form id="search-form">
                            <div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Order no</label>
                                        <input type="number" class="form-control" name="order_number" id="order_number" >

                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Order Status</label>
                                        <select name="status" id="order-status" class="form-control js-example-basic-single">
                                            {!! \App\Http\Controllers\OrderController::status() !!}
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Per Page</label>
                                        <select name="per_page" class="form-control js-example-basic-single">
                                            {!! \App\Helpers\helpers::per_page() !!}
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-1">

                                    <div class="form-group">

                                        <label style="visibility: hidden">afafffsfafas</label>

                                        <button type="button" onclick="get_data()"  class="btn btn-info btn-mini"><i class="fa fa-search"></i> </button>

                                    </div>

                                </div>

                                <div></div>
                            </div>
                        </form>
                        <form id="form">
                            <div class="card-block">
                                <div class="col-sm-12 table-responsive pad0">
                                    <table class="table ">
                                        <tr style="background-color: #eeeeee">
                                            <th>Sr#</th>
                                            <th>Order#</th>
                                            <th>Date</th>
                                            <th>Customer</th>
                                            <th>Payment</th>
                                            <th>Order Status</th>
                                            <th>Discount</th>
                                            <th>Shipping</th>
                                            <th>Total</th>
                                            <th>Action</th>
                                        </tr>
                                        <tbody id="get_data">

                                        </tbody>

                                        {{--<tbody>--}}
                                        {{--@foreach($result as $item)--}}
                                            {{--<tr>--}}
                                                {{--<td>{{ $item->id }}</td>--}}
                                                {{--<td>{{ date('d-m-Y h:i:s',strtotime($item->date_created))  }}</td>--}}
                                                {{--<td>{{ $item->payment_method_title }}</td>--}}
                                                {{--<td>{{ $item->discount_total }}</td>--}}
                                                {{--<td>{{ $item->shipping_total }}</td>--}}
                                                {{--<td>{{ $item->total }}</td>--}}
                                                {{--<td>{{ $item->status }}</td>--}}
                                                {{--<td>--}}
                                                    {{--@can('website_order_view')--}}
                                                        {{--<a class="btn btn-info btn-mini" href="{{ route('website_order.show',$item->id) }}"><i class="fa fa-eye"></i></a>--}}
                                                        {{--<a class="btn btn-danger btn-mini" href="#"><i class="fa fa-trash"></i></a>--}}
                                                    {{--@endcan--}}
                                                {{--</td>--}}
                                            {{--</tr>--}}
                                        {{--@endforeach--}}
                                        {{--</tbody>--}}
                                    </table>
{{--                                    <div class="pagination-panel pull-right"></div>--}}

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
        $(document).ready(function () {
            get_data();
        });
        function get_data(){
            $('.loader-bg').show();
            $.ajax({
                url:"{{ url('get_website_order') }}",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type:"GET",
                data:$("#search-form").serialize(),
                dataType:"JSON",
                success:function (data) {
                    htmlData='';
                    var total=0;
                    for(i in data) {
                        htmlData += '<tr>'+
                        '<td>'+ (Number(i)+1 )+'</td>'+
                        '<td>'+ data[i].id +'</td>'+
                        '<td style=" white-space: nowrap;">'+ dateFormat(data[i].date_created, 'dd-MM-yyyy')+'</td>'+
                        '<td>'+ data[i].billing.first_name + data[i].billing.last_name+'</td>'+
                        '<td>'+ data[i].payment_method_title +'</td>'+
                        '<td>'+ data[i].status +'</td>'+
                        '<td>'+ data[i].discount_total +'</td>'+
                        '<td>'+ data[i].shipping_total +'</td>'+
                        '<td>'+ data[i].total +'</td>'+
                        '<td>';
                        @can('website_order_view')
                            htmlData += '<a class="btn btn-info btn-mini" href="website_order/'+ data[i].id +'"><i class="fa fa-eye"></i></a>'+
                        '<a class="btn btn-danger btn-mini" href="#"><i class="fa fa-trash"></i></a>';
                        @endcan
                            htmlData += ` </td>
                        </tr>`;
                        total= total+ Number(data[i].total);
                    }
                    htmlData+='<tr>' +
                        '<td colspan="7"></td>' +
                        '<td><b>Total</b></td>' +
                        '<td><b>'+total+'</b></td>' +
                        '</tr>';
                    $("#get_data").html(htmlData);
                    $('.loader-bg').hide();

                },error:function () {
                    alert('error');
                    $('.loader-bg').hide();
                }
            });
        }
    </script>
@endsection
