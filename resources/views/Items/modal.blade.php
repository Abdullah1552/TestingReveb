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
    @media (min-width: 992px) {
        .modal-md {
            width: 100%;
            max-width: 1300px;
        }
    }
    .col-md-1 {
        width: 12.333333% !important;
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
            <div class="modal-header refEdit">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">×</span> </button>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-right:10px;"> <span aria-hidden="true">−</span> </button>
                <h5 class="modal-title">Product Details</h5>
            </div>
            <!-- end of modal-header -->
            <div class="modal-body plr30 panel panel-default">
                <form id="item-form">
                    <input type="hidden" name="id" value="0">
                    <div class="row">
                        <div class="form-group col-md-2 pf">
                            <label>Brand <sup class="text-danger">*</sup></label>
                            <select class="js-example-basic-single form-control  clients select2-hidden-accessible" name="brand_id" id="client_id" tabindex="-1" aria-hidden="true">
                                <option value="">Select Brand</option>
                                {!! App\Models\Product\Brand::dropdown() !!}
                            </select>
                        </div>
                        <div class="form-group col-md-4 pf">
                            <label for="inputdefault">Product Name <sup class="text-danger">*</sup></label>
                            <input class="form-control" id="" name="name" type="text"  value="" placeholder="Item Name">
                        </div>
                        <div class="form-group col-md-2 pf">
                            <label for="inputdefault">Product Code: <sup class="text-danger">*</sup></label>
                            <div class="input-group">
                                <input class="form-control" id="product-code" name="product_code" type="text" placeholder="Product Code">
                                <span onclick="product_code()" class="input-group-addon"><i class="fa fa-refresh"></i> </span>
                            </div>
                        </div>
                        <div class="form-group col-md-2 pf">
                            <label>Product Category</label>
                            <select class="form-control js-example-basic-single" name="product_category">
                                <option value="">Select</option>
                                {!! App\Models\Product\Category::dropdown() !!}
                            </select>
                        </div>
                        <div class="form-group col-md-2 pf">
                            <label for="inputdefault">Weight (g): <sup class="text-danger">*</sup></label>
                            <input class="form-control " name="weight" type="text"  value="" placeholder="Weight">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-2 pf">
                            <label for="inputdefault">Unit:<sup class="text-danger">*</sup></label>
                            <select class="form-control " name="unit" >
                                <option value="">Select</option>
                                {!! App\Models\UnitType::unitTypeList() !!}
                            </select>
                        </div>
                        <div class="form-group col-md-2 pf">
                            <label for="inputdefault">Product Cost: <sup class="text-danger">*</sup></label>
                            <input class="form-control product_cost" name="product_cost" type="number" placeholder="Product Cost">
                        </div>
                        <div class="form-group col-md-2 pf">
                            <label for="inputdefault">Product Price: <sup class="text-danger">*</sup></label>
                            <input class="form-control profit_in" name="product_price" type="number" placeholder="Product Price">
                        </div>
                        <div class="form-group col-md-2 pf">
                            <label for="inputdefault">Proft in %:</label>
                            <input class="form-control profit_per" name="profit_per" type="text" placeholder="0.00">
                        </div>
                        <div class="form-group col-md-2 pf">
                            <label for="inputdefault">Proft in Value</label>
                            <input readonly class="form-control profit_val" name="profit_val" type="text" placeholder="0.00">
                        </div>
                        <div class="form-group col-md-2 pf">
                            <label>Maintain Inventory: </label>
                            <select class="js-example-basic-single form-control" name="inventory">
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-2 pf">
                            <label for="inputdefault">Alert Quantity: <sup class="text-danger">*</sup></label>
                            <input class="form-control " name="alert_qty" type="text" placeholder="Alert Quantity">
                        </div>
                        <div class="form-group col-md-2">
                            <label>Product Tax</label>
                            <select name="product_tax" class="form-control">
                                <option value="">No Tax</option>
                                {!! App\Models\Tax::dropdown() !!}
                            </select>
                        </div>
                        <div class="form-group col-md-2">
                            <label>Tax Method: </label>
                            <select class="js-example-basic-single form-control  clients select2-hidden-accessible" name="tax_method" name="tax_method">
                                <option value="1">Exclusive</option>
                                <option value="2">Inclusive</option>
                            </select>
                        </div>
                        <div class="form-group col-md-2">
                            <input type="checkbox" name="featured" value="1">&nbsp;
                            <label>Featured</label>
                            <p class="italic">Featured product will be displayed in POS</p>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="file" class="custom-file">
                                Product Images <span class="text-warning">(First Image will be Thumb image)</span></label>
                            <input type="file" class="form-control" name="product_images[]" multiple>
                        </div>
                    </div>
                  {{--  <div class="row">
                        <div class="col-md-12">
                            <div class="form-group col-md-2">
                                <label>Purchase Tax</label>
                                <select name="purchase_tax" class="form-control js-example-basic-single">

                                </select>
                            </div>
                        </div>
                        <!--col-->
                    </div>--}}
                    <!--row-->
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label>Product Details</label>
                            <textarea class="form-control textarea" id="txtEditor" name="detail"></textarea>
                        </div>
                    </div>
                    <!--row-->
                    <div class="row">
                        {{--<div class="col-md-12 mt-2" id="diffPrice-option">--}}
                            {{--<h5><input onclick="different_price()" name="is_diffPrice" type="checkbox" id="is-diffPrice" value="1">--}}
                                {{--&nbsp; This product has different price for different Location</h5>--}}
                            {{--<div class="col-md-5" id="diff-price-loc" style="display: none">--}}
                                {{--<table class="table">--}}
                                    {{--<thead>--}}
                                    {{--<tr>--}}
                                        {{--<th>Location</th>--}}
                                        {{--<th>Price</th>--}}
                                    {{--</tr>--}}
                                    {{--</thead>--}}
                                    {{--<tbody id="fetch_warehouse_price">--}}
                                    {{--<?php $i=0; ?>--}}
                                    {{--@foreach($warehouses as $warehouse)--}}
                                        {{--<tr>--}}
                                            {{--<td><input type="hidden" name="warehouse_id[]" value="{{ $warehouse->id }}">{{ $warehouse->WH_Name }}</td>--}}
                                            {{--<td><input type="number" name="diff_price[]" class="form-control "></td>--}}
                                        {{--</tr>--}}
                                        {{--<?php $i++; ?>--}}
                                    {{--@endforeach--}}
                                    {{--</tbody>--}}
                                {{--</table>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        <div class="col-md-12 mt-2">
                            <h5><input onclick="var_price()" name="is_variant" type="checkbox" id="is-diffPrice" value="1">
                                &nbsp; This product has variant</h5>
                            <div id="promotional-price" style="display: none">
                                {{--<div class="col-md-4 form-group mt-2">--}}
                                <input type="hidden" name="attribute" id="get_attribute">
                                {{--</div>--}}
                                <div class="table-responsive ml-2">
                                    <table id="variant-table" class="table table-hover variant-list">
                                        <thead>
                                        <tr>
                                            <th>Attribute</th>
                                            <th>Name</th>
                                            <th>Item Code</th>
                                            <th>Additional Price</th>
                                            <th><i class="dripicons-trash"></i></th>
                                        </tr>
                                        </thead>
                                        <tbody id="more-variant"></tbody>

                                    </table>
                                </div>
                            </div>
                        </div>
                        {{--<div class="col-md-12 mt-2" id="diffPrice-option">--}}
                            {{--<h5><input onclick="promo_price()" name="is_promo" type="checkbox" value="1">--}}
                                {{--&nbsp; Add Promotional Price</h5>--}}
                            {{--<div class="row" style="display: none;" id="pp">--}}
                                {{--<div class="col-md-4" id="promotion_price" style="">--}}
                                    {{--<label>Promotional Price</label>--}}
                                    {{--<input type="number" name="promotional_price" class="form-control">--}}
                                {{--</div>--}}
                                {{--<div class="col-md-4" id="start_date" style="">--}}
                                    {{--<div class="form-group">--}}
                                        {{--<label>Promotion Starts</label>--}}
                                        {{--<div class="input-group">--}}
                                            {{--<div class="input-group-prepend">--}}
                                                {{--<div class="input-group-text"><i class="dripicons-calendar"></i></div>--}}
                                            {{--</div>--}}
                                            {{--<input type="text" name="promotional_start" id="" class="form-control date">--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--<div class="col-md-4" id="last_date" style="">--}}
                                    {{--<div class="form-group">--}}
                                        {{--<label>Promotion Ends</label>--}}
                                        {{--<div class="input-group">--}}
                                            {{--<div class="input-group-prepend">--}}
                                                {{--<div class="input-group-text"><i class="dripicons-calendar"></i></div>--}}
                                            {{--</div>--}}
                                            {{--<input type="text" name="promotional_end" class="form-control date">--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    </div>
                    <!--row-->
                    <div class="row">
                        <div class="form-group col-md-12">
                            <button type="submit" class="btn btn-mini btn-success save-rec pull-right"><i class="fa fa-save"></i> Save</button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- end of modal-body -->
        </div>
        <!-- end of modal-content -->
    </div>
    <!-- end of modal-dialog -->
</div>
