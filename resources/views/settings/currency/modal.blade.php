<style>
    .modal-body {
        max-height: 100%;
    }
    .modal-header {
        padding: 5px;
        border: 0px;
    }
    .modal-content {
        background: #eee !important;
    }
    .form-group {
        margin-bottom: 0.3rem !important;
    }

    @media (min-width: 992px) {
        .modal-md {
            width: 100%;
            max-width: 1300px;
        }
    }
    .col-md-1 {
        width: 12.333333% !important;
    }
    .pf {
        padding-left: 5px !important;
        padding-right: 5px !important;
    }
    label {
        display: contents !important;
        color: #050505;
    }
    .table input[type="text"] {
        width: 100%;
        padding: 0px;
        font-size: 13px;
        text-transform: uppercase;
    }
    label {
        display: contents !important;
        color: #050505;
    }
    .card-header, .card-block {
        padding: 5px !important;
    }
    .card {
        margin-bottom: 5px !important;
    }
</style>
<div class="modal" id="new-sub_head">
    <div class="modal-dialog">
        <form id="currency-form">
            @CSRF
            <input type="hidden" name="id" value="0">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h5 class="modal-title">Add Currency</h5>
                </div>
                <!-- Modal body -->
                <div class="modal-body plr30">
                    <div class="row">
                        <!--col-->
                        <div class="col-md-12">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Name*</label>
                                    <input type="text" name="name" class="form-control form-control-sm">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Code *</label>
                                    <input type="text" name="code" class="form-control form-control-sm">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Exchange Rate *</label>
                                    <input type="text" name="exchange_rate" class="form-control form-control-sm">
                                </div>
                            </div>
                        </div>

                        <!--col-->
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
