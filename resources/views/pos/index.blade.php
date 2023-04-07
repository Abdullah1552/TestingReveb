<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('', 'Revebe-Digital-Agency') }}</title>

    <link rel="shortcut icon" href="{{ URL::asset('public/assets/images/favicon.png') }}" type="image/x-icon">
    <link rel="icon" href="{{ URL::asset('public/assets/images/favicon.png') }}" type="image/x-icon">
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
    <!-- iconfont -->
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('public/assets/icon/icofont/css/icofont.css?v=1') }}">
    <!-- simple line icon -->
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('public/assets/icon/simple-line-icons/css/simple-line-icons.css') }} ">
    <!-- Font Awesome -->
    <link href="{{ URL::asset('public/assets/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
    <!-- Select 2 css -->
    <link rel="stylesheet" href="{{ URL::asset('public/assets/plugins/select2/dist/css/select2.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('public/assets/plugins/select2/css/s2-docs.css') }}">
    <!-- Multi Select css -->
    <link rel="stylesheet" href="{{ URL::asset('public/assets/plugins/bootstrap-multiselect/dist/css/bootstrap-multiselect.css') }}" />
    <link rel="stylesheet" href="{{ URL::asset('public/assets/plugins/multiselect/css/multi-select.css') }}" />
    <!-- Date Picker css -->
    <link rel="stylesheet" href="{{ URL::asset('public/assets/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css') }}" />
    <!-- Bootstrap Date-Picker css -->
    <link rel="stylesheet" href="{{ URL::asset('public/assets/plugins/bootstrap-datepicker/css/bootstrap-datetimepicker.css') }} " />
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('public/assets/plugins/bootstrap-daterangepicker/daterangepicker.css') }}" />
    <!-- Color Picker css -->
    <link rel="stylesheet" href="{{ URL::asset('public/assets/plugins/spectrum/spectrum.css') }}" />
    <!-- Required Fremwork -->
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('public/assets/plugins/bootstrap/css/bootstrap.min.css') }}">
    <!-- Weather css -->
    <link href="public/assets/css/svg-weather.css" rel="stylesheet">
    <!-- Echart js -->
    <script src="{{ URL::asset('public/assets/plugins/charts/echarts/js/echarts-all.js') }}"></script>
    <!-- Style.css -->
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('public/assets/css/main.css?v=1620732357') }}">
    <!-- Responsive.css-->
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('public/assets/css/responsive.css') }}">
    <!-- Tags css -->
    <link rel="stylesheet" href="{{ URL::asset('public/assets/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.css') }}" />
    <!-- bash syntaxhighlighter css -->
    <link type="text/css" rel="stylesheet" href="{{ URL::asset('public/assets/plugins/syntaxhighlighter/styles/shCoreDjango.css') }}"/>
    <link type="text/css" rel="stylesheet" href="{{ URL::asset('public/assets/css/toastr.min.css') }}"/>
    <!--color css-->
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('public/assets/css/color/color-1.min.css') }}" id="color"/>
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('public/assets/css/style.css') }}" />
    <script src="{{ URL::asset('public/assets/plugins/Jquery/dist/jquery.min.js') }}"></script>
    <script src="https://kit.fontawesome.com/yourcode.js" crossorigin="anonymous"></script>
    <style>
        .logo, .sidebar-toggle{ display: none !important;}
        .mt10{ margin-top: 0px !important;}
        .payment-options{
            background-color: #FFF;
            bottom: 0;
            left: 0;
            padding: 0 10px;
            position: fixed;
            width: 100%;
            z-index: 999;
        }
        .payment-options .column-3{
            min-width: 9%;
            float: left;
            margin: 10px 0;
            padding: 0 5px;
        }
        .btn:not(:disabled):not(.disabled) {
            cursor: pointer;
        }
        .btn-custom {
            display: block;
            font-size: 13px;
            letter-spacing: 0.015em;
            line-height: 1.7;
            width: 100%;
            color: #FFF;
            background: #7c5cc4;
        }
        .cus-table {
            height: 400px;
        }
        .cus-table tbody {
            overflow-x: hidden;
        }
        .simple-box{
            height: 59px;
            border-radius: 5px;
            margin-bottom: -15px;
            max-width: 118px;
            text-align: center;
        }
        .jumbotron-custom {
            padding: 1rem 2rem;
            padding-top: 1rem;
            padding-right: 2rem;
            padding-bottom: 1rem;
            padding-left: 2rem;
        }
        .totals table input{
            height: 25px !important;
            padding: 5px !important;
        }
    </style>
</head>
<body class="sidebar-mini fixed">
<div class="loader-bg">
    <div class="loader-bar">
    </div>
