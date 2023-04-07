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
    <div class="modal-dialog" role="document">
        <form id="discount-form">
            @CSRF
            <input type="hidden" name="id" id="discount-id" value="0">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h5 class="modal-title">Create Discount</h5>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <div class="col-md-12">
                    <div class="row">
                        <div class="form-group col-md-6 pf">
                            <label for="name">Name <sup class="text-danger">*</sup></label>
                            <input class="form-control " autocomplete="off" id="name" name="name" type="text">
                        </div>
                        <div class="form-group col-md-6 pf">
                            <label for="discount_by">Discount By <sup class="text-danger">*</sup></label>
                            <select class="form-control " id="discount_by" name="discount_by">
                                <option selected value="" class="select">--Select--</option>
                                <option value="category">Category</option>
                                <option value="product">Product</option>
                            </select>
                        </div>
                    </div>

                    <div class="row cat_search d-none">
                        <input type="checkbox" id="cat_search" >
                        <label for="categories" style="font-size: 11px;padding-left: 10px;">Enable categories for products search </label>
                        <div class="form-group col-md-12 pf discount_products d-none">
                            <select class="form-control js-example-basic-multiple" id="categories" name="categories[]" multiple="" >
                                {!! \App\Models\Product\Category::dropdown() !!}
                            </select>
                        </div>
                    </div>
                    <div class="row ">
                        <div class="form-group col-md-12 pf">
                            <label for="discount_on"><label id="discount_on_label" for="discount_on">Products </label> <sup class="text-danger">*</sup></label>
                            <select class="form-control js-example-basic-multiple" id="discount_on" name="discount_on[]" multiple="" >
                            </select>
                        </div>
                    </div>

                        <div class="row">
                        <div class="form-group col-md-3 pf">
                            <label for="discount_type">Discount Type<span class="text-danger">*</span></label>
                            <select class="form-control  " id="discount_type" name="discount_type" required>
                                <option selected value="" class="select">--Select--</option>
                                <option value="Fixed">Fixed</option>
                                <option value="Percentage">Percentage(%)</option>
                            </select>
                        </div>
                        <div class="form-group col-md-3 pf">
                            <label for="value">Value<span class="text-danger">*</span></label>
                            <input type="number" class="form-control" autocomplete="off" id="value" name="value" type="text">
                        </div>
                        <div class="form-group col-md-3 pf">
                            <label for="valid_from">Valid From<span class="text-danger">*</span></label>
                            <input class="form-control  date" autocomplete="off" id="valid_from" name="valid_from" type="text">
                        </div>
                        <div class="form-group col-md-3 pf">
                            <label for="valid_till">Valid Till<span class="text-danger">*</span></label>
                            <input class="form-control  date" autocomplete="off" id="valid_till" name="valid_till" type="text">
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-3 pf">
                            <label for="min_qty">Min Qty<span class="text-danger">*</span></label>
                            <input type="number" class="form-control" autocomplete="off" id="min_qty" name="min_qty" type="text">
                        </div>
                        <div class="form-group col-md-3 pf">
                            <label for="max_qty">Maximum Qty<span class="text-danger">*</span></label>
                            <input type="number" class="form-control" autocomplete="off" id="max_qty" name="max_qty" type="text">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-3 pf">
                            <input type="checkbox" autocomplete="off" id="status" name="status" value="1" checked>
                            <label for="status">Is active</label>
                        </div>

                    </div>
                    {{--<div class="row">
                        <div class="col-md-12">
                            <div class="col-md-3">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" name="days[]" value="Monday">
                                        Monday
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" name="days[]" value="Tuesday">
                                        Tuesday
                                    </label>
                                </div>
                            </div>
                            <!--col-->
                            <div class="col-md-3">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" name="days[]" value="Wednesday">
                                        Wednesday
                                    </label>
                                </div>
                            </div>
                            <!--col-->
                            <div class="col-md-3">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" name="days[]" value="Thursday">
                                        Thursday
                                    </label>
                                </div>
                            </div>
                            <!--col-->
                            <div class="col-md-3">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" name="days[]" value="Friday">
                                        Friday
                                    </label>
                                </div>
                            </div>
                            <!--col-->
                            <div class="col-md-3">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" name="days[]" value="Saturday">
                                        Saturday
                                    </label>
                                </div>
                            </div>
                            <!--col-->
                            <div class="col-md-3">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" name="days[]" value="Sunday">
                                        Sunday
                                    </label>
                                </div>
                            </div>
                            <!--col-->
                        </div>
                    </div>--}}
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
