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
            .page-title, #search-form, .main-header .panel-heading, hr{
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

                <div class="main-header" style="margin-top: 0px;">
                    <h5>Adjustments</h5>

                    <ol class="breadcrumb breadcrumb-title breadcrumb-arrow">

                        <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="icofont icofont-home"></i></a> </li>

                        <li class="breadcrumb-item">Adjustments</li>

                        <li class="breadcrumb-item active">Adjustment List </li>

                    </ol>

                </div>

            </div>

            <!-- End start -->

            <div class="row">

                <!-- Form Control starts -->

                <div class="col-md-12">

                    <div class="card">

                        <form id="form">
                            <div id="search-form">
                            <div class="col-md-2">

                                <div class="form-group">

                                    <label>Date From</label>

                                    <input name="df" class="form-control date" value="" autocomplete="off">

                                </div>

                            </div>

                            <div class="col-md-2">

                                <div class="form-group">

                                    <label>Date To</label>

                                    <input name="dt" class="form-control date" value="" autocomplete="off">

                                </div>

                            </div>

                            <div class="col-md-2">

                                <div class="form-group">

                                    <label>Reference </label>

                                    <input type="text" name="reference" class="form-control " placeholder="Reference">

                                </div>

                            </div>
                            <div class="col-md-2">

                                <div class="form-group">

                                    <label>Select Location</label>

                                    <select name="wherehouse_id" class="form-control ">

                                        <option value="0">Select</option>

                                        {!! App\Models\WhereHouse::dropdown() !!}

                                    </select>

                                </div>

                            </div>
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

                            <div></div>
                            </div>
                        </form>

                            <!-- Form Control ends -->

                            <!-- Form Control starts -->



                            <div class="row">

                                <!-- Form Control starts -->

                                <div class="col-md-12">

                                    <div class="card">

                                            <form id="adjustment-data">

                                            <div class="card-block">
                                                    <div class="btn-group pull-right no-report">
                                                        @can('adjustment_create')
                                                            <button type="button" onclick="add_new()" class="btn btn-mini btn-primary pull-right">Add New</button>
                                                        @endcan
                                                        <button type="button" class="btn btn-mini btn-success exportToExcel"><i class="fa fa fa-file-excel-o"></i> </button>
                                                        <button type="button" class="btn btn-mini btn-info" id="printDiv"><i class="fa fa fa-print"></i> </button>
                                                    </div>

                                                <div class="col-sm-12 table-responsive pad0">
                                                    {!! \App\Helpers\helpers::a_four_header() !!}
                                                    <h4 class="print-header" align="center" style="display:none;margin-bottom: 0px;margin-top: 5px;font-size: 14px;">Adjustments Report</h4>

                                                    <table class="table table2excel">

                                                        <tr style="background-color: #eeeeee">

                                                            <th scope="col" class="no-report"><input type="checkbox" id="select_all"  /></th>

                                                            <th>Sr#</th>

                                                            <th>Date</th>

                                                            <th>Reference</th>

                                                            <th>Location</th>
                                                            <th>Descriptions</th>
                                                            <th>Quantity</th>