</div>
<div class="wrapper">
    @include('layouts.navbar')
    <div class="container-fluid">
       <br><br><br><br>
        <div class="row">
            <form id="pos-form">
                <input type="hidden" class="form-control date" name="date" value="<?php echo date('Y-m-d') ?>">

            <!--input State starts-->
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-block">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Location</label>
                                <select class="form-control form-control-sm select2" name="WHID" id="pos-WHID">
                                    {!! App\Models\WhereHouse::dropdown($pos->default_location) !!}
                                </select>
                            </div>
                        </div>
                        <!--col-->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Customer</label>
                                <select class="form-control form-control-sm select2" id="customer_id" name="customer_id" onchange="add_new_cus(this.value)">
                                    <option value="new">Add New Customer</option>
                                    {!! App\Models\Customer::dropdown_mobile($pos->default_customer) !!}
                                </select>
                            </div>
                        </div>
                        <!--col-->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Sale Person</label>
                                <select class="form-control form-control-sm select2" name="sale_person">
                                    {!! App\Models\SalePerson::dropdown($pos->default_saleperson) !!}
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <input  class="form-control" list="product" name="" id="product_id"
                                        placeholder="Please type product code and select" autocomplete="off">
                                <datalist id="product">
                                    {!! App\Models\Product::dropdown() !!}
                                </datalist>
                            </div>
                        </div>
                        <!--col-->
                        <div class="col-md-12">
                            <div style="min-height:50px !important; max-height: 400px !important; overflow: scroll">
                            <table id="myTable" class="table cus-table">
                                <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Stock Availble</th>
                                    <th>Discount</th>
                                    <th>Tax</th>
                                    <th style="text-align: center">SubTotal</th>
                                </tr>
                                </thead>
                                <tbody id="get_data"></tbody>
                            </table>
                            </div>
                            <div class="col-12 totals" style="border-top: 2px solid #e4e6fc; padding-top: 10px;">
                                <table class="table">
                                    <tr>
                                        <td>Item</td>
                                        <td><input type="text" value="0" class="form-control form-control-sm" id="item-count" readonly></td>
                                        <td>Tax:</td>
                                        <td><input readonly type="number" class="form-control form-control-sm" value="0" min="0" id="tax_input" name="order_tax"></td>
                                        <td>Shipping:</td>
                                        <td>
                                            <input type="number" id="shipping_input" min="0" value="0" class="form-control" name="shipping_cost"></td>
                                    </tr>
                                    <tr>
                                        <td>Promotional Disc.</td>
                                        <td><input type="number" name="promotional_discount" value="0" min="0" id="promotional_discount" class="form-control form-control-sm" readonly ></td>
                                       {{-- <td>Product Disc.</td>
                                        <td><input type="number" name="total_discount" value="0" min="0" id="discount_input" class="form-control form-control-sm" readonly></td>--}}
                                        <td>Additional Disc.</td>
                                        <td><input type="number" name="additional_discount" value="0" min="0" id="additional_discount"  class="form-control form-control-sm" ></td>
                                        {{--<td>Total Disc.</td>
                                        <td><input type="number" name="total_discounts" value="0" min="0" id="total_discounts" class="form-control form-control-sm" readonly></td>--}}

                                        <td style="text-align: right;">Total:</td>
                                        <td><input type="text" value="0" class="form-control form-control-sm" id="subtotal" readonly></td>


                                    </tr>
                                    <tr>
                                        {{--<td>Coupon</td>--}}
                                        {{--<td><input type="text" id="coupon_input" class="form-control form-control-sm"></td>--}}
                                    </tr>
                                    <tr style="background: #296ad0; color:#ffffff">
                                        <td colspan="10" align="center"><h3 >Grand Total:<span id="grand_total"></span>
                                            </h3></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <!--col-->
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-block">
                        <div class="col-md-6">
                            <select class="form-control select2" onchange="fetch_product(this.value)">
                                <option value="">Select Category</option>
                                {!! App\Models\Product\Category::dropdown() !!}
                            </select>
                        </div>
                        <div class="col-md-6">
                            <select class="form-control select2" onchange="fetch_product('',this.value)">
                                <option value="">Select Brand</option>
                                {!! App\Models\Product\Brand::dropdown() !!}
                            </select>
                        </div>
                        {{--<div class="col-md-4">--}}
                            {{--<button type="button" class="btn btn-block btn-danger" id="featured-filter">Featured</button>--}}
                        {{--</div>--}}
                        <!--col-->
                        <br><br>
                        <div id="right-product" style="overflow: scroll;min-height: 450px;max-height: 450px"></div>
                    </div>
                </div>
            </div>
            <!--input State ends-->
            </form>
        </div>
    </div>
</div><!--wrapper-->
<div class="payment-options">
    <div class="column-3">
        <button  style="background: #0984e3" onclick="pay()" type="button" class="btn btn-custom payment-btn" data-toggle="modal" data-target="#add-payment" id="credit-card-btn"><i class="fa fa-credit-card"></i> Pay</button>
    </div>
{{--    <div class="column-3">--}}
{{--        <button onclick="finalize_sale()" style="background: #0984e3" type="button" class="btn btn-custom payment-btn" data-toggle="modal" data-target="#add-payment" id="credit-card-btn"><i class="fa fa-credit-card"></i> Card</button>--}}
{{--    </div>--}}
{{--    <div class="column-3">--}}
{{--        <button onclick="finalize_sale()" style="background: #00cec9" type="button" class="btn btn-custom payment-btn" data-toggle="modal" data-target="#add-payment" id="cash-btn"><i class="fa fa-money"></i> Cash</button>--}}
{{--    </div>--}}
{{--    <div class="column-3">--}}
{{--        <button style="background-color: #e28d02" type="button" class="btn btn-custom" id="draft-btn"><i class="dripicons-flag"></i> Draft</button>--}}
{{--    </div>--}}
{{--    <div class="column-3">--}}
{{--        <button onclick="finalize_sale()" style="background-color: #fd7272" type="button" class="btn btn-custom payment-btn" data-toggle="modal" data-target="#add-payment" id="cheque-btn"><i class="fa fa-money"></i> Cheque</button>--}}
{{--    </div>--}}
{{--    <div class="column-3">--}}
{{--        <button onclick="finalize_sale()" style="background-color: #5f27cd" type="button" class="btn btn-custom payment-btn" data-toggle="modal" data-target="#add-payment" id="gift-card-btn"><i class="fa fa-credit-card-alt"></i> Gift Card</button>--}}
{{--    </div>--}}
{{--    <div class="column-3">--}}
{{--        <button onclick="finalize_sale()" style="background-color: #b33771" type="button" class="btn btn-custom payment-btn" data-toggle="modal" data-target="#add-payment" id="deposit-btn"><i class="fa fa-university"></i> Bank Deposit</button>--}}
{{--    </div>--}}
{{--    <div class="column-3">--}}
{{--        <button onclick="finalize_sale()" style="background-color: #319398" type="button" class="btn btn-custom payment-btn" data-toggle="modal" data-target="#add-payment" id="point-btn"><i class="dripicons-rocket"></i> Points</button>--}}
{{--    </div>--}}
    <div class="column-3">
        <button style="background-color: #d63031;" type="button" class="btn btn-custom" id="cancel-btn" onclick="return confirmCancel()"><i class="fa fa-close"></i> Cancel</button>
    </div>
    <div class="column-3">
        <button style="background-color: #cddc39;" type="button" class="btn btn-custom" id="cancel-btn" onclick="sale_return()"><i class="fa fa-close"></i> Return</button>
    </div>
    <div class="column-3">
        <button onclick="recent_trans()" style="background-color: #ffc107;" type="button" class="btn btn-custom" data-toggle="modal" data-target="#recentTransaction"><i class="dripicons-clock"></i> Recent transaction</button>
    </div>
</div>


