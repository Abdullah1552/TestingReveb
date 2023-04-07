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
    <div class="modal-dialog modal-md modal-sm" role="document" style="width: 80%">
        <div class="modal-content">
            <div class="modal-header refEdit">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                <h5 class="modal-title">Create Payment Voucher</h5>
            </div>
            <!-- end of modal-header -->
            <div class="modal-body">
                <div id="clone_rv" style="display: none;">
                    <div class="multi_rv">
                        <div class="form-group col-md-2">
                            <select class="js-example-basic-single form-control form-control-sm all_accounts" name="payment_to[]">
                                <option value="0">Select A/C</option>
                                {!! App\Models\TransAccount::bank_cash() !!}
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <textarea type="text" class="form-control form-control-sm particulars" name="particulars[]" placeholder="Particulars"></textarea>
                        </div>
                        <div class="form-group col-md-2">
                            <input type="text" class="form-control form-control-sm multi_rv_list" name="paid_amount[]" placeholder="Paid Amount">
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <form id="payment-form">
                    <input type="hidden" name="trans_code" value="0">
                    <div class="row">
                        <div class="form-group col-md-2 pf">
                            <label for="inputdefault">Transaction Date <sup class="text-danger">*</sup></label>
                            <input class="form-control form-control-sm date" id="rvm_trans_date" name="trans_date" type="text" autocomplete="off" value="{{ date('Y-m-d') }}">
                        </div>
                        <div class="form-group col-md-2 pf">
                            <label for="inputdefault">Posting Date <sup class="text-danger">*</sup></label>
                            <input class="form-control form-control-sm date" name="posting_date" type="text" autocomplete="off" value="{{ date('Y-m-d') }}">
                        </div>
                        <div class="form-group col-md-4 pf">
                            <label>Select Bank/Cash <sup class="text-danger">*</sup></label>
                            <select class="js-example-basic-single form-control form-control-sm bank_cash" name="payment_from" id="rvm_client_id">
                                <option value="0">Select A/C</option>
                                {!! App\Models\TransAccount::bank_cash() !!}
                            </select>
                        </div>
                        <div class="form-group col-md-2 pf">
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
                        <div class="def_rv">
                            <div class="multi_rv">
                                <div class="form-group col-md-4">
                                    <label>Select A/C</label>
                                    <select class="js-example-basic-single form-control form-control-sm all_accounts" name="payment_to[]">
                                        <option value="0">Select A/C</option>
                                        {!! App\Models\TransAccount::dropdown() !!}
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Particulars <sup class="text-danger">*</sup></label>
                                    <textarea type="text" class="form-control form-control-sm particulars" id="" name="particulars[]" placeholder="Particulars"></textarea>
                                </div>
                                <div class="form-group col-md-2">
                                    <label>Paid Amount <sup class="text-danger">*</sup></label>
                                    <input type="text" class="form-control form-control-sm multi_rv_list" id="rvm_receive_amount" name="paid_amount[]" placeholder="Paid Amount">
                                </div>
                                {{--<div class="form-group col-md-1">--}}
                                    {{--<button style="margin-top:20px;" type="button" onClick="multi_rvm(this)" class="btn btn-mini btn-info"><i class="fa fa-plus"></i></button>--}}
                                {{--</div>--}}
                            </div>
                        </div>
                        <div id="multi_rv"></div>
                        <div class="form-group col-md-2">
                            <label>Cheque#</label>
                            <input type="text" placeholder="e.g. Cheque No" class="form-control form-control-sm" name="ref_no">
                        </div>
                        {{--<div class="form-group col-md-2">--}}
                            {{--<label>Currency Type</label>--}}
                            {{--<select class="form-control form-control-sm" name="cur_type">--}}
                                {{--<option value="0">Currency Type</option>--}}
                            {{--</select>--}}
                        {{--</div>--}}
                        {{--<div class="form-group col-md-2">--}}
                            {{--<label>Conversion Rate</label>--}}
                            {{--<input type="text" placeholder="Currency Conversion" class="form-control form-control-sm" name="conversion_rate" id="cur_rate">--}}
                        {{--</div>--}}
                        {{--<div class="form-group col-md-2">--}}
                            {{--<label>Conversion Total</label>--}}
                            {{--<input type="text" placeholder="Conversion Rate" class="form-control form-control-sm total_conv" name="conversion_rate" id="cur_total">--}}
                        {{--</div>--}}
                        {{--<div class="form-group col-md-2">--}}
                            {{--<label>Manaul Pv#</label>--}}
                            {{--<input type="text" placeholder="Manual Pv No" class="form-control form-control-sm" name="manual_pv">--}}
                        {{--</div>--}}
                        <div class="form-grop col-md-4" style="margin-top: 25px;">
                            <button type="button" class="btn btn-mini btn-success pull-right" onClick="save_rec()">
                                <i class="fa fa-save"></i> Save</button>
                        </div4
                        <div class="clearfix"></div>
                        <!--<div class="form-group col-md-9">
                            <input type="text" placeholder="Narration" class="form-control form-control-sm" name="narration">
                        </div>-->
                        <div class="form-grop col-md-6">
                            <strong>Total Amount:
                                <span id="total_receipt_amount"></span>
                            </strong>
                        </div>
                    </div>
                </form>
                </div>
            </div>
            <!-- end of modal-body -->
        </div>
    </div>
    <!-- end of modal-content -->
</div>
<!-- end of modal-dialog -->
</div>
<!-- end of modal -->