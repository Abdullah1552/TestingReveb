<div class="modal" id="new-sub_head">
    <div class="modal-dialog">
        <form id="employee-form">
            @CSRF
            <input type="hidden" name="id" value="0">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h5 class="modal-title">Employee Details</h5>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <div class="form-group col-md-4 pf">
                        <label for="inputdefault">Employee Name <sup class="text-danger">*</sup></label>
                        <input class="form-control form-control-sm" id="" name="EMP_Name" type="text">
                    </div>
                    <div class="form-group col-md-4 pf">
                        <label for="inputdefault">Contact Person</label>
                        <input class="form-control form-control-sm" id="" name="EMP_Contact_Person" type="text">
                    </div>
                    <div class="form-group col-md-4 pf">
                        <label for="inputdefault">Designation</label>
                        <select class="form-control form-control-sm js-example-basic-single" id="" name="EMP_Designation">
                            <option value="">Select Designation</option>
                            {!! App\Models\Designation::dropdown() !!}
                        </select>
                    </div>
                    <div class="form-group col-md-4 pf">
                        <label for="inputdefault">Date Of Birth</label>
                        <input class="form-control form-control-sm date" autocomplete="off" id="" name="EMP_DOB" type="text">
                    </div>
                    <div class="form-group col-md-4 pf">
                        <label for="inputdefault">Phone</label>
                        <input class="form-control form-control-sm" id="" name="EMP_Phone" type="text">
                    </div>
                    <div class="form-group col-md-4 pf">
                        <label for="inputdefault">Mobile<sup class="text-danger">*</sup></label>
                        <input class="form-control form-control-sm" id="" name="EMP_Mobile" type="text">
                    </div>
                    <div class="form-group col-md-4 pf">
                        <label for="inputdefault">Email</label>
                        <input class="form-control form-control-sm" id="" name="EMP_Email" type="text">
                    </div>
                    <div class="form-group col-md-4 pf">
                        <label for="inputdefault">City</label>
                        <select class="form-control form-control-sm js-example-basic-single" id="" name="EMP_CYID">
                            <option value="0">Select City</option>
                            {!! App\Models\City::cityList() !!}
                        </select>
                    </div>
                    <div class="form-group col-md-4 pf">
                        <label for="inputdefault">A/C Type</label>
                        <select class="form-control form-control-sm js-example-basic-single" id="" name="PID">
                            <option value="0">Select A/c Type</option>
                            {!! App\Models\SubHead::AccountType() !!}
                        </select>
                    </div>
                    <div class="form-group col-md-4 pf">
                        <label for="inputdefault">OB Type</label>
                        <select class="form-control form-control-sm js-example-basic-single" id="" name="OB_Type">
                            <option value="1">Dr</option>
                            <option value="2">Cr</option>
                        </select>
                    </div>
                    <div class="form-group col-md-4 pf">
                        <label for="inputdefault">OB Amount</label>
                        <input class="form-control form-control-sm date" autocomplete="off" id="" name="OB" type="text">
                    </div>
                    <div class="clearfix"></div>
                    <div class="form-group col-md-12 pf">
                        <label for="inputdefault">Address 1<sup class="text-danger">*</sup></label>
                        <input class="form-control form-control-sm" id="" name="EMP_Address_1" type="text">
                    </div>
                    <div class="form-group col-md-12 pf">
                        <label for="inputdefault">Address 2</label>
                        <input class="form-control form-control-sm" id="" name="EMP_Address_2" type="text">
                    </div>
                    <div class="form-group col-md-12 pf">
                        <label for="inputdefault">Address 3</label>
                        <input class="form-control form-control-sm" id="" name="EMP_Address_3" type="text">
                    </div>
                    <!-- Modal footer -->
                    <div class="clearfix"></div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" onclick="save_rec()">Submit</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </div>

            </div>
        </form>
    </div>

</div>