@include('pos.recent-trans-modal')
@include('pos.finalize-sale-modal')
@include('pos.sale_return-modal')
@include('pos.pay-modal')
@include('people.customer.modal')
@include('pos.warehosue-qty-modal');
<script>



    //@new customer pop up
    $(function () {
       $(".select2").select2();
    });
    function add_new_cus(g) {
        if(g=='new'){
            $("#new-sub_head").modal();
            $("#new-sub_head").find('.btn-success').attr('onclick','save_customer()');

        }
        $(".more-item").html('');
    }
    function select_product(g){
        var prc=g;
        let WHID=$("#pos-WHID").val();
        add_product(prc,WHID);
    }
    //fetch product
    fetch_product();
    function fetch_product(cat, brand) {
        $('.loader-bg').show();
        $.ajax({
            url:"{{ url('sale/fetch_product') }}",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            type:"POST",
            dataType:"JSON",
            data:{'cat':cat, 'brand':brand},
            success:function (data) {
                var htmlData='';
              for(i in data.data){
                  if(data.data[i].item_code==null){
                      ic=data.data[i].product_code;
                  }else{
                      ic=data.data[i].item_code;
                  }
                  if(data.data[i].product_images!=null) {
                      thumbImg=data.data[i].product_images.split(',');
                  }else{
                      thumbImg=[''];
                  }
                    htmlData+='<div class="col-md-4">\
                    <a href="#" onclick="select_product(\''+ic+'\')">\
                        <img src="'+thumbImg+'" class="img-fluid" alt="">\
                        <p>'+data.data[i].name+'('+(data.data[i].item_code=='null'?data.data[i].item_code:data.data[i].item_code)+')</p>\
                        </a>\
                        </div>';
              }
              $("#right-product").html(htmlData);
                $('.loader-bg').hide();
            }
        });
    }
    function save_customer() {
        $('.loader-bg').show();
        $.ajax({
            url:"{{ route('customers.store') }}",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            type:"POST",
            dataType:"JSON",
            data:$("#customer-form").serializeArray(),
            success:function (data) {
                $("#customer-form input[name~='id']").val(0);
                toastr.success('Operation successfull.');
                document.getElementById("customer-form").reset();
                $("#customer_id").append('<option value="'+data.id+'">'+data.name+'</option>')
                $('.loader-bg').hide();
                $("#new-sub_head").modal('hide');
            },error:function(ajaxcontent) {
                vali=ajaxcontent.responseJSON.errors;
                var errors='';
                $.each(vali, function( index, value ) {
                    $("#customer-form input[name~='" + index + "']").css('border', '1px solid red');
                    $("#customer-form select[name~='" + index + "']").parents('.form-group').find('.select2').css('border', '1px solid red');
                    toastr.error(value);
                    $('.loader-bg').hide();
                });
            }
        })
    }
    function grand_total_cal(){
        let discountCost =  parseInt($("#additional_discount").val());
        let shipping=parseFloat($("#shipping_input").val());
        let prom_disc =  parseFloat( $('#promotional_discount').val());
        let tax=parseFloat($("#tax_input").val());
        let coupan=parseFloat($("#coupon_input").val());
        if(isNaN(discountCost)){
            var discountDecimal =0;
        }else{
            var discountDecimal = b_decimals(discountCost);
        }
        if(isNaN(prom_disc)){
            prom_disc =0;
        }else{
            prom_disc = b_decimals(prom_disc);
        }
        if(isNaN(shipping)){
            shipping=0;
        }else{
            shipping= b_decimals(shipping);
        }
        if(isNaN(tax)){
            tax=0;
        }else{
            tax = b_decimals(tax);
        }
        if(isNaN(coupan)){
            coupan=0;
        }else{
            coupan= b_decimals(coupan);
        }
        let grandTotal = $('#subtotal').val()
        if(!isNaN(shipping))
        {
            $('#grand_total').html(b_decimals(parseFloat(grandTotal) - parseFloat(discountDecimal) - parseFloat(prom_disc)+parseFloat(shipping)+parseFloat(tax)-parseFloat(coupan)))
        }
    }
    $(document).on('keyup', '#shipping_input', function() {
        grand_total_cal();
    });
    $(document).on('keyup', '#additional_discount   ', function() {
        grand_total_cal();
    });
   /* function additional_discount(){
        grand_total_cal();
    };*/
    $(document).on('keyup', '#tax_input', function() {
        let taxCost =  parseInt($(this).val());
        var taxDecimal = b_decimals(taxCost);
        let grandTotal = $('#grand_total').html()
        if(isNaN(taxDecimal))
        {
            return false
        }else{
            $('#grand_total').html(parseFloat(grandTotal) + parseFloat(taxDecimal))

        }
    });
    function recent_trans() {
        get_recent_transactions();
        const audio = new Audio("{{ URL::asset('public/beep/beep-07.mp3') }}");
        audio.play();
        $("#recent-trans").modal();
    }
    function finalize_sale() {
        const audio = new Audio("{{ URL::asset('public/beep/beep-07.mp3') }}");
        audio.play();
        $("#finalize-sale").modal();
    }
    function pay() {
        const audio = new Audio("{{ URL::asset('public/beep/beep-07.mp3') }}");
        audio.play();
        let grand_total=$("#grand_total").text();
        $("#modal_total_amount").text(grand_total);
        // $("#cash").val(grand_total);
        $("#outStanding").text(grand_total);
        $("#paid").text('0');
        $("#pay").modal();
    }
    function sale_return() {
        const audio = new Audio("{{ URL::asset('public/beep/beep-07.mp3') }}");
        audio.play();
        $('.returnRows').remove();
        $('#returnitem-count').text('0(0)');
        $('#returnsubtotal').text(0);
        $('#returngrand_total').text(0);
        $("#sale-return_modal").modal();
    }
    function receivd_amount() {
        let cash=$("#cash").val();
        let credit_card=$("#credit-card").val();
        let qr_payment=$("#qr-code").val();
        let other_amount=$("#other-amount").val();
        let paid=Number(cash)+Number(credit_card)+Number(qr_payment)+Number(other_amount);
        $("#change").val(paid);
        $("#paid").text(paid);
        let grand_total=$("#grand_total").text();
        $("#outStanding").text(Number(grand_total)-Number(paid));
        if( paid >  Number(grand_total)){
            $("#paid").text(grand_total);
            $("#write_off").val(Number(grand_total)-Number(paid));
            $("#outStanding").text('0');

        }else{
            $("#write_off").val('0');

        }


    }
    function cash_change(g) {
        let cash=$("#cash").val();
        let rec_cash=$(g).val();
        $("#write_off").val(Number(rec_cash)-Number(cash));

    }
    function get_recent_transactions(page){
        $.ajax({
            url:'/sale/pos/recent_sale_invoice',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            type:"POST",
            dataType:"JSON",
            success:function (data) {

                htmlData='';
                for(i in data.data){
                    let date=data.data[i].inv_date.substr(0,10);
                    let [year, month, day] = date.split('-');
                    date = [day, month, year].join('-');

                    htmlData+='<tr>';
                    htmlData+='<td>'+date+'</td>';
                    htmlData+='<td>'+data.data[i].si+'</td>';
                    htmlData+='<td>'+data.data[i].customers.name+'</td>';
                    htmlData+='<td>'+data.data[i].WH_Name+'</td>';
                    htmlData+='<td>'+(data.data[i].sale_created_by !=null? data.data[i].sale_created_by.name:'N/A')+'</td>';
                    htmlData+='<td>'+data.data[i].net_total+'</td>';
                    htmlData+='<td>';
                    htmlData+=' <a type="button" href="{{ url('sale/gen_invoice/') }}/'+data.data[i].id+'" class="btn btn-mini btn-info"><i class="fa fa-print"></i> </button>';
                    htmlData+='</td>';
                    htmlData+='</tr>';
                }
                $("#get_dataa").html(htmlData);
            }
        })
    }
