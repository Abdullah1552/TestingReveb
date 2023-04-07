<div class="modal" id="new-sub_head">
    <div class="modal-dialog">
        <form id="cost_center-form" onSubmit="return false;">
            @CSRF
            <input type="hidden" name="id" value="0">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h5 class="modal-title">Customer Type Details</h5>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <div class="form-group col-md-12 pf">
                        <label for="inputdefault">Customer Type</label>
                        <input class="form-control form-control-sm" name="Customer_Type" type="text" placeholder="Customer Type">
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