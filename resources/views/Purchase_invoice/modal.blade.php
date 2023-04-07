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
        width: 10.333333% !important;
    }
    .pf {
        padding-left: 2px !important;
        padding-right: 2px !important;
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
    <div class="modal-dialog modal-md modal-md modal-sm" role="document">
        <div class="modal-content">
            <form id="purchase-form">
                <input type="hidden" name="p" value="0">
                <div class="modal-header refEdit">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">×</span> </button>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-right:10px;"> <span aria-hidden="true">−</span> </button>
                    <h5 class="modal-title">Purchae Invoice</h5>
                </div>
                <!-- end of modal-header -->
                <div class="modal-body plr30">
                    <div class="row">
                        <div class="form-group col-md-1 pf">
                            <label for="inputdefault">Date </label>
                            <input class="form-control form-control-sm date" id="" name="date" type="text"  value="<?php echo date('Y-m-d') ?>" placeholder="Date">
                        </div>
                        <div class="form-group col-md-1 pf">
                            <label for="inputdefault">Supplier </label>
                            <select class="js-example-basic-single form-control form-control-sm" name="SUPID" id="" >
                                <option value="">Select</option>
                                {!! App\Models\Supplier::dropdown() !!}
                            </select>
                        </div>
                        <div class="form-group col-md-1 pf">
                            <label for="inputdefault">Gate Pass </label>
                            <input class="form-control form-control-sm" name="GID" id="" placeholder="Gate Pass" onchange="show_gatepass(this.value)">
                        </div>
                        <div class="form-group col-md-1 pf">
                            <label for="inputdefault">Branch </label>
                            <select class="js-example-basic-single form-control form-control-sm" name="BID" id="" >
                                <option value="0">Select Branch</option>
                                {!! App\Models\Branches::dropdown() !!}
                            </select>
                        </div>
                        <div class="form-group col-md-1 pf">
                            <label for="inputdefault">Wherehouse </label>
                            <select class="js-example-basic-single form-control form-control-sm" name="WHID" id="" >
                                <option value="">Select Wherehouse</option>
                                {!! App\Models\WhereHouse::dropdown() !!}
                            </select>
                        </div>
                        {{-- <div class="form-group col-md-1 pf">
                            <label for="inputdefault">Rep/Employee </label>
                            <select class="js-example-basic-single form-control form-control-sm" name="" id="" >
                                <option value="">Select</option>
                                {!! App\Models\Employee::dropdown() !!}
                            </select>
                        </div> --}}
                        <div class="form-group col-md-1 pf">
                            <label for="inputdefault">Vehicle Number</label>
                            <input class="form-control form-control-sm" id="" name="Vehicle_number" type="text"  value="" placeholder="Vehicle Number">
                        </div>
                        <div class="form-group col-md-2 pf">
                            <label for="inputdefault">Delivery Address </label>
                            <input class="form-control form-control-sm" name="Delivery_address" id="" placeholder="Delivery Address">
                        </div>
                        <div class="form-group col-md-1 pf">
                            <label for="inputdefault">Payment Terms </label>
                            <select class="js-example-basic-single form-control form-control-sm" name="Payment_Term" id="" >
                                <option value="0">Select</option>
                                {!! App\Helpers\helpers::payment_type() !!}
                            </select>
                        </div>
                        <div class="form-group col-md-1 pf">
                            <label for="inputdefault">Delivery Via</label>
                            <input class="form-control form-control-sm" id="" name="Delivery_Via" type="text"  value="" placeholder="Delivery Via">
                        </div>
                        {{-- <div class="form-group col-md-1 pf">
                            <label for="inputdefault">Buyer Name</label>
                            <input class="form-control form-control-sm" id="" name="inv_date" type="text"  value="" placeholder="Buyer Name">
                        </div>
                        <div class="form-group col-md-1 pf">
                            <label for="inputdefault">Contact Person</label>
                            <input class="form-control form-control-sm" id="" name="inv_date" type="text"  value="" placeholder="Contact Person">
                        </div> --}}
                        <div class="form-group col-md-5 pf">
                            <label>Narration</label>
                            <input class="form-control form-control-sm" id="" name="Narration" type="text"  value="" placeholder="Narration">
                        </div>

                        <div class="clearfix"></div>
                        <!-- Form Control starts -->
                        <div class="col-md-12 pf">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-header text-primary">
                                            <h5 class="card-header-text refText" style="color: rgb(26, 168, 157);">Item Details:</h5>
                                        </div>
                                        <div class="card-block">
                                            {{--<div class="parentRemove row-rem newrow">--}}
                                            {{--<div class="form-group col-md-2 pf">--}}
                                                {{--<label>Item Name</label>--}}
                                                {{--<select class="js-example-basic-single form-control form-control-sm" name="" id="" >--}}
                                                    {{--<option value="">Select Item</option>--}}
                                                    {{--{!! App\Models\Item::itemList() !!}--}}
                                                {{--</select>--}}
                                            {{--</div>--}}
                                            {{--<div class="form-group col-md-1 pf">--}}
                                                {{--<label>Remarks</label>--}}
                                                {{--<input type="text" class="form-control form-control-sm" id="" name="" placeholder="Remarks">--}}
                                            {{--</div>--}}
                                            {{--<div class="form-group col-md-1 pf">--}}
                                                {{--<label>UOM</label>--}}
                                                {{--<select class="form-control form-control-sm" id="" name="">--}}
                                                    {{--<option value="0">Select</option>--}}
                                                   {{--{!! App\Models\UnitType::unitTypeList() !!}--}}
                                                {{--</select>--}}
                                            {{--</div>--}}
                                                {{--<div class="form-group col-md-1 pf">--}}
                                                    {{--<label>Standar Bag Wt</label>--}}
                                                    {{--<input type="text" class="form-control form-control-sm qty" id="qty" name="qty" placeholder="Standar Bag Wt">--}}
                                                {{--</div>--}}
                                                {{--<div class="form-group col-md-1 pf">--}}
                                                    {{--<label>Quantity</label>--}}
                                                    {{--<input type="text" class="form-control form-control-sm qty" id="qty" name="qty" placeholder="Qty">--}}
                                                {{--</div>--}}
                                                {{--<div class="form-group col-md-1 pf">--}}
                                                    {{--<label>Total Bags</label>--}}
                                                    {{--<input type="text" class="form-control form-control-sm qty" id="qty" name="qty" placeholder="Total Bag">--}}
                                                {{--</div>--}}
                                                {{--<div class="form-group col-md-1 pf">--}}
                                                    {{--<label>Per Bag Rate</label>--}}
                                                    {{--<input type="text" class="form-control form-control-sm qty" id="qty" name="qty" placeholder="Per Bag Rate">--}}
                                                {{--</div>--}}
                                                {{--<div class="form-group col-md-1 pf">--}}
                                                    {{--<label>Per kg Rate</label>--}}
                                                    {{--<input type="text" class="form-control form-control-sm qty" id="qty" name="qty" placeholder="Per Kg Rate">--}}
                                                {{--</div>--}}
                                                {{--<div class="form-group col-md-1 pf">--}}
                                                    {{--<label>Unit Price</label>--}}
                                                    {{--<input type="text" class="form-control form-control-sm qty" id="qty" name="qty" placeholder="Quantity">--}}
                                                {{--</div>--}}
                                                {{--<div class="form-group col-md-1 pf">--}}
                                                    {{--<label>GST %</label>--}}
                                                    {{--<input type="text" class="form-control form-control-sm qty" id="qty" name="qty" placeholder="Quantity">--}}
                                                {{--</div>--}}
                                                {{--<div class="form-group col-md-2 pf"></div>--}}
                                                {{--<div class="form-group col-md-1 pf">--}}
                                                    {{--<label>GST Amount</label>--}}
                                                    {{--<input type="text" class="form-control form-control-sm qty" id="qty" name="qty" placeholder="Quantity">--}}
                                                {{--</div>--}}
                                            {{--<div class="form-group col-md-1 pf">--}}
                                                {{--<label>Amount</label>--}}
                                                {{--<input type="text" class="form-control form-control-sm total" id="amount" name="amount" placeholder="Amount" readonly="">--}}
                                            {{--</div>--}}
                                            {{--<div class="form-group col-md-1 pf" style="width: 5% !important;">--}}
                                                {{--<label style="visibility: hidden">Amountflakhfahfahfh</label>--}}
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
                        <!-- Form Control ends -->
                        <div class="clearfix"></div>
                        <!-- Form Control starts -->
                        <div class="col-md-5 pf">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-header text-primary">
                                            <h5 class="card-header-text refText" style="color: rgb(26, 168, 157);">Add Charges:</h5>
                                        </div>
                                        <div class="card-block">
                                            <div class="form-group col-md-6 pr5">
                                                <label>Title</label>
                                                <select class="js-example-basic-single form-control form-control-sm" name="" id="" >
                                                    <option value="0">Select</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6 pr5">
                                                <label>Amount</label>
                                                <input type="number" class="form-control form-control-sm" id="fc" name="Add_cf" placeholder="Sale Fraction" onchange="pc()">
                                            </div>
                                            <div class="form-group col-md-6 pr5">
                                                <select class="js-example-basic-single form-control form-control-sm" name="" id="">
                                                    <option value="0">Select</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6 pr5">
                                                <input type="number" class="form-control form-control-sm" id="sc" name="Add_cs" placeholder="Sale Fraction" onchange="pc()">
                                            </div>
                                        </div>
                                    </div>
                                    <!--card-->
                                </div>
                                <!--col-md-12-->
                            </div>
                            <!--row-->
                        </div>
                        <!-- Form Control ends -->

                        <!-- Form Control starts -->
                        <div class="col-md-5 pf">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-header text-primary">
                                            <h5 class="card-header-text refText" style="color: rgb(26, 168, 157);">Less Charges:</h5>
                                        </div>
                                        <div class="card-block">
                                            <div class="form-group col-md-6 pr5">
                                                <label>Title</label>
                                                <select class="js-example-basic-single form-control form-control-sm" name="" id="" >
                                                    <option value="0">Select</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6 pr5">
                                                <label>Amount</label>
                                                <input type="number" class="form-control form-control-sm" id="flc" name="Less_cf" placeholder="Sale Fraction" onchange="lc()">
                                            </div>
                                            <div class="form-group col-md-6 pr5">
                                                <select class="js-example-basic-single form-control form-control-sm" name="" id="" >
                                                    <option value="0">Select</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6 pr5">
                                                <input type="number" class="form-control form-control-sm" id="slc" name="Less_cs" placeholder="Sale Fraction" onchange="lc()">
                                            </div>
                                        </div>
                                    </div>
                                    <!--card-->
                                </div>
                                <!--col-md-12-->
                            </div>
                            <!--row-->
                        </div>
                        <!-- Form Control ends -->
                        <!-- Form Control starts -->
                        <div class="col-md-2 pf">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-header text-primary">
                                            <h5 class="card-header-text refText" style="color: rgb(26, 168, 157);">Net Total</h5>
                                        </div>
                                        <div class="card-block">
                                            <div class="form-group col-md-12 pr5">
                                                <input type="text" class="form-control form-control-sm" id="net_total" placeholder="Total Amount Exc Charges" name="Net_Total">
                                            </div>
                                            <div class="form-group col-md-12 pr5">
                                                <input type="text" class="form-control form-control-sm" id="sale_tax" placeholder="Sale Tax" name="Sale_Tax">
                                            </div>
                                            <div class="form-group col-md-12 pr5">
                                                <input type="text" class="form-control form-control-sm" id="gross_amount" placeholder="Gross Amount" name="Gross_Amount">
                                            </div>
                                            <div class="form-group col-md-12 pr5">
                                                <input type="text" class="form-control form-control-sm" id="add_charges" placeholder="Add Charges" name="Total_AC">
                                            </div>
                                            <div class="form-group col-md-12 pr5">
                                                <input type="text" class="form-control form-control-sm " id="less_charges" placeholder="Less Charges" name="Total_LC">
                                            </div>
                                            <div class="form-group col-md-12 pr5">
                                                <input type="text" class="form-control form-control-sm" id="net_amount" placeholder="Net Amount" name="Net_Amount">
                                            </div>
                                            <div class="form-group col-md-12 pr5">
                                                <button type="button" class="btn btn-mini btn-success" onclick="save_rec()">Save</button>
                                                <button type="button" class="btn btn-mini btn-danger" data-dismiss="modal">Cancel</button>
                                            </div>

                                        </div>
                                    </div>
                                    <!--card-->
                                </div>
                                <!--col-md-12-->
                            </div>
                            <!--row-->
                        </div>
                        <!-- Form Control ends -->
                        <div class="clearfix"></div>
                    </div>
                </div>
                <!-- end of modal-body -->
            </form>
        </div>
        <!-- end of modal-content -->
    </div>
    <!-- end of modal-dialog -->
</div>
