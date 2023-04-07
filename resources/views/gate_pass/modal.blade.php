<style>
    .modal-body {
        max-height: 100%;
    }
    .modal-header {
        padding: 5px;
        border: 0px;
    }
    .modal-content {
        background: #eee !important;
    }
    .form-group {
        margin-bottom: 0.3rem !important;
    }

    @media (min-width: 992px) {
        .modal-md {
            width: 100%;
            max-width: 1300px;
        }
    }
    .col-md-1 {
        width: 12.333333% !important;
    }
    .row-rem .col-md-1{
        width: 10.333333% !important;
    }
    .pf {
        padding-left: 3px !important;
        padding-right: 3px !important;
    }
    label {
        display: contents !important;
        color: #050505;
    }
    .table input[type="text"] {
        width: 100%;
        padding: 0px;
        font-size: 13px;
        text-transform: uppercase;
    }
    label {
        display: contents !important;
        color: #050505;
    }
    .card-header, .card-block {
        padding: 5px !important;
    }
    .card {
        margin-bottom: 5px !important;
    }
</style>
<div class="modal fade" id="new">
    <div class="modal-dialog modal-md modal-sm" role="document">
        <div class="modal-content">
            <form id="gatepass-form">
                <input type="hidden" name="id" value="0">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">×</span> </button>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-right:10px;"> <span aria-hidden="true">−</span> </button>
                    <h5 class="modal-title">Gate Pass</h5>
                </div>
                <!-- end of modal-header -->
                <div class="modal-body plr30">
                    <div class="row">
                        <div class="form-group col-md-1 pf">
                            <label for="inputdefault">Date </label>
                            <input class="form-control form-control-sm date" id="" name="date" type="text" placeholder="Date">
                        </div>
                        <div class="form-group col-md-1 pf">
                            <label for="inputdefault">Supplier </label>
                            <select class="form-control form-control-sm js-example-basic-single" id="" name="SUPID" onchange="fetch_po(this.value)">
                                <option value="">Select</option>
                                {!! App\Models\Supplier::dropdown() !!}
                            </select>
                        </div>
                        <div class="form-group col-md-1 pf">
                            <label for="inputdefault">Purchase Order </label>
                            <input class="form-control form-control-sm" id="" name="POID" onchange="fetch_po(this.value, 'po')" type="text" placeholder="Purchase Order #">
                        </div>
                        <div class="form-group col-md-1 pf">
                            <label for="inputdefault">Driver Name</label>
                            <input class="form-control form-control-sm" id="" name="Driver_name" type="text"  value="" placeholder="Driver Name">
                        </div>
                        <div class="form-group col-md-1 pf">
                            <label for="inputdefault">Driver CNIC</label>
                            <input class="form-control form-control-sm" id="" name="Driver_cnic" type="text"  value="" placeholder="Driver CNIC">
                        </div>
                        <div class="form-group col-md-1 pf">
                            <label for="inputdefault">Vehicle Number</label>
                            <input class="form-control form-control-sm" id="" name="Vehicle_number" type="text"  value="" placeholder="Vehicle Number">
                        </div>
                        <div class="form-group col-md-1 pf">
                            <label for="inputdefault">Vehicle Type</label>
                            <select class="form-control form-control-sm" name="Vehicle_type">
                                <option value="">Select</option>
                                {!! App\Helpers\helpers::Vehicle_type() !!}
                            </select>
                        </div>
                        <div class="form-group col-md-1 pf">
                            <label for="inputdefault">Number Of Bags</label>
                            <input class="form-control form-control-sm" id="" name="No_bags" type="text"  value="" placeholder="Number Of Bags">
                        </div>
                        <div class="form-group col-md-1 pf">
                            <label>1st Weight</label>
                            <input class="form-control form-control-sm fw" id="" onchange="net_weight()" name="F_weight" type="text"  value="" placeholder="1st Weight">
                        </div>
                        <div class="form-group col-md-1 pf">
                            <label>2nd Weight</label>
                            <input class="form-control form-control-sm sw" id="" name="S_weight" onchange="net_weight()" type="text"  value="" placeholder="2nd Weight">
                        </div>
                        <div class="form-group col-md-1 pf">
                            <label>Net Weight</label>
                            <input class="form-control form-control-sm nw" readonly="readonly" id="" name="Net_weight" type="text"  value="" placeholder="Net Weight">
                        </div>
                        <div class="form-group col-md-1 pf">
                            <label>Delivery Address</label>
                            <input class="form-control form-control-sm" id="" name="Delivery_address" type="text"  value="" placeholder="Delivery Address">
                        </div>
                        <div class="form-group col-md-1 pf">
                            <label for="inputdefault">Branch </label>
                            <select class="js-example-basic-single form-control form-control-sm" name="BID" id="" >
                                <option value="0">Select Branch</option>
                                {!! App\Models\Branches::dropdown() !!}
                            </select>
                        </div>
                        <div class="form-group col-md-1 pf">
                            <label for="inputdefault">weighing charges </label>
                            <input class="form-control form-control-sm" id="" name="Weighing_charges" type="text" placeholder="Owner Name">
                        </div>
                        <div class="form-group col-md-1 pf">
                            <label for="inputdefault">Trans Charges</label>
                            <input class="form-control form-control-sm" id="" name="Trans_charges" type="text"  value="" placeholder="Delivery Via">
                        </div>
                        <div class="form-group col-md-1 pf">
                            <label for="inputdefault">Raw Material Nature</label>
                            <select class="form-control form-control-sm" name="Raw_material_nature">
                                <option value="">Select</option>
                                {!! App\Helpers\helpers::raw_material_nature() !!}
                            </select>
                        </div>
                        {{--<div class="form-group col-md-1 pf">--}}
                            {{--<label for="inputdefault">Lab Condition</label>--}}
                            {{--<select class="form-control form-control-sm" name="inv_date">--}}
                                {{--<option value="0">Yes</option>--}}
                                {{--<option value="1">No</option>--}}
                            {{--</select>--}}
                        {{--</div>--}}
                        <div class="form-group col-md-1 pf">
                            <label>Time In</label>
                            <input style="height: 27px" class="form-control form-control-sm" id="" name="Time_in" type="time"  value="" placeholder="Time In">
                        </div>
                        <div class="form-group col-md-1 pf">
                            <label>Time Out</label>
                            <input style="height: 27px" class="form-control form-control-sm" onchange="calculateTime()" id="" name="Time_out" type="time"  value="" placeholder="Time out">
                        </div>
                        <div class="form-group col-md-1 pf">
                            <label>Unloading Time</label>
                            <input class="form-control form-control-sm" id="" name="Unloading_time" type="text"  value="" placeholder="Unloading Time">
                        </div>
                        <div class="form-group col-md-1 pf">
                            <label>Unloading Type</label>
                            <select class="form-control form-control-sm" id="" name="Unloading_type">
                                <option value="">Select</option>
                            </select>
                        </div>
                        <div class="form-group col-md-1 pf">
                            <label>Warehouse</label>
                            <select class="form-control form-control-sm js-example-basic-single" name="WHID">
                                <option value="">Select</option>
                                {!! App\Models\WhereHouse::dropdown() !!}
                            </select>
                        </div>
                        <div class="form-group col-md-1 pf">
                            <label>Bilty Number</label>
                            <input class="form-control form-control-sm" id="" name="Bilty_No" type="text"  value="" placeholder="Bilty Number">
                        </div>
                        <div class="form-group col-md-1 pf">
                            <label>DC Number</label>
                            <input class="form-control form-control-sm" id="" name="DC_No" type="text"  value="" placeholder="DC Number">
                        </div>
                        <div class="form-group col-md-1 pf">
                            <label>Finance Email ID</label>
                            <input class="form-control form-control-sm" id="" name="Fanacial_email" type="text"  value="" placeholder="Finance Email ID">
                        </div>
                        <div class="form-group col-md-1 pf">
                            <label>Owner Email</label>
                            <input class="form-control form-control-sm" id="" name="Owner_email" type="text"  value="" placeholder="Owner Email">
                        </div>
                    </div>
                    <div class="col-md-12 pf">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header text-primary">
                                        <h5 class="card-header-text refText" style="color: rgb(26, 168, 157);">Item Details:</h5>
                                    </div>
                                    <div class="card-block">
                                        {{--<div class="parentRemove row-rem">--}}
                                            {{--<div class="form-group col-md-2 pf">--}}
                                                {{--<label>Item Name</label>--}}
                                                {{--<select class="js-example-basic-single form-control form-control-sm" name="item_id[]" id="" required="required">--}}
                                                    {{--<option value="">Select Item</option>--}}
                                                    {{--{!! App\Models\Item::itemList() !!}--}}
                                                {{--</select>--}}
                                            {{--</div>--}}
                                            {{--<div class="form-group col-md-1 pf">--}}
                                            {{--<label>Remarks</label>--}}
                                            {{--<input type="text" class="form-control form-control-sm" id="" name="" placeholder="Remarks">--}}
                                            {{--</div>--}}
                                            {{--<div class="form-group col-md-1 pf">--}}
                                                {{--<label>Unit</label>--}}
                                                {{--<select class="form-control form-control-sm" id="" name="unit[]">--}}
                                                    {{--<option value="0">Select</option>--}}
                                                {{--</select>--}}
                                            {{--</div>--}}
                                            {{--<div class="form-group col-md-1 pf">--}}
                                                {{--<label>Standard Bag Weight</label>--}}
                                                {{--<input type="text" class="form-control form-control-sm st_bag_weight" id="quantity" name="bag_weight[]" placeholder="Standard Bag Weight" required="required">--}}
                                            {{--</div>--}}
                                            {{--<div class="form-group col-md-1 pf">--}}
                                                {{--<label>Quantity</label>--}}
                                                {{--<input type="text" class="form-control form-control-sm qty" id="quantity" name="quantity[]" placeholder="Quantity" required="required">--}}
                                            {{--</div>--}}
                                            {{--<div class="form-group col-md-1 pf">--}}
                                                {{--<label>Per Kg Rate</label>--}}
                                                {{--<input type="text" class="form-control form-control-sm per_kg_w" id="quantity" name="per_kg_rate[]" placeholder="Per Kg Rate" required="required">--}}
                                            {{--</div>--}}
                                            {{--<div class="form-group col-md-1 pf">--}}
                                                {{--<label>Unit Price</label>--}}
                                                {{--<input type="text" class="form-control form-control-sm price" id="unitprice" name="unit_price[]" placeholder="Rate" required="required">--}}
                                            {{--</div>--}}
                                            {{--<div class="form-group col-md-1 pf" style="width: 7% !important;">--}}
                                            {{--<label>Req Date</label>--}}
                                            {{--<input type="text" class="form-control form-control-sm date" id="" name="" placeholder="Amount">--}}
                                            {{--</div>--}}
                                            {{--<div class="form-group col-md-1 pf" style="width: 7% !important;">--}}
                                            {{--<label>Qlty Spec</label>--}}
                                            {{--<input type="text" class="form-control form-control-sm" id="" name="" placeholder="Amount">--}}
                                            {{--</div>--}}
                                            {{--<div class="form-group col-md-1 pf">--}}
                                            {{--<label>Source Inspec</label>--}}
                                            {{--<input type="text" class="form-control form-control-sm" id="" name="" placeholder="Amount">--}}
                                            {{--</div>--}}
                                            {{--<div class="form-group col-md-1 pf">--}}
                                                {{--<label>Amount</label>--}}
                                                {{--<input type="text" class="form-control form-control-sm total" id="amount" name="amount[]" placeholder="Amount" required="required">--}}
                                            {{--</div>--}}
                                            {{--<div class="form-group col-md-1 pf" style="width: 5% !important;">--}}
                                                {{--<label style="visibility: hidden">Amountflakhfahfah</label>--}}
                                                {{--<button type="button" class="btn btn-mini btn-primary" onclick="more_item()"><i class="fa fa-plus"></i> </button>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                        <div class="more-item"></div>
                                    </div>
                                </div>
                                <!--card-->
                            </div>
                            <!--col-md-12-->
                        </div>
                        <!--row-->
                    </div>
                </div>
                <!-- end of modal-body -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" onclick="save_rec()">Submit</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
        <!-- end of modal-content -->
    </div>
    <!-- end of modal-dialog -->
</div>