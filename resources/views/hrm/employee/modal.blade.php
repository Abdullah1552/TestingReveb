<div class="modal" id="new-sub_head">
    <div class="modal-dialog">
        <form id="employee-form" method="post"  enctype="multipart/form-data" >
            @CSRF
            <input type="hidden" name="id" value="0">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h5 class="modal-title">Add Employee</h5>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <div class="row">
                       <div class="col-md-12">
                           <div class="form-group col-md-4 pf">
                               <label for="inputdefault">Name *<sup class="text-danger">*</sup></label>
                               <input  class="form-control form-control-sm" id="" name="name" type="text">
                           </div>
                           <div class="form-group col-md-4 pf">
                               <label >Image</label>
                               <input  type="file" class="form-control form-control-sm"  name="emp_photo">
                           </div>

                           <div class="form-group col-md-4 pf">

                               <label for="inputdefault">Department</label>
                               <select class="form-control form-control-sm js-example-basic-single" id="" name="dep_id">
                                   <option value="">Select Department *</option>
                                  {!! App\Models\Hrm\Department::dropdown() !!}

                               </select>
                           </div>
                       </div>
                    </div>
                 <div class="row">
                     <div class="col-md-12">
                         <div class="form-group col-md-4 pf">
                             <label for="inputdefault">Email *</label>
                             <input class="form-control form-control-sm " autocomplete="off" id="" name="email" type="text">
                         </div>
                         <div class="form-group col-md-4 pf">
                             <label for="inputdefault">Address</label>
                             <input class="form-control form-control-sm" id="" name="emp_address" type="text">
                         </div>

                         <div class="form-group col-md-4 pf">
                             <label for="inputdefault">Phone Number<sup class="text-danger">*</sup></label>
                             <input class="form-control form-control-sm" id="" name="phone" type="text">
                         </div>
                     </div>
                 </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group col-md-4 pf">
                            <label for="inputdefault">Country</label>
                            <select class="form-control form-control-sm js-example-basic-single" id="" name="country_id">
                                <option value="0">Select Country</option>
                                <option value="1">pakistan</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4 pf">
                            <label for="inputdefault">City</label>
                            <select class="form-control form-control-sm js-example-basic-single" id="" name="city_id">
                                <option value="0">Select City</option>
                                <option value="1">Lahore</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group m-t-25">
                                <label for="inputdefault">Add User</label>
                                <input class="" id="add-user"  type="checkbox">
                            </div>
                        </div>
                    </div>
                </div>
                    <div id="user-login">
                    <div class="form-group col-md-12 pf">
                        <label for="inputdefault">UserName *<sup class="text-danger">*</sup></label>
                        <input class="form-control form-control-sm" id="" name="user_email" type="text">
                    </div>
                    <div class="form-group col-md-12 pf">
                        <label for="inputdefault">Password *</label>
                        <input class="form-control form-control-sm" id="" name="password" type="text">
                    </div>
                    </div>
                    <div class="form-group col-md-12 pf">
                        <label for="inputdefault">Role *</label>
                        <select class="form-control form-control-sm js-example-basic-single" id="" name="role_id">
                            <option value="">Select Role</option>
                            <option value="1">Test Role</option>
                        </select>
                    </div>
                    <!-- Modal footer -->
                    <div class="clearfix"></div>
                    <div class="modal-footer">
                        <button type="submit"  class="btn btn-success">Submit</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </div>

            </div>
        </form>
    </div>

</div>
