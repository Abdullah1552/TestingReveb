@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="container-fluid ">
            <!-- Header start -->
            <div class="row">
                <div class="main-header" style="margin-top: 0px;">
                    <h4>Print Barcode</h4>
                    <ol class="breadcrumb breadcrumb-title breadcrumb-arrow">
                        <li class="breadcrumb-item"><a href="../index"><i class="icofont icofont-home"></i></a> </li>
                        <li class="breadcrumb-item"><a href="#">Product</a> </li>
                        <li class="breadcrumb-item active">Print Barcode</li>
                    </ol>
                </div>
            </div>
            <!-- End start -->
            <div class="row ">
                <div class="col-md-12">
                    <div class="card-block card">
                        <div class="panel panel-default">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="col-md-12">
                                        <label>Add Product</label>
                                        <div class="input-group">
                                            <span class="input-group-addon" id="alighaddon1"><i class="fa fa-barcode"></i> </span>
                                            <input  class="form-control" list="product" name="" id="product_id" placeholder="Please type product code and select" autocomplete="off">
                                            <datalist id="product">
                                                {!! App\Models\Product::dropdown() !!}
                                            </datalist>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--row-->
                            <div class="row">
                                <div class="col-md-12" >
                                    <table id="myTable" class="table">
                                        <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Code</th>
                                            <th>Quantity</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody class="tfoot" >


                                        </tbody>
                                    </table>
                                    <div class="form-group col-md-2">
                                        <label><input class="name" id="p-name" name="permission[]" type="checkbox" value="1" style="background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);">
                                            Product Name</label>
                                    </div>
                                    <!--col-->
                                    <div class="form-group col-md-2">
                                        <label><input id="category" class="name" name="permission[]" type="checkbox" value="1" style="background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);">
                                            Product Category</label>
                                    </div>
                                    <!--col-->
                                    <div class="form-group col-md-1">
                                        <label><input class="name" id="p-price" name="permission[]" type="checkbox" value="1" style="background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);">
                                            Price</label>

                                    </div>
                                    <div class="form-group col-md-2">
                                        <label><input id="p-brand" class="name" name="permission[]" type="checkbox" value="1" style="background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);">
                                            Brand</label>
                                    </div>
                                    <!--col-->
                                </div>
                                <div class="col-md-12">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Paper Width (MM)*</label><br>
                                            <input type="text" class="form-control" id="width-val" name="size" value="50">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Paper Height(pixel) *</label><br>
                                            <input type="text" class="form-control" id="height-val" value="30">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--row-->
                            <br>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <button class="btn btn-success pull-right" onclick="add_new()">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--panel-default-->
                </div>
                <!--col-->
            </div>
        </div>
        @include('barcode.modal');
        <script type="text/javascript" src="jquery-barcode.js"></script>
        <script>
            $("#print-btn").on("click", function() {
                var divToPrint=document.getElementById('printarea');
                var newWin=window.open('','Print-Window');
                newWin.document.open();
                newWin.document.write('<style type="text/css">@media  print { @page  {  size: 50mm 30mm; margin: 10 !important; margin;0 auto; } th,td, span{text-align: center !important;}, }</style><body onload="window.print()">'+divToPrint.innerHTML+'</body>');
                newWin.document.close();
                setTimeout(function(){newWin.close();},10);
            });
            function appendData(qty, htmlElement)
            {
                $('#myTable tr:last').after(htmlElement);

            }
            $("#myTable").on('click', '.trash', function () {
                $(this).closest('tr').remove();
            });
            function add_new() {

                $('#barcode tbody').html('');
                $(".quantity").each(function(){
                    let productCost = $(this).closest('tr').find('td.product-cost').find('input').val();
                    let PID = $(this).closest('tr').find('td.product-cost').find('.product-id').val();
                    let productCode = $(this).closest('tr').find('td.code').text()
                    let productName = $(this).closest('tr').find('td.product-cost').text();
                    let brand = $(this).closest('tr').find('td.product-cost').find('.brand').val();
                    let category = $(this).closest('tr').find('td.product-cost').find('.category').val();
                    let productQuantity = $(this).val()
                    var inputVal = $('#width-val').val();
                    var hght = $('#height-val').val();
                    for(let i = 1; i <=  productQuantity; i++)
                    {
                        printBarcode(productCost, productCode, productName, inputVal,brand,hght,PID,category)
                        break;
                    }
                });
                $("#new-sub_head").modal();
            }

            function printBarcode(productCost, productCode, productName, width,brand,hght,PID,category){
                //get random key genrate
                    $.ajax({
                        url:"{{ url('generate_product_code') }}",
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        type:"GET",
                        data:{code:productCode,price:productCost, name:productName, 'brand':brand, 'PID':PID, 'category':category},
                        dataType:"JSON",
                        success:function (data) {
                            $('#barcode tbody').append(data);
                            if($('#p-name').is(":checked"))
                            {
                                $('.productName').show()
                            }
                            if($('#p-price').is(":checked"))
                            {
                                $('.productCost').show()
                            }
                            if($('#p-brand').is(":checked"))
                            {
                                $('.brand_name').show()
                            }
                            if($('#category').is(":checked"))
                            {
                                $('.category').show()
                            }
                            // $('.barcode-selecter').attr('style', 'width: '+width+'px !important');
                            $('.barcode-selecter').attr('style', 'width: '+width+'mm !important');
                            $('.barcode-selecter').attr('style', 'height: '+hght+'px !important');
                        }
                    });

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
                                var pCode = data[0].product_code
                                if(data[0].is_variant==1)
                                {
                                    var varient_code = data[0].item_code;
                                    pCode =  varient_code;
                                }else{
                                    var varient_code = data[0].product_code;
                                    pCode =  varient_code
                                }
                                if(data[0].is_variant==1){
                                    product_price=Number(data[0].product_price)+Number(data[0].additonal_price);
                                }else{
                                    product_price=Number(data[0].product_price);
                                }
                                let htmlElement = '<tr class="rows"> ' +
                                    '<td class="product-cost" >'+data[0].name+' <input type="hidden"  value="'+product_price+'">' +
                                    '<input class="brand" type="hidden" name="brand[]" value="'+data[0].brand_name+'"> ' +
                                    '<input class="category" type="hidden" name="category[]" value="'+data[0].category_name+'"> ' +
                                    '<input type="hidden" class="product-id"  value="'+data[0].PID+'">'+
                                    '</td>'+
                                    '<td class="product-code code" >'+pCode+'</td>'+
                                    '<td id="" ><input type="number" min="1" class="quantity" name="qty[]" value="1"></td>'+
                                    '<td><i class="fa fa-trash trash" style="border: none"></i></td>'+
                                    '</tr>';

                                $('#product_id').val('')

                                let pro_code = $('.product-code').text();

                                if(pro_code !== '')
                                {
                                    var isProUpdated = 0;
                                    $(".product-code").each(function(){
                                        let currentProductCode = $(this).text();
                                        console.log(currentProductCode, $.trim(data[0].item_code));
                                        if (parseInt(currentProductCode) === parseInt(data[0].product_code) || $.trim(currentProductCode) === $.trim(data[0].item_code))
                                        {
                                            isProUpdated = 1;
                                            alert('duplicate input is not allowed!')

                                        }


                                    });
                                    if(isProUpdated === 0 ){
                                        // alert('man')
                                        isProUpdated = 1;
                                        appendData(data.alert_qty, htmlElement)
                                    }
                                }
                                else{
                                    appendData(1, htmlElement)

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
        </script>
@endsection
