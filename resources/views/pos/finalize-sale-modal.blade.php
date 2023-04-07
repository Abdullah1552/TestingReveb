<div class="modal" id="finalize-sale">
    <div class="modal-dialog">
        <form id="city-form">
            @CSRF
            <input type="hidden" name="id" value="0">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h5 class="modal-title">Finalize Sale</h5>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Received Amount</label>
                                <input type="text" class="form-control form-control-sm" placeholder="0.00">
                            </div>
                        </div>
                        <!--col-->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Paying Amount</label>
                                <input type="text" class="form-control form-control-sm" placeholder="0.00">
                            </div>
                        </div>
                        <!--col-->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Change</label>
                                <input readonly type="text" class="form-control form-control-sm" placeholder="0.00">
                            </div>
                        </div>
                        <!--col-->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Paid By</label>
                                <select class="form-control form-control-sm select2">
                                    <option value="">Credit Card</option>
                                </select>
                            </div>
                        </div>
                        <!--col-->
                        <div class="col-md-4">
                        <div class="form-group row">
                            <label>Credit Card</label>
                            <div class="col-md-12">
                                <div class="input-group input-group-sm">
                                    <span class="input-group-addon" id="alighaddon1"><i class="fa fa-credit-card"></i> </span>
                                    <input type="text" class="form-control form-control-sm" placeholder="Credit Card">
                                </div>
                            </div>
                        </div>
                        </div>
                        <!--col-->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>CVV</label>
                                <input type="text" class="form-control form-control-sm" placeholder="MM/YY/CVC">
                            </div>
                        </div>
                        <!--col-->
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Payment Note</label>
                                <textarea rows="2" class="form-control"></textarea>
                            </div>
                        </div>
                        <!--col-->
                    </div>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label>Sale Note</label>
                            <textarea rows="3" class="form-control" name="sale_note"></textarea>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Staff Note</label>
                            <textarea rows="3" class="form-control" name="staff_note"></textarea>
                        </div>
                    </div>
                    <!-- Modal footer -->
                    <div class="clearfix"></div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" data-dismiss="modal">Submit</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </div>

            </div>
        </form>
    </div>

</div>