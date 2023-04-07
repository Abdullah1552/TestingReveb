<div class="col-md-12" style="min-height: 100%;height: 100%; float: left;">
    <div class="clearfix"></div>
    <table class="table-print table2excel"
           style=" width: 100%; font-family: sans-serif;text-align: center;border-collapse: collapse; margin-top: 10px;font-size: 12px;">
        <thead>
        <tr style="margin-bottom: 100px;">
            <td colspan="5" style="font-family: sans-serif;    text-align: left;">
                <img
                    src="{{ url('storage/app/public/sale_images') }}/{{ \App\Models\BusinessSetting::first()->business_logo }}"
                    width="150"/>
                <p class="line"> {{\App\Models\WhereHouse::find(Auth::user()->WHID)->WH_Address}}</p>
                <p class="line"><strong>Phone : </strong> {{\App\Models\WhereHouse::find(Auth::user()->WHID)->WH_Mobile}}</p>
                <p class="line"><strong>Email : </strong> {{\App\Models\WhereHouse::find(Auth::user()->WHID)->WH_Email}}</p>
            </td>
            <td></td>

            <td style="font-family: sans-serif;    text-align: left;" colspan="4"><span style="font-size: 1.5rem;font-weight: bolder;">Sale Return Report</span>
                <p class="line"><strong>Issue date:</strong> {{date("d-m-Y ", time())}}</p>
                @if(isset($request->df) && $request->df) <p class="line"><strong>Date from :</strong> {{$request->df}}</p> @endif
                @if(isset($request->dt) && $request->dt) <p class="line"><strong>Date To:</strong> {{$request->dt}}</p> @endif
                @if(isset($request->WHID) && $request->WHID) <p class="line"><strong>Location :</strong> @foreach($request->WHID as $whid) {{\App\Models\WhereHouse::find($whid)->WH_Name}}, @endforeach </p> @endif
                @if(isset($request->created_by) && $request->created_by) <p class="line"><strong>Created BY :</strong> @foreach($request->created_by as $created_by) {{\App\Models\User::find($created_by)->name}}, @endforeach </p> @endif
                @if(isset($request->customers) && $request->customers) <p class="line"><strong>Customers: </strong> @foreach($request->customers as $customer) {{\App\Models\Customer::find($customer)->name}}, @endforeach </p> @endif
            </td>


        </tr>

        <tr class="spacer" style="height: 20px;"></tr>

        <tr style="border: 1px solid #000;" class="bg-dg">
            <th class="report_col">Sr#</th>
            <th class="report_col">Date</th>
            <th class="report_col">Invoice NO.</th>
            <th class="report_col">Created by</th>

            <th class="report_col">Location</th>
            <th class="report_col">Customer</th>
            <th class="report_col">Qty </th>
            <th class="report_col">Amount</th>

        </tr>
        </thead>
        <tbody>
        <?php $total_amount= 0; $total_qty= 0;
        $i=1;
        ?>
        @if(isset($reports) && count($reports))
            @foreach($reports as $report)
                    <tr style="border: 1px solid #000;">
                        <td class="report_col">{{$i++}}</td>
                        <td class="report_col">{{date("d-m-Y", strtotime(substr($report->date,0,10))) }} </td>
                        <td class="report_col"><a  href="/sale_return_print/{{$report->id}}" target="_blank">{{$report->id}}</a></td>
                        <td class="report_col">{{isset($report->created_by)?$report->created_by:"N/A"}}</td>

                        <td class="report_col">{{isset($report->warehouse_name)?$report->warehouse_name:"N/A"}}</td>
                        <td class="report_col">{{$report->customer_name}}</td>
                        <td class="report_col">{{$report->total_qty}}</td>
                        <td class="report_col">{{$report->net_total}}</td>
                    </tr>
                   <?php
                   $total_qty += (float) $report->total_qty;
                   $total_amount += (float) $report->net_total;
                   ?>
            @endforeach
            <tr style="border: 1px solid #000;" class="bg-dg">
                <th colspan="6"  class="report_col"> Total</th>
                <th class="report_col"> {{$total_qty}} </th>
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

