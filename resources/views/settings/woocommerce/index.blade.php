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
                        <li class="breadcrumb-item">Woocommerce Setting</li>
                    </ol>
                </div>
            </div>
            <!-- End start -->

            <div class="row ">
                <div class="col-md-12">
                    <div class="card-block card">
                        <!-- Rounded switch -->
                        <label class="switch">
                            <input type="checkbox" {{$result->state=='1'? 'checked':''}}>
                            <span class="slider round woocomercebtn" data-id="{{ ($result)?$result->id:'' }}" data-state="{{ ($result)?$result->state:'' }}"></span>
                        </label>
                        <form action="{{ route('woocommerce_seetings.store') }}" method="post" enctype="multipart/form-data" class="woocomerce_box " >
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
                                <div class="row ">
                                        <div class="col-lg-12">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Website URL *</label>
                                                    <input type="text" name="woocommerce_url" class="form-control" placeholder="https://www.revebe.com"
                                                           value="{{ $result->woocommerce_url }}">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Woocommerce Consumer Key *</label>
                                                    <input type="text" name="woocommerce_sk" class="form-control" placeholder="ck_9887656543"
                                                           value="{{ $result->woocommerce_sk }}">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Woocommerce Secrete Key *</label>
                                                    <input type="text" name="woocommerce_sc" class="form-control" placeholder="cs_9887656543"
                                                           value="{{ $result->woocommerce_sc }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row ">
                                        <div class="col-lg-12">

                                                <button type="button" class="btn btn-success " onclick="woo_sync_modal()"> <i class="fa fa-product-hunt"></i> Upload Products</button>
                                                <button type="button" class="btn btn-success " onclick="update_products_sync()"> <i class="fa fa-product-hunt"></i> Update Products</button>
                                                <button type="button" class="btn btn-success " onclick="woo_upload_stock_modal()"> <i class="fa fa-opencart"></i> Update Stock</button>

                                            </div>

                                        </div>
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

                        </form>
                    </div>

                </div>
                <!--panel-default-->
            </div>
            <!--col-->
        </div>
    </div>
    <script>


        function woo_sync_modal() {
            $('#upload-product-modal').modal('show');
        }

        function woo_upload_stock_modal() {
            $('#upload-stock-modal').modal('show');
        }


        function woo_sync() {
            $('.loader-bg').show();
            $.ajax({
                url:"/woocommerce_seetings/upload_products",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type:"post",
                success:function (ajaxcontent) {

                    ajaxSuccessToastr(ajaxcontent);
                    $('#upload-product-modal').modal('hide');

                },error:function(ajaxcontent) {
                    ajaxErrorToastr(ajaxcontent);
                }
            });
        }

        function update_products_sync() {
            $('.loader-bg').show();
            $.ajax({
                url:"/woocommerce_seetings/update-products",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type:"post",
                success:function (ajaxcontent) {

                    ajaxSuccessToastr(ajaxcontent);
                    $('#update-product-modal').modal('hide');

                },error:function(ajaxcontent) {
                    ajaxErrorToastr(ajaxcontent);
                }
            });
        }

        function update_stock_sync() {
            $('.loader-bg').show();
            $.ajax({
                url:"/woocommerce_seetings/update-products-stock",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type:"post",
                success:function (ajaxcontent) {

                    ajaxSuccessToastr(ajaxcontent);
                    $('#upload-stock-modal').modal('hide');

                },error:function(ajaxcontent) {
                    ajaxErrorToastr(ajaxcontent);
                }
            });
        }



        $(document).ready(function(){
            $(".woocomercebtn").click(function(){
                 id = $(".woocomercebtn").attr("data-id");
                 state =$(".woocomercebtn").attr("data-state")=='1'?'0':'1';
                 $('.loader-bg').show();
                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    type:"POST",
                    dataType:"JSON",
                    url:"/woocommerce_toggle",
                    data:{
                        id:id,
                        state:state
                    },
                    success:function (data) {
                        $('.loader-bg').hide();
                        $(".woocomercebtn").attr("data-state",state );
                        $(".woocomerce_box").slideToggle();
                        toastr.success(data.success);
                    } ,error:function(ajaxcontent) {
                        vali=ajaxcontent.responseJSON.errors;
                        if(vali==undefined){
                            toastr.error(ajaxcontent.responseJSON.message);
                            $('.loader-bg').hide();
                            return false;
                        }
                        var errors='';
                        $.each(vali, function( index, value ) {
                            $("#adjustment-form input[name~='" + index + "']").css('border', '1px solid red');
                            toastr.error(value);
                        });
                        $('.loader-bg').hide();
                    }
                });
            });
            @if($result->state == '0'|| !isset($result->id))
            $(".woocomerce_box").slideToggle();
            $(".woocomercebtn").attr("data-state",'0');
            @endif
        });
    </script>
    @include('settings.woocommerce.upload-product-modal')
    @include('settings.woocommerce.upload-stock-modal')

@endsection
