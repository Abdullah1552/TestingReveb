
<div class="modal fade" id="upload-stock-modal">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header refEdit">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-right:10px;">
                    <span aria-hidden="true">−</span></button>
            </div>
            <!-- end of modal-header -->
            <div class="modal-body plr30 panel panel-default">
                <h3><b>Update Product's Stock to WooCommerce</b></h3>
                <ol style="font-size: 11px;font-size: 11px;background-color:rgba(0,255,21,0.2);border-color: rgba(0,255,21,0.2);color: #1c620b;font-weight: bolder;">
                    <li>POS Product's Stock will be upload to WooCommerce </li>
                    <li>it will only Update those product's stock that are already exist on Woocommerce</li>
                </ol>

                <div class="row" style="padding: 13px;">
                    <div class="form-group col-md-12">
                        <button type="button" class="btn btn-mini btn-white pull-right" data-dismiss="modal" aria-label="Close"><i class="fa fa-close" ></i> Close</button>
                        <button type="button" class="btn btn-mini btn-success save-rec pull-right" onclick="update_stock_sync()"><i class="fa fa-repeat"></i>Start Sync</button>
                    </div>
                </div>
            </div>
            <!-- end of modal-body -->
        </div>
        <!-- end of modal-content -->
    </div>
    <!-- end of modal-dialog -->
</div>
