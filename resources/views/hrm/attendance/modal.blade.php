<div class="modal" id="new-sub_head">
    <div class="modal-dialog">
        <form id="">
            @CSRF
            <input type="hidden" name="id" value="0">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h5 class="modal-title">Add Attendance</h5>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <div class="row">
                       <div class="col-md-12">
                           <div class="form-group col-md-4 pf">
                               <label for="inputdefault">Employee *</label>
                           <select class="form-control form-control-sm js-example-basic-single" id="" name="PID">
                               <option value="0">Select Employee</option>
                           </select>
                           </div>
                           <div class="form-group col-md-4 pf">
                               <label for="inputdefault">Date *</label>
                               <input class="form-control form-control-sm dat" id="" name="EMP_Contact_Person" type="text">
                           </div>
                           <div class="form-group col-md-4 pf">
                               <label for="inputdefault">CheckIn *</label>
                               <input class="form-control form-control-sm dat" id="" name="EMP_Contact_Person" type="text">

                           </div>
                       </div>
                    </div>
                 <div class="row">
                     <div class="col-md-12">
                         <div class="form-group col-md-4 pf">
                             <label for="inputdefault">CheckOut *</label>
                             <input class="form-control form-control-sm " autocomplete="off" id="" name="EMP_DOB" type="text">
                         </div>
                         <div class="form-group col-md-4 pf">
                             <label for="inputdefault">Note</label>
                             <textarea class="form-control " id="" name="EMP_Phone"></textarea>
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
