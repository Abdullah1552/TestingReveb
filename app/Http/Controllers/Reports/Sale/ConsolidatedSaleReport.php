<?php

namespace App\Http\Controllers\reports\sale;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ConsolidatedSaleReport extends Controller
{
    public function index(  )
    {
        return view('Reports.sale.consolidated-sale.index');
    }

    public function get_records(Request $request)
    {
        $data['request']=$request;
        $data['reports']=DB::table('stock_details')
            ->orderBy('stock_details.id','DESC')
            ->leftJoin('sale_invoices','sale_invoices.id','stock_details.SID')
            ->leftJoin('sale_returns','sale_returns.id','stock_details.SRID')
            ->leftJoin('customers as si_cus','sale_invoices.customer_id','si_cus.id')
            ->leftJoin('customers as sr_cus','sale_returns.customer_id','sr_cus.id')
            ->leftJoin('where_houses','stock_details.WHID','where_houses.id')
            ->Leftjoin('users as si_crt','sale_invoices.created_by','si_crt.id')
            ->Leftjoin('users as sr_crt','sale_returns.created_by','sr_crt.id')
            ->groupBY('SID','SRID')
            ->select(
                'where_houses.Wh_Name as warehouse_name',
                DB::raw('sum(stock_details.QTY) as total_qty'),
                DB::raw('(select IFNULL(si_cus.name,sr_cus.name)) as customer_name '),
                DB::raw('(select IFNULL(sale_invoices.id,sale_returns.id)) as invoice_no'),
                DB::raw('(SELECT IF(sale_invoices.id, "SI", "SR")) as doc_type'),
                DB::raw('(select IFNULL(sale_invoices.inv_date,sale_returns.date)) as date'),
                DB::raw('(select IFNULL(sale_invoices.net_total,sale_returns.net_total)) as net_total'),
                DB::raw('(select IFNULL(si_crt.name,sr_crt.name)) as created_by'),
                DB::raw('(select IFNULL(sale_invoices.sale_status,3)) as status'),
                )
            ->whereRaw('(select IFNULL(sale_invoices.id,sale_returns.id)) IS NOT NULL')
            ->when($request->customers,function ($query) use ($request) {
                return  $query->whereIn('sale_invoices.customer_id', $request->customers)->whereIn('sale_returns.customer_id', $request->customers);
            })
            ->when($request->created_by,function ($query) use ($request) {
                return $query->whereIn('sale_invoices.created_by', $request->created_by)->whereIn('sale_returns.created_by', $request->created_by);
            })
            ->when($request->WHID, function ($query) use ($request) {
                return $query->whereIn('stock_details.WHID', $request->WHID);
            })
            ->when($request->df, function ($query) use ($request) {
                return $query->whereBetween(DB::raw('DATE(sale_invoices.inv_date)'), [$request->df, isset($request->dt) ? $request->dt : date('Y-m-d')])->whereBetween(DB::raw('DATE(sale_returns.date)'), [$request->df, isset($request->dt) ? $request->dt : date('Y-m-d')]);
            })
            ->get();

        return view('Reports.sale.consolidated-sale.report',$data);
    }
}
