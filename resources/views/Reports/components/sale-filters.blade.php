<div class="card-header no-report row">
    <form id="report-filters">

        <div class="col-md-2">
            <div class="form-group">
                <label>Date From</label>
                <input type="text" name="df" class="form-control date" autocomplete="off">
            </div>
        </div>

        <div class="col-md-2">
            <div class="form-group">
                <label>Date To</label>
                <input type="text" name="dt" class="form-control date" autocomplete="off">
            </div>
        </div>

        @if(!request()->is('reports/sale/cash-register'))
            @if(request()->is('reports/sale/invoice') )
                <div class="col-md-2" style="">
                    <div class="form-group">
                        <label>Sale Type</label>
                        <select class="js-example-basic-single form-control " name="sale_type">
                            {!! \App\Models\SaleInvoice::sale_type_dropdown() !!}
                        </select>
                    </div>
                </div>
            @endif

            @if(request()->is('reports/purchase/product_purchase') )
                <div class="col-md-4" style="">
                    <div class="form-group">
                        <label>Choose Products </label>
                        <select class="form-control select2" id="product_code" name="product_code[]" multiple="">
                            <option value="0">Select</option>
                            {!! \App\Models\Product::dropdown2() !!}
                        </select>
                    </div>
                </div>
            @endif

            @if(request()->is('reports/purchase/product_purchase') )
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Product Category</label>
                        <select class="form-control select2" id="category" name="category[]" multiple="">
                            <option value="0">Select</option>
                            {!! \App\Models\Product\Category::dropdown() !!}
                        </select>
                    </div>
                </div>
            @endif
            <div class="col-md-3">
                <div class="form-group">
                    <label> Created by</label>
                    <select class="form-control select2" id="created_by" name="created_by[]" multiple="">
                        <option value="0">Select</option>
                        {!! \App\Models\User::dropdown() !!}
                    </select>
                </div>
            </div>


            <div class="col-md-3">
                <div class="form-group">
                    <label> Customer </label>
                    <select class="form-control select2" id="customers" name="customers[]" multiple="">
                        <option value="0">Select</option>
                        {!! \App\Models\Customer::dropdown() !!}
                    </select>
                </div>
            </div>
        @endif

        <div class="col-md-3">
            <div class="form-group">
                <label>Location</label>
                <select class="form-control select2" id="WHID" name="WHID[]" multiple="">
                    <option value="0">Select</option>
                    {!! \App\Models\WhereHouse::dropdown() !!}
                </select>
            </div>
        </div>

        @if(request()->is('reports/sale/product-wise-sale') )
            <div class="col-md-4" style="">
                <div class="form-group">
                    <label>Choose Products </label>
                    <select class="form-control select2" id="product_code" name="product_code[]" multiple="">
                        <option value="0">Select</option>
                        {!! \App\Models\Product::dropdown2() !!}
                    </select>
                </div>
            </div>
        @endif
        @if(request()->is('reports/sale/product-wise-sale') )
            <div class="col-md-3">
                <div class="form-group">
                    <label>Product Category</label>
                    <select class="form-control select2" id="category" name="category[]" multiple="">
                        <option value="0">Select</option>
                        {!! \App\Models\Product\Category::dropdown() !!}
                    </select>
                </div>
            </div>
        @endif


        @if(request()->is('reports/sale/cash-register'))
            <div class="col-md-3">
                <div class="form-group">
                    <label> Open by</label>
                    <select class="form-control select2" id="open_by" name="open_by[]" multiple="">
                        <option value="0">Select</option>
                        {!! \App\Models\User::dropdown() !!}
                    </select>
                </div>
            </div>
        @endif
        @if(request()->is('reports/sale/cash-register'))
            <div class="col-md-3">
                <div class="form-group">
                    <label> Closed by</label>
                    <select class="form-control select2" id="closed_by" name="closed_by[]" multiple="">
                        <option value="0">Select</option>
                        {!! \App\Models\User::dropdown() !!}
                    </select>
                </div>
            </div>
        @endif


        <div class="col-md-12" style="padding-top: 30px;">
            <div class="col-md-10"></div>
            <div class="col-md-1">
                <div class="form-group">
                    <button type="button" onclick="get_reports()" class="btn btn-info btn-mini"><i
                                class="fa fa-search"></i>
                    </button>
                </div>
            </div>
        </div>
    </form>
    <div class="btn-group pull-right no-report">
        <button type="button" class="btn btn-mini btn-success exportToExcel"><i class="fa fa fa-file-excel-o"></i>
        </button>
        <button type="button" class="btn btn-mini btn-info" id="printDiv"><i class="fa fa fa-print"></i></button>

    </div>
</div>