</script>
</body>
</html>
<!-- Required Jqurey -->
<script src="{{ URL::asset('public/assets/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<script src="{{ URL::asset('public/assets/plugins/tether/dist/js/tether.min.js') }}"></script>

<!-- Required Fremwork -->
<script src="{{ URL::asset('public/assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>

<!-- waves effects.js -->
<script src="{{ URL::asset('public/assets/plugins/Waves/waves.min.js') }}"></script>

<!-- Scrollbar JS-->
<!--<script src="assets/plugins/jquery-slimscroll/jquery.slimscroll.js"></script>
<script src="assets/plugins/jquery.nicescroll/jquery.nicescroll.min.js"></script>-->

<!--classic JS-->
<script src="{{ URL::asset('public/assets/plugins/classie/classie.js') }}"></script>

<!-- notification -->
<script src="{{ URL::asset('public/assets/plugins/notification/js/bootstrap-growl.min.js') }}"></script>
<!-- Date picker.js -->
<script src="{{ URL::asset('public/assets/plugins/datepicker/js/moment-with-locales.min.js') }}"></script>
<script src="{{ URL::asset('public/assets/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js') }}"></script>

<!-- Rickshaw Chart js -->
<script src="{{ URL::asset('public/assets/plugins/d3/d3.js') }}"></script>
<!--<script src="assets/plugins/rickshaw/rickshaw.js"></script>-->

<!-- Sparkline charts -->
<script src="{{ URL::asset('public/assets/plugins/jquery-sparkline/dist/jquery.sparkline.js') }}"></script>
<!-- Bootstrap Datepicker js -->
<script type="text/javascript" src="{{ URL::asset('public/assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ URL::asset('public/assets/plugins/bootstrap-datepicker/js/bootstrap-datetimepicker.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('public/assets/plugins/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
<!-- Counter js  -->
<script src="{{ URL::asset('public/assets/plugins/waypoints/jquery.waypoints.min.js') }}"></script>
<script src="{{ URL::asset('public/assets/plugins/countdown/js/jquery.counterup.js') }}"></script>

