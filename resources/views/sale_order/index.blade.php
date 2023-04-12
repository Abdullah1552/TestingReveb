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
        @media print {
            .print-header{ display: block !important;}
            .page-title, #search-form, .panel-heading, hr{
                display: none;}
            @page { size: auto;  margin: 0 auto}
            html, body {
                padding: 0;
                margin: 0;
            }
            th, td{ font-size: 10px}
            #chartContainer{
                margin-top: -50px !important;
            }
            .col-md-6{ width: 50% !important; float: left}
            .no-report{ display: none;}
            .report-show{
                display: block !important;
            }
        }
    </style>
    <div class="content-wrapper">
        <div class="container-fluid">
            <!-- Header start -->
            <div class="row no-report">
                <div class="main-header no-report" style="margin-top: 0px;">
                    <ol class="breadcrumb breadcrumb-title breadcrumb-arrow">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="icofont icofont-home"></i></a> </li>
                        <li class="breadcrumb-item">Sale</li>
                        <li class="breadcrumb-item active">Sale Invoice List </li>
                    </ol>
                </div>
            </div>
            <!-- End start -->
            <div class="row">
                <!-- Form Control starts -->
                <div class="col-md-12">
                    <div class="card">
                        <form id="form" class="no-report" style="padding: 15px;">
                            <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Date From</label>
                                    <input name="df" class="form-control date" placeholder="Date From" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Date To</label>
                                    <input name="dt" class="form-control date" placeholder="Date To" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Invoice No.</label>
                                    <input name="invoice_no" class="form-control" placeholder="Invoice No." autocomplete="off">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Select Person</label>
                                    <select name="saleperson_id" class="js-example-basic-single form-control ">
                                        <option value="0" selected>Select</option>
                                        {!! App\Models\SalePerson::dropdown() !!}
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Select Location</label>
                                    <select name="wherehouse_id" class="js-example-basic-single form-control ">
                                        <option value="0" selected>Select</option>
                                        {!! App\Models\WhereHouse::dropdown() !!}
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Select Customer</label>
                                    <select name="customer_id" class="js-example-basic-single form-control ">
                                        <option value="0" selected>Select</option>
                                        {!! App\Models\Customer::dropdown() !!}
                                    </select>
                                </div>
                            </div>
                            </div>
                            <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Sale Type</label>
                                    <select  class="js-example-basic-single form-control " name="sale_type">
                                        {!! \App\Models\SaleInvoice::sale_type_dropdown() !!}
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Payment Status</label>
                                    <select  class="js-example-basic-single form-control " name="payment_status">
                                        <option value="" selected>Select Status</option>
                                        {!! App\Helpers\helpers::payment_status() !!}
                                    </select>
                                </div>
                            </div>
                            @if(\Illuminate\Support\Facades\Auth::user()->type != "end_user")
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Created by</label>
                                    <select  class="js-example-basic-single form-control " name="created_by">
                                        <option value="" selected></option>
                                        {!! \App\Models\User::dropdown() !!}
                                    </select>
                                </div>
                            </div>
                            @endif

                            <div class="col-md-1">
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
                                    <button type="button" onclick="get_data(1)" class="btn btn-info btn-mini"><i class="fa fa-search"></i> </button>
                                </div>
                            </div>
                            </div>
                        </form>
                        <div class="card-block">
                            <div class="col-md-12 no-report">
                                <button class="btn btn-mini btn-success exportToExcel pull-right"  type="button" >
                                    <span ><i title="export to csv" class="fa fa-file-text-o" ></i></span>
                                </button>
                                <button class="btn btn-mini btn-info pull-right" id="printDiv"  type="button" >
                                    <span > <i title="print" class="fa fa-print" ></i></span>
                                </button>
                                @can('sale_view')
                                    <button type="button" onclick="add_new()" class="btn btn-mini btn-primary pull-right">Add New</button>
                                @endcan
                            </div>
                            <div class="col-sm-12 table-responsive pad0">
                                {!! \App\Helpers\helpers::a_four_header() !!}
                                <h4 class="print-header" align="center" style="display:none;margin-bottom: 0px;margin-top: 5px;font-size: 14px;">Sale Invoice Report</h4>
                                <table class="table table2excel" style="text-align: center !important;">
                                    <tr style="background-color: #eeeeee;">
                                        <th scope="col" class="no-report"><input type="checkbox" /></th>
                                        <th class="text-center">#</th>
                                        <th class="text-center">Date</th>
                                        <th class="text-center">Invoice#</th>
                                        <th class="text-center">Customer</th>
                                        <th class="text-center">Sale Person</th>
                                        <th class="text-center">Created_by</th>
                                        <th class="text-center">Location</th>
                                        <th class="text-center">Sale Status</th>
                                        <th class="text-center">Payment</th>
                                        <th class="text-center">Grand Total</th>
                                        <th class="text-center">Paid</th>
                                        <th class="no-report">Action</th>
                                    </tr>
                                    <tbody id="get_data">
                                    </tbody>
                                </table>
                                <div class="pagination-panel pull-right no-report"></div>

                            </div>
                        </div>
                        <!--card-block-->
                    </div>
                    <!--card-->
                </div>
                <!-- Form Control ends -->
            </div>
        </div>
    </div>
    @include('sale_order.modal');
    <script>
        var totalQty = 0;
        $("#myTable").on('click', '.trash', function () {
            totalQty =  $('#total-qty').text();
            let removeQty =   $(this).closest('tr').find('td.input-qty input').val();
            let updatedQty = parseInt(totalQty) - parseInt(removeQty)
            $('#total-qty').text(updatedQty);
            let subTotal =  $(this).closest('tr').find('td.sub-total').text();
            let total  = $('#total').text();
            $('#total').html(parseInt(total) - parseInt(subTotal))
            $(this).closest('tr').remove();

            //subtotal
            let sum =  calculate();
            $('#subtotal').text(sum);
            $(".paying_amount").val(sum);

            $('.asdfasdfasdf12da').html(sum.toString());

            //total tax
            let taxSum = calculateTax();
            $('#total-tax').html(taxSum)

            //Decreasing from grand total
            // let orderDiscount =  $('#order_discount_input').val();
            // let shippingCost = $('#order_shipping_input').val()
            // let deductDiscount = total  - orderDiscount;
            // let addShipmentCost = deductDiscount - shippingCost
            // $('#grand_total').html(addShipmentCost);
            $('#net-total').val(sum)
            //count rows
            totalQty =  $('#total-qty').text();
            let rowCount = rowsIndex();
            $('#item-count').html(rowCount+'('+totalQty+')')
            // alert($('#grand_total').html())
        });

        function rowsIndex()
        {
            var rowCount = $(".rows").length;
            return rowCount;
        }
        //Change quantity
        $(document).on('keyup change', '.quantity', function() {
            let productCost = $(this).closest('tr').find('td.product-cost').find('input').val();
            let min_qty=$(this).closest('tr').find('.min_qty').val();
            let max_qty=$(this).closest('tr').find('.max_qty').val();
            let productQty = Number($(this).val());
            let discount = $(this).closest('tr').find('.input-discount').val();
            let total = productCost * productQty ;
            let total_dis=Number(productQty)*Number(discount);
            $(this).closest('tr').find(".line_discount").text(total_dis);
            if(productQty>=min_qty && productQty<=max_qty) {
                let total_dis = Number(productQty) * Number(discount);
                $(this).closest('tr').find(".line_discount").text(total_dis);
                var dis=total_discount();
                // $("#discount_input").val(dis);
                $("#total-discount").text(dis);
            }else{
                $(this).closest('tr').find(".line_discount").text(0);
                var dis=total_discount();
                // $("#discount_input").val(0);
                $("#total-discount").text(dis);
            }

            $(this).closest('tr').find('td.sub-total span').text(total-dis);
            $(this).closest('tr').find('td.sub-total input').val(total-dis);
            //subtotal
            let sum =  calculate();
            $('#total').html(sum);
            //Decreasing from grand total
            $('#grand_total').html(parseInt(sum));
            $('#subtotal').text(sum);
            $('#net-total').val(sum);
            $(".paying_amount").val(sum);
            //check quantity
            let quantity = checkQuantity();
            $('#total-qty').html(quantity);
            //count rows
            totalQty =  $('#total-qty').text();
            let rowCount = rowsIndex();
            $('#item-count').html(rowCount+'('+totalQty+')')
            let eachSubTotal =  $(this).closest('tr').find('td.sub-total').text()
            $('#sub-total-input').val(eachSubTotal);
        });
        function calculate() {
            var sum = 0;
            $(".sub-total").each(function(){
                sum += parseFloat($(this).text());
            });
            return sum;
        }
        function calculateTax()
        {
            var sum = 0;
            $(".tax-amount").each(function(){
                sum += parseFloat($(this).text());
            });
            return sum.toFixed(2);
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
            $('#myTable tr:last').before(htmlElement);

            $('#total-qty').html(qty);
            let taxSum = calculateTax();
            $('#total-tax').html(taxSum)
            let sum =  calculate();
            //total quantity
            let quantity = checkQuantity();
            $('#total').html(sum);
            $('#total-qty').html(quantity);
            let dis=total_discount();
            $("#total-discount").text(dis);
        }
        $(document).on('keyup change', '#order_discount_input', function() {
            let orderDiscount =  parseInt($(this).val());
            let orderDiscountDecimal = orderDiscount.toFixed(2);
            let shippingCost = parseInt($('#order_shipping_input').val())
            if(isNaN(orderDiscount)) {
                let floatValue = 0
                $('#order_discount').html(floatValue.toFixed(2))

            }else{
                $('#order_discount').html(orderDiscountDecimal)
            }
            //total
            let sum =  calculate();
            let discountedSubTotal = (sum + parseInt(shippingCost)) - parseInt(orderDiscount);
            $('#grand_total').html(discountedSubTotal);
            $(".paying_amount").val(discountedSubTotal)
            $('#net-total').val(sum);
            $('#subtotal').text(discountedSubTotal);
        });
        $(document).on('keyup change', '#order_shipping_input', function() {
            let orderShippingCost =  parseInt($(this).val());
            let orderShippingDecimal = orderShippingCost.toFixed(2);

            if(isNaN(orderShippingDecimal))
            {
                let floatValue = 0
                $('#shipping_cost').html(floatValue.toFixed(2))
            }else{
                $('#shipping_cost').html(orderShippingDecimal)
                //total
                let sum =  calculate();
                let discountedSubTotal = sum + orderShippingCost;
                $('#grand_total').html(discountedSubTotal);
                $(".paying_amount").val(discountedSubTotal)
                $('#net-total').val(sum);
                $('#subtotal').text(discountedSubTotal);
            }
        });

        $('#product_id').on('input', function() {
            var userText = $(this).val();
            $("#product").find("option").each(function() {
                if ($(this).val() == userText || $(this).attr('pc') == userText ) {
                    var prc=$(this).attr('pc');
                    var inv_date=$("#sale-form input[name~='date']").val();
                    $.ajax({
                        url:"{{ url('load_product') }}",
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        type:"POST",
                        dataType:"JSON",
                        data:{'product_string':prc,'date':inv_date},
                        success:function (data) {
                            let additonal_price =(typeof(data[0].additonal_price) != "undefined")? Number(data[0].additonal_price):0;
                            let product_discount = data[0].product_discount??0;
                            let subTotal = (data[0].product_price*1)+additonal_price;
                            var pCode = data[0].product_code
                            if(data[0].is_variant==1) {
                                var varient_code = data[0].item_code;
                                pCode =  varient_code;
                            }else{
                                var varient_code = data[0].product_code;
                                pCode =  varient_code
                            }
                            let available_stock = Number(data[0].pq)- Number(data[0].sq);

                            let htmlElement = '<tr class="rows"> ' +
                                '<td colspan="1" ><input type="hidden" name="product_id[]" value="'+data[0].PID+'">'+data[0].name+''+
                                '<input type="hidden" class="min_qty" value="'+data[0].min_qty+'">' +
                                '<input type="hidden" class="max_qty" value="'+data[0].max_qty+'">' +
                                '</td>'+
                                '<td class="product-code"> <input type="hidden" name="product_varient[]" value="'+pCode +'">'+pCode+'</td>'+
                                '<td class="input-qty"><input type="number" min="1" class="quantity" min="0" name="qty[]" value="1"></td>'+
                                '<td class="product-cost"><input type="hidden" name="Unit_cost[]" value="'+(Number(data[0].product_price)+additonal_price)+'">'+(Number(data[0].product_price)+additonal_price)+'</td>'+
                                '<td><input type="hidden" class="input-discount" name="discount[]" value="'+product_discount+'"><span class="line_discount">0.00</span></td>'+
                                '<td>'+available_stock+'</td>'+
                                '<td class="tax-amount" >0.00</th>'+
                                '<td class="sub-total">' +
                                '<input type="hidden" name="sub_total[]" value="'+(subTotal-product_discount)+'"><span>'+(subTotal-product_discount)+'</span></td>'+
                                '<td><i class="fa fa-trash trash" style="border: none"></i></td>'+
                                '</tr>';
                            $('#product_id').val('');
                            let pro_code = $('.product-code').text();
                            // alert(pro_code.replace(/[a-z]-/ig, ""));
                            if(pro_code !== '')
                            {
                                var isProUpdated = 0;
                                $(".product-code").each(function(){
                                    let currentProductCode = $(this).text();
                                    if (parseInt(currentProductCode) === parseInt(data[0].product_code) || $.trim(currentProductCode) === $.trim(data[0].item_code))
                                    {
                                        isProUpdated = 1;
                                        let currentQty = parseInt($(this).closest('tr').find('.quantity').val())  + 1;
                                        $(this).closest('tr').find('.quantity').val(currentQty)
                                        let productCost= parseInt($(this).closest('tr').find('td.product-cost').text())
                                        let currentInputQty  =  parseInt($(this).closest('tr').find('.quantity').val())
                                        let finalSubTotal = (productCost * currentInputQty) + 10.00;

                                        $(this).closest('tr').find('td.sub-total span').html(finalSubTotal)
                                        $(this).closest('tr').find('td.sub-total input').val(finalSubTotal)
                                        //total quantity
                                        let quantity = checkQuantity();
                                        $('#total-qty').html(quantity);
                                        //count rows
                                        totalQty =  $('#total-qty').text();
                                        let rowCount = rowsIndex();
                                        $('#item-count').html(rowCount+'('+totalQty+')')
                                        //total
                                        let sum =  calculate();
                                        $('#total').html(sum);
                                        $('#subtotal').html(sum);
                                        $('#grand_total').html(sum);
                                        $('#net-total').val(sum);
                                        $(".paying_amount").val(sum);
                                    }
                                });

                                if(isProUpdated === 0 ){
                                    isProUpdated = 1;
                                    appendData(data.alert_qty, htmlElement)
                                    //total quantity
                                    let quantity = checkQuantity();
                                    $('#total-qty').html(quantity);
                                    //count rows
                                    totalQty =  $('#total-qty').text();
                                    let rowCount = rowsIndex();
                                    $('#item-count').html(rowCount+'('+totalQty+')')
                                    //total
                                    let sum =  calculate();
                                    $('#total').html(sum);
                                    $('#subtotal').html(sum);
                                    $('#grand_total').html(sum);
                                    $('#net-total').val(sum);
                                    $(".paying_amount").val(sum)
                                }
                            }
                            else{
                                appendData(1, htmlElement)
                                //total
                                let sum =  calculate();
                                $('#total').html(sum);
                                $('#subtotal').html(sum);
                                $('#grand_total').html(sum);
                                $('#net-total').val(sum);
                                $(".paying_amount").val(sum);
                                //count rows
                                totalQty =  $('#total-qty').text();
                                let rowCount = rowsIndex();
                                $('#item-count').html(rowCount+'('+totalQty+')');
                                let dis=total_discount();
                                $("#total-discount").html(dis);

                            }


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
            })
        });
        function add_new() {
            $("#purchaseorder").modal();
            $("#sale-form input[name~='id']").val(0);
            document.getElementById("sale-form").reset();
            $(".first-row").show();
            $(".more-item").html('');
            $("#total").text(0);
            $("#total-tax").text(0);
            $("#item-count").text(0);
            $("#subtotal").text(0);
            $("#order_discount").text(0);
            $("#order_discount").text(0);
            $("#shipping_cost").text(0);
            $("#grand_total").text(0);
            $("#myTable").find("tr:gt(0):not(:last)").remove();
            // $(".js-example-basic-single").select2("val", "");
            $(".js-example-basic-single").val("").trigger('change');
        }
        $('#sale-form').submit(function(e) {
            e.preventDefault();
            $('.loader-bg').show();
            var formData = new FormData(this);
            $.ajax({
                url:"{{ route('sale_invoice.store') }}",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type:"POST",
                dataType:"JSON",
                contentType: false,
                cache: false,
                processData: false,
                data:formData,
                success:function (data) {
                    $("#sale-form input[name~='id']").val(0);
                    toastr.success('Operation successfull.');
                    document.getElementById("sale-form").reset();
                    $('.rows').remove()
                    $('#item-count').text('0(0)')
                    $('#subtotal').text(0)
                    $('#grand_total').text(0);
                    $("#purchaseorder").modal('hide');
                    $('.loader-bg').hide();
                }
                ,error:function(ajaxcontent) {
                    vali=ajaxcontent.responseJSON.errors;
                    if(vali==undefined){
                        toastr.error(ajaxcontent.responseJSON.message);
                        $('.loader-bg').hide();
                        return false;
                    }
                    var errors='';
                    $.each(vali, function( index, value ) {
                        $("#Purchaeorder-form input[name~='" + index + "']").css('border', '1px solid red');
                        toastr.error(value);
                    });
                    $('.loader-bg').hide();
                }
            })
        });
        $(document).ready(function () {
            get_data();
        });
        function get_data(page){
            $.ajax({
                url:'{{url('get_sale_order_invoice')}}?page='+page,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type:"POST",
                data:$("#form").serialize(),
                dataType:"JSON",
                success:function (data) {

                    htmlData='';
                    let total_net_total= 0;
                    let totalreceived_amount= 0;
                    for(i in data.data){
                        let date=data.data[i].inv_date.split(' ')[0];
                        let [year, month, day] = date.split('-');
                        date = [day, month, year].join('-');
                        htmlData+='<tr id="'+data.data[i].SID+'">';
                        htmlData+='<td class="no-report"><input type="checkbox"></td>';
                        htmlData+='<td>'+(Number(i)+1)+'</td>';
                        htmlData+='<td style="white-space: nowrap;">'+date+'</td>';
                        htmlData+='<td>'+(data.data[i].si!=null? data.data[i].si:'')+'</td>';
                        htmlData+='<td>'+(data.data[i].customers!=null? data.data[i].customers.name:'N/A')+'</td>';
                        htmlData+='<td>'+(data.data[i].sale_person!=null? data.data[i].sale_person.name:'N/A')+'</td>';
                        htmlData+='<td>'+(data.data[i].sale_created_by !=null? data.data[i].sale_created_by.name:'N/A')+'</td>';
                        htmlData+='<td>'+data.data[i].WH_Name+'</td>';
                        htmlData+='<td>'+ss(data.data[i].sale_status)+'</td>';
                        htmlData+='<td>'+pss(data.data[i].payment_status)+'</td>';
                        htmlData+='<td>'+b_decimals(data.data[i].net_total)+'</td>';
                        htmlData+='<td>'+b_decimals(data.data[i].received_amount)+'</td>';

                        htmlData+='<td class="no-report">';
                        // htmlData+='<a class="btn btn-mini btn-primary" href="javascript:void(0)" onclick="edit('+data.data[i].id+')"><i class="fa fa-edit"></i></a>';
                        @can('sale_view')
                            htmlData+=' <button type="button" onclick="del_rec(\''+data.data[i].SID+'\', \'{{ url('/sale_invoice/') }}/'+data.data[i].SID+'\')" class="btn btn-mini btn-danger"><i class="fa fa-trash-o"></i> </button>';
                        htmlData+=' <a type="button" target="_blank" href="{{ url('print_sale') }}/'+data.data[i].SID+'" class="btn btn-mini btn-info"><i class="fa fa-print"></i> </button>';
                        @endcan
                            htmlData+='</td>';
                        htmlData+='</tr>';
                        total_net_total+=Number(data.data[i].net_total);
                        totalreceived_amount+=Number(data.data[i].received_amount);
                    }
                    htmlData+='<tr>' +
                        '<td colspan="8" style="text-align: right"><b>Total</b></td>' +
                        '<td style="text-align: center"><b>'+ b_decimals(total_net_total)+'</b></td>'+
                        '<td style="text-align: center"><b>'+b_decimals(totalreceived_amount)+'</b></td>'+
                        '</tr>';
                    $("#get_data").html(htmlData);
                    pagination(data.total, data.per_page, data.current_page, data.to ,get_data);
                }
            })
        }
        function edit(id) {
            $('.loader-bg').show();
            $(".first-row").hide();
            $("#purchaseorder").modal();
            $.ajax({
                url:"{{ url('purchase_invoice') }}/"+id+"/edit",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success:function (data) {
//                    $("").append(data.html);
                    $('#myTable tr:last').before(data[1]);
                    $(".js-example-basic-single").select2();
                    $("#purchase-form input[name~='id']").val(data[0].id);
                    $("#purchase-form select[name~='SUPID']").val(data[0].SUPID);
                    $("#purchase-form select[name~='WHID']").val(data[0].WHID);
                    $('.loader-bg').hide();
                    st();
                    $(".js-example-basic-single").select2();
                }
            })
        }
        function more_item() {
            $(".more-item").append('<div class="row-rem parentRemove"> <div class="clearfix"></div> ' +
                '<div class="form-group col-md-2 pf">' +
                '<select class="js-example-basic-single form-control form-control-sm" name="item_id[]">' +
                '<option value="">Select Item</option>{!! App\Models\Item::itemList() !!}</select>' +
                '</div>' +
                '<div class="form-group col-md-1 pf">'+
                '<select class="js-example-basic-single form-control form-control-sm" name="unit[]">' +
                '<option value="0">Select</option>{!! App\Models\UnitType::unitTypeList() !!}'+
                '</select>'+
                '</div>' +
                '<div class="form-group col-md-1 pf" style="width: 12% !important;">'+
                '<input type="text" class="form-control form-control-sm st_bag_weight" id="quantity" name="bag_weight[]" placeholder="Standard Bag Weight" required="required">'+
                '</div>'+
                '<div class="form-group col-md-1 pf" style="width:6% !important">' +
                '<input type="text" class="form-control form-control-sm qty" id="" name="quantity[]" placeholder="Qty">' +
                '</div>' +
                '<div class="form-group col-md-1 pf" style="width:8% !important" style="width:8% !important">'+
                '<input type="text" class="form-control form-control-sm total_bag" id="quantity" name="total_bag[]" required="required" placeholder="Total Bag">'+
                '</div>'+
                '<div class="form-group col-md-1 pf" style="width:8% !important">'+
                '<input type="text" class="form-control form-control-sm per_bag_rate" id="quantity" name="per_bag_rate[]" placeholder="Per Kg Rate" required="required">'+
                '</div>'+
                '<div class="form-group col-md-1 pf" style="width:8% !important">'+
                '<input type="text" class="form-control form-control-sm per_kg_w" id="quantity" name="per_kg_rate[]" placeholder="Per Kg Rate" required="required">'+
                '</div>'+
                '<div class="form-group col-md-1 pf">' +
                '<input type="text" class="form-control form-control-sm price" id="" name="unit_price[]" placeholder="Rate">' +
                '</div>' +
                '<div class="form-group col-md-1 pf">' +
                '<input type="text" class="form-control form-control-sm total" id="" name="amount[]" placeholder="Amount">' +
                '</div>' +
                '<div class="form-group col-md-1 pf" style="width: 5% !important;">' +
                '<button type="button" class="btn btn-mini btn-danger remove" name=""><i class="fa fa-trash"></i> </button>' +
                '</div><div class="clearfix"></div></div>');
            $(".js-example-basic-single").select2();
        }
        $(document).on('change','.parentRemove',function() {
            var sum=0;
            g=$(this);
            $(this).each(function(){
                var price;
                var stw=g.find(".st_bag_weight").val();
                var per_kg_rate=g.find(".per_kg_w").val();
                var per_bag_rate=g.find(".per_bag_rate").val();
                qty=g.find(".qty").val();
                if(stw==0 || stw==''){
                    g.find(".per_kg_w").attr('readonly','readonly');
                    g.find(".per_bag_rate").attr('readonly', 'readonly');
                    price=g.find(".price").val();
                    g.find(".total").val(price*qty);
                }else{
                    g.find(".per_kg_w").removeAttr('readonly');
                    g.find(".per_bag_rate").removeAttr('readonly');
                    g.find(".total_bag").val(Number(qty)/Number(stw));
                }
                if(per_kg_rate>0){
                    per_bag_rate=g.find(".per_bag_rate").val(Number(per_kg_rate)*Number(stw));
                    price=g.find(".price").val((Number(per_kg_rate)*Number(stw)).toFixed(5));
                    total=Number(per_kg_rate)*Number(qty)*Number(stw);
                    g.find(".total").val((Number(total)).toFixed(5));
                }
                if(per_bag_rate>0){
                    per_kg_rate=g.find(".per_kg_w").val(Number(per_bag_rate)/Number(stw));
                    price=g.find(".price").val(Number(per_bag_rate));
                    total=Number(per_bag_rate)*Number(qty);
                    g.find(".total").val((Number(total)).toFixed(5));
                }
            });
            st();
        });
        function st()
        {
            var sum=0;
            $(".total").each(function(){
                sum+=Number($(this).val());
            });
            $("#net_amount").val((sum).toFixed(5));
        }
        $(document).on('click','.remove',function() {
            $(this).parent().closest(".row-rem").remove();
            var sum=0;
            $(".total").each(function(){
                sum += +$(this).val();
            });
            $("#net_amount").val(sum);
        });
        function get_next_date(days) {
            od=$(".order_date").val();
            var myDate=new Date(od);
            myDate.setDate(myDate.getDate()+Number(days));
            // format a date
            var dt =myDate.getFullYear()+'-'+ ("0" + (myDate.getMonth() + 1)).slice(-2)+'-'+("0" + (myDate.getDate())).slice(-2);
            $(".delivery_date").val(dt);

        }
        function get_delivery_date(days) {
            od=$(".delivery_date").val();
            var myDate=new Date(od);
            myDate.setDate(myDate.getDate()+Number(days));
            // format a date
            var dt = ("0" + (myDate.getMonth() + 1)).slice(-2)+'-'+("0" + (myDate.getDate())).slice(-2) + '-' + myDate.getFullYear();
            $(".after_delivery").val(dt);

        }
        $(document).on('change','.supplier',function() {
            id=$(this).val();
            $.ajax({
                url:"{{ url('') }}/"+id,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type:"GET",
                dataType:"JSON",
                success:function (data) {
                    $("#contact_person").val(data.S_Contact_Person);
                }
            })
        });
        $(document).on('change','.branch',function() {
            id=$(this).val();
            $.ajax({
                url:"{{ url('') }}/"+id+"",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type:"GET",
                dataType:"JSON",
                success:function (data) {
                    $("#branch").val(data.BR_Address1);
                }
            })
        });
        $(".received_amount").on("keyup",function () {
            let paying_amount=$(".paying_amount").val();
            $(".balance").val(Number(paying_amount)-Number($(this).val()));
        });
    </script>
    <script type="text/javascript">
        $('#printDiv').on('click', function(event) {
            window.print();
        });
    </script>
    <script src="{{ URL::asset('public/export_excel/jquery.table2excel.js') }}"></script>
    <script>
        $(function() {
            $(".exportToExcel").click(function(e){
                //$(".excel-heading").show();
                var table = $('.table2excel');
                if(table && table.length){
                    var preserveColors = (table.hasClass('table2excel_with_colors') ? true : false);
                    $('.table2excel').table2excel({
                        exclude: ".noExl",
                        name: "Excel Document Name",
                        filename: "sale" + new Date().toISOString().replace(/[\-\:\.]/g, "") + ".xls",
                        fileext: ".xls",
                        exclude_img: true,
                        exclude_links: true,
                        exclude_inputs: true,
                        preserveColors: true,
                    });
                }
            });

        });
    </script>
@endsection
