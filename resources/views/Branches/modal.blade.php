<div class="modal" id="new-sub_head">
    <div class="modal-dialog">
        <form id="branch-form">
            @CSRF
            <input type="hidden" name="id" value="0">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h5 class="modal-title">Branch Details</h5>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <div class="form-group col-md-6 pf">
                        <label for="inputdefault">Branch Name <sup class="text-danger">*</sup></label>
                        <input class="form-control form-control-sm" id="" name="BR_Name" type="text" placeholder="Branch Name">
                    </div>
                    <div class="form-group col-md-6 pf">
                        <label for="inputdefault">Email </label>
                        <input class="form-control form-control-sm" id="" name="BR_Email" type="text" placeholder="Email">
                    </div>
                    <div class="form-group col-md-6 pf">
                        <label for="inputdefault">Phone</label>
                        <input class="form-control form-control-sm" id="" name="BR_Phone" type="text" placeholder="Phone">
                    </div>
                    <div class="form-group col-md-6 pf">
                        <label for="inputdefault">City</label>
                        <select class="form-control form-control-sm js-example-basic-single" id="" name="CYID">
                            <option value="1">Select City</option>
                            {!! App\Models\City::cityList() !!}
                        </select>
                    </div>
                    <div class="form-group col-md-12 pf">
                        <input class="form-control form-control-sm" id="" name="BR_Address1" type="text" placeholder="Address 1">
                    </div>
                    <div class="form-group col-md-12 pf">
                        <input class="form-control form-control-sm" id="" name="BR_Address2" type="text" placeholder="Address 2">
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