<!-- custom js -->
<script type="text/javascript" src="{{ URL::asset('public/assets/js/main.min.js?v=1') }}"></script>
<!--<script type="text/javascript" src="assets/pages/dashboard.js"></script>-->
<script type="text/javascript" src="{{ URL::asset('public/assets/pages/elements.js') }}"></script>
<!--<script src="assets/js/menu.min.js"></script>-->
<script src="{{ URL::asset('public/assets/js/menu.js?v=1') }}"></script>
<script type="text/javascript" src="{{ URL::asset('public/assets/pages/advance-form.js') }}"></script>
<!-- Multi Select js -->
<script src="{{ URL::asset('public/assets/plugins/bootstrap-multiselect/dist/js/bootstrap-multiselect.js') }}"></script>
<script src="{{ URL::asset('public/assets/plugins/multiselect/js/jquery.multi-select.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('public/assets/plugins/multi-select/js/jquery.quicksearch.js') }}"></script>
<!-- highlite js -->
<!-- color picker -->
<script type="text/javascript" src="{{ URL::asset('public/assets/plugins/spectrum/spectrum.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('public/assets/plugins/jscolor/jscolor.js') }}"></script>
<!-- Select 2 js -->
<script src="{{ URL::asset('public/assets/plugins/select2/dist/js/select2.full.min.js') }}"></script>
<!-- Max-Length js -->
<script src="{{ URL::asset('public/assets/plugins/bootstrap-maxlength/src/bootstrap-maxlength.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('public/assets/plugins/syntaxhighlighter/scripts/shCore.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('public/assets/plugins/syntaxhighlighter/scripts/shBrushJScript.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('public/assets/plugins/syntaxhighlighter/scripts/shBrushXml.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('public/assets/pages/accordion.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('public/assets/js/toastr.min.js') }}"></script>
<script type="text/javascript">SyntaxHighlighter.all();</script>
<script type="text/javascript" src="{{ URL::asset('public/js/admin.js?v=1620732365') }}"></script>
<script type="text/javascript" src="{{ URL::asset('public/js/inc.func.js?v=1620732365') }}"></script>
<script type="text/javascript" src="{{ URL::asset('public/js/account.func.js?v=1620732365') }}"></script>
<script type="text/javascript" src="{{ URL::asset('pos') }}"></script>
<script type="text/javascript" src="{{ URL::asset('public/js/tourSale.js?v=1') }}"></script>
<script>
    var cashFlag = false
    var cCardFlag = false
    var QRCOdeFlag = false

    $('#cash').on('click keyup change', function (){
        cashFlag = true
        cCardFlag = false
        QRCOdeFlag = false
    })
    $('#credit-card').on('click keyup change', function (){
        cCardFlag = true
        cashFlag = false
        QRCOdeFlag = false
    })
    $('#qr-code').on('click keyup change', function (){
        QRCOdeFlag = true
        cCardFlag = false
        cashFlag = false
    })
    $('.jumbotron-custom').on('click', function (){
        if(cashFlag)
        {
            let concatNum = $(this).html().toString();
            if(concatNum === 'Del')
            {
                $('#cash').val('0.00')
            }else{

                let existValue = $('#cash').val()
                if(parseInt(existValue) === 0.00){

                    $('#cash').val( concatNum)
                }else{
                    $('#cash').val(existValue + concatNum)
                }

            }

        }else if(cCardFlag){
            let concatNum = $(this).html().toString();
            if(concatNum === 'Del')
            {
                $('#credit-card').val(0)
            }else{
                let existValue = $('#credit-card').val()

                    $('#credit-card').val(existValue + concatNum)

            }

        }else if(QRCOdeFlag){
            let concatNum = $(this).html().toString();
            if(concatNum === 'Del')
            {
                $('#qr-code').val(0)
            }else{
                let existValue = $('#qr-code').val()
                $('#qr-code').val(existValue + concatNum)
            }


        }
    })
    function add_product(prc,WHID,){
        $.ajax({
            url:"{{ url('load_product') }}",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            type:"POST",
            dataType:"JSON",
            data:{WHID:WHID,product_string:prc},
            success:function (data) {

                let subTotal = (data[0].product_price*1)+(data[0].additonal_price!=null?Number(data[0].additonal_price):Number(0));
                var pCode = data[0].product_code
                var code = ''
                if(data[0].is_variant==1)
                {
                    var varient_code = data[0].item_code;
                    pCode =  data[0].name+'('+varient_code+')';
                    code = data[0].item_code;
                }else{
                    var varient_code = data[0].product_code;
                    pCode = data[0].name+'('+varient_code+')'
                    code = data[0].product_code;
                }

                let htmlElement = '<tr class="rows"> ' +
                    '<td colspan="1" class="product-code" onclick="check_wh_stock(\''+data[0].item_code+'\')">' +
                    '<input type="hidden" class="min_qty" value="'+data[0].min_qty+'">' +
                    '<input type="hidden" class="max_qty" value="'+data[0].max_qty+'">' +
                    '<input type="hidden" class="p-code" value="'+code+'">'+
                    '<input type="hidden" name="product_id[]" value="'+data[0].PID+'"> ' +
                    '<input type="hidden" class="discount_type"  value="'+data[0].discount_type+'"> ' +
                    '<input type="hidden" class="discount_value"  value="'+b_decimals(data[0].discount_value)+'"> ' +
                    '<input type="hidden" class="variants '+data[0].item_code+'" value="'+data[0].variants+'"> ' +
                    '<input type="hidden" class="product_varient" name="product_varient[]" value="'+data[0].item_code+'">'+pCode+'</td>'+
                    '<td class="product-cost"><input type="hidden" name="Unit_cost[]" value="'+b_decimals(Number(data[0].product_price)+(data[0].additonal_price!=null?Number(data[0].additonal_price):Number(0)))+'">'+b_decimals(Number(data[0].product_price)+(data[0].additonal_price!=null?Number(data[0].additonal_price):Number(0)))+'</td>'+
                    '<td class="input-qty"><input type="number" min="1" class="quantity" name="qty[]" value="1"></td>'+
                    '<td>'+data[0].available_stock+'</td>'+
                    '<td><input type="hidden" class="input-discount" name="discount[]" value="'+b_decimals(data[0].discount)+'"><span class="line_discount ">'+'0'+'</span></td>'+

                    '<td id="" >0.00</td>'+
                    '<td class="sub-total">' +
                    '<input type="hidden" name="sub_total[]" value="'+b_decimals(subTotal)+'"><span>'+b_decimals(subTotal)+'</span></td>'+
                    '<td><i class="fa fa-trash trash" style="border: none"></i></td>'+
                    '</tr>';
                $('#product_id').val('')
                let pro_code = $('.product-code').text();
                // Check Products exists in POS table or not
                if(pro_code !== '')
                {
                    var isProUpdated = 0;
                    $(".product-code").each(function(){
                        let currentProductCode = $(this).find('.p-code').val();
                        // Check Current product already exists
                        if (parseInt(currentProductCode) === parseInt(data[0].product_code) || $.trim(currentProductCode) === $.trim(data[0].item_code))
                        {
                            //change quantity and subtotal
                            isProUpdated = 1;
                            let qty = parseInt($(this).closest('tr').find('.quantity').val())  + 1;
                            $(this).closest('tr').find('.quantity').val(qty)
                            let productCost= parseInt($(this).closest('tr').find('td.product-cost').text());
                            let finalSubTotal = productCost * qty;
                            $(this).closest('tr').find('td.sub-total').find('span').html(finalSubTotal);
                            $(this).closest('tr').find('td.sub-total').find('input').val(finalSubTotal);

                        }
                    });

                    // Check Current product not already exists
                    if(isProUpdated === 0 ){
                        isProUpdated = 1;
                        appendData(data.alert_qty, htmlElement)
                    }

                    //total quantity
                    let quantity = checkQuantity();
                    //count rows
                    let rowCount = rowsIndex();
                    $('#item-count').val(rowCount+'('+quantity+')')
                    //subtotal
                    let sum =  calculate();
                    $('#subtotal').val(sum);
                    $('#grand_total').text(sum);
                }
                else{

                    appendData(1, htmlElement)

                    //total
                    let sum =  calculate();
                    $('#total').html(sum);
                    $('#subtotal').val(sum);
                    $('#grand_total').html(sum);
                    $('#net-total').val(sum);
                    //total quantity
                    let quantity = checkQuantity();
                    let rowCount = rowsIndex();
                    $('#item-count').val(rowCount+'('+quantity+')');
                    let dis=total_discount();
                    // $("#discount_input").val(dis);
                }
                var dis=total_discount();
                // $("#discount_input").val(dis);
                discount_by_category();
                grand_total_cal();
                count_disc();
            }
            ,error:function(ajaxcontent) {
                vali=ajaxcontent.responseJSON.errors;
                var errors='';
                $.each(vali, function( index, value ) {
                    $("#Purchaeorder-form input[name~='" + index + "']").css('border', '1px solid red');
                    toastr.error(value);
                });
                $('.loader-bg').hide();
            }
        })
    }
    $('#product_id').on('input', function() {
        var userText = $(this).val();
        $("#product").find("option").each(function() {
            //search in list if avaialbe with same text or code
            if ($(this).val() == userText || $(this).attr('pc') == userText ) {
                var prc=$(this).attr('pc');
                let WHID = $("#pos-WHID").val();
                add_product(prc,WHID);
            }
        })
    });

    function discount_by_category(){
        if ($('.input-qty').length > 0) {
            $.ajax({
                url:"{{ url('discount_on_category') }}",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type:"POST",
                data: $("#pos-form").serialize(),
                dataType:"JSON",
                success:function (data) {
                    $('.loader-bg').hide();
                    $('#promotional_discount').val(Number(data));
                    grand_total_cal();
                },
                error:function(ajaxcontent) {
                    // $('.loader-bg').show();
                    vali=ajaxcontent.responseJSON.errors;
                    var errors='';
                    $.each(vali, function( index, value ) {
                        $("#Purchaeorder-form input[name~='" + index + "']").css('border', '1px solid red');
                        toastr.error(value);
                    });
                }
            });
        }




    }
    var totalQty = 0;
    $("#myTable").on('click', '.trash', function () {
        totalQty =  $('#total-qty').text();
        let removeQty =   $(this).closest('tr').find('td.input-qty input').val();
        let updatedQty = parseInt(totalQty) - parseInt(removeQty)
        $('#total-qty').val(updatedQty);
        let subTotal =  $(this).closest('tr').find('td.sub-total').text();
        let total  = $('#total').text();
        $('#total').html(parseInt(total) - parseInt(subTotal))
        $(this).closest('tr').remove();
        //subtotal
        let sum =  calculate();
        $('#subtotal').val(sum);
        $('#grand_total').text(sum);
        //count rows
        let quantity = checkQuantity();
        let rowCount = rowsIndex();
        $('#item-count').val(rowCount+'('+quantity+')');
        var dis=total_discount();
        // $("#discount_input").val(dis);
        discount_by_category();
    });

    function rowsIndex()
    {
        var rowCount = $(".rows").length;
        return rowCount;
    }
    //function that actually calculate discount
    function pos_discount(obj){
        let productCost = Number( obj.closest('tr').find('td.product-cost').text());
        let min_qty=Number(obj.closest('tr').find('.min_qty').val());
        let max_qty=Number(obj.closest('tr').find('.max_qty').val());
        let discountCost =  parseInt($("#additional_discount").val());
        if(isNaN(discountCost)){
            var discountDecimal =0;
        }else{
            var discountDecimal = b_decimals(discountCost);
        }
        let productQty = Number(obj.val());
        let total = productCost * productQty ;
        // let subTotalWithDiscount = 5 * total / 100;
        let discount = obj.closest('tr').find('.input-discount').val();
        if(productQty>=min_qty && productQty<=max_qty) {
            let total_dis = Number(productQty) * Number(discount);
            obj.closest('tr').find(".line_discount").text(total_dis);
            var dis=total_discount();
            // $("#discount_input").val(dis);
        }else{
            obj.closest('tr').find(".line_discount").text(0);
            var dis=total_discount();
            // $("#discount_input").val(dis);
        }
        obj.closest('tr').find('td.sub-total').find('span').html(total-dis);
        obj.closest('tr').find('td.sub-total').find('input').val(total-dis);
        calc_products_discount(obj);
        //subtotal
        let sum =  calculate();

        $('#subtotal').val(sum);
        //Decreasing from grand total

        $('#grand_total').html(parseFloat(sum));

        $('#net-total').val(sum);

        //check quantity
        let quantity = checkQuantity();
        let rowCount = rowsIndex();
        $('#item-count').val(rowCount+'('+quantity+')')
        let eachSubTotal =  obj.closest('tr').find('td.sub-total').find('span').text();
        $('#sub-total-input').val(eachSubTotal);
        discount_by_category();
        grand_total_cal();

    }


    //On Change quantity Count Discount
    $(document).on('keyup mouseup', '.quantity', function() {
        pos_discount($(this));
    });

    //count selected all products discount at once
    //we will call this function on produ.ct select
    function count_disc() {
        $('.quantity').each(function(i, obj) {
            pos_discount($(this));
        });
    }

    function calc_products_discount(obj){
        let current_product=obj.closest('tr').find('.product_varient').val();
        let productCost = Number( obj.closest('tr').find('td.product-cost').text());
        let min_qty=Number(obj.closest('tr').find('.min_qty').val());
        let max_qty=Number(obj.closest('tr').find('.max_qty').val());
        let discountCost =  parseInt($("#additional_discount").val());
        discount_type = obj.closest('tr').find('.discount_type').val();
        discount_value = obj.closest('tr').find('.discount_value').val();
        let qty = Number(obj.val());
        var total_qty=0;
        total_qty =+qty;
        let disc_products=[];
        disc_products[0]={'product_code' : current_product, 'cost' : productCost , 'qty' : qty, 'discount_type' : discount_type , 'discount_value' : Number(discount_value)  };

        let variants=obj.closest('tr').find('.variants').val();
        variants_arr = variants.split(',');

        variants_arr.forEach(function (variant,index){
            if(variant != current_product){
                $('.'+variant).each(function(i, obj) {
                    product_code = $(this).closest('tr').find('.product_varient').val();
                    cost = Number( $(this).closest('tr').find('td.product-cost').text());
                    qty = Number( $(this).closest('tr').find('.quantity').val());
                    discount_type = $(this).closest('tr').find('.discount_type').val();
                    discount_value = $(this).closest('tr').find('.discount_value').val();
                    total_qty = total_qty + qty;
                    disc_products[disc_products.length]={'product_code' : product_code, 'cost' : cost , 'qty' : qty , 'discount_type' : discount_type , 'discount_value' : Number(discount_value) };

                });
            }

        });
        if(total_qty>=min_qty && total_qty<=max_qty) {
            disc_products.forEach(function (product,index){
                switch (product.discount_type){
                    case "Fixed":
                        disc = product.discount_value;
                        break;
                    case "Percentage":
                        percentage = product.discount_value;
                        product_price = product.cost;
                        disc = percentage /100 * product_price;
                        break;
                    default:
                        console('another type of Disc');
                        break;
                }
                disc=b_decimals(disc) *  product.qty ;
                total = product.cost * product.qty ;
                $('.'+product.product_code).each(function(i, obj) {
                    $(this).closest('tr').find(".line_discount").text(b_decimals(disc));
                    $(this).closest('tr').find('td.sub-total').find('span').html(b_decimals(total-disc));
                    $(this).closest('tr').find('td.sub-total').find('input').val(b_decimals(total-disc));

                });
            });

        }else{
            disc_products.forEach(function (product,index){
                total = product.cost * product.qty ;
                $('.'+product.product_code).each(function(i, obj) {
                    $(this).closest('tr').find(".line_discount").text(0);
                    $(this).closest('tr').find('td.sub-total').find('span').html(total);
                    $(this).closest('tr').find('td.sub-total').find('input').val(total);
                });
            });
        }
    }


    function calculate()
    {
        var sum = 0;
        $(".sub-total").each(function(){
            sum += parseFloat($(this).text());
        });
        return b_decimals(sum);
    }
    function calculateTax()
    {
        var sum = 0;
        $(".tax-amount").each(function(){
            sum += parseFloat($(this).text());
        });
        return b_decimals( sum);
    }

    function checkQuantity() {
        var quantity = 0;
        $(".quantity").each(function(){
            quantity += parseFloat($(this).val());
        });
        return quantity
    }
    function total_discount() {
        var dis = 0;
        $(".line_discount").each(function(){
            dis += parseFloat($(this).text());
        });
        return dis;
    }
    function appendData(qty, htmlElement)
    {
        $('#myTable tr:last').after(htmlElement);
    }

    function openNav() {
        document.getElementById("mySidenav").style.width = "250px";
        $("#openNav").hide();
        $("#closeNav").show();
    }

    function closeNav() {
        document.getElementById("mySidenav").style.width = "0";
        $("#closeNav").hide();
        $("#openNav").show();
    }