{{--                                                            <th>Note</th>--}}

                                                            <th class="no-report">Action</th>

                                                        </tr>

                                                        <tbody id="get_data"></tbody>
                                                        <tr>
                                                            <td colspan="8" class="no-report" align="right"> <button type="button" onclick="del_multiple_rec('adjustment-data','/product/delete_multiple_adjustments')" class="btn btn-mini btn-danger"><i class="fa fa-trash-o"></i> selected</button></td>
                                                        </tr>

                                                    </table>

                                                    <div class="pagination-panel pull-right no-report"></div>



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

                @include('adjustment.modal');

                <script>

                    $('#').on('keyup keypress', function(e) {
                        var keyCode = e.keyCode || e.which;
                        if (keyCode === 13) {
                            e.preventDefault();
                            return false;
                        }
                    });

                    $('#adjustment-form').on('keyup keypress', function(e) {
                        var keyCode = e.keyCode || e.which;
                        if (keyCode === 13) {
                            e.preventDefault();
                            return false;
                        }
                    });
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

                        $('#grand_total').html();

                    });



                    function rowsIndex()

                    {

                        var rowCount = $(".rows").length;

                        return rowCount;

                    }

                    //Change quantity

                    $(document).on('keyup change', '.quantity', function() {



                        let productCost = $(this).closest('tr').find('td.product-cost').find('input').val();

                        let productQty = Number($(this).val());

                        // 10 is tax add

                        let total = (Number(productCost) * Number(productQty)) + 10;



                        $(this).closest('tr').find('td.sub-total span').text(total);

                        $(this).closest('tr').find('td.sub-total input').val(total);

                        //subtotal

                        let sum =  calculate();

                        $('#total').html(sum);

                        //Decreasing from grand total

                        $('#grand_total').html(parseInt(sum));

                        $('#subtotal').text(sum);

                        $('#net-total').val(sum);

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

                    function calculate()

                    {

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

                    }

                    $(document).on('keyup change', '#order_discount_input', function() {

                        let orderDiscount =  parseInt($(this).val());

                        let orderDiscountDecimal = orderDiscount.toFixed(2);

                        let shippingCost = parseInt($('#order_shipping_input').val())

                        if(isNaN(orderDiscount))

                        {

                            let floatValue = 0

                            $('#order_discount').html(floatValue.toFixed(2))



                        }else{

                            $('#order_discount').html(orderDiscountDecimal)

                            //total

                            let sum =  calculate();

                            let discountedSubTotal = (sum + parseInt(shippingCost)) - orderDiscount;

                            $('#grand_total').html(discountedSubTotal);

                            $('#net-total').val(sum);

                            $('#subtotal').text(discountedSubTotal);

                        }

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

                            $('#net-total').val(sum);

                            $('#subtotal').text(discountedSubTotal);

                        }

                    });



                    $('#product_id').on('input', function() {

                        var userText = $(this).val();



                        $("#product").find("option").each(function() {

                            if ($(this).val() == userText || $(this).attr('pc') == userText ) {

                                var prc=$(this).attr('pc');

                                $.ajax({

                                    url:"{{ url('load_productPurchae') }}",

                                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},

                                    type:"POST",

                                    dataType:"JSON",

                                    data:{product_string:prc},

                                    success:function (data) {

                                        let subTotal = (data[0].product_cost *  1) + 10.00

                                        var pCode = data[0].product_code

                                        if(data[0].is_variant==1)

                                        {

                                            var varient_code = data[0].item_code;

                                            pCode =  varient_code;

                                        }else{

                                            var varient_code = data[0].product_code;

                                            pCode =  varient_code

                                        }



                                        let htmlElement = '<tr class="rows"> ' +

                                            '<td colspan="1" ><input type="hidden" name="product_id[]" value="'+data[0].PID+'">'+data[0].name+'</td>'+

                                            '<td class="product-code"> <input type="hidden" name="product_varient[]" value="'+pCode +'">'+pCode+'</td>'+

                                            '<td class="input-qty"><input type="number" min="1" class="quantity" name="qty[]" value="1"></td>'+

                                            '<td class="input-qty"><select name="action_type[]"><option value="1">Plus</option><option value="2">Minus</option> </select></td>'+

                                            '<td><i class="fa fa-trash trash" style="border: none"></i></td>'+

                                            '</tr>';

                                        $('#product_id').val('')

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

                                            //count rows

                                            totalQty =  $('#total-qty').text();

                                            let rowCount = rowsIndex();

                                            $('#item-count').html(rowCount+'('+totalQty+')')



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

                    })



                    function add_new() {

                        $("#new").modal();

                        $("#adjustment-form input[name~='id']").val(0);

                        // document.getElementById("Purchaeorder-form").reset();

                        $(".first-row").show();

                        $(".more-item").html('');

                        $("#myTable").find("tr:gt(0):not(:last)").remove();

                        // $(".js-example-basic-single").select2("val", "");

                        $(".js-example-basic-single").val("").trigger('change');

                    }

                    $('#adjustment-form').submit(function(e) {

                        e.preventDefault();

                        $('.loader-bg').show();

                        var formData = new FormData(this);

                        $.ajax({

                            url:"{{ route('adjustment.store') }}",

                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},

                            type:"POST",

                            dataType:"JSON",

                            contentType: false,

                            cache: false,

                            processData: false,

                            data:formData,

                            success:function (data) {

                                $("#adjustment-form input[name~='id']").val(0);

                                toastr.success('Operation successfull.');

                                document.getElementById("adjustment-form").reset();

                                $('.rows').remove()

                                $('#item-count').text('0(0)')

                                $('#subtotal').text(0)

                                $('#grand_total').text(0);

                                $('.loader-bg').hide();

                                $("#new").modal('hide');

                                get_data();

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

                                    $("#adjustment-form input[name~='" + index + "']").css('border', '1px solid red');

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

                        let Total_qty=0;

                        $.ajax({

                            url:'{{url('product/get_adjustment')}}',

                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},

                            type:"POST",

                            data:$("#form").serialize(),

                            dataType:"JSON",

                            success:function (data) {



                                htmlData='';

                                for(i in data.data){
                                    let date=data.data[i].created_at.split(' ')[0];
                                    let [year, month, day] = date.split('-');
                                    date = [day, month, year].join('-');

                                    htmlData+='<tr id="'+data.data[i].id+'">';

                                    htmlData+='<td class="no-report"><input type="checkbox" class="records" name="records[]" value="'+data.data[i].id+'"></td>';

                                    htmlData+='<td>'+(Number(i)+1)+'</td>';

                                    htmlData+='<td>'+date+'</td>';

                                    htmlData+='<td>'+data.data[i].reference+'</td>';

                                    htmlData+='<td>'+data.data[i].WH_Name+'</td>';

                                    htmlData+='<td>Adjustment - '+data.data[i].id+'</td>';
                                    htmlData+='<td>'+data.data[i].pq+'</td>';

                                    // htmlData+='<td>'+data.data[i].notes+'</td>';

                                    htmlData+='<td class="no-report">';

                                    @can('adjustment_edit')

                                        htmlData+='<a class="btn btn-mini btn-primary" href="javascript:void(0)" onclick="edit('+data.data[i].id+')"><i class="fa fa-edit"></i></a>';

                                    @endcan

                                            @can('adjustment_delete')

                                        htmlData+=' <button type="button" onclick="del_rec(\''+data.data[i].id+'\', \'{{ url('/product/adjustment') }}/'+data.data[i].id+'\')" class="btn btn-mini btn-danger"><i class="fa fa-trash-o"></i> </button>';

                                    @endcan

                                        htmlData+=' <a target="_blank" href="{{ url('product/print_adjustment') }}/'+data.data[i].id+'" class="btn btn-mini btn-default"><i class="fa fa-print"></i> </button>';

                                    htmlData+='</td>';

                                    htmlData+='</tr>';
                                    Total_qty=Total_qty + Number(data.data[i].pq);

                                }

                                htmlData+='<tr class="">'+
                                    '<td class="no-report"></td>'+
                                    '<td colspan="5" style="padding:3px;text-align: right;font-weight: bolder;">Total:</td>'+
                                    '<td style="padding:3px;text-align: left;font-weight: bolder;"><b>'+Total_qty+'</b></td>'+
                                    '</tr>';




                                $("#get_data").html(htmlData);

                                pagination(data.total, data.per_page, data.current_page, data.to ,get_data);

                            }

                        })

                    }

                    function edit(id) {

                        $('.loader-bg').show();

                        $(".first-row").hide();

                        document.getElementById("adjustment-form").reset();
                        $("#myTable").find("tr:gt(0):not(:last)").remove();

                        $("#new").modal();

                        $.ajax({

                            url:"{{ url('product/adjustment') }}/"+id+"/edit",

                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},

                            success:function (data) {

                                $('#myTable tr:last').before(data.product_line);

                                $("#adjustment-form input[name~='id']").val(data.result.id);

                                $("#adjustment-form select[name~='WHID']").val(data.result.WHID);
                                $("#adjustment-form input[name~='reference']").val(data.result.reference);

                                $("#adjustment-form [name~='inovice_details']").val(data.result.notes);

                                $(".js-example-basic-single").select2();

                                $('.loader-bg').hide();

                                st();

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

                </script>

    {{--    <script>--}}

    {{--        function add_new() {--}}

    {{--            $("#purchaseorder").modal();--}}

    {{--            $("#Purchaeorder-form input[name~='id']").val(0);--}}

    {{--            document.getElementById("Purchaeorder-form").reset();--}}

    {{--            $(".first-row").show();--}}

    {{--            $(".more-item").html('');--}}

    {{--        }--}}

    {{--        function save_rec() {--}}

    {{--            $('.loader-bg').show();--}}

    {{--            $.ajax({--}}

    {{--                url:"{{ route('purchase_order.store') }}",--}}

    {{--                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},--}}

    {{--                type:"POST",--}}

    {{--                dataType:"JSON",--}}

    {{--                data:$("#Purchaeorder-form").serialize(),--}}

    {{--                success:function (data) {--}}

    {{--                    $("#Purchaeorder-form input[name~='id']").val(0);--}}

    {{--                    toastr.success('Operation successfull.');--}}

    {{--                    document.getElementById("Purchaeorder-form").reset();--}}

    {{--                    $('.loader-bg').hide();--}}

    {{--                    $("#purchaseorder").modal('hide');--}}

    {{--                    get_data();--}}

    {{--                 }--}}

    {{--                ,error:function(ajaxcontent) {--}}

    {{--                     vali=ajaxcontent.responseJSON.errors;--}}

    {{--                     var errors='';--}}

    {{--                     $.each(vali, function( index, value ) {--}}

    {{--                         $("#Purchaeorder-form input[name~='" + index + "']").css('border', '1px solid red');--}}

    {{--                         toastr.error(value);--}}

    {{--                     });--}}

    {{--                     $('.loader-bg').hide();--}}

    {{--                 }--}}

    {{--            })--}}

    {{--        }--}}

    {{--        $(document).ready(function () {--}}

    {{--            get_data();--}}

    {{--        });--}}

    {{--        function get_data(page){--}}

    {{--            $.ajax({--}}

    {{--                url:"{{ url('get_purchaseorder') }}?page="+page,--}}

    {{--                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},--}}

    {{--                type:"POST",--}}

    {{--                dataType:"JSON",--}}

    {{--                success:function (data) {--}}

    {{--                    //console.log(data.data[1].employee.EMP_Name);--}}

    {{--                    htmlData='';--}}

    {{--                    for(i in data.data){--}}

    {{--                        htmlData+='<tr id="'+data.data[i].id+'">';--}}

    {{--                        htmlData+='<td>'+(Number(i)+1)+'</td>';--}}

    {{--                        htmlData+='<td>'+data.data[i].supplier.S_Name+'</td>';--}}

    {{--                        htmlData+='<td>'+data.data[i].Delivery_Via+'</td>';--}}

    {{--                        htmlData+='<td>'+data.data[i].employee.EMP_Name+'</td>';--}}

    {{--                        htmlData+='<td>'+data.data[i].branch.BR_Name+'</td>';--}}

    {{--                        htmlData+='<td>'+data.data[i].net_total+'</td>';--}}

    {{--                        htmlData+='<td>';--}}

    {{--                        htmlData+='<a class="btn btn-mini btn-primary" href="javascript:void(0)" onclick="edit('+data.data[i].id+')"><i class="fa fa-edit"></i></a>';--}}

    {{--                        htmlData+=' <button type="button" onclick="del_rec(\''+data.data[i].id+'\', \'{{ url('/purchase_order/') }}/'+data.data[i].id+'\')" class="btn btn-mini btn-danger"><i class="fa fa-trash-o"></i> </button>';--}}

    {{--                        htmlData+='</td>';--}}

    {{--                        htmlData+='</tr>';--}}

    {{--                    }--}}

    {{--                    $("#get_data").html(htmlData);--}}

    {{--                    pagination(data.total, data.per_page, data.current_page, data.to ,get_data);--}}

    {{--                }--}}

    {{--            })--}}

    {{--        }--}}

    {{--        function edit(id) {--}}

    {{--            $('.loader-bg').show();--}}

    {{--            $(".first-row").hide();--}}

    {{--            $("#purchaseorder").modal();--}}

    {{--            $.ajax({--}}

    {{--                url:"{{ url('purchase_order') }}/"+id+"/edit",--}}

    {{--                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},--}}

    {{--                success:function (data) {--}}

    {{--                    $("#Purchaeorder-form input[name~='id']").val(data[0].id);--}}

    {{--                    $("#Purchaeorder-form select[name~='SUPID']").val(data[0].SUPID);--}}

    {{--                    $("#Purchaeorder-form input[name~='Contact_Person']").val(data[0].Contact_Person);--}}

    {{--                    $("#Purchaeorder-form select[name~='BID']").val(data[0].BID);--}}

    {{--                    $("#Purchaeorder-form select[name~='lab']").val(data[0].lab);--}}

    {{--                    $("#Purchaeorder-form select[name~='EMPID']").val(data[0].EMPID);--}}

    {{--                    $("#Purchaeorder-form select[name~='Payment_Term']").val(data[0].Payment_Term);--}}

    {{--                    $("#Purchaeorder-form input[name~='Delivery_Via']").val(data[0].Delivery_Via);--}}

    {{--                    $("#Purchaeorder-form input[name~='Delivery_address']").val(data[0].Delivery_address);--}}

    {{--                    $("#Purchaeorder-form input[name~='Delivery_days']").val(data[0].Delivery_days);--}}

    {{--                    $("#Purchaeorder-form input[name~='Delivery_date']").val(data[0].Delivery_date);--}}

    {{--                    $(".more-item").html(data[1]);--}}

    {{--                    $(".js-example-basic-single").select2();--}}



    {{--                    //$("#SUPID option[value='"+data.SUPID+"']").attr("selected", true);--}}

    {{--                    //$("#Purchaeorder-form input[name~='CT_Name']").val(data.CT_Name);--}}

    {{--                    $('.loader-bg').hide();--}}

    {{--                    st();--}}

    {{--                }--}}

    {{--            })--}}

    {{--        }--}}

    {{--        function more_item() {--}}

    {{--            $(".more-item").append('<div class="row-rem parentRemove"> <div class="clearfix"></div> ' +--}}

    {{--                '<div class="form-group col-md-2 pf">' +--}}

    {{--                '<select class="js-example-basic-single form-control form-control-sm" name="item_id[]">' +--}}

    {{--                '<option value="">Select Item</option>{!! App\Models\Item::itemList() !!}</select>' +--}}

    {{--                '</div>' +--}}

    {{--                '<div class="form-group col-md-1 pf">'+--}}

    {{--                '<select class="js-example-basic-single form-control form-control-sm" name="unit[]">' +--}}

    {{--                    '<option value="0">Select</option>{!! App\Models\UnitType::unitTypeList() !!}'+--}}

    {{--                '</select>'+--}}

    {{--                '</div>' +--}}

    {{--                '<div class="form-group col-md-1 pf" style="width: 12% !important;">'+--}}

    {{--                    '<input type="text" class="form-control form-control-sm st_bag_weight" id="quantity" name="bag_weight[]" placeholder="Standard Bag Weight" required="required">'+--}}

    {{--                '</div>'+--}}

    {{--                '<div class="form-group col-md-1 pf" style="width:6% !important">' +--}}

    {{--                '<input type="text" class="form-control form-control-sm qty" id="" name="quantity[]" placeholder="Qty">' +--}}

    {{--                '</div>' +--}}

    {{--                '<div class="form-group col-md-1 pf" style="width:8% !important" style="width:8% !important">'+--}}

    {{--                '<input type="text" class="form-control form-control-sm total_bag" id="quantity" name="total_bag[]" required="required" placeholder="Total Bag">'+--}}

    {{--                '</div>'+--}}

    {{--                '<div class="form-group col-md-1 pf" style="width:8% !important">'+--}}

    {{--                '<input type="text" class="form-control form-control-sm per_bag_rate" id="quantity" name="per_bag_rate[]" placeholder="Per Kg Rate" required="required">'+--}}

    {{--                '</div>'+--}}

    {{--                '<div class="form-group col-md-1 pf" style="width:8% !important">'+--}}

    {{--                '<input type="text" class="form-control form-control-sm per_kg_w" id="quantity" name="per_kg_rate[]" placeholder="Per Kg Rate" required="required">'+--}}

    {{--                '</div>'+--}}

    {{--                '<div class="form-group col-md-1 pf">' +--}}

    {{--                '<input type="text" class="form-control form-control-sm price" id="" name="unit_price[]" placeholder="Rate">' +--}}

    {{--                '</div>' +--}}

    {{--                '<div class="form-group col-md-1 pf">' +--}}

    {{--                '<input type="text" class="form-control form-control-sm total" id="" name="amount[]" placeholder="Amount">' +--}}

    {{--                '</div>' +--}}

    {{--                '<div class="form-group col-md-1 pf" style="width: 5% !important;">' +--}}

    {{--                '<button type="button" class="btn btn-mini btn-danger remove" name=""><i class="fa fa-trash"></i> </button>' +--}}

    {{--                '</div><div class="clearfix"></div></div>');--}}

    {{--            $(".js-example-basic-single").select2();--}}

    {{--        }--}}

    {{--        $(document).on('change','.parentRemove',function() {--}}

    {{--            var sum=0;--}}

    {{--            g=$(this);--}}

    {{--            $(this).each(function(){--}}

    {{--                var price;--}}

    {{--                var stw=g.find(".st_bag_weight").val();--}}

    {{--                var per_kg_rate=g.find(".per_kg_w").val();--}}

    {{--                var per_bag_rate=g.find(".per_bag_rate").val();--}}

    {{--                qty=g.find(".qty").val();--}}

    {{--                if(stw==0 || stw==''){--}}

    {{--                    g.find(".per_kg_w").attr('readonly','readonly');--}}

    {{--                    g.find(".per_bag_rate").attr('readonly', 'readonly');--}}

    {{--                    price=g.find(".price").val();--}}

    {{--                    g.find(".total").val(price*qty);--}}

    {{--                }else{--}}

    {{--                    g.find(".per_kg_w").removeAttr('readonly');--}}

    {{--                    g.find(".per_bag_rate").removeAttr('readonly');--}}

    {{--                    g.find(".total_bag").val(Number(qty)/Number(stw));--}}

    {{--                }--}}

    {{--                if(per_kg_rate>0){--}}

    {{--                    per_bag_rate=g.find(".per_bag_rate").val(Number(per_kg_rate)*Number(stw));--}}

    {{--                    price=g.find(".price").val((Number(per_kg_rate)*Number(stw)).toFixed(5));--}}

    {{--                    total=Number(per_kg_rate)*Number(qty)*Number(stw);--}}

    {{--                    g.find(".total").val((Number(total)).toFixed(5));--}}

    {{--                }--}}

    {{--                if(per_bag_rate>0){--}}

    {{--                    per_kg_rate=g.find(".per_kg_w").val(Number(per_bag_rate)/Number(stw));--}}

    {{--                    price=g.find(".price").val(Number(per_bag_rate));--}}

    {{--                    total=Number(per_bag_rate)*Number(qty);--}}

    {{--                    g.find(".total").val((Number(total)).toFixed(5));--}}

    {{--                }--}}

    {{--            });--}}

    {{--            st();--}}

    {{--        });--}}

    {{--        function st()--}}

    {{--        {--}}

    {{--            var sum=0;--}}

    {{--            $(".total").each(function(){--}}

    {{--                sum+=Number($(this).val());--}}

    {{--            });--}}

    {{--            $("#net_amount").val((sum).toFixed(5));--}}

    {{--        }--}}

    {{--        $(document).on('click','.remove',function() {--}}

    {{--            $(this).parent().closest(".row-rem").remove();--}}

    {{--            var sum=0;--}}

    {{--            $(".total").each(function(){--}}

    {{--                sum += +$(this).val();--}}

    {{--            });--}}

    {{--            $("#net_amount").val(sum);--}}

    {{--        });--}}

    {{--        function get_next_date(days) {--}}

    {{--            od=$(".order_date").val();--}}

    {{--            var myDate=new Date(od);--}}

    {{--            myDate.setDate(myDate.getDate()+Number(days));--}}

    {{--            // format a date--}}

    {{--            var dt =myDate.getFullYear()+'-'+ ("0" + (myDate.getMonth() + 1)).slice(-2)+'-'+("0" + (myDate.getDate())).slice(-2);--}}

    {{--            $(".delivery_date").val(dt);--}}



    {{--        }--}}

    {{--        function get_delivery_date(days) {--}}

    {{--            od=$(".delivery_date").val();--}}

    {{--            var myDate=new Date(od);--}}

    {{--            myDate.setDate(myDate.getDate()+Number(days));--}}

    {{--            // format a date--}}

    {{--            var dt = ("0" + (myDate.getMonth() + 1)).slice(-2)+'-'+("0" + (myDate.getDate())).slice(-2) + '-' + myDate.getFullYear();--}}

    {{--            $(".after_delivery").val(dt);--}}



    {{--        }--}}

    {{--        $(document).on('change','.supplier',function() {--}}

    {{--            id=$(this).val();--}}

    {{--            $.ajax({--}}

    {{--                url:"{{ url('fetch_supplier_det') }}/"+id,--}}

    {{--                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},--}}

    {{--                type:"GET",--}}

    {{--                dataType:"JSON",--}}

    {{--                success:function (data) {--}}

    {{--                    $("#contact_person").val(data.S_Contact_Person);--}}

    {{--                }--}}

    {{--            })--}}

    {{--        });--}}

    {{--        $(document).on('change','.branch',function() {--}}

    {{--            id=$(this).val();--}}

    {{--            $.ajax({--}}

    {{--                url:"{{ url('branches') }}/"+id+"",--}}

    {{--                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},--}}

    {{--                type:"GET",--}}

    {{--                dataType:"JSON",--}}

    {{--                success:function (data) {--}}

    {{--                    $("#branch").val(data.BR_Address1);--}}

    {{--                }--}}

    {{--            })--}}

    {{--        });--}}

    {{--    </script>--}}
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
                                    filename: "opening_inventory" + new Date().toISOString().replace(/[\-\:\.]/g, "") + ".xls",
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

