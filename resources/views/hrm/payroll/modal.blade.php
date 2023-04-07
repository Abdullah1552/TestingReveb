<div class="modal" id="new-sub_head">
    <div class="modal-dialog">
        <form id="payroll">
            @CSRF
            <input type="hidden" name="id" value="0">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h5 class="modal-title">Add Payroll</h5>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group col-md-6 pf">
                                <label for="inputdefault">Empolyee *</label>
                                <select class="form-control form-control-sm js-example-basic-single" id="" name="employee_id">
                                    <option value="">Select Employee</option>
                                    {!! App\Models\Employee::dropdown() !!}
                                </select>
                            </div>
                            <div class="form-group col-md-6 pf">
                                <label for="inputdefault">Salary From Account *</label>
                                <select class="form-control form-control-sm js-example-basic-single" id="" name="salary_from_acc">
                                    <option value="sales">Sales Account[11111]</option>
                                </select>
                            </div>
                        </div>
                    </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group col-md-6 pf">
                                    <label for="inputdefault">Payment Method *</label>
                                    <select class="form-control form-control-sm js-example-basic-single" id="" name="payment_method">
                                        <option value="cash">Cash</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6 pf">
                                    <label for="inputdefault">Basic Salary *</label>
                                    <input class="form-control" autocomplete="off" id="" name="basic_salary" type="text">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group col-md-6 pf">
                                    <label for="inputdefault">Allowances</label>
                                    <input class="form-control" autocomplete="off" id="" name="allowances" type="text" placeholder="0.00">
                                </div>
                                <div class="form-group col-md-6 pf">
                                    <label for="inputdefault">Deductions</label>
                                    <input class="form-control" autocomplete="off" id="" name="deductions" type="text" placeholder="0.00">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group col-md-12 pf">
                                    <label for="inputdefault">Net Salary</label>
                                    <input class="form-control" autocomplete="off" id="" name="net_salary" type="text" placeholder="0.00">
                                </div>
                            </div>
                        </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group col-md-12 pf">
                                <label for="inputdefault">Remarks</label>
                                <textarea class="form-control" autocomplete="off" id="" name="remarks"></textarea>
                            </div>
                        </div>
                    </div>


                    </div>
                    <!-- Modal footer -->
                    <div class="clearfix"></div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" onclick="save_rec()">Submit</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </div>

        </form>
    </div>
</div>

</div>
