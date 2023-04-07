<div class="modal" id="new-sub_head">
    <div class="modal-dialog">
        <form id="form">
            @CSRF
            <input type="hidden" name="id" value="0">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h5 class="modal-title">Product Attribute</h5>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <div class="col-md-12">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Attribute Name</label>
                                <input type="text" name="name" class="md-form-control form-control-sm" placeholder="Attribute Name e.g. Cloth, Size">
                                <span class="md-line"></span></div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Attribute Value</label>
                                <input type="text" name="attr_value" class="md-form-control form-control-sm" placeholder="Seprated with comma e.g. S,M,L">
                                <span class="md-line"></span></div>
                        </div>
                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" onclick="save_rec()" class="btn btn-success">Submit</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </form>

    </div>
</div>
