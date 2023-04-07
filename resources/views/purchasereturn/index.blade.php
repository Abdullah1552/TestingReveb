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
                        <li class="breadcrumb-item">Purchase Return</li>
                        <li class="breadcrumb-item active">Purchase Return List </li>
                    </ol>
                </div>
            </div>
            <!-- End start -->
            <div class="row">
                <!-- Form Control starts -->
                <div class="col-md-12">
                    <div class="card">
                        <br>
                        <form id="form">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Supplier</label>
                                    <select name="SUPID" class="form-control js-example-basic-single">
                                        <option value="">Select Supplier</option>
                                        {!! \App\Models\Supplier::dropdown() !!}
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="form-group">
                                    <label>PR#</label>
                                    <input name="sr" class="form-control" placeholder="Enter PR#">
                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="form-group">
                                    <label>Date From</label>
                                    <input name="df" class="form-control date" value="" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="form-group">
                                    <label>Date To</label>
                                    <input name="dt" class="form-control date" value="" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="form-group">
                                    <label style="visibility: hidden">afafffsfafas</label>
                                    <button type="button" onclick="get_data(1)" class="btn btn-info"><i class="fa fa-search"></i> </button>
                                </div>
                            </div>
                        </form>
                        <div class="card-block">
                            @can('purchase_return_view')
                                <button type="button" onclick="add_new()" class="btn btn-mini btn-primary pull-right">Add New</button>
                            @endcan
                            <div class="col-sm-12 table-responsive pad0">
                                <table class="table ">
                                    <tr style="background-color: #eeeeee">
                                        <th scope="col"><input type="checkbox" /></th>
                                        <th>#</th>
                                        <th>Date</th>
                                        <th>PR#</th>
                                        <th>Location</th>
                                        <th>Supplier</th>
                                        <th>Quantity</th>
                                        <th>Amount</th>
                                        <th>Action</th>
                                    </tr>
                                    <tbody id="get_data">
                                    </tbody>
                                </table>
                                <div class="pagination-panel pull-right"></div>

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
    @include('purchasereturn.modal');
    <script>
        $('#purchase-form').on('keyup keypress', function(e) {
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
            let productQty = Number($(this).val());
            // 10 is tax add
            let total = (Number(productCost) * Number(productQty));

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
            let shippingCost = parseInt($('#order_shipping_input').val());
            if(isNaN(orderDiscount)){
                orderDiscountDecimal=0;
            }else{
                let orderDiscountDecimal = orderDiscount.toFixed(2);
                $('#order_discount').html(orderDiscountDecimal)
            }
            if(isNaN(shippingCost)){
                shippingCost=0;
            }else{
                shippingCost=parseFloat(shippingCost).toFixed(2);
            }
            let sum =  calculate();
            let discountedSubTotal = (sum + parseInt(shippingCost)) - orderDiscount;
            $("#grand_total").text(discountedSubTotal);
            $("#net-total").val(discountedSubTotal);
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

                            let subTotal = (data[0].product_cost *  1);
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
                                '<td class="product-cost"><input type="hidden" name="Unit_cost[]" value="'+data[0].product_cost+'">'+data[0].product_cost+'</td>'+
                                '<td id="" >0.00</td>'+
                                '<td class="tax-amount" >0.00</th>'+
                                '<td class="sub-total">' +
                                '<input type="hidden" name="sub_total[]" value="'+subTotal+'"><span>'+subTotal+'</span></td>'+
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
            $("#purchase-return").modal();
            $("#Purchaeorder-form input[name~='id']").val(0);
            document.getElementById("purchase-form").reset();
            $(".first-row").show();
            $(".more-item").html('');
            $("#myTable").find("tr:gt(0):not(:last)").remove();
            // $(".js-example-basic-single").select2("val", "");
            $(".js-example-basic-single").val("").trigger('change');
        }
        $('#purchase-form').submit(function(e) {
            e.preventDefault();
            $('.loader-bg').show();
            var formData = new FormData(this);
            $.ajax({
                url:"{{ route('purchase_return.store') }}",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type:"POST",
                dataType:"JSON",
                contentType: false,
                cache: false,
                processData: false,
                data:formData,
                success:function (data) {
                    $("#Purchaeorder-form input[name~='id']").val(0);
                    toastr.success('Operation successfull.');
                    document.getElementById("purchase-form").reset();
                    $('.rows').remove();
                    $('#item-count').text('0(0)');
                    $('#subtotal').text(0);
                    $('#grand_total').text(0);

                    $('.loader-bg').hide();
                    $("#purchase-return").modal('hide');
                    get_data();
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
        });
        $(document).ready(function () {
            get_data();
        });
        function get_data(page){
            let Total_qty=0;
            let Total_amount=0;
            $.ajax({
                url:'{{url('returns/get_purchase_return')}}',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type:"POST",
                data:$("#form").serialize(),
                dataType:"JSON",
                success:function (data) {
                    htmlData='';
                    for(i in data.data){
                        htmlData+='<tr id="'+data.data[i].id+'">';
                        htmlData+='<td><input type="checkbox"></td>';
                        htmlData+='<td>'+(Number(i)+1)+'</td>';
                        htmlData+='<td>'+data.data[i].date+'</td>';
                        htmlData+='<td>'+data.data[i].pr+'</td>';
                        htmlData+='<td>'+data.data[i].location.WH_Name+'</td>';
                        htmlData+='<td>'+data.data[i].supplier.name+'</td>';
                        htmlData+='<td>'+data.data[i].total_QTY+'</td>';
                        htmlData+='<td>'+data.data[i].net_total+'</td>';
                        htmlData+='<td>';
                        @can('purchase_return_edit')
                            htmlData+='<a class="btn btn-mini btn-primary" href="javascript:void(0)" onclick="edit('+data.data[i].id+')"><i class="fa fa-edit"></i></a>';
                        @endcan
                                @can('purchase_return_delete')
                            htmlData+=' <button type="button" onclick="del_rec(\''+data.data[i].id+'\', \'{{ url('/returns/purchase_return/') }}/'+data.data[i].id+'\')" class="btn btn-mini btn-danger"><i class="fa fa-trash-o"></i> </button>';
                        @endcan
                            htmlData+=' <a href="{{ url('returns/purchase_return_print') }}/'+data.data[i].id+'" target="_blank"  class="btn btn-mini btn-info"><i class="fa fa-print"></i> </a>';
                        htmlData+='</td>';
                        htmlData+='</tr>';
                        Total_qty=Total_qty + Number(data.data[i].total_QTY);
                        Total_amount=Total_amount + Number(data.data[i].net_total);

                    }
                    htmlData+='<tr class="">'+
                        '<td colspan="6" style="padding:3px;text-align: right;font-weight: bolder;">Total:</td>'+
                        '<td style="padding:3px;text-align: left;font-weight: bolder;"><b>'+Total_qty+'</b></td>'+
                        '<td style="padding:3px;text-align: left;font-weight: bolder;"><b>'+Total_amount+'</b></td>'+
                        '</tr>';
                    $("#get_data").html(htmlData);
                    pagination(data.total, data.per_page, data.current_page, data.to ,get_data);
                }
            })
        }
        function edit(id) {
            $("#myTable").find("tr:gt(0):not(:last)").remove();

            $('.loader-bg').show();
            $(".first-row").hide();
            $("#purchase-return").modal();
            $.ajax({
                url:"{{ url('returns/purchase_return') }}/"+id+"/edit",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success:function (data) {
//                    $("").append(data.html);
                    $('#myTable tr:last').before(data[1]);
                    $(".js-example-basic-single").select2();
                    $("#purchase-form input[name~='id']").val(data[0].id);
                    $("#purchase-form input[name~='date']").val(data[0].date);
                    $("#purchase-form select[name~='SUPID']").val(data[0].SUPID);
                    $("#purchase-form select[name~='WHID']").val(data[0].WHID);
                    $("#purchase-form input[name~='discount']").val(data[0].discount);
                    $("#total").text(parseFloat(data[0].net_total)+parseFloat(data[0].discount));
                    $("#grand_total").text(data[0].net_total);
                    $("#net-total").val(data[0].net_total);
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
    </script>
@endsection
