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
            <td></td>

            <td style="font-family: sans-serif;    text-align: left;" colspan="5"><span style="font-size: 1.5rem;font-weight: bolder;">Consolidated Report-Purchase</span>
                <p class="line"><strong>Issue date:</strong> {{date("d-m-Y ", time())}}</p>
                @if(isset($request->df) && $request->df) <p class="line"><strong>Date from :</strong> {{$request->df}}</p> @endif
                @if(isset($request->dt) && $request->dt) <p class="line"><strong>Date To:</strong> {{$request->dt}}</p> @endif
                @if(isset($request->WHID) && $request->WHID) <p class="line"><strong>Location :</strong> @foreach($request->WHID as $whid) {{\App\Models\WhereHouse::find($whid)->WH_Name}}, @endforeach </p> @endif
                @if(isset($request->supplier) && $request->WHID) <p class="line"><strong>Location :</strong> @foreach($request->WHID as $whid) {{\App\Models\WhereHouse::find($whid)->WH_Name}}, @endforeach </p> @endif
                @if(isset($request->created_by) && $request->created_by) <p class="line"><strong>Created BY :</strong> @foreach($request->created_by as $created_by) {{\App\Models\User::find($created_by)->name}}, @endforeach </p> @endif
                @if(isset($request->suppliers) && $request->suppliers) <p class="line"><strong>supplier :</strong> @foreach($request->suppliers as $supplier) {{\App\Models\Supplier::find($supplier)->name}}, @endforeach </p> @endif
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
            <th class="report_col">Sr#</th>
            <th class="report_col">Date</th>
            <th class="report_col">Invoice NO.</th>
            <th class="report_col">Location</th>
            <th class="report_col">Reference</th>
            <th class="report_col">Supplier Name</th>
            <th class="report_col">Created by</th>
            <th class="report_col">status</th>
            <th class="report_col">Qty</th>
            <th class="report_col">Amount</th>
        </tr>
        </thead>
        <tbody>
        <?php $total_amount= 0; $total_qty= 0;
        $i=1;
        ?>
        @if(isset($reports) && count($reports))
            <?php
            function purchase_status($status) {
                if($status==0){
                    return 'Received';
                }else if($status==1){
                    return 'Partial';
                }else if($status==2){
                    return 'Pending';
                }else if($status==3){
                    return 'Ordered';
                }else if($status==4){
                    return 'Returned';
                }
            }
            ?>
            @foreach($reports as $report)
                    <tr style="border: 1px solid #000;">
                        <td class="report_col">{{$i++}}</td>
                        <td class="report_col">{{date("d-m-Y", strtotime(substr($report->date,0,10))) }} </td>
                        @if($report->doc_type == "PI")
                            <td class="report_col"><a  href="/print_purchase/{{$report->invoice_no}}" target="_blank">PI-{{$report->invoice_no}}</a></td>
                        @else
                            <td class="report_col"><a  href="/purchase_return_print/{{$report->invoice_no}}" target="_blank">PR-{{$report->invoice_no}}</a></td>
                        @endif
                        <td class="report_col">{{isset($report->warehouse_name)?$report->warehouse_name:"N/A"}}</td>
                        <td class="report_col">{{$report->reference}}</td>
                        <td class="report_col">{{$report->supplier_name}}</td>
                        <td class="report_col">{{isset($report->created_by)?$report->created_by:"N/A"}}</td>
                        <td class="report_col">{{$report->total_qty}}</td>
                        <td class="report_col">{{purchase_status($report->status)}}</td>
                        <td class="report_col">{{$report->net_total}}</td>
                    </tr>
                   <?php
                   if($report->doc_type == "PI"){
                       $total_amount += (float) $report->net_total;
                       $total_qty += (float) $report->total_qty;
                   }else{
                       $total_amount -= (float) $report->net_total;
                       $total_qty -= (float) $report->total_qty;
                   }

                   ?>
            @endforeach
            <tr style="border: 1px solid #000;" class="bg-dg">
                <th colspan="7"  class="report_col"> Total</th>
                <th class="report_col"> {{$total_qty}} </th>
                <th></th>
                <th class="report_col"> {{$total_amount}} </th>
            </tr>

        @endif

        <tr>
            <div class="page-footer col-md-12">
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

