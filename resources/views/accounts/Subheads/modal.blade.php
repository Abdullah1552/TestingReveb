<div class="modal" id="new-sub_head">
    <div class="modal-dialog">
        <form action="{{ route('subheads.store') }}" method="post">
            @CSRF
            <input type="hidden" name="id" value="0">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h5 class="modal-title">Add New Subhead A/C</h5>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <div class="col-md-12 pad0">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Root A/C <sup class="text-danger">*</sup></label>
                                <select name="RID" id="fetch_head_acc" class="js-example-basic-single form-control form-control-sm">
                                    <option value="0">Select Root A/C</option>
                                   {!! App\Models\RootAccount::rootList() !!}
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Head A/C <sup class="text-danger">*</sup></label>
                                <select name="HID" id="show_head_acc" class="js-example-basic-single form-control form-control-sm">
                                    <option value="0">Select Head A/C</option>
                                    {!! App\Models\HeadAccount::headAccList() !!}
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Sub Head Name <sup class="text-danger">*</sup></label>
                                <input type="text" class="form-control form-control-sm" name="Sub_Head_Name" style="border-bottom: 1px solid rgba(0, 0, 0, 0.15);">
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Submit</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>
        </form>
    </div>
</div>