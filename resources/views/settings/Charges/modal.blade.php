<div class="modal" id="new-sub_head">
    <div class="modal-dialog">
        <form id="charges-form">
            @CSRF
            <input type="hidden" name="id" value="0">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h5 class="modal-title">Charges Details</h5>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <div class="col-md-12 pad0">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Charges Name</label>
                                <input type="text" name="Ch_Name" class="md-form-control form-control-sm" placeholder="Charges Name">
                                <span class="md-line"></span></div>
                        </div>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" onclick="save_rec()" class="btn btn-success">Submit</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>
        </form>
    </div>
</div>