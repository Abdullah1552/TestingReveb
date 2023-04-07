<div class="modal" id="wh-qty">
    <div class="modal-dialog modal-lg">
        <form id="city-form">
            @CSRF
            <input type="hidden" name="id" value="0">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h5 class="modal-title">Location Wise Quantity </h5>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                        <div class="tab-pane active" id="sale" role="tabpanel">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Category Name</th>
                                    <th>Product Name</th>
                                    <th>Product Code</th>
                                    <th>Location</th>
                                    <th>Available Quantity</th>
                                </tr>
                                </thead>
                                <tbody id="get_wh_qty"></tbody>
                            </table>
                        </div>
                    <!-- Modal footer -->
                    <div class="clearfix"></div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </div>

            </div>
        </form>
    </div>

</div>
