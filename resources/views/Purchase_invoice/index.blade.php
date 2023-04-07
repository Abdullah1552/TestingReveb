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
                    <h5>Purchase Invoice</h5>
                    <ol class="breadcrumb breadcrumb-title breadcrumb-arrow">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="icofont icofont-home"></i></a> </li>
                        <li class="breadcrumb-item">Purchase Invoice</li>
                        <li class="breadcrumb-item active">Purchse Invoice List </li>
                    </ol>
                </div>
            </div>
            <!-- End start -->
            <div class="row">
                <!-- Form Control starts -->
                <div class="col-md-12">
                    <div class="card">
                        <form id="form">
                            <div class="card-block">
                                <button type="button" onclick="add_new()" class="btn btn-mini btn-primary pull-right">Add New</button>
                                <div class="col-sm-12 table-responsive pad0">
                                    <table class="table table-bordered">
                                        <tr style="background-color: #eeeeee">
                                            <th>Sr#</th>
                                            <th>Date</th>
                                            <th>Supplier</th>
                                            <th>Total Exc Charges</th>
                                            <th>Add Charges</th>
                                            <th>Less Charges</th>
                                            <th>Net Amount</th>
                                            <th>Action</th>
                                        </tr>
                                        <tbody id="get_data"></tbody>
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
    @include('Purchase_invoice.modal');
    <script>
        function add_new() {
            $("#new").modal();
            $("#purchase-form input[name~='id']").val(0);
            document.getElementById("purchase-form").reset();
        }
        function save_rec() {
            $('.loader-bg').show();
            $.ajax({
                url:"{{ route('purchase_invoice.store') }}",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type:"POST",
                dataType:"JSON",
                data:$("#purchase-form").serialize(),
                success:function (data) {
                    $("#purchase-form input[name~='id']").val(0);
                    toastr.success('Operation successfull.');
                    document.getElementById("purchase-form").reset();
                    $('.loader-bg').hide();
                    $("#new").modal('hide');
                    get_data();
                },error:function(ajaxcontent) {
                    vali=ajaxcontent.responseJSON.errors;
                    var errors='';
                    $.each(vali, function( index, value ) {
                        $("#purchase-form input[name~='" + index + "']").css('border', '1px solid red');
                        toastr.error(value);
                    });
                    $('.loader-bg').hide();
                }
            })
        }
        $(document).ready(function () {
            get_data();
        });
        function get_data(page){
            $.ajax({
                url:"{{ url('get_purchase_invoices') }}?page="+page,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type:"POST",
                dataType:"JSON",
                success:function (data) {
                    htmlData='';
                    for(i in data.data){
                        htmlData+='<tr id="'+data.data[i].id+'">';
                        htmlData+='<td>'+(Number(i)+1)+'</td>';
                        htmlData+='<td>'+data.data[i].date+'</td>';
                        htmlData+='<td>'+data.data[i].supplier.S_Name+'</td>';
                        htmlData+='<td>'+data.data[i].Net_Total+'</td>';
                        htmlData+='<td>'+data.data[i].Total_AC+'</td>';
                        htmlData+='<td>'+data.data[i].Total_LC+'</td>';
                        htmlData+='<td>'+data.data[i].Net_Amount+'</td>';
                        htmlData+='<td>';
                        htmlData+='<a class="btn btn-mini btn-primary" href="javascript:void(0)" onclick="edit('+data.data[i].id+')"><i class="fa fa-edit"></i></a>';
                        htmlData+=' <button type="button" onclick="del_rec(\''+data.data[i].id+'\', \'{{ url('/countries/') }}/'+data.data[i].id+'\')" class="btn btn-mini btn-danger"><i class="fa fa-trash-o"></i> </button>';
                        htmlData+='</td>';
                        htmlData+='</tr>';
                    }
                    $("#get_data").html(htmlData);
                    pagination(data.total, data.per_page, data.current_page, data.to ,get_data);
                }
            })
        }
        function edit(id) {
            $('.loader-bg').show();
            $("#new").modal();
            $.ajax({
                url:"{{ url('purchase_invoice') }}/"+id+"/edit",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success:function (data) {
                    $("#purchase-form input[name~='id']").val(data[0].id);
                    $("#purchase-form input[name~='date']").val(data[0].date);
                    $("#purchase-form select[name~='SUPID']").val(data[0].SUPID);
                    $("#purchase-form input[name~='GID']").val(data[0].GID);
                    $("#purchase-form input[name~='BID']").val(data[0].BID);
                    $("#purchase-form input[name~='Vehicle_number']").val(data[0].Vehicle_number);
                    $("#purchase-form input[name~='Delivery_address']").val(data[0].Delivery_address);
                    $("#purchase-form select[name~='Payment_Term']").val(data[0].Payment_Term);
                    $("#purchase-form input[name~='Delivery_Via']").val(data[0].Delivery_Via);
                    $("#purchase-form input[name~='Narration']").val(data[0].Narration);
                    $("#purchase-form input[name~='Net_Total']").val(data[0].Net_Total);
                    $("#purchase-form input[name~='Sale_Tax']").val(data[0].Sale_Tax);
                    $("#purchase-form input[name~='Gross_Amount']").val(data[0].Gross_Amount);
                    $("#purchase-form input[name~='Total_AC']").val(data[0].Total_AC);
                    $("#purchase-form input[name~='Total_LC']").val(data[0].Total_LC);
                    $("#purchase-form input[name~='Net_Amount']").val(data[0].Net_Amount);
                    $("#purchase-form input[name~='Add_cf']").val(data[0].Add_cf);
                    $("#purchase-form input[name~='Add_cs']").val(data[0].Add_cs);
                    $("#purchase-form input[name~='Less_cf']").val(data[0].Less_cf);
                    $("#purchase-form input[name~='Less_cs']").val(data[0].Less_cs);
                    $(".more-item").html(data[1]);
                    $('.loader-bg').hide();
                    $(".js-example-basic-single").select2();
                }
            })
        }
        //fetch items against gate pass number
        function show_gatepass(id) {
            $('.loader-bg').show();
            $("#new").modal();
            $.ajax({
                url:"{{ url('gate_pass') }}/"+id,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success:function (data) {
//                    $("#gatepass-form input[name~='id']").val(data[0].id);
                    $("#purchase-form select[name~='SUPID']").val(data[0].SUPID);
                    $("#purchase-form input[name~='date']").val(data[0].date);
                    $("#purchase-form input[name~='Vehicle_number']").val(data[0].Vehicle_number);
                    $("#purchase-form input[name~='Delivery_address']").val(data[0].Delivery_address);
                    $("#purchase-form select[name~='BID']").val(data[0].BID);
                    $("#purchase-form select[name~='WHID']").val(data[0].WHID);
                    $(".more-item").html(data[1]);
                    $(".js-example-basic-single").select2();
                    $('.loader-bg').hide();
                    st();
                }
            })
        }
        function more_item() {
            $(".card-block").append('<div class="row-rem parentRemove newrow"> <div class="clearfix"></div> ' +
                '<div class="form-group col-md-2 pf">' +
                '<select class="js-example-basic-single form-control form-control-sm" name="">' +
                '<option value="">Select Item</option>{!! App\Models\Item::itemList() !!}</select>' +
                '</div>' +
                '<div class="form-group col-md-1 pf">'+
                '<select class="form-control form-control-sm" name="">' +
                    '<option value="0">Select</option>'+
                '</select>'+
                '</div>' +
                '<div class="form-group col-md-1 pf">' +
                '<input type="text" class="form-control form-control-sm qty" id="qty" name="" placeholder="Quantity">' +
                '</div>' +
                '<div class="form-group col-md-1 pf">' +
                '<input type="text" class="form-control form-control-sm price" id="u-price" name="" placeholder="Rate">' +
                '</div>' +
                '<div class="form-group col-md-1 pf" style="width: 7% !important;">' +
                '<input type="text" class="form-control form-control-sm date" id="" name="" placeholder="Amount">' +
                '</div>'+
                '<div class="form-group col-md-1 pf" style="width: 7% !important;">' +
                '<input type="text" class="form-control form-control-sm" id="gst" name="" placeholder="%">' +
                '</div>' +
                '<div class="form-group col-md-1 pf">'+
                '<input type="text" class="form-control form-control-sm" id="gst-amount" name="" placeholder="GST Amount">' +
                '</div>' +
                '<div class="form-group col-md-1 pf">' +
                '<input type="text" class="form-control form-control-sm total" id="amount" name="" placeholder="0.00" readonly="">' +
                '</div>' +
                '<div class="form-group col-md-1 pf" style="width: 5% !important;">' +
                '<button type="button" class="btn btn-mini btn-danger remove" name=""><i class="fa fa-trash"></i> </button>' +
                '</div><div class="clearfix"></div></div>');
            $(".js-example-basic-single").select2();
        }
        
        $(document).on('click','.remove',function() {
            $(this).parent().closest(".row-rem").remove();
            var sum=0;
            $(".total").each(function(){
                sum += +$(this).val();
            });
            $("#net_total").val(sum);
        });


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
        $(document).on('change','.gst_per',function() {
            var sum=0;
            g=$(this);
            $(this).each(function(){
                var amount=g.parents('.parentRemove').find('.total').val();
                var gst_amount=Number(amount)/Number(g.val());
                var amount=(g.parents('.parentRemove').find('.gst_amount').val(gst_amount.toFixed(5)));
            });
            st();
        });
        function st()
        {
            var sum=0;
            var gst=0;
            $(".total").each(function(){
                sum+=Number($(this).val());
            });
            $(".gst_amount").each(function(){
                gst+=Number($(this).val());
            });
            net_total=$("#net_total").val((sum).toFixed(5));
            sale_tax=$("#sale_tax").val((gst).toFixed(5));
            var ac=$("#add_charges").val();
            var lc=$("#less_charges").val();
            $("#gross_amount").val(Number(sum)+Number(gst));
            $("#net_amount").val(Number(sum)+Number(gst)+Number(ac)-Number(lc));


        }
        function pc(){
            var fc=$("#fc").val();
            var sc=$("#sc").val();
            $("#add_charges").val(Number(fc)+Number(sc));
            st();
        }
        function lc(){
            var fc=$("#flc").val();
            var sc=$("#slc").val();
            $("#less_charges").val(Number(fc)+Number(sc));
            st();
        }
    </script>
    <script type="text/javascript">
        $('.card-block').on("change", "#gst", function(e){
            e.preventDefault();
            var qty = $(this).parents('.newrow').find('#qty').val();
            var unit_price = $(this).parents('.newrow').find('#u-price').val();
            var gst = $(this).val();
            var total = Number(qty)*Number(unit_price);

            var gst_amount = Number(total) * Number(gst)/Number(100);

            $(this).parents('.newrow').find('#gst-amount').val(gst_amount);
            var tax = $(this).parents('.newrow').find('#gst-amount').val();

            $(this).parents('.newrow').find('#amount').val(Number(total)+Number(tax));
        })
    </script>
    
@endsection