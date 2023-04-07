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
                        <li class="breadcrumb-item">User Management</li>
                        <li class="breadcrumb-item active">Permissions</li>
                    </ol>
                </div>
            </div>
            <!-- End start -->
            <div class="row">
                <!-- Form Control starts -->
                <div class="col-md-12">
                    <div class="card">
                            <div class="card-block">
                                <button type="button" onclick="add_new()" class="btn btn-mini btn-primary pull-right">Add New</button>
                                <div class="col-sm-12 table-responsive pad0">
                                    <table class="table ">
                                        <tr style="background-color: #eeeeee">
                                            <th>#</th>
                                            <th>Menu Name</th>
                                            <th>Action</th>
                                        </tr>
                                        <tbody id="get_data"></tbody>
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
    @include('permissions.modal');
    <script>
        function add_new() {
            $("#new").modal();
            $("#form input[name~='id']").val(0);
            document.getElementById("form").reset();
        }
        function save_rec() {
            $.ajax({
                url:"{{ route('permission.store') }}",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type:"POST",
                dataType:"JSON",
                data:$("#form").serialize(),
                success:function (data) {
                    $("#form input[name~='id']").val(0);
                    toastr.success('Operation successfull.');
                    document.getElementById("form").reset();
                    $('.loader-bg').hide();
                    $("#new").modal('hide');
                    get_data();
                }
                ,error:function(ajaxcontent) {
                    vali=ajaxcontent.responseJSON.errors;
                    var errors='';
                    $.each(vali, function( index, value ) {
                        $("#form input[name~='" + index + "']").css('border', '1px solid red');
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
            $("#loader").show()
            $.ajax({
                url:"{{ url('user/get_permission') }}?page="+page,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type:"POST",
                dataType:"JSON",
                success:function (data) {
                    htmlData='';
                    for(i in data.data){
                        htmlData+='<tr id="'+data.data[i].id+'">';
                        htmlData+='<td>'+(Number(i)+1)+'</td>';
                        htmlData+='<td>'+data.data[i].name+'</td>';
                        htmlData+='<td>';
                        htmlData+='<a  class="btn btn-primary btn-xs" href="javascript:void(0)" onclick="edit('+data.data[i].id+')"><i class="fa fa-edit"></i> </a>';
                        htmlData+=' <a  class="btn btn-danger btn-xs" href="javascript:void(0)" onclick="del_rec(\''+data.data[i].id+'\', \'{{ url('Application_Setup/user_management/permission/') }}/'+data.data[i].id+'\')"><i class="fa fa-trash"></i> </a>';
                        htmlData+='</td>';
                        htmlData+='</tr>';
                    }
                    $("#get_data").html(htmlData);
                    $("#loader").hide()
                    if(data.total>0) {
                        pagination(data.total, data.per_page, data.current_page, data.to, get_data);
                    }
                }
            })
        }
        function edit(id) {
            $('.loader-bg').show();
            $(".first-row").hide();
            $("#purchaseorder").modal();
            $.ajax({
                url:"{{ url('purchase_order') }}/"+id+"/edit",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success:function (data) {
                    $("#Purchaeorder-form input[name~='id']").val(data[0].id);
                    $("#Purchaeorder-form select[name~='SUPID']").val(data[0].SUPID);
                    $("#Purchaeorder-form input[name~='Contact_Person']").val(data[0].Contact_Person);
                    $("#Purchaeorder-form select[name~='BID']").val(data[0].BID);
                    $("#Purchaeorder-form select[name~='lab']").val(data[0].lab);
                    $("#Purchaeorder-form select[name~='EMPID']").val(data[0].EMPID);
                    $("#Purchaeorder-form select[name~='Payment_Term']").val(data[0].Payment_Term);
                    $("#Purchaeorder-form input[name~='Delivery_Via']").val(data[0].Delivery_Via);
                    $("#Purchaeorder-form input[name~='Delivery_address']").val(data[0].Delivery_address);
                    $("#Purchaeorder-form input[name~='Delivery_days']").val(data[0].Delivery_days);
                    $("#Purchaeorder-form input[name~='Delivery_date']").val(data[0].Delivery_date);
                    $(".more-item").html(data[1]);
                    $(".js-example-basic-single").select2();

                    //$("#SUPID option[value='"+data.SUPID+"']").attr("selected", true);
                    //$("#Purchaeorder-form input[name~='CT_Name']").val(data.CT_Name);
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
                url:"{{ url('fetch_supplier_det') }}/"+id,
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
                url:"{{ url('branches') }}/"+id+"",
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
