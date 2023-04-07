<div class="modal" id="new-sub_head">
    <div class="modal-dialog">
        <form id="wherehouse-form">
            @CSRF
            <input type="hidden" name="id" value="0">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h5 class="modal-title">Add Location</h5>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <div class="form-group col-md-4 pf">
                        <label for="inputdefault">Name *</label>
                        <input class="form-control form-control-sm" id="" name="WH_Name" type="text">
                    </div>
                    <div class="form-group col-md-4 pf">
                        <label for="inputdefault">Phone Number *</label>
                        <input class="form-control form-control-sm" id="" name="WH_Mobile" type="text">
                    </div>
                    <div class="form-group col-md-4 pf">
                        <label for="inputdefault">Email <sup class="text-danger">*</sup></label>
                        <input class="form-control form-control-sm" id="" name="WH_Email" type="text">
                    </div>
                    <div class="clearfix"></div>
                    <div class="form-group col-md-12 pf">
                        <label for="inputdefault">Address <sup class="text-danger">*</sup></label>
                        <textarea class="form-control form-control-sm" id="" name="WH_Address"></textarea>
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
