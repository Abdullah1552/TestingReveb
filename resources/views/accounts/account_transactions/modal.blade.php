<div class="modal" id="new-sub_head">
    <div class="modal-dialog">
        <form id="trans-form">
            @CSRF
            <input type="hidden" name="id" value="0">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h5 class="modal-title">Add New Trans A/C</h5>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <div class="col-md-12 pad0">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Account Type <sup class="text-danger">*</sup></label>
                                <select name="PID" id="fetch_head_acc" class="js-example-basic-single form-control form-control-sm">
                                    <option value="">Select A/C Type</option>
                                    {!! App\Models\SubHead::AccountType() !!}
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="md-input-wrapper">
                                <input type="text" name="Trans_Acc_Name" class="md-form-control form-control-sm">
                                <label>Account Name</label>
                                <span class="md-line"></span></div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="col-sm-6">
                            <label>OB Type</label>
                            <select class="js-example-basic-single form-control form-control-sm"  name="OB_Type">
                                <option value="1">Debit</option>
                                <option value="2">Credit</option>
                            </select>
                        </div>
                        <div class="col-sm-6">
                            <div class="md-input-wrapper">
                                <input type="text" name="OB" class="md-form-control">
                                <label>Opening Balance</label>
                                <span class="md-line"></span>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" onclick="save_rec()">Submit</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>