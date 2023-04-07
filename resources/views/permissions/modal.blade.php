<div class="modal" id="new">
    <div class="modal-dialog">
        <form id="form">
            @CSRF
            <input type="hidden" name="id" value="0">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h5 class="modal-title">Permission</h5>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <div class="form-group col-md-8 pf">
                        <label for="inputdefault">Permission Name</label>
                        <input class="form-control form-control-sm" id="" name="name" type="text" placeholder="Permission">
                    </div>
                    <div class="form-group col-md-4 pf">
                        <label for="inputdefault">Form</label>
                        <select class="form-control form-control-sm" id="" name="form">
                            <option value="0">No</option>
                            <option value="1">Yes</option>
                        </select>
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
