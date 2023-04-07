<div class="card-header no-report">
    <form id="report-filters">
        @if(!request()->is('reports/Inventory/low_stock') )
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
        @endif
        @if(request()->is('reports/Inventory/product_stock_detail') || request()->is('reports/Inventory/low_stock') || request()->is('reports/Inventory/available_stock') || request()->is('reports/Inventory/stock_adjustment') || request()->is('reports/Inventory/opening_inventory'))
            <div class="col-md-3">
                <div class="form-group">
                    <label>Location</label>
                    <select class="form-control select2" id="WHID" name="WHID[]" multiple="">
                        <option value="0">Select</option>
                        {!! \App\Models\WhereHouse::dropdown() !!}
                    </select>
                </div>
            </div>
        @endif
        @if(request()->is('reports/Inventory/stock_transfer'))
            <div class="col-md-2">
                <div class="form-group">
                    <label>From </label>
                    <select class="form-control select2" id="from" name="WHIDF[]" multiple="">
                        <option value="0">Select</option>
                        {!! \App\Models\WhereHouse::dropdown() !!}
                    </select>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label>To </label>
                    <select class="form-control select2" id="to" name="WHIDT[]" multiple="">
                        <option value="0">Select</option>
                        {!! \App\Models\WhereHouse::dropdown() !!}
                    </select>
                </div>
            </div>
        @endif

        <div class="col-md-3">
            <div class="form-group">
                <label>Product Category</label>
                <select class="form-control select2" id="category" name="category[]" multiple="">
                    <option value="0">Select</option>
                    {!! \App\Models\Product\Category::dropdown() !!}
                </select>
            </div>
        </div>

        @if(  false  )
            <div class="col-md-2">
                <div class="form-group">
                    <label>Min QTY</label>
                    <input type="number" min="0" name="min_qty" class="form-control" autocomplete="off">
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label>Max QTY</label>
                    <input type="number" min="0" name="max_qty" class="form-control" autocomplete="off">
                </div>
            </div>
        @endif
        <div class="col-md-4" style="">
            <div class="form-group">
                <label>Choose Products </label>
                <select class="form-control select2" id="product_code" name="product_code[]" multiple="">
                    <option value="0">Select</option>
                    {!! \App\Models\Product::dropdown2() !!}
                </select>
            </div>
        </div>
        @if( request()->is('reports/Inventory/low_stock') || request()->is('reports/Inventory/available_stock')  || request()->is('reports/Inventory/product_stock_detail')  )
             <div class="col-md-3" style="padding-top: 14px;">
                <div class="form-group">
                    <label for="">Include Zero Qty (0)</label> : <br>
                    <input id="include_0" name="include_0" value="1" type="radio" >
                    <span>Yes</span>
                    <input id="include_0" name="include_0" value="0"  type="radio" checked  >
                    <span>No</span>

                </div>
            </div>
        @endif
        @if( request()->is('reports/Inventory/low_stock') )
            <div class="col-md-2">
                <div class="form-group">
                    <label>Manual Alert QTY</label>
                    <input type="number" min="0" name="alert_qty" class="form-control" autocomplete="off">
                </div>
            </div>
        @endif

        <div class="col-md-12" style="padding-top: 30px;">
            <div class="col-md-10"></div>
            <div class="col-md-1">
                <div class="form-group">
                    <button type="button" onclick="get_reports()" class="btn btn-info btn-mini"><i class="fa fa-search"></i>
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
