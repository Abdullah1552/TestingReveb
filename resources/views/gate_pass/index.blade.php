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
                    <h5>Gate Pass</h5>
                    <ol class="breadcrumb breadcrumb-title breadcrumb-arrow">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="icofont icofont-home"></i></a> </li>
                        <li class="breadcrumb-item">Purchase</li>
                        <li class="breadcrumb-item active">Gate Pass List </li>
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
                                            <th>#</th>
                                            <th>Driver Name</th>
                                            <th>Vehicle Number</th>
                                            <th>Vehicle Type</th>
                                            {{--<th>Unloading Location</th>--}}
                                            {{--<th>Status</th>--}}
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
    @include('gate_pass.modal');
    <script>
        function add_new() {
            $("#new").modal();
            $("#gatepass-form input[name~='id']").val(0);
            document.getElementById("").reset('gatepass-form');
        }
        function save_rec() {
            $('.loader-bg').show();
            $.ajax({
                url:"{{ route('gate_pass.store') }}",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type:"POST",
                dataType:"JSON",
                data:$("#gatepass-form").serialize(),
                success:function (data) {
                    $("#gatepass-form input[name~='id']").val(0);
                    toastr.success('Operation successfull.');
                    document.getElementById("gatepass-form").reset();
                    $('.loader-bg').hide();
                    $("#new").modal('hide');
                    get_data();
                },error:function(ajaxcontent) {
                    vali=ajaxcontent.responseJSON.errors;
                    var errors='';
                    $.each(vali, function( index, value ) {
                        $("#gatepass-form input[name~='" + index + "']").css('border', '1px solid red');
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
                url:"{{ url('get_gate_pass') }}?page="+page,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type:"POST",
                dataType:"JSON",
                success:function (data) {
                    htmlData='';
                    for(i in data.data){
                        htmlData+='<tr id="'+data.data[i].id+'">';
                        htmlData+='<td>'+(Number(i)+1)+'</td>';
                        htmlData+='<td>'+data.data[i].Driver_name+'</td>';
                        htmlData+='<td>'+data.data[i].Vehicle_number+'</td>';
                        htmlData+='<td>N/A</td>';
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
                url:"{{ url('gate_pass') }}/"+id+"/edit",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success:function (data) {
                    $("#gatepass-form input[name~='id']").val(data[0].id);
                    $("#gatepass-form input[name~='POID']").val(data[0].id);
                    $("#gatepass-form input[name~='date']").val(data[0].date);
                    $("#gatepass-form select[name~='SUPID']").val(data[0].SUPID);
                    $("#gatepass-form input[name~='Driver_name']").val(data[0].Driver_name);
                    $("#gatepass-form input[name~='Driver_cnic']").val(data[0].Driver_cnic);
                    $("#gatepass-form input[name~='Vehicle_number']").val(data[0].Vehicle_number);
                    $("#gatepass-form input[name~='Vehicle_type']").val(data[0].Vehicle_type);
                    $("#gatepass-form input[name~='No_bags']").val(data[0].No_bags);
                    $("#gatepass-form input[name~='F_weight']").val(data[0].F_weight);
                    $("#gatepass-form input[name~='S_weight']").val(data[0].S_weight);
                    $("#gatepass-form input[name~='Net_weight']").val(data[0].Net_weight);
                    $("#gatepass-form input[name~='Delivery_address']").val(data[0].Delivery_address);
                    $("#gatepass-form select[name~='BID']").val(data[0].BID);
                    $("#gatepass-form input[name~='Weighing_charges']").val(data[0].Weighing_charges);
                    $("#gatepass-form input[name~='Trans_charges']").val(data[0].Trans_charges);
                    $("#gatepass-form select[name~='Raw_material_nature']").val(data[0].Raw_material_nature);
                    $("#gatepass-form input[name~='Time_in']").val(data[0].Time_in);
                    $("#gatepass-form input[name~='Time_out']").val(data[0].Time_out);
                    $("#gatepass-form input[name~='Unloading_time']").val(data[0].Unloading_time);
                    $("#gatepass-form input[name~='Unloading_type']").val(data[0].Unloading_type);
                    $("#gatepass-form select[name~='WHID']").val(data[0].WHID);
                    $("#gatepass-form input[name~='Bilty_No']").val(data[0].Bilty_No);
                    $("#gatepass-form input[name~='DC_No']").val(data[0].DC_No);
                    $("#gatepass-form input[name~='Fanacial_email']").val(data[0].Fanacial_email);
                    $("#gatepass-form input[name~='Owner_email']").val(data[0].Owner_email);
                    $(".more-item").html(data[1]);
                    $(".js-example-basic-single").select2();
                    $('.loader-bg').hide();
                    st();
                }
            })
        }
        function more_item() {
            $(".more-item").append('<div class="row-rem"> <div class="clearfix"></div> ' +
                '<div class="form-group col-md-3 pf">' +
                '<select class="js-example-basic-single form-control form-control-sm" name="">' +
                '<option value="">Select Item</option>{!! App\Models\Item::itemList() !!}</select>' +
                '</div>' +
                '<div class="form-group col-md-1 pf">' +
                '<input type="text" class="form-control form-control-sm" id="" name="" placeholder="Remarks">' +
                '</div>' +
                '<div class="form-group col-md-1 pf" style="width: 7% !important;">'+
                '<select class="form-control form-control-sm" name="">' +
                    '<option value="0">Select</option>'+
                '</select>'+
                '</div>' +
                '<div class="form-group col-md-1 pf" style="width: 7% !important;">' +
                '<input type="text" class="form-control form-control-sm" id="" name="" placeholder="Qty">' +
                '</div>' +
                '<div class="form-group col-md-1 pf" style="width: 10% !important;">' +
                '<input type="text" class="form-control form-control-sm" id="" name="" placeholder="Unit Price" style="background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);">' +
                '</div>' +
                '<div class="form-group col-md-1 pf" style="width: 7% !important;">' +
                '<input type="text" class="form-control form-control-sm" id="" name="" placeholder="GST %" style="background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);">' +
                '</div>' +
                '<div class="form-group col-md-1 pf" style="width: 7% !important;">' +
                '<input type="text" class="form-control form-control-sm" id="" name="" placeholder="GST Add %">' +
                '</div>' +
                '<div class="form-group col-md-1 pf">' +
                '<input type="text" class="form-control form-control-sm" id="" name="" placeholder="Taxable Amount">' +
                '</div>' +
                '<div class="form-group col-md-1 pf" style="width: 7% !important;">' +
                '<input type="text" class="form-control form-control-sm" id="" name="" placeholder="Discount">' +
                '</div>' +
                '<div class="form-group col-md-1 pf" style="width: 5% !important;">' +
                '<button type="button" class="btn btn-mini btn-danger remove" name=""><i class="fa fa-trash"></i> </button>' +
                '</div><div class="clearfix"></div></div>');
            $(".js-example-basic-single").select2();
        }
        //feth purchase order on supplier base
        function fetch_po(id, type) {
            $('.loader-bg').show();
            $(".first-row").hide();
            $("#purchaseorder").modal();
            if(type=='po')
            {
                callUrl="{{ url('purchase_order') }}/" + id + "/edit";
            }else{
                callUrl="{{ url('purchase_order') }}/"+id ;
            }
            $.ajax({
                url:callUrl,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success:function (data) {
                    $("#Purchaeorder-form input[name~='id']").val(data[0].id);
                    $("#gatepass-form input[name~='POID']").val(data[0].id);
                    $("#gatepass-form select[name~='SUPID']").val(data[0].SUPID);
                    $("#Purchaeorder-form input[name~='Contact_Person']").val(data[0].Contact_Person);
                    $("#gatepass-form select[name~='BID']").val(data[0].BID);
                    $("#Purchaeorder-form select[name~='lab']").val(data[0].lab);
                    $("#Purchaeorder-form select[name~='EMPID']").val(data[0].EMPID);
                    $("#Purchaeorder-form select[name~='Payment_Term']").val(data[0].Payment_Term);
                    $("#Purchaeorder-form input[name~='Delivery_Via']").val(data[0].Delivery_Via);
                    $("#gatepass-form input[name~='Delivery_address']").val(data[0].Delivery_address);
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
        function net_weight() {
            var fw=$(".fw").val();
            var sw=$(".sw").val();
            var nw=$(".nw").val(Number(fw)-Number(sw));
        }
        function calculateTime() {
            var timein=$("#gatepass-form input[name~='Time_in']").val();
            var timeout=$("#gatepass-form input[name~='Time_out']").val();
            var startTime=moment(timein, "HH:mm");
            var endTime=moment(timeout, "HH:mm");
            var duration = moment.duration(startTime.diff(endTime));
            var hours = parseInt(duration.asHours());
            var minutes = parseInt(duration.asMinutes())-hours*60;
            var timeout=$("#gatepass-form input[name~='Unloading_time']").val(hours + ' hour, '+ minutes+' minutes.');


        }
    </script>
@endsection