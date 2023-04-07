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
<div class="modal fade" id="new">
    <div class="modal-dialog modal-md modal-md modal-sm" role="document">
        <div class="modal-content">
            <form id="oinventory-form">
                <input type="hidden" name="id" value="0">
                @CSRF
                <div class="modal-header refEdit">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">×</span> </button>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-right:10px;"> <span aria-hidden="true">−</span> </button>
                    <h5 class="modal-title">Add Opening Inventory</h5>
                </div>
                <!-- end of modal-header -->
                <div class="modal-body plr30">
                    <div class="row">
                        {{--<div class="form-group col-md-1 pf">--}}
                        {{--<label for="inputdefault">Locaions<sup class="text-danger">*</sup></label>--}}
                        {{--<select class="js-example-basic-single form-control form-control-sm" name="client_id"   tabindex="-1" aria-hidden="true">--}}
                        {{--<option value="0">Select Locations</option>--}}
                        {{--{!! App\Models\Branches::dropdown() !!}--}}
                        {{--</select>--}}
                        {{--</div>--}}

                        <div class="col-md-12 pf">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-block">
                                            <div class="form-group col-md-4 pf">
                                                <div class="form-group">
                                                    <label for="inputdefault">Wherehouse<sup class="text-danger">*</sup></label>
                                                    <select class="js-example-basic-single form-control form-control-sm WHID" name="WHID"   tabindex="-1" aria-hidden="true">
                                                        <option value="0">Select Wherehouse</option>
                                                        {!! App\Models\WhereHouse::dropdown() !!}
                                                    </select>
                                                </div>
                                            </div>
                                            <!-- Form Control starts -->
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <span class="input-group-addon" id="alighaddon1"><i class="fa fa-barcode"></i> </span>
                                                        <input  class="form-control" list="product" name="" id="product_id" placeholder="Please type product code and select" autocomplete="off">
                                                        <datalist id="product">
                                                            {!! App\Models\Product::dropdown() !!}
                                                        </datalist>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--col-->
                                            <div class="table-responsive" style="margin-top: 21px">
                                                <table id="myTable" class="table table-hover order-list table-bordered">
                                                    <thead>
                                                    <tr style="background: darkgray; color: white">
                                                        <th>Name</th>
                                                        <th>Code</th>
                                                        <th>Quantity</th>
                                                        <th class="recieved-product-qty d-none">Received</th>
                                                      {{--  <th>Net Unit Cost</th>
                                                        <th>Discount</th>
                                                        <th>Tax</th>
                                                        <th>SubTotal</th>--}}
                                                        <th class="fa fa-trash" style="border: none"></th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    </tbody>
                                                    <tfoot class="tfoot active">
                                                    <tr>
                                                        <th colspan="2">Total</th>
                                                        <th id="total-qty">0</th>
                                                        <th class="recieved-product-qty d-none"></th>
                                                        {{--<th></th>
                                                        <th id="total-discount">0.00</th>
                                                        <th id="total-tax">0.00</th>
                                                        <th id="total">0.00</th>--}}
                                                        <th><i class="fa fa-trash" style="border: none"></i></th>
                                                    </tr>

                                                    </tfoot>
                                                </table>
                                                <button type="button" class="btn btn-mini btn-primary m-t-10 pull-right" onclick="save_rec()">Submit</button>
                                            </div>
                                        </div>
                                        <!--card-block-->
                                    </div>
                                    <!--card-->
                                </div>
                                <!--col-md-12-->

                            </div>
                            <!--row-->
                        </div>
                        <div class="col-md-10 pf"></div>
                        <!-- Form Control ends -->
                        <div class="col-md-2 pf">

{{--                            <div class="row">--}}
{{--                                <div class="col-md-12">--}}
{{--                                    <div class="card">--}}
{{--                                        <div class="card-header text-primary">--}}
{{--                                            <h5 class="card-header-text" style="color: rgb(26, 168, 157);">Total</h5>--}}
{{--                                        </div>--}}
{{--                                        <div class="card-block">--}}
{{--                                            <div class="form-group col-md-12 pf">--}}
{{--                                                <input type="text" class="form-control form-control-sm" id="total" placeholder="Total" name="">--}}
{{--                                            </div>--}}
{{--                                            <div class="form-group col-md-12 pf">--}}
{{--                                                <button type="button" class="btn btn-mini btn-success">Save</button>--}}
{{--                                                <button type="button" class="btn btn-mini btn-danger">Cancel</button>--}}
{{--                                            </div>--}}

{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <!--card-->--}}
{{--                                </div>--}}
{{--                                <!--col-md-12-->--}}
{{--                            </div>--}}
                            <!--row-->
                        </div>
                    </div>
                </div>
                <!-- end of modal-body -->
            </form>
        </div>
        <!-- end of modal-content -->
    </div>
    <!-- end of modal-dialog -->
</div>
