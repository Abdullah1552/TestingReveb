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
            width: 60%;
            max-width: 1300px;
        }
    }
    .col-md-1 {
        width: 12.333333% !important;
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
<div class="modal fade modal-flex" id="new" style="overflow:auto;">
    <div class="modal-dialog modal-md modal-sm" role="document" style="width: 80%;">
        <div class="modal-content">
            <div class="modal-header refEdit">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                <h5 class="modal-title">Create Journal Voucher</h5>
            </div>
            <!-- end of modal-header -->
            <div class="modal-body">
                <div id="clone_rv" style="display: none;">
                    <div class="multi_rv">
                        <div class="form-group col-md-2">
                            <select class="js-example-basic-single form-control form-control-sm" name="trans_acc[]">
                                <option value="0">Trans A/C</option>
                            </select>
                        </div>
                        <div class="form-group col-md-1">
                            <select class="form-control form-control-sm invoice_list" onChange="multi_rv(this)" name="inv_id[]">
                                <option value="0">Select Invoice</option>
                            </select>
                        </div>
                        <!-- <div class="form-group col-md-3">
                                <input type="text" class="form-control form-control-sm prev_balance" name="prev_balance[]">
                              </div>-->
                        <div class="form-group col-md-4">
                            <textarea class="form-control form-control-sm" name="narration[]" placeholder="Narration"></textarea>
                        </div>
                        <div class="form-group col-md-1">
                            <input type="text" class="form-control form-control-sm multi_rv_list" id="rvm_receive_amount" name="dr_amount[]" placeholder="Dr Amount">
                        </div>
                        <div class="form-group col-md-1">
                            <input type="text" class="form-control form-control-sm multi_rv_list_cr" id="rvm_receive_amount" name="cr_amount[]" placeholder="Cr Amount">
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <form id="jv-form">
                    <input type="hidden" name="trans_code" value="0">
                    <div class="row">
                        <div class="form-group col-md-3 pf">
                            <label for="inputdefault">Transaction Date <sup class="text-danger">*</sup></label>
                            <input class="form-control form-control-sm date" id="rvm_trans_date" name="trans_date" type="text" autocomplete="off" value="">
                        </div>
                        <div class="form-group col-md-3 pf">
                            <label for="inputdefault">Posting Date <sup class="text-danger">*</sup></label>
                            <input class="form-control form-control-sm date" id="rvm_trans_date" name="posting_date" type="text" autocomplete="off" value="">
                        </div>
                        <div class="form-group col-md-3 pf">
                            <label>Branch</label>
                            <select class="form-control form-control-sm" name="branch_id" onChange="fetch_all_acc(this)">

                            </select>
                        </div>
                    <!--<div class="form-group col-md-3 pf">
              <label>Payment From <sup class="text-danger">*</sup></label>
              <select class="js-example-basic-single form-control form-control-sm all_accounts" name="payment_from" id="rvm_client_id" onChange="get_client_inv_list(this.value)">
                <option value="0">Select A/C</option>

                            </select>
                          </div>-->
                        <div class="form-group col-md-3 pf">
                            <label>Payment Type</label>
                            <select class="form-control form-control-sm" name="payment_type">
                                <option value="1">Cash</option>
                                <option value="2">Cheque</option>
                                <option value="3">Online</option>
                                <option value="4">Other</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <!--<div class="clearfix"></div>-->
                        <div class="multi_rv">
                       <div class="form-group col-md-2">
                <label>Trans A/C</label>
                <select class="js-example-basic-single form-control form-control-sm all_accounts" name="trans_acc[]">
                  <option value="0">Select A/C</option>
                                </select>
                                </div>
                              <div class="form-group col-md-1">
                                <label>Invoices List</label>
                                <select class="row form-control form-control-sm invoice_list" onChange="multi_rv(this)" name="inv_id[]">
                  <option value="0">Select Invoice</option>
                </select>
              </div>
              <div class="form-group col-md-4">
                <label style="font-size: 10px;">
                Narration <sup class="text-danger">*</sup></label>
				  <textarea  class="form-control form-control-sm " name="narration[]" placeholder="Narration"></textarea>
              </div>
              <div class="form-group col-md-1">
                <label style="font-size: 10px;">
                Dr Amount <sup class="text-danger">*</sup></label>
                <input type="text" class="form-control form-control-sm multi_rv_list" name="dr_amount[]" placeholder="Dr Amount">
              </div>
              <div class="form-group col-md-1">
                <label style="font-size: 10px;">
                Cr Amount <sup class="text-danger">*</sup></label>
                <input type="text" class="form-control form-control-sm multi_rv_list_cr" name="cr_amount[]" placeholder="Cr Amount">
              </div>
              <div class="form-group col-md-1">
              	<button style="margin-top:20px;" type="button" onclick="multi_rvm(this)" class="btn btn-mini btn-info"><i class="fa fa-plus"></i></button>
              </div>
                        </div>
                        <div class="clearfix"></div>
                        <div id="multi_rv"></div>
                        <div class="form-group col-md-3"></div>
                        <div class="form-group col-md-3 pf"></div>
                        <div class="form-group col-md-1" style="text-align: right">
                            <label>Total:</label>
                        </div>
                        <div class="form-group col-md-1">
                            <input type="text" class="form-control form-control-sm" id="total_dr" placeholder="Total Dr" style="font-weight: bold;" name="tdr">
                        </div>
                        <div class="form-group col-md-1">
                            <input type="text" class="form-control form-control-sm" id="total_cr" placeholder="Total Cr" style="font-weight: bold" name="tcr">
                        </div>
                        <div class="clearfix"></div>
                        <div class="form-group col-md-1">
                            <label>Cheque#</label>
                            <input type="text" placeholder="Cheque#" class="form-control form-control-sm" name="ref_no">
                        </div>
                        <div class="form-group col-md-2 pf">
                            <label>Currency Type</label>
                            <select class="form-control form-control-sm" name="cur_type">
                                <option value="0">Currency Type</option>

                            </select>
                        </div>
                        <div class="form-group col-md-2">
                            <label>Conv Rate</label>
                            <input type="text" placeholder="Currency Rate" class="form-control form-control-sm" name="conversion_rate" onKeyUp="get_oc_total()" id="cur_rate" value="0">
                        </div>
                        <div class="form-group col-md-2">
                            <label>OC Dr Total</label>
                            <input type="text" placeholder="Currency Credit" class="form-control form-control-sm" name="conversion_rate" id="o_tdr">
                        </div>
                        <div class="form-group col-md-2">
                            <label>OC Cr Total</label>
                            <input type="text" placeholder="Currency Debit" class="form-control form-control-sm" name="conversion_rate" id="o_tcr">
                        </div>
                        <div class="form-group col-md-2">
                            <label>Manual Jv#</label>
                            <input type="text" placeholder="Manual JV No" class="form-control form-control-sm" name="manual_jv">
                        </div>
                        <div class="clearfix"></div>
                        <!--<div class="form-grop col-md-6"> <strong>Total Received Amount: <span id="total_receipt_amount"></span> </strong> </div>-->
                        <div class="form-grop col-md-12">
                            <button type="button" class="btn btn-mini btn-success pull-right" onClick="save_jv_voucher()"> <i class="fa fa-save"></i> Save</button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- end of modal-body -->
        </div>
    </div>
    <!-- end of modal-content -->
</div>
<!-- end of modal-dialog -->
</div>
<!-- end of modal -->