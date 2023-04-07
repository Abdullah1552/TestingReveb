<div class="col-md-12" style="min-height: 100%;height: 100%; float: left;">
    <div class="clearfix"></div>
    <table class="table-print table2excel"
           style=" width: 100%; font-family: sans-serif;text-align: center;border-collapse: collapse; margin-top: 10px;font-size: 12px;">
        <thead>
        <tr style="margin-bottom: 100px;">
            <td colspan="3" style="font-family: sans-serif;    text-align: left;">
                <img
                    src="{{ url('storage/app/public/sale_images') }}/{{ \App\Models\BusinessSetting::first()->business_logo }}"
                    width="150"/>
                <p class="line"> {{\App\Models\WhereHouse::find(Auth::user()->WHID)->WH_Address}}</p>
                <p class="line"><strong>Phone : </strong> {{\App\Models\WhereHouse::find(Auth::user()->WHID)->WH_Mobile}}</p>
                <p class="line"><strong>Email : </strong> {{\App\Models\WhereHouse::find(Auth::user()->WHID)->WH_Email}}</p>
            </td>
            <td></td>

            <td style="font-family: sans-serif;    text-align: left;" colspan="2"><span
                    style="font-size: 1.5rem;font-weight: bolder;">Low Stock Report</span>
                <p class="line"><strong>Issue date:</strong> {{date("d-m-Y ", time())}}</p>
                @if(isset($request->df) && $request->df) <p class="line"><strong>Date from :</strong> {{$request->df}}</p> @endif
                @if(isset($request->dt) && $request->dt) <p class="line"><strong>Date To:</strong> {{$request->dt}}</p> @endif
                @if(isset($request->min_qty) && $request->min_qty) <p class="line"><strong>Min Qty:</strong> {{$request->min_qty}}</p> @endif
                @if(isset($request->max_qty) && $request->max_qty) <p class="line"><strong>Max Qty:</strong> {{$request->max_qty}}</p> @endif
                @if(isset($request->WHID) && $request->WHID) <p class="line"><strong>Location :</strong> @foreach($request->WHID as $whid) {{\App\Models\WhereHouse::find($whid)->WH_Name}}, @endforeach </p> @endif
            </td>


        </tr>

        <tr class="spacer" style="height: 20px;"></tr>
        @if(isset($request->category) && $request->category)
            <tr class="text-left" style="height: 20px;">
                <td colspan="4"><strong> Categories:</strong>  @foreach($request->category as $category) {{\App\Models\Product\Category::find($category)->name}}, @endforeach</td>
            </tr>
        @endif
        @if(isset($request->product_code) && $request->product_code)
            <tr class="text-left" style="height: 20px;">
                <td colspan="4"><strong> Products:</strong>  @foreach($request->product_code as $product_code) {{$product_code}}, @endforeach</td>
            </tr>
            <tr class="spacer" style="height: 20px;"></tr>
        @endif


        <tr style="border: 1px solid #000;" class="bg-dg">
            <th style="border: 1px solid #000; padding: 3px;text-align:center">Sr#</th>
            <th style="border: 1px solid #000; padding: 3px;text-align:center">Product Code</th>
            <th style="border: 1px solid #000; padding: 3px;text-align:center">Product Name</th>
            <th style="border: 1px solid #000; padding: 3px;text-align:center">Product Category</th>
            <th style="border: 1px solid #000; padding: 3px;text-align:center">Location</th>
            <th style="border: 1px solid #000; padding: 3px;text-align:center">Alert Qty</th>
            <th style="border: 1px solid #000; padding: 3px;text-align:center">QTY</th>
        </tr>
        </thead>
        <tbody>
        <?php $total_quantity = 0;
        $i=1;
        ?>
        @if(isset($products) && count($products))
            @foreach($products as $product)
                    <tr style="border: 1px solid #000;">
                        <td style="border: 1px solid #000; padding: 2px;width:5%;">{{$i++}}</td>
                        <td style="border: 1px solid #000; padding: 2px;text-align:center;">{{$product->product_code}} </td>
                        <td style="border: 1px solid #000; padding: 2px;text-align:center;">{{$product->product_name}}</td>
                        <td style="border: 1px solid #000; padding: 2px;text-align:center;">{{$product->category_name}}</td>
                        <td style="border: 1px solid #000; padding: 2px;text-align:center;">{{isset($product->warehouse_name)?$product->warehouse_name:"N/A"}}</td>
                        <td style="border: 1px solid #000; padding: 2px;text-align:center;">{{$product->alert_qty}}</td>
                        <td style="border: 1px solid #000; padding: 2px;width:5%;">{{$product->available_stock}}</td>
                    </tr>
                   <?php $total_quantity += (int) $product->available_stock;?>
            @endforeach
        @endif
        <tr style="border: 1px solid #000;display:none;" class="bg-dg">
            <th style="padding: 3px;text-align: right;border: 1px solid #000"> Total</th>
            <th style="padding: 3px;text-align: right;"> {{$total_quantity}} </th>
        </tr>

        <tr>
            <div class="page-footer col-md-12">
                <table
                    style="width: 100%; font-family: sans-serif;text-align: center;border-collapse: collapse; margin-top: 10px;font-size: 12px;">
                    <tr style="border: 1px solid #000;" class="bg-dg">
                        <th style="padding: 3px;text-align: right;border: 1px solid #000"> Total</th>
                        <th style="padding: 3px;text-align: right;"> {{$total_quantity}} </th>
                    </tr>
                </table>

                <table
                    style="margin-top:200px ;width: 100%; font-family: sans-serif;text-align: center;border-collapse: collapse; font-size: 12px;">

                    <tr>
                        <td>________________________________</td>
                        <td>________________________________</td>
                        <td>________________________________</td>
                    </tr>
                    <tr>
                        <td style="text-align: center;">Prepared by</td>
                        <td style="text-align: center;">Checked by</td>
                        <td style="text-align: center;">Approved by</td>
                    </tr>
                </table>
                <br>


            </div>
        </tr>
        </tbody>
    </table>
</div>

