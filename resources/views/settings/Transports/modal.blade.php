<div class="modal" id="new-sub_head">
    <div class="modal-dialog">
        <form id="transport-form">
            @CSRF
            <input type="hidden" name="id" value="0">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h5 class="modal-title">Transport Details</h5>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <div class="form-group col-md-4 pf">
                        <label for="inputdefault">Transport Name <sup class="text-danger">*</sup></label>
                        <input class="form-control form-control-sm" id="" name="TR_Name" type="text" placeholder="Transport Name">
                    </div>
                    <div class="form-group col-md-4 pf">
                        <label for="inputdefault">Mobile <sup class="text-danger">*</sup></label>
                        <input class="form-control form-control-sm" id="" name="TR_Mobile" type="text">
                    </div>
                    <div class="form-group col-md-4 pf">
                        <label for="inputdefault">Phone</label>
                        <input class="form-control form-control-sm" id="" name="TR_Phone" type="text">
                    </div>
                    <div class="form-group col-md-4 pf">
                        <label for="inputdefault">City <sup class="text-danger">*</sup></label>
                        <select class="form-control form-control-sm js-example-basic-single" id="" name="CYID">
                            <option value="">Select City</option>
                            {!! App\Models\City::cityList() !!}
                        </select>
                    </div>
                    <div class="form-group col-md-4 pf">
                        <label for="inputdefault">National Tax No</label>
                        <input class="form-control form-control-sm" id="" name="TR_National_Tax" type="text">
                    </div>
                    <div class="form-group col-md-4 pf">
                        <label for="inputdefault">Sale Tax Reg.No</label>
                        <input class="form-control form-control-sm" id="" name="TR_Sale_Tax" type="text">
                    </div>
                    <div class="form-group col-md-4 pf">
                        <label for="inputdefault">A/C Type <sup class="text-danger">*</sup></label>
                        <select class="form-control form-control-sm js-example-basic-single" name="PID">
                            <option value="">Select</option>
                            {!! App\Models\SubHead::AccountType() !!}
                        </select>
                    </div>
                    <div class="form-group col-md-8 pf">
                        <label for="inputdefault">Address 1<sup class="text-danger">*</sup></label>
                        <input class="form-control form-control-sm" id="" name="TR_Adress1" type="text">
                    </div>
                    <div class="form-group col-md-12 pf">
                        <label for="inputdefault">Address 2<sup class="text-danger">*</sup></label>
                        <input class="form-control form-control-sm" id="" name="TR_Adress2" type="text">
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