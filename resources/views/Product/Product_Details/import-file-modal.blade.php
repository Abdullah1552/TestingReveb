<div class="modal" id="import-file">
    <div class="modal-dialog">
        <form id="bulk-form">
            @CSRF
            <input type="hidden" name="id" value="0">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h5 class="modal-title">Product Category</h5>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Import file</label>
                                <input type="file" name="import_file" class="md-form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <a href="{{ URL::asset('public/excel_sample/category.xlsx') }}" download="" class="btn btn-primary waves-effect waves-light form-control m-t-25" data-toggle="tooltip" data-placement="top" title="" data-original-title=".icofont-bubble-left">
                                    <i class="icofont icofont-bubble-down"></i><span class="m-l-10">Download Sample File</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Submit</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </form>

    </div>
</div>
