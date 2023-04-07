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
    .pf {
        padding-left: 5px !important;
        padding-right: 5px !important;
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
<div class="modal" id="new-sub_head">
    <div class="modal-dialog modal-md modal-md modal-sm" role="document">
        <form id="customer-form">
            @CSRF
            <input type="hidden" name="id" value="0">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h5 class="modal-title">Customer Details</h5>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <div class="form-group col-md-1 pf">
                        <label for="inputdefault">Customer Name <sup class="text-danger">*</sup></label>
                        <input class="form-control form-control-sm" id="" name="C_Name" type="text">
                    </div>
                    <div class="form-group col-md-1 pf">
                        <label for="inputdefault">Contact Person</label>
                        <input class="form-control form-control-sm" id="" name="C_C_Person" type="text">
                    </div>
                    <div class="form-group col-md-1 pf">
                        <label for="inputdefault">Designation</label>
                        <select class="form-control form-control-sm js-example-basic-single" id="" name="C_Designation">
                            <option value="">Select Designation</option>
                            {!! App\Models\Designation::dropdown() !!}
                        </select>
                    </div>
                    <div class="form-group col-md-1 pf">
                        <label for="inputdefault">Date Of Birth</label>
                        <input class="form-control form-control-sm date" autocomplete="off" id="" name="C_DOB" type="text">
                    </div>
                    <div class="col-md-1 pf">
                        <label>Customer Type</label>
                        <select class="form-control form-control-sm" name="C_DOB">
                            <option value="">Select</option>
                            {!! App\Models\CustomerType::dropdown() !!}
                        </select>
                    </div>
                    <div class="form-group col-md-1 pf">
                        <label for="inputdefault">National Tax No</label>
                        <input class="form-control form-control-sm" id="" name="C_National_Tax_No" type="text">
                    </div>
                    <div class="form-group col-md-1 pf">
                        <label for="inputdefault">S.T.Reg.No </label>
                        <input class="form-control form-control-sm" id="" name="C_STR_Reg_No" type="text">
                    </div>
                    <div class="form-group col-md-1 pf">
                        <label for="inputdefault">Phone</label>
                        <input class="form-control form-control-sm" id="" name="C_Phone" type="text">
                    </div>
                    <div class="form-group col-md-1 pf">
                        <label for="inputdefault">Mobile<sup class="text-danger">*</sup></label>
                        <input class="form-control form-control-sm" id="" name="C_Mobile" type="text">
                    </div>
                    <div class="form-group col-md-1 pf">
                        <label for="inputdefault">Email</label>
                        <input class="form-control form-control-sm" id="" name="C_Email" type="text">
                    </div>
                    <div class="form-group col-md-1 pf">
                        <label for="inputdefault">Credit Limit</label>
                        <input class="form-control form-control-sm" id="" name="C_Credit_Limit" type="text">
                    </div>
                    <div class="form-group col-md-1 pf">
                        <label for="inputdefault">Credit Days</label>
                        <input class="form-control form-control-sm" id="" name="C_Credit_Days" type="text">
                    </div>
                    <div class="form-group col-md-1 pf">
                        <label for="inputdefault">Expirty Date</label>
                        <input class="form-control form-control-sm date" autocomplete="off" id="" name="C_Expiry_Date" type="text">
                    </div>
                    <div class="form-group col-md-1 pf">
                        <label for="inputdefault">A/C Type</label>
                        <select class="form-control form-control-sm js-example-basic-single" id="" name="PID">
                            <option value="">Select A/c Type</option>
                            {!! App\Models\SubHead::AccountType() !!}
                        </select>
                    </div>
                    <div class="form-group col-md-1 pf">
                        <label for="inputdefault">OB Type</label>
                        <select class="form-control form-control-sm js-example-basic-single" id="" name="OB_Type">
                            <option value="1">Dr</option>
                            <option value="2">Cr</option>
                        </select>
                    </div>
                    <div class="form-group col-md-1 pf">
                        <label for="inputdefault">OB Amount</label>
                        <input class="form-control form-control-sm date" autocomplete="off" id="" name="OB" type="text">
                    </div>
                    <div class="form-group col-md-1 pf">
                        <label>City</label>
                        <select class="form-control form-control-sm js-example-basic-single" id="" name="C_CYID">
                            <option value="">City</option>
                        </select>
                    </div>
                    <div class="form-group col-md-1 pf">
                        <label>Cost Central Code</label>
                        <select class="form-control form-control-sm js-example-basic-single" id="" name="C_Cost_CID">
                            <option value="">Select</option>
                        </select>
                    </div>
                    <div class="form-group col-md-3 pf">
                        <label for="inputdefault">Address 1<sup class="text-danger">*</sup></label>
                        <input class="form-control form-control-sm" id="" name="C_Adress_1" type="text">
                    </div>
                    <div class="form-group col-md-3 pf">
                        <label for="inputdefault">Address 2</label>
                        <input class="form-control form-control-sm" id="" name="C_Adress_2" type="text">
                    </div>
                    <div class="form-group col-md-3 pf">
                        <label for="inputdefault">Address 3</label>
                        <input class="form-control form-control-sm" id="" name="C_Adress_3" type="text">
                    </div>
                    <!-- Modal footer -->
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
                                        <div class="form-group col-md-3 pf">
                                            <label>Item Name</label>
                                            <select class="js-example-basic-single form-control form-control-sm" name="C_ItemID[]" id="">
                                                <option value="0">Select Item</option>
                                                {!! App\Models\Item::itemList() !!}
                                            </select>
                                        </div>
                                        <div class="form-group col-md-1 pf">
                                            <label>Price</label>
                                            <input type="number" class="form-control form-control-sm" id="" name="C_Item_Price[]" placeholder="Price">
                                        </div>
                                        <div class="form-group col-md-1 pf">
                                            <label style="visibility: hidden">Amountflakhfahfahfh</label>
                                            <button type="button" class="btn btn-mini btn-primary" onclick="more_item()"><i class="fa fa-plus"></i> </button>
                                        </div>
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
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" onclick="save_rec()">Submit</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </div>

            </div>
        </form>
    </div>

</div>