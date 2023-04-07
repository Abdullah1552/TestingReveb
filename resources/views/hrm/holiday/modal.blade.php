<div class="modal" id="new-sub_head">
    <div class="modal-dialog">
        <form id="holiday-form">
            @CSRF
            <input type="hidden" name="id" value="0">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h5 class="modal-title">Add Holiday</h5>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <div class="row">
                       <div class="col-md-12">
                           <div class="form-group col-md-6 pf">
                               <label for="inputdefault">From *</label>
                               <input class="form-control form-control-sm date" autocomplete="off" id="" name="from" type="text" placeholder="Enter Date">

                           </div>
                           <div class="form-group col-md-6 pf">
                               <label for="inputdefault">To *</label>
                               <input class="form-control form-control-sm date" autocomplete="off" id="" name="to" type="text" placeholder="Enter Date">

                           </div>
                           <div class="form-group col-md-12 pf">
                               <label for="inputdefault">Note</label>
                               <textarea class="form-control " id="" name="note"></textarea>
                           </div>

                       </div>
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
