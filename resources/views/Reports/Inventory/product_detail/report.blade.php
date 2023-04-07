
<div class="col-md-12" style="min-height: 100%;height: 100%; float: left;">
    <div class="clearfix"></div>
    <table class="table-print table2excel"
           style=" width: 100%; font-family: sans-serif;text-align: center;border-collapse: collapse; margin-top: 10px;font-size: 12px;">
        <thead>
        <tr style="margin-bottom: 100px;">
            <td colspan="9" style="font-family: sans-serif;    text-align: left;">
                <img
                    src="{{ url('storage/app/public/sale_images') }}/{{ \App\Models\BusinessSetting::first()->business_logo }}"
                    width="150"/>
                <p class="line"> {{\App\Models\WhereHouse::find(Auth::user()->WHID)->WH_Address}}</p>
                <p class="line"><strong>Phone : </strong> {{\App\Models\WhereHouse::find(Auth::user()->WHID)->WH_Mobile}}</p>
                <p class="line"><strong>Email : </strong> {{\App\Models\WhereHouse::find(Auth::user()->WHID)->WH_Email}}</p>
            </td>

            <td class="doc" style="font-family: sans-serif;    text-align: center;" colspan="5"><span
                    style="font-size: 1.5rem;font-weight: bolder;">Product Detail Report</span>
                <p class="line" ><strong>Issue date:</strong> {{date("d-m-Y h:i:s a", time())}}</p>
                @if(isset($request->df) && $request->df) <p class="line" ><strong>Date from :</strong> {{$request->df}}</p> @endif
                @if(isset($request->dt) && $request->dt) <p class="line" ><strong>Date To:</strong> {{$request->dt}}</p> @endif
                @if(isset($request->min_qty) && $request->min_qty) <p class="line" ><strong>Min Qty:</strong> {{$request->min_qty}}</p> @endif
                @if(isset($request->max_qty) && $request->max_qty) <p class="line" ><strong>Max Qty:</strong> {{$request->max_qty}}</p> @endif
                @if(isset($request->WHID) && $request->WHID) <p class="line" ><strong>Location :</strong> @foreach($request->WHID as $whid) {{\App\Models\WhereHouse::find($whid)->WH_Name}}, @endforeach </p> @endif
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
{{--            <th style="border: 1px solid #000; padding: 3px;text-align:center">Date</th>--}}
            <th class="report_col" style="white-space: nowrap;">Product Code</th>
            <th class="report_col">Product Name</th>
            <th class="report_col">Product Category</th>
            <th class="report_col">Location</th>
            @if(isset($request->df) && $request->df)
                <th class="report_col">Previous Stock</th>
            @endif
            <th class="report_col">Opening Inventory</th>
            <th class="report_col">Transfer In</th>
            <th class="report_col">Transfer Out</th>
            <th class="report_col"> Adjustment (+)</th>
            <th class="report_col"> Adjustment (-)</th>
            <th class="report_col">Purchase</th>
            <th class="report_col">Purchase Return</th>
            <th class="report_col">Sale</th>
            <th class="report_col">Sale Return</th>
            @if(isset($request->df) && $request->df)
            <th class="report_col">Net Stock</th>
            @endif
            <th class="report_col">Available Stock</th>
        </tr>

        </thead>
        <tbody>
        <?php $total_quantity = 0;
        $i=1;
        ?>
        @if(isset($products) && count($products))
            @foreach($products as $product)
                <tr style="border: 1px solid #000;">
                    <td class="report_col">{{$i++}}</td>
{{--                    <td style="border: 1px solid #000; padding: 2px;text-align:center;">{{date("d-m-Y", strtotime(substr($product->created_at,0,10))) }} </td>--}}
                    <td class="report_col">{{$product->product_code}} </td>
                    <td class="report_col">{{$product->product_name}}</td>
                    <td class="report_col">{{$product->category_name}}</td>
                    <td class="report_col">{{$product->warehouse_name}}</td>
                    @if(isset($request->df) && $request->df)
                        <td style="border: 1px solid #000; padding: 3px;text-align:center;width:5%;">{{$product->previous_stock}}</td>
                    @endif
                    <td class="report_col">{{$product->oi}}</td>
                    <td class="report_col">{{$product->transfer_in}}</td>
                    <td class="report_col">{{$product->transfer_out}}</td>
                    <td class="report_col">{{$product->adjustment_plus}}</td>
                    <td class="report_col">{{$product->adjustment_minus}}</td>
                    <td class="report_col">{{$product->purchase}}</td>
                    <td class="report_col">{{$product->purchase_return}}</td>
                    <td class="report_col">{{$product->sold}}</td>
                    <td class="report_col">{{$product->sale_return}}</td>
                    @if(isset($request->df) && $request->df)
                    <td style="border: 1px solid #000; padding: 3px;text-align:center;width:5%;">{{(float)$product->oi + (float) $product->transfer_in
                     - (float) $product->transfer_out +(float)$product->adjustment_plus - (float)$product->adjustment_minus
                      +(float)$product->purchase -(float)$product->purchase_return -(float)$product->sold + (float)$product->sale_return }}</td>
                    @endif
                    <td style="border: 1px solid #000; padding: 3px;text-align:center;width:5%;">{{$product->available_stock}}</td>
                    <?php $total_quantity=+ (float)$product->available_stock; ?>
                </tr>
            @endforeach
        @endif
        <tr style="border: 1px solid #000;display:none;" class="bg-dg">
            <th style="padding: 3px;text-align: right;border: 1px solid #000"> Total Available Stock </th>
            <th style="padding: 3px;text-align: right;"> {{$total_quantity}} </th>
        </tr>

        <tr>
            <div class="page-footer col-md-12">
                @if(isset($products) && count($products))

                <table
                    style="width: 100%; font-family: sans-serif;text-align: center;border-collapse: collapse; margin-top: 10px;font-size: 12px;">
                    <tr style="border: 1px solid #000;" class="bg-dg">
                        <th style="padding: 3px;text-align: right;border: 1px solid #000"> Total</th>
                        <th style="padding: 3px;text-align: right;"> {{$total_quantity}} </th>
                    </tr>
                </table>
                @endif
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

