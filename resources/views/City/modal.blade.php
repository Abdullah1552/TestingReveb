<div class="modal" id="new-sub_head">
    <div class="modal-dialog">
        <form id="city-form">
            @CSRF
            <input type="hidden" name="id" value="0">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h5 class="modal-title">City Details</h5>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <div class="form-group col-md-4 pf">
                        <label for="inputdefault">Country <sup class="text-danger">*</sup></label>
                        <select class="form-control form-control-sm js-example-basic-single">
                            <option value="">Select Country</option>
                            {!! App\Models\Country::CT_List() !!}
                        </select>
                    </div>
                    <div class="form-group col-md-4 pf">
                        <label for="inputdefault">Zone <sup class="text-danger">*</sup></label>
                        <select class="form-control form-control-sm js-example-basic-single" id="" name="ZID">
                            <option value="">Select Zone</option>
                            {!! App\Models\Zone::zoneList() !!}
                        </select>
                    </div>
                    <div class="form-group col-md-12 pf">
                        <label for="inputdefault">City Name<sup class="text-danger">*</sup></label>
                        <input type="text" class="form-control form-control-sm" name="CY_Name">
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