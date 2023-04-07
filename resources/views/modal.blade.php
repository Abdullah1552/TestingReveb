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
                <div class="modal-header refEdit" style="background: rgb(26, 168, 157);">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">×</span> </button>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-right:10px;"> <span aria-hidden="true">−</span> </button>
                    <h5 class="modal-title">ITEM DETAILS</h5>
                </div>
                <!-- end of modal-header -->
                <div class="modal-body plr30">
                    <div class="row">
                        <div class="form-group col-md-3 pf">
                            <label for="inputdefault">Item Name <sup class="text-danger">*</sup></label>
                            <input class="form-control form-control-sm" id="" name="inv_date" type="text"  value="" placeholder="Item Name">
                        </div>
                        <div class="form-group col-md-1 pf">
                            <label for="inputdefault">Article No: <sup class="text-danger">*</sup></label>
                            <input class="form-control form-control-sm" id="" name="inv_date" type="text"  value="" placeholder="Item Name">
                        </div>
                        <div class="form-group col-md-1 pf">
                            <label>Brand <sup class="text-danger">*</sup></label>
                            <select class="js-example-basic-single form-control form-control-sm clients select2-hidden-accessible" name="client_id" id="client_id" onchange="new_client(this, 'client', '2','1','1', 'Customer/Receivables')" tabindex="-1" aria-hidden="true">
                                <option value="0">Select Brand</option>
                            </select>
                        </div>
                        <div class="form-group col-md-1 pf">
                            <label for="inputdefault">Origin: <sup class="text-danger">*</sup></label>
                            <input class="form-control form-control-sm" name="" type="text"  value="" placeholder="Origin">
                        </div>
                        <div class="form-group col-md-1 pf">
                            <label for="inputdefault">Technology: <sup class="text-danger">*</sup></label>
                            <input class="form-control form-control-sm" name="" type="text"  value="" placeholder="Technology">
                        </div>
                        <div class="form-group col-md-1 pf">
                            <label for="inputdefault">Pack Size: <sup class="text-danger">*</sup></label>
                            <input class="form-control form-control-sm" name="" type="text"  value="" placeholder="Pack Size">
                        </div>
                        <div class="form-group col-md-1 pf">
                            <label for="inputdefault">UOM:<sup class="text-danger">*</sup></label>
                            <input class="form-control form-control-sm" name="" type="text"  value="" placeholder="UOM">
                        </div>
                        <div class="form-group col-md-1 pf">
                            <label for="inputdefault">Min QTY:</label>
                            <input class="form-control form-control-sm" name="" type="text" placeholder="Min Qty">
                        </div>
                        <div class="form-group col-md-1 pf">
                            <label for="inputdefault">Max QTY:</label>
                            <input class="form-control form-control-sm" name="" type="text" placeholder="Min Qty">
                        </div>
                        <div class="form-group col-md-1 pf">
                            <label for="inputdefault">Hold QTY:</label>
                            <input class="form-control form-control-sm" name="" type="text" placeholder="Min Qty">
                        </div>
                        <div class="form-group col-md-1 pf">
                            <label for="inputdefault">Booked QTY:</label>
                            <input class="form-control form-control-sm" name="" type="text" placeholder="Min Qty">
                        </div>
                        <div class="form-group col-md-1 pf">
                            <label>Item Type </label>
                            <select class="js-example-basic-single form-control form-control-sm clients select2-hidden-accessible" name="client_id" id="client_id" onchange="new_client(this, 'client', '2','1','1', 'Customer/Receivables')" tabindex="-1" aria-hidden="true">
                                <option value="0">Select Type</option>
                            </select>
                        </div>
                        <div class="form-group col-md-1 pf">
                            <label>Maintain Inventory: </label>
                            <select class="js-example-basic-single form-control form-control-sm clients select2-hidden-accessible" name="client_id" id="client_id" onchange="new_client(this, 'client', '2','1','1', 'Customer/Receivables')" tabindex="-1" aria-hidden="true">
                                <option value="0">Yes</option>
                                <option value="0">No</option>
                            </select>
                        </div>
                        <div class="form-group col-md-1 pf">
                            <label for="inputdefault">Lead Time:</label>
                            <input class="form-control form-control-sm" name="" type="text" placeholder="Lead Time">
                        </div>
                        <div class="form-group col-md-1 pf">
                            <label for="inputdefault">Dealer Margin:</label>
                            <input class="form-control form-control-sm" name="" type="text" placeholder="Dealer Margin">
                        </div>
                        <div class="clearfix"></div>
                        <!-- Form Control starts -->
                        <div class="col-md-4 pf">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-header text-primary">
                                            <h5 class="card-header-text refText" style="color: rgb(26, 168, 157);">Sale Details:</h5>
                                        </div>
                                        <div class="card-block">
                                            <div class="form-group col-md-12 pr5">
                                                <label>Sale Unit</label>
                                                <input type="number" class="form-control form-control-sm" id="" name="" placeholder="Sale Unit">
                                            </div>
                                            <div class="form-group col-md-12 pr5">
                                                <label>Sales Fraction</label>
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
                        <div class="col-md-4 pf">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-header text-primary">
                                            <h5 class="card-header-text refText" style="color: rgb(26, 168, 157);">PURCHASE DETAILS:</h5>
                                        </div>
                                        <div class="card-block">
                                            <div class="form-group col-md-12 pr5">
                                                <label>Purchase Unit</label>
                                                <input type="number" class="form-control form-control-sm" id="" name="" placeholder="Sale Unit">
                                            </div>
                                            <div class="form-group col-md-12 pr5">
                                                <label>Purchase Fraction</label>
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
                        <div class="col-md-4 pf">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-header text-primary">
                                            <h5 class="card-header-text refText" style="color: rgb(26, 168, 157);">GST Details</h5>
                                        </div>
                                        <div class="card-block">
                                            <div class="form-group col-md-6 pr5">
                                                <label>Price Exc GST</label>
                                                <input type="text" class="form-control form-control-sm t_psfp" placeholder="0.00 %" name="">
                                            </div>
                                            <div class="form-group col-md-6 pr5">
                                                <label>Sale Tax %</label>
                                                <input type="number" class="form-control form-control-sm row t_psf" name="psf" onchange="t_psf(this)">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>Price INC GST</label>
                                                <input type="number" class="form-control form-control-sm t_disp" placeholder="%" name="discountp" onchange="t_disp(this)">
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
                        <div class="form-group col-md-1 pf">
                            <label>GL Sale </label>
                            <select class="js-example-basic-single form-control form-control-sm clients select2-hidden-accessible" name="client_id" id="client_id" onchange="new_client(this, 'client', '2','1','1', 'Customer/Receivables')" tabindex="-1" aria-hidden="true">
                                <option value="0">Select A/C</option>
                            </select>
                        </div>
                        <div class="form-group col-md-1 pf">
                            <label>GL Purchase </label>
                            <select class="js-example-basic-single form-control form-control-sm clients select2-hidden-accessible" name="client_id" id="client_id" onchange="new_client(this, 'client', '2','1','1', 'Customer/Receivables')" tabindex="-1" aria-hidden="true">
                                <option value="0">Select A/C</option>
                            </select>
                        </div>
                        <div class="form-group col-md-1 pf">
                            <label>GL Discount </label>
                            <select class="js-example-basic-single form-control form-control-sm clients select2-hidden-accessible" name="client_id" id="client_id" onchange="new_client(this, 'client', '2','1','1', 'Customer/Receivables')" tabindex="-1" aria-hidden="true">
                                <option value="0">Select A/C</option>
                            </select>
                        </div>
                        <div class="form-group col-md-1 pf">
                            <label>GL Sale Tax </label>
                            <select class="js-example-basic-single form-control form-control-sm clients select2-hidden-accessible" name="client_id" id="client_id" onchange="new_client(this, 'client', '2','1','1', 'Customer/Receivables')" tabindex="-1" aria-hidden="true">
                                <option value="0">Select A/C</option>
                            </select>
                        </div>
                        <div class="col-md-2"></div>
                        <div class="col-md-4 pf pull-right">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-header text-primary">
                                            <h5 class="card-header-text refText" style="color: rgb(26, 168, 157);">Net Sale</h5>
                                        </div>
                                        <div class="card-block">
                                            <div class="form-group col-md-6 pr5">
                                                <label>Total Received:</label>
                                                <input type="number" class="form-control form-control-sm t_payable" name="payable_amount">
                                            </div>
                                            <div class="form-group col-md-6 pl5">
                                                <label>Total Issued</label>
                                                <input type="number" class="form-control form-control-sm t_receiveable" name="receiveable_amount" onchange="t_psf_rec(this)">
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label>Balance</label>
                                                <input type="number" class="form-control form-control-sm tprofit" name="profit">
                                            </div>
                                            <div class="form-group col-md-12">
                                                <button type="button" class="btn btn-mini btn-success save-rec" onclick="save_invoice('ticket', 'ticket-form')"><i class="fa fa-save"></i> Save</button>
                                            </div>
                                            <div class="form-group col-md-12" id="refundDiv" style="display:none;"> </div>
                                        </div>
                                    </div>
                                    <!--card-->
                                </div>
                                <!--col-md-12-->
                            </div>
                            <!--row-->
                        </div>
                        <!-- Form Control ends -->
                    </div>
                </div>
                <!-- end of modal-body -->
            </form>
        </div>
        <!-- end of modal-content -->
    </div>
    <!-- end of modal-dialog -->
</div>