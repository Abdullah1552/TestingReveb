<?php

namespace App\Http\Controllers\reports\purchase;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ConsolidatedPurchaseReport extends Controller
{
    public function index()
    {
        return view('Reports.Purchase.consolidated-purchase.index');
    }

    public function get_records(Request $request)
    {
        $data['request']=$request;
        $data['reports']=DB::table('stock_details')

            ->when($request->WHID, function ($query) use ($request) {
                $query->whereIn('stock_details.WHID', $request->WHID);
            })
            ->orderBy('stock_details.id','DESC')
           ->leftJoin('purchase_invoices','purchase_invoices.id','stock_details.PID')
            ->leftJoin('purchase_returns','purchase_returns.id','stock_details.PRID')
            ->leftJoin('suppliers as pi_sup','purchase_invoices.SUPID','pi_sup.id')
            ->leftJoin('suppliers as pr_sup','purchase_returns.SUPID','pr_sup.id')
            ->join('where_houses','stock_details.WHID','where_houses.id')
            ->Leftjoin('users as pi_crt','purchase_invoices.created_by','pi_crt.id')
            ->Leftjoin('users as pr_crt','purchase_invoices.created_by','pr_crt.id')
            ->groupBY('PID','PRID')
            ->select(
                'where_houses.Wh_Name as warehouse_name',
                DB::raw('sum(stock_details.QTY) as total_qty'),
                DB::raw('(select IFNULL(pi_sup.name,pr_sup.name)) as supplier_name'),
                DB::raw('(select IFNULL(purchase_invoices.id,purchase_returns.id)) as invoice_no'),
                DB::raw('(SELECT IF(purchase_invoices.id, "PI", "PR")) as doc_type'),
                DB::raw('(select IFNULL(purchase_invoices.purchase_date,purchase_returns.date)) as date'),
                DB::raw('(select IFNULL(purchase_invoices.reference,purchase_returns.pr)) as reference'),
                DB::raw('(select IFNULL(purchase_invoices.net_total,purchase_returns.net_total)) as net_total'),
                DB::raw('(select IFNULL(pi_crt.name,pr_crt.name)) as created_by'),
                DB::raw('(select IFNULL(purchase_invoices.purchase_status,4)) as status'),
                )
            ->whereRaw('(select IFNULL(purchase_invoices.id,purchase_returns.id)) IS NOT NULL')
            ->when($request->suppliers,function ($query) use ($request) {
                  $query->whereIn('purchase_invoices.SUPID', $request->suppliers)->whereIn('purchase_returns.SUPID', $request->suppliers);
            })
            ->when($request->created_by,function ($query) use ($request) {
                 $query->whereIn('purchase_invoices.created_by', $request->created_by)->whereIn('purchase_returns.created_by', $request->created_by);
            })
            ->when($request->reference, function($query)use ($request){
                 $query->where('purchase_invoices.reference','LIKE', '%'.$request->reference.'%');
            })
            ->when($request->df, function ($query) use ($request) {
                return $query->whereBetween(DB::raw('DATE(purchase_invoices.inv_date)'), [$request->df, isset($request->dt) ? $request->dt : date('Y-m-d')])->whereBetween(DB::raw('DATE(purchase_returns.date)'), [$request->df, isset($request->dt) ? $request->dt : date('Y-m-d')]);
            })
            ->get();
        return view('Reports.Purchase.consolidated-purchase.report',$data);
    }

}