</script>
<script>
    $("ul.treeview-menu li").each(function(){
        if($(this).hasClass("active")){
            $(this).closest("li.treeview").addClass("active");
        }
    });
    $('.date').datepicker({
        todayBtn: false,
        clearBtn: false,
        keyboardNavigation: false,
        forceParse: false,
        todayHighlight: true,
        autoclose:true,
        format: 'yyyy-mm-dd'
    });
    //save invoice
    function save_rec() {
        $('.loader-bg').show();
        var formData = new FormData($("#pos-form")[0]);
        let net_total=$("#grand_total").text();
        let cash=$("#cash").val();
        let cc=$("#credit-card").val();
        let qr_code=$("#qr-code").val();
        let other_amount=$("#other-amount").val();
        let change_cash=$("#change_cash").val();
        let write_off=$("#write_off").val();
        formData.append('net_total',net_total);
        formData.append('cash',cash);
        formData.append('credit_card',cc);
        formData.append('qr_code',qr_code);
        formData.append('other_payment',other_amount);
        formData.append('write_off',write_off);
        $.ajax({
            url:"{{ route('pos.store') }}",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            type:"POST",
            dataType:"JSON",
            contentType: false,
            cache: false,
            processData: false,
            data:formData,
            success:function (data) {
                $("#pos-form input[name~='id']").val(0);
                toastr.success('Operation successfull.');
                $('.rows').remove()
                $('#item-count').text('0(0)')
                $('#subtotal').text(0)
                $('#grand_total').text(0);
                $('.loader-bg').hide();
                $("#pay").modal('hide');
                $("#cash").val('');

                document.getElementById("pos-form").reset();
                window.location.href='{{ url('sale/gen_invoice/') }}/'+data;
            }
            ,error:function(ajaxcontent) {
                vali=ajaxcontent.responseJSON.errors;
                var errors='';
                $.each(vali, function( index, value ) {
                    $("#Purchaeorder-form input[name~='" + index + "']").css('border', '1px solid red');
                    toastr.error(value);
                });
                $('.loader-bg').hide();
            }
        })
    }
    //stock details warehouse wise
    function check_wh_stock(id) {
        $("#wh-qty").modal();
        $.ajax({
            url: "{{ url('product/check_wh_stock') }}/"+id,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            type: "GET",
            dataType: "JSON",
            success: function (data) {
                var htmlData='';
                for(i in data){
                    var rq=(data[i].pq)-(data[i].sq);
                    htmlData+='<tr>';
                        htmlData+='<td>'+data[i].category_name+'</td>';
                        htmlData+='<td>'+data[i].name+'</td>';
                        htmlData+='<td>'+data[i].item_code+'</td>';
                        htmlData+='<td>'+data[i].WH_Name+'</td>';
                        htmlData+='<td>'+rq+'</td>';
                    htmlData+='</tr>';
                }
                if(data.length == 0){
                    htmlData=`<tr>
                                    <td colspan="4" style="text-align: center;">No Stock Available!</td>
                            </tr>`;
                }
                $("#get_wh_qty").html(htmlData);
            }
        });
    }
    $('#return_product_id').on('input', function() {
        var userText = $(this).val();
        $("#return_product").find("option").each(function() {
            if ($(this).val() == userText || $(this).attr('pc') == userText ) {
                var prc=$(this).attr('pc');
                $.ajax({
                    url:"{{ url('load_productPurchae') }}",
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    type:"POST",
                    dataType:"JSON",
                    data:{product_string:prc},
                    success:function (data) {
                        let additonal_price =(typeof(data[0].additonal_price) != "undefined")? Number(data[0].additonal_price):0;

                        let subTotal = (data[0].product_price *  1)+additonal_price;
                        var pCode = data[0].product_code
                        if(data[0].is_variant==1)
                        {
                            var varient_code = data[0].item_code;
                            pCode =  varient_code;
                        }else{
                            var varient_code = data[0].product_code;
                            pCode =  varient_code
                        }

                        let htmlElement = '<tr class="returnRows"> ' +
                            '<td colspan="1" ><input type="hidden" name="product_id[]" value="'+data[0].PID+'">'+data[0].name+'</td>'+
                            '<td class="return_product-code"> <input type="hidden" name="product_varient[]" value="'+pCode +'">'+pCode+'</td>'+
                            '<td class="return_input-qty"><input type="number" min="1" class="returnQuantity" name="qty[]" value="1"></td>'+
                            '<td class="return_product-cost"><input type="hidden" name="Unit_cost[]" value="'+(Number(data[0].product_price)+additonal_price)+'">'+(Number(data[0].product_price)+additonal_price)+'</td>'+
                            '<td id="" >0.00</td>'+
                            '<td class="return_tax-amount" >0.00</th>'+
                            '<td class="return_sub-total">' +
                            '<input type="hidden" name="sub_total[]" value="'+subTotal+'"><span>'+subTotal+'</span></td>'+
                            '<td><i class="fa fa-trash trashReturn" style="border: none"></i></td>'+
                            '</tr>';
                        $('#return_product_id').val('')
                        let pro_code = $('.return_product-code').text();
                        // alert(pro_code.replace(/[a-z]-/ig, ""));
                        if(pro_code !== '')
                        {
                            var isProUpdated = 0;
                            $(".return_product-code").each(function(){
                                let currentProductCode = $(this).text();
                                if (parseInt(currentProductCode) === parseInt(data[0].product_code) || $.trim(currentProductCode) === $.trim(data[0].item_code))
                                {

                                    isProUpdated = 1;
                                    let currentQty = parseInt($(this).closest('tr').find('.quantity').val())  + 1;
                                    $(this).closest('tr').find('.quantity').val(currentQty)
                                    let productCost= parseInt($(this).closest('tr').find('td.return_product-cost').text())
                                    let currentInputQty  =  parseInt($(this).closest('tr').find('.quantity').val())
                                    let finalSubTotal = (productCost * currentInputQty);

                                    $(this).closest('tr').find('td.return_sub-total span').html(finalSubTotal)
                                    $(this).closest('tr').find('td.return_sub-total input').val(finalSubTotal)
                                    //total quantity
                                    let quantity = checkReturnQuantity();
                                    $('#return_total-qty').html(quantity);
                                    //count rows
                                    totalQty =  $('#return_total-qty').text();
                                    let rowCount = returnRowsIndex();
                                    $('#return_item-count').html(rowCount+'('+totalQty+')')
                                    //total
                                    let sum =  returnCalculate();
                                    $('#return_total').html(sum);
                                    $('#return_subtotal').html(sum);
                                    $('#return_grand_total').html(sum);
                                    $('#return_net-total').val(sum);
                                }




                            });

                            if(isProUpdated === 0 ){
                                isProUpdated = 1;
                                appendReturnData(data.alert_qty, htmlElement)
                                //total quantity
                                let quantity = checkReturnQuantity();

                                $('#return_total-qty').html(quantity);
                                //count rows
                                totalQty =  $('#return_total-qty').text();
                                let rowCount = returnRowsIndex();
                                $('#return_item-count').html(rowCount+'('+totalQty+')')
                                //total
                                let sum =  returnCalculate();
                                $('#return_total').html(sum);
                                $('#return_subtotal').html(sum);
                                $('#return_grand_total').html(sum);
                                $('#return_net-total').val(sum);
                            }
                        }
                        else{
                            appendReturnData(1, htmlElement)
                            //total
                            let sum =  returnCalculate();
                            $('#return_total').html(sum);
                            $('#return_subtotal').html(sum);
                            $('#return_grand_total').html(sum);
                            $('#return_net-total').val(sum);
                            //count rows
                            totalQty =  $('#return_total-qty').text();
                            let rowCount = returnRowsIndex();
                            $('#return_item-count').html(rowCount+'('+totalQty+')')


                        }


                    }
                    ,error:function(ajaxcontent) {
                        vali=ajaxcontent.responseJSON.errors;
                        var errors='';
                        $.each(vali, function( index, value ) {
                            $("#sale-return input[name~='" + index + "']").css('border', '1px solid red');
                            toastr.error(value);
                        });
                        $('.loader-bg').hide();
                    }
                })
            }
        })
    })
    function appendReturnData(qty, htmlElement)
    {
        $('#return_myTable tr:last').before(htmlElement);

        $('#return_total-qty').html(qty);
        let taxSum = returnCalculateTax();
        $('#return_total-tax').html(taxSum)
        let sum =  returnCalculate();
        //total quantity
        let quantity = checkReturnQuantity();
        $('#return_total').html(sum);
        $('#return_total-qty').html(quantity);
    }
    function checkReturnQuantity() {
        var quantity = 0;
        $(".returnQuantity").each(function(){
            quantity += parseFloat($(this).val());
        });
        return quantity
    }
    function returnRowsIndex()
    {
        var rowCount = $(".returnRows").length;
        return rowCount;
    }
    $('#sale-return').submit(function(e) {
        e.preventDefault();
        $('.loader-bg').show();
        var formData = new FormData(this);
        $.ajax({
            url:"{{ route('sale_return.store') }}",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            type:"POST",
            dataType:"JSON",
            contentType: false,
            cache: false,
            processData: false,
            data:formData,
            success:function (data) {
                $("#sale-return input[name~='id']").val(0);
                toastr.success('Operation successfull.');
                document.getElementById("sale-return").reset();
                $('.returnRows').remove();
                $('#returnitem-count').text('0(0)');
                $('#returnsubtotal').text(0);
                $('#returngrand_total').text(0);
                $("#sale-return_modal").modal('hide');
                $('.loader-bg').hide();
            }
            ,error:function(ajaxcontent) {
                vali=ajaxcontent.responseJSON.errors;
                var errors='';
                $.each(vali, function( index, value ) {
                    $("#sale-return  input[name~='" + index + "']").css('border', '1px solid red');
                    toastr.error(value);
                });
                $('.loader-bg').hide();
            }
        })
    });
    $("#return_myTable").on('click', '.trashReturn', function () {
        totalQty =  $('#return_total-qty').text();
        let removeQty =   $(this).closest('tr').find('td.return_input-qty input').val();
        let updatedQty = parseInt(totalQty) - parseInt(removeQty)
        $('#return_total-qty').val(updatedQty);
        let subTotal =  $(this).closest('tr').find('td.return_sub-total').text();
        let total  = $('#return_total').text();
        $('#return_total').html(parseInt(total) - parseInt(subTotal))
        $(this).closest('tr').remove();
        //subtotal
        let sum =  returnCalculate();
        $('#return_subtotal').val(sum);
        $('#return_grand_total').text(sum);
        //count rows
        let quantity = checkReturnQuantity();
        let rowCount = returnRowsIndex();
        $('#return_item-count').val(rowCount+'('+quantity+')');
    });
    function returnCalculate()
    {
        var sum = 0;
        $(".return_sub-total").each(function(){
            sum += parseFloat($(this).text());
        });
        return sum;
    }

    $(document).on('keyup change', '#return_order_discount_input', function() {
        let orderDiscount =  parseInt($(this).val());
        let shippingCost = parseInt($('#return_order_shipping_input').val());
        if(isNaN(orderDiscount)){
            orderDiscountDecimal=0;
        }else{
            let orderDiscountDecimal = b_decimals(orderDiscount);
            $('#return_order_discount').html(orderDiscountDecimal)
        }
        if(isNaN(shippingCost)){
            shippingCost=0;
        }else{
            shippingCost= b_decimals(parseFloat(shippingCost));
        }
        let sum =  returnCalculate();
        let discountedSubTotal = (sum + parseInt(shippingCost)) - orderDiscount;
        $("#return_grand_total").text(discountedSubTotal);
        $("#return_net-total").val(discountedSubTotal);
    });
    $(document).on('keyup change', '#return_order_shipping_input', function() {
        let shippingCost =parseInt($(this).val());
        let orderDiscount = parseInt($('#return_order_discount_input').val());
        if(isNaN(orderDiscount)){
            orderDiscountDecimal=0;
        }else{
            let orderDiscountDecimal = b_decimals(orderDiscount);
            $('#return_order_discount').html(orderDiscountDecimal)
        }
        if(isNaN(shippingCost)){
            shippingCost=0;
        }else{
            shippingCost= b_decimals(parseFloat(shippingCost));
            $("#return_shipping_cost").text(shippingCost);
        }
        let sum =  returnCalculate();
        let discountedSubTotal = (sum + parseInt(shippingCost)) - orderDiscount;
        $("#return_grand_total").text(discountedSubTotal);
        $("#return_net-total").val(discountedSubTotal);
    });
    function returnCalculateTax()
    {
        var sum = 0;
        $(".return_tax-amount").each(function(){
            sum += parseFloat($(this).text());
        });
        return b_decimals(sum);
    }

</script>

@include('pos.cash-register-modal')