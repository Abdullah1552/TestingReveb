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

            <td style="font-family: sans-serif;    text-align: left;" colspan="6"><span style="font-size: 1.5rem;font-weight: bolder;">Cash Register Report</span>
                <p class="line"><strong>Issue date:</strong> {{date("d-m-Y ", time())}}</p>
                @if(isset($request->df) && $request->df) <p class="line"><strong>Date from :</strong> {{$request->df}}</p> @endif
                @if(isset($request->dt) && $request->dt) <p class="line"><strong>Date To:</strong> {{$request->dt}}</p> @endif
                @if(isset($request->sale_type) && $request->sale_type) <p class="line"><strong>Sale type(s):</strong> {{$request->sale_type}}</p> @endif
                @if(isset($request->WHID) && $request->WHID) <p class="line"><strong>Location :</strong> @foreach($request->WHID as $whid) {{\App\Models\WhereHouse::find($whid)->WH_Name}}, @endforeach </p> @endif
                @if(isset($request->created_by) && $request->created_by) <p class="line"><strong>Created BY :</strong> @foreach($request->created_by as $created_by) {{\App\Models\User::find($created_by)->name}}, @endforeach </p> @endif
                @if(isset($request->customers) && $request->customers) <p class="line"><strong>Customers: </strong> @foreach($request->customers as $customer) {{\App\Models\Customer::find($customer)->name}}, @endforeach </p> @endif
            </td>


        </tr>

        <tr class="spacer" style="height: 20px;"></tr>

        <tr style="border: 1px solid #000;" class="bg-dg">
            <th class="report_col">Sr#</th>
            <th class="report_col">Open at</th>
            <th class="report_col">Open by</th>
            <th class="report_col">Closed by</th>
            <th class="report_col">Closed at</th>
            <th class="report_col">Location</th>
            <th class="report_col">Cash In Hand</th>
            <th class="report_col">Cash sale</th>
            <th class="report_col">Sale Return</th>
            <th class="report_col">Credit pay</th>
            <th class="report_col">Qr pay</th>
            <th class="report_col">Other pay</th>
            <th class="report_col">Total Cash</th>
            <th class="report_col">Total Sale</th>


        </tr>
        </thead>
        <tbody>
        <?php
        $cash_in_hand= 0;
        $total_sale= 0;
        $total_sale_return= 0;
        $credit_card_payment= 0;
        $qr_code_payment= 0;
        $other_payment= 0;
        $total_cash= 0;
        $total_sale= 0;
        $i=1;
        ?>
        @if(isset($reports) && count($reports))
            @foreach($reports as $report)
                    <tr style="border: 1px solid #000;">
                        <td class="report_col">{{$i++}}</td>
                        <td class="report_col">{{date("d-m-Y  h:i:sa", strtotime($report->created_at)) }} </td>
                        <td class="report_col">{{$report->staff->name}}</td>
                        <td class="report_col">{{isset($report->closing_staff->name)?$report->closing_staff->name:"Not Closed"}}</td>
                        <td class="report_col">{{isset($report->closing_staff->name)?date("d-m-Y  h:i:sa", strtotime(substr($report->updated_at,0,10))):"Not Closed" }}</td>
                        <td class="report_col">{{$report->location->WH_Name}}</td>
                        <td class="report_col">{{$report->cash_in_hand}}</td>
                        <td class="report_col">{{$report->total_sale}}</td>
                        <td class="report_col">{{$report->total_sale_return}}</td>
                        <td class="report_col">{{$report->credit_card_payment}}</td>
                        <td class="report_col">{{$report->qr_code_payment}}</td>
                        <td class="report_col">{{$report->other_payment}}</td>
                        <td class="report_col">{{$report->total_cash}}</td>
                        <td class="report_col">{{$report->total_sale}}</td>
                    </tr>
                   <?php
                    $cash_in_hand =+ (float) $report->cash_in_hand;
                    $total_sale =+ (float) $report->total_sale;
                    $total_sale_return =+ (float) $report->total_sale_return;
                    $credit_card_payment =+ (float) $report->credit_card_payment;
                    $qr_code_payment =+ (float) $report->qr_code_payment;
                    $other_payment =+ (float) $report->other_payment;
                    $total_cash =+ (float) $report->total_cash;
                    $total_sale =+ (float) $report->total_sale;
                   ?>
            @endforeach
            <tr style="border: 1px solid #000;" class="bg-dg">
                <th colspan="6"  class="report_col"> Total</th>
                <th class="report_col"> {{$cash_in_hand}} </th>
                <th class="report_col"> {{$total_sale}} </th>
                <th class="report_col"> {{$total_sale_return}} </th>
                <th class="report_col"> {{$credit_card_payment}} </th>
                <th class="report_col"> {{$qr_code_payment}} </th>
                <th class="report_col"> {{$other_payment}} </th>
                <th class="report_col"> {{$total_cash}} </th>
                <th class="report_col"> {{$total_sale}} </th>
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

