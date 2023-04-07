<div class="modal" id="new-sub_head">
    <div class="modal-dialog">
        <form id="area-form">
            @CSRF
            <input type="hidden" name="id" value="0">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h5 class="modal-title">Area Details</h5>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <div class="form-group col-md-4 pf">
                        <label for="inputdefault">City <sup class="text-danger">*</sup></label>
                        <select class="form-control form-control-sm js-example-basic-single" name="CYID">
                            <option value="">Select City</option>
                            {!! App\Models\City::cityList() !!}
                        </select>
                    </div>
                    <div class="form-group col-md-8 pf">
                        <label for="inputdefault">Area Name <sup class="text-danger">*</sup></label>
                        <input class="form-control form-control-sm" id="" name="AR_Name" type="text" placeholder="Area Name">
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