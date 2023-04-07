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
                <div class="main-header" style="margin-top: 0px;">
                    <h5>Opening Inventory</h5>
                    <ol class="breadcrumb breadcrumb-title breadcrumb-arrow">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="icofont icofont-home"></i></a> </li>
                        <li class="breadcrumb-item">Inventory </li>
                        <li class="breadcrumb-item active">Opening Inventory </li>
                    </ol>
                </div>
            </div>
            <!-- End start -->
            <div class="row">
                <!-- Form Control starts -->
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header no-report">
                            <form id="form">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Date From</label>
                                        <input type="text" name="df" class="form-control date" autocomplete="off">
                                    </div>
                                </div>
                                <!--col-->
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Date To</label>
                                        <input type="text" name="dt" class="form-control date" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label> Description</label>
                                        <input name="pn" class="form-control " placeholder="Search With Inventory Description"   id="search">
                                    </div>
                                </div>
                                <!--col-->
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Select Location</label>
                                        <select name="WHID" class="form-control js-example-basic-single">
                                            <option value="0">Select</option>
                                            {!! \App\Models\WhereHouse::dropdown() !!}
                                        </select>
                                    </div>
                                </div>
                                <!--col-->
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
                            </form>
                        </div>
                        <div class="card-block">
                            <div class="btn-group pull-right no-report">
                                <button type="button" onclick="add_new()" class="btn btn-mini btn-primary pull-right">Add New</button>
                                <button type="button" class="btn btn-mini btn-success exportToExcel"><i class="fa fa fa-file-excel-o"></i> </button>
                                <button type="button" class="btn btn-mini btn-info" id="printDiv"><i class="fa fa fa-print"></i> </button>
                            </div>
                            <form id="o_inventory-data">
                                <div class="col-sm-12 table-responsive">
                                    {!! \App\Helpers\helpers::a_four_header() !!}
                                    <h4 class="print-header" align="center" style="display:none;margin-bottom: 0px;margin-top: 5px;font-size: 14px;">Opening Inventory Report</h4>
                                    <table class="table table-bordered table2excel">
                                        <tr style="background-color: #eeeeee">
                                            <th scope="col" class="no-report"><input type="checkbox" id="select_all" name="records[]"  /></th>
                                            <th>#</th>
                                            <th>Date</th>
                                            <th>Description</th>
                                            <th>Quantity</th>
                                            <th>Location</th>
                                            <th class="no-report">Action</th>
                                        </tr>
                                        <tbody id="get_data"></tbody>
                                        <tr>
                                            <td colspan="8" class="no-report" align="right"> <button type="button" onclick="del_multiple_rec('o_inventory-data','/delete_multiple_opening_inventory')" class="btn btn-mini btn-danger"><i class="fa fa-trash-o"></i> selected</button></td>
                                        </tr>
                                    </table>
                                    <div class="pagination-panel pull-right no-report"></div><br>
                                </div>
                            </form>

                        </div>
                        <!--card-block-->
                    </div>
                    <!--card-->
                </div>
                <!-- Form Control ends -->
            </div>
        </div>
    </div>
    @include('Opening_Inventory.modal');
    <script>
        $('#oinventory-form').on('keyup keypress', function(e) {
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
        });
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
        function rowsIndex()
        {
            var rowCount = $(".rows").length;
            return rowCount;
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
        function reset_totals(){
            $('#total').html('0');
            $('#total-qty').html('0');
            $('#subtotal').html('0');
            $('#grand_total').html("0");
            $('#net-total').val('0');
        }
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
                                /*'<td class="product-cost"><input type="hidden" name="Unit_cost[]" value="'+data[0].product_cost+'">'+data[0].product_cost+'</td>'+
                                '<td class="" >0</td>'+
                                '<td class="tax-amount" >00</td>'+
                                '<td class="sub-total">' +
                                '<input type="hidden" name="sub_total[]" value="'+subTotal+'"><span>'+subTotal+'</span></td>'+*/
                                '<td><i class="fa fa-trash trash" style="border: none"></i></td>'+
                                '</tr>';
                            $('#product_id').val('')
                            let pro_code = $('.product-code').text();
                            // alert(pro_code.replace(/[a-z]-/ig, ""));
                            if(pro_code !== '')
                            {
                                var isProUpdated = 0;
                                reset_totals();
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
            $("#oinventory-form input[name~='WHID']").select2('val', '0');
            $("#oinventory-form input[name~='id']").val(0);
            document.getElementById("oinventory-form").reset();
            $("#myTable").find("tr:gt(0):not(:last)").remove();
            reset_totals();
        }
        function save_rec() {
            $('.loader-bg').show();
            $.ajax({
                url:"{{ route('opening_inventory.store') }}",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type:"POST",
                dataType:"JSON",
                data:$("#oinventory-form").serialize(),
                success:function (data) {
                    $("#country-form input[name~='id']").val(0);
                    toastr.success('Operation successfull.');
                    document.getElementById("oinventory-form").reset();
                    $("#myTable").find("tr:gt(0):not(:last)").remove();
                    $('.loader-bg').hide();
                    $("#new").modal('hide');
                    get_data();
                },error:function(ajaxcontent) {
                   ajaxErrorToastr(ajaxcontent);
                    $('.loader-bg').hide();
                }
            })
        }
        $(document).ready(function () {
            get_data();
        });
        $(document).ready(function() {
    $('#search').on('keyup', function() {
        get_data(1); // Trigger the search function with the first page number
    });
});
        function get_data(page){
            $('.loader-bg').show();
            var searchKeyword = $('#search').val();
            $.ajax({
                url:"{{ url('get_opening_inventory') }}?page="+page,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type:"POST",
                data:{
            "pn": searchKeyword // Pass the search keyword as data
        },
                dataType:"JSON",
                success:function (data) {
                    htmlData='';
                    let tq=0;
                    for(i in data.data){
                        let date=data.data[i].date.split(' ')[0];
                        let [year, month, day] = date.split('-');
                        date = [day, month, year].join('-');
                        tq +=Number(data.data[i].tq);

                        htmlData+='<tr id="'+data.data[i].id+'">';
                        htmlData+='<td class="no-report"><input type="checkbox" class="records" name="records[]" value="'+data.data[i].id+'"></td>';
                        htmlData+='<td>'+(Number(i)+1)+'</td>';
                        htmlData+='<td>'+date+'</td>';
                        htmlData+='<td>Opening Inventory - '+data.data[i].id+'</td>';
                        htmlData+='<td>'+data.data[i].tq+'</td>';
                        htmlData+='<td>'+data.data[i].WH_Name+'</td>';
                        htmlData+='<td class="no-report">';
                        @can('opening_inventory_edit')
                            htmlData+='<a class="btn btn-mini btn-primary" href="javascript:void(0)" onclick="edit('+data.data[i].id+')"><i class="fa fa-edit"></i></a>';
                        @endcan
                                @can('opening_inventory_delete')
                            htmlData+=' <button type="button" onclick="del_rec(\''+data.data[i].id+'\', \'{{ url('/opening_inventory/') }}/'+data.data[i].id+'\')" class="btn btn-mini btn-danger"><i class="fa fa-trash-o"></i> </button>';
                        @endcan
                            htmlData+=' <a class="btn btn-mini btn-default" target="_blank" href="{{ url('print_opening_inventory') }}/'+data.data[i].id+'"><i class="fa fa-print"></i></a>';
                        htmlData+='</td>';
                        htmlData+='</tr>';
                    }
                    htmlData+='<tr>' +
                        '<td class="no-report"></td>';
                        htmlData+='<td colspan="3" align="right">Total:</td>';
                        htmlData+='<td colspan="3">'+tq+'</td>';
                    htmlData+='</tr>';
                    $("#get_data").html(htmlData);
                    pagination(data.total, data.per_page, data.current_page, data.to ,get_data);
                    $('.loader-bg').hide();

                }
            })
        }
        function edit(id) {
            document.getElementById("oinventory-form").reset();
            $("#myTable").find("tr:gt(0):not(:last)").remove();
            reset_totals();
            $('.loader-bg').show();
            $("#new").modal();
            $.ajax({
                url:"{{ url('opening_inventory') }}/"+id+"/edit",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success:function (data) {
                    $('#myTable tr:last').before(data.product_line);
                    $("#oinventory-form input[name~='id']").val(data.result.id);
                    $("#oinventory-form select[name~='WHID']").val(data.result.WHID);
                    let qty=0;
                    let sub_total=0;
                    $(".quantity").each(function () {
                        qty+=Number($(this).val());
                    });
                    $('#total-qty').html(qty);
                    $(".js-example-basic-single").select2();
                    $('.loader-bg').hide();
                    st();

                }
            });
        }
        function more_item() {
            $(".more-item").append('<div class="parentRemove row-rem"><div class="clearfix"></div> ' +
                '<div class="form-group col-md-1 pr5">' +
                '<select class="js-example-basic-single form-control form-control-sm clients select2-hidden-accessible" name="client_id" id="client_id"  tabindex="-1" aria-hidden="true">' +
                '<option value="0">Select Item</option>{!! App\Models\Item::itemList() !!}</select>' +
                '</div>' +
                '<div class="form-group col-md-1 pr5">' +
                '<input type="number" class="form-control form-control-sm" id="" name="" placeholder="Unit">' +
                '</div>' +
                '<div class="form-group col-md-1 pr5">' +
                '<input type="number" class="form-control form-control-sm qty" id="" name="" placeholder="Quantity">' +
                '</div>' +
                '<div class="form-group col-md-1 pr5">'+
                '<input type="number" class="form-control form-control-sm rate" id="" name="" placeholder="Rate">' +
                '</div>' +
                '<div class="form-group col-md-1 pr5">' +
                '<input type="number" class="form-control form-control-sm amount" id="" name="" placeholder="Amount">' +
                '</div>' +
                '<div class="form-group col-md-1 pr5">' +
                '<button type="button" class="btn btn-mini btn-danger remove" name=""><i class="fa fa-trash"></i> </button>' +
                '</div><div class="clearfix"></div></div>');
            $(".js-example-basic-single").select2();
        }
        $(document).on('change','.parentRemove',function() {
            var sum=0;
            g=$(this);
            $(this).each(function(){
                price=g.find(".rate").val();
                qty=$(this).find(".qty").val();
                total=Number(price)*Number(qty);
                g.find(".amount").val((Number(total)).toFixed(2));
            });
            st();
        });
        function st()
        {
            var sum=0;
            $(".amount").each(function(){
                sum+=Number($(this).val());
            });
            $("#total").val((sum).toFixed(2));
        }
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
    <script type="text/javascript">
        $('#printDiv').on('click', function(event) {
            window.print();
        });
    </script>
@endsection
