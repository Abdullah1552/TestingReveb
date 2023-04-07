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
<div class="modal fade" id="new">
    <div class="modal-dialog modal-md modal-md modal-sm" role="document">
        <div class="modal-content">
            <form id="ticket-form">
                <div class="modal-header refEdit">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">×</span> </button>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-right:10px;"> <span aria-hidden="true">−</span> </button>
                    <h5 class="modal-title">Sale Invoice With GST</h5>
                </div>
                <!-- end of modal-header -->
                <div class="modal-body plr30">
                    <div class="row">
                        <div class="form-group col-md-1 pf">
                            <label for="inputdefault">Date </label>
                            <input class="form-control form-control-sm date" id="" name="inv_date" type="text"  value="" placeholder="Date">
                        </div>
                        <div class="form-group col-md-1 pf">
                            <label for="inputdefault">Employee </label>
                            <select class="js-example-basic-single form-control form-control-sm clients select2-hidden-accessible" name="client_id" id="client_id" onchange="new_client(this, 'client', '2','1','1', 'Customer/Receivables')" tabindex="-1" aria-hidden="true">
                                <option value="0">Select Employee</option>
                            </select>
                        </div>
                        <div class="form-group col-md-1 pf">
                            <label for="inputdefault">Branch </label>
                            <select class="js-example-basic-single form-control form-control-sm clients select2-hidden-accessible" name="client_id" id="client_id" onchange="new_client(this, 'client', '2','1','1', 'Customer/Receivables')" tabindex="-1" aria-hidden="true">
                                <option value="0">Select Branch</option>
                            </select>
                        </div>
                        <div class="form-group col-md-1 pf">
                            <label for="inputdefault">Cost Center </label>
                            <select class="js-example-basic-single form-control form-control-sm clients select2-hidden-accessible" name="client_id" id="client_id" onchange="new_client(this, 'client', '2','1','1', 'Customer/Receivables')" tabindex="-1" aria-hidden="true">
                                <option value="0">Select</option>
                            </select>
                        </div>
                        <div class="form-group col-md-1 pf">
                            <label for="inputdefault">Wherehouse </label>
                            <select class="js-example-basic-single form-control form-control-sm clients select2-hidden-accessible" name="client_id" id="client_id" onchange="new_client(this, 'client', '2','1','1', 'Customer/Receivables')" tabindex="-1" aria-hidden="true">
                                <option value="0">Select Wherehouse</option>
                            </select>
                        </div>
                        <div class="form-group col-md-1 pf">
                            <label for="inputdefault">Cash/Bank </label>
                            <select class="js-example-basic-single form-control form-control-sm clients select2-hidden-accessible" name="client_id" id="client_id" onchange="new_client(this, 'client', '2','1','1', 'Customer/Receivables')" tabindex="-1" aria-hidden="true">
                                <option value="0">Select</option>
                            </select>
                        </div>
                        <div class="form-group col-md-1 pf">
                            <label for="inputdefault">Customer </label>
                            <select class="js-example-basic-single form-control form-control-sm clients select2-hidden-accessible" name="client_id" id="client_id" onchange="new_client(this, 'client', '2','1','1', 'Customer/Receivables')" tabindex="-1" aria-hidden="true">
                                <option value="0">Select</option>
                            </select>
                        </div>
                        <div class="form-group col-md-1 pf">
                            <label for="inputdefault">S.T.Reg#:</label>
                            <input class="form-control form-control-sm" id="" name="inv_date" type="text"  value="" placeholder="S.T.Reg #">
                        </div>
                        <div class="form-group col-md-10 pf">
                            <input class="form-control form-control-sm" id="" name="inv_date" type="text"  value="" placeholder="Narration">
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
                                            <div class="form-group col-md-3 pf">
                                                <label>Item Name</label>
                                                <select class="js-example-basic-single form-control form-control-sm clients select2-hidden-accessible" name="client_id" id="client_id" onchange="new_client(this, 'client', '2','1','1', 'Customer/Receivables')" tabindex="-1" aria-hidden="true">
                                                    <option value="0">Select Item</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-1 pf">
                                                <label>Remarks</label>
                                                <input type="text" class="form-control form-control-sm" id="" name="" placeholder="Remarks">
                                            </div>
                                            <div class="form-group col-md-1 pf" style="width: 7% !important;">
                                                <label>Unit</label>
                                                <select class="form-control form-control-sm" id="" name="">
                                                    <option value="0">Select</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-1 pf" style="width: 7% !important;">
                                                <label>Quantity</label>
                                                <input type="text" class="form-control form-control-sm" id="" name="" placeholder="Quantity">
                                            </div>
                                            <div class="form-group col-md-1 pf" style="width: 10% !important;">
                                                <label>Unit Price</label>
                                                <input type="text" class="form-control form-control-sm" id="" name="" placeholder="Rate">
                                            </div>
                                            <div class="form-group col-md-1 pf" style="width: 7% !important;">
                                                <label>GST %</label>
                                                <input type="text" class="form-control form-control-sm" id="" name="" placeholder="Amount">
                                            </div>
                                            <div class="form-group col-md-1 pf" style="width: 7% !important;">
                                                <label>GST Add %</label>
                                                <input type="text" class="form-control form-control-sm" id="" name="" placeholder="Amount">
                                            </div>
                                            <div class="form-group col-md-1 pf">
                                                <label>Taxable Amount</label>
                                                <input type="text" class="form-control form-control-sm" id="" name="" placeholder="Amount">
                                            </div>
                                            <div class="form-group col-md-1 pf" style="width: 7% !important;">
                                                <label>Dealer Dis</label>
                                                <input type="text" class="form-control form-control-sm" id="" name="" placeholder="Amount">
                                            </div>
                                            <div class="form-group col-md-1 pf" style="width: 5% !important;">
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
                                                <select class="js-example-basic-single form-control form-control-sm clients select2-hidden-accessible" name="client_id" id="client_id" onchange="new_client(this, 'client', '2','1','1', 'Customer/Receivables')" tabindex="-1" aria-hidden="true">
                                                    <option value="0">Select</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6 pr5">
                                                <label>Amount</label>
                                                <input type="number" class="form-control form-control-sm" id="" name="" placeholder="Sale Fraction">
                                            </div>
                                            <div class="form-group col-md-6 pr5">
                                                <select class="js-example-basic-single form-control form-control-sm clients select2-hidden-accessible" name="client_id" id="client_id" onchange="new_client(this, 'client', '2','1','1', 'Customer/Receivables')" tabindex="-1" aria-hidden="true">
                                                    <option value="0">Select</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6 pr5">
                                                <input type="number" class="form-control form-control-sm" id="" name="" placeholder="Sale Fraction">
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
                                                <select class="js-example-basic-single form-control form-control-sm clients select2-hidden-accessible" name="client_id" id="client_id" onchange="new_client(this, 'client', '2','1','1', 'Customer/Receivables')" tabindex="-1" aria-hidden="true">
                                                    <option value="0">Select</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6 pr5">
                                                <label>Amount</label>
                                                <input type="number" class="form-control form-control-sm" id="" name="" placeholder="Sale Fraction">
                                            </div>
                                            <div class="form-group col-md-6 pr5">
                                                <select class="js-example-basic-single form-control form-control-sm clients select2-hidden-accessible" name="client_id" id="client_id" onchange="new_client(this, 'client', '2','1','1', 'Customer/Receivables')" tabindex="-1" aria-hidden="true">
                                                    <option value="0">Select</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6 pr5">
                                                <input type="number" class="form-control form-control-sm" id="" name="" placeholder="Sale Fraction">
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
                                                <input type="text" class="form-control form-control-sm t_psfp" placeholder="Total Amount Exc Charges" name="">
                                            </div>
                                            <div class="form-group col-md-12 pr5">
                                                <input type="text" class="form-control form-control-sm t_psfp" placeholder="Sale Tax" name="">
                                            </div>
                                            <div class="form-group col-md-12 pr5">
                                                <input type="text" class="form-control form-control-sm t_psfp" placeholder="Gross Amount" name="">
                                            </div>
                                            <div class="form-group col-md-12 pr5">
                                                <input type="text" class="form-control form-control-sm t_psfp" placeholder="Add Charges" name="">
                                            </div>
                                            <div class="form-group col-md-12 pr5">
                                                <input type="text" class="form-control form-control-sm t_psfp" placeholder="Less Charges" name="">
                                            </div>
                                            <div class="form-group col-md-12 pr5">
                                                <input type="text" class="form-control form-control-sm t_psfp" placeholder="Dealer Discount" name="">
                                            </div>
                                            <div class="form-group col-md-12 pr5">
                                                <input type="text" class="form-control form-control-sm t_psfp" placeholder="Net Amount" name="">
                                            </div>
                                            <div class="form-group col-md-12 pr5">
                                                <button type="button" class="btn btn-mini btn-success">Save</button>
                                                <button type="button" class="btn btn-mini btn-danger">Cancel</button>
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