<div class="col-md-12" style="min-height: 100%;height: 100%; float: left;">
    <div class="clearfix"></div>
    <table class="table-print table2excel"
           style=" width: 100%; font-family: sans-serif;text-align: center;border-collapse: collapse; margin-top: 10px;font-size: 12px;">
        <thead>
        <tr style="margin-bottom: 100px;">
            <td colspan="4" style="font-family: sans-serif;    text-align: left;">
                <img
                    src="{{ url('storage/app/public/sale_images') }}/{{ \App\Models\BusinessSetting::first()->business_logo }}"
                    width="150"/>
                <p class="line"> {{\App\Models\WhereHouse::find(Auth::user()->WHID)->WH_Address}}</p>
                <p class="line"><strong>Phone : </strong> {{\App\Models\WhereHouse::find(Auth::user()->WHID)->WH_Mobile}}</p>
                <p class="line"><strong>Email : </strong> {{\App\Models\WhereHouse::find(Auth::user()->WHID)->WH_Email}}</p>
            </td>

            <td style="font-family: sans-serif;text-align: left;padding-left: 5%;" colspan="2"><span
                    style="font-size: 1.5rem;font-weight: bolder;">Stock Transfer</span>
                <p class="line"><strong>Issue date:</strong> {{date("d-m-Y h:i:s a", time())}}</p>
                @if(isset($request->df) && $request->df) <p class="line"><strong>Date from :</strong> {{$request->df}}</p> @endif
                @if(isset($request->dt) && $request->dt) <p class="line"><strong>Date To:</strong> {{$request->dt}}</p> @endif
                @if(isset($request->WHID) && $request->WHID) <p class="line"><strong>From :</strong> @foreach($request->WHID as $whid) {{\App\Models\WhereHouse::find($whid)->WH_Name}}, @endforeach </p> @endif

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
        @endif
        <tr class="spacer" style="height: 20px;"></tr>


        <tr style="border: 1px solid #000;" class="bg-dg">
            <th style="border: 1px solid #000; padding: 3px;text-align:center">Sr#</th>
            <th style="border: 1px solid #000; padding: 3px;text-align:center">Date</th>
            <th style="border: 1px solid #000; padding: 3px;text-align:center">Product Code</th>
            <th style="border: 1px solid #000; padding: 3px;text-align:center">Product Name</th>
            <th style="border: 1px solid #000; padding: 3px;text-align:center">Product Category</th>
            <th style="border: 1px solid #000; padding: 3px;text-align:center">Status</th>
            <th style="border: 1px solid #000; padding: 3px;text-align:center">From</th>
            <th style="border: 1px solid #000; padding: 3px;text-align:center">To</th>
            <th style="border: 1px solid #000; padding: 3px;text-align:center">Qty</th>
        </tr>
        </thead>
        <tbody>
        <?php $total_quantity = 0;
        $i=1;
        ?>
        @if(isset($products) && count($products))

            <?php
            function transfer_status($status) {
                if($status==1){
                    return 'Completed';
                }else if($status==2){
                    return 'Pending';
                }else if($status==3){
                    return 'Sent';
                }
            }
            ?>
            @foreach($products as $product)
                <?php $total_quantity+= (int) $product->Qty;  ?>
                <tr style="border: 1px solid #000;">
                    <td style="border: 1px solid #000; padding: 2px;width:5%;">{{$i++}}</td>
                    <td style="border: 1px solid #000; padding: 2px;text-align:center;">{{date("d-m-Y", strtotime(substr($product->created_at,0,10))) }} </td>
                    <td style="border: 1px solid #000; padding: 2px;text-align:center;">{{$product->product_code}} </td>
                    <td style="border: 1px solid #000; padding: 2px;text-align:center;">{{$product->name}}</td>
                    <td style="border: 1px solid #000; padding: 2px;text-align:center;">{{$product->category_name}}</td>
                    <td style="border: 1px solid #000; padding: 2px;text-align:center;">{{transfer_status($product->status)}}</td>
                    <td style="border: 1px solid #000; padding: 2px;text-align:center;">{{$product->from}}</td>
                    <td style="border: 1px solid #000; padding: 2px;text-align:center;">{{$product->to}}</td>
                    <td style="border: 1px solid #000; padding: 2px;width:5%;">{{$product->Qty}}</td>
                </tr>
            @endforeach
        @endif
        <tr style="border: 1px solid #000;display:none;" class="bg-dg">
            <th style="padding: 3px;text-align: right;border: 1px solid #000"> Total</th>
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

