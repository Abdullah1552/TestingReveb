<?php

namespace App\Http\Controllers\reports\sale;

use App\Http\Controllers\Controller;
use App\Models\SaleReturn;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SaleReturnController extends Controller
{
    public function index()
    {
        return view('Reports.sale.return.index');
    }

    public function get_records(Request $request)
    {
        $data['request']=$request;
        $data['reports']=SaleReturn::orderBy('stock_details.id','DESC')
            ->leftjoin('customers','sale_returns.customer_id','customers.id')
            ->Join('stock_details','stock_details.SRID','=','sale_returns.id')
            ->join('where_houses','stock_details.WHID','where_houses.id')
            ->Leftjoin('users','sale_returns.created_by','users.id')
            ->select('where_houses.WH_Name as warehouse_name','customers.name as customer_name',
                'sale_returns.id','sale_returns.date as date','sale_returns.net_total',
                'users.name as created_by',DB::raw('sum(stock_details.QTY) as total_qty'))
            ->groupBY('SRID')
            ->when($request->customers,function ($query) use ($request) {
                return $query->whereIn('sale_returns.customer_id', $request->customers);
            })
            ->when($request->created_by,function ($query) use ($request) {
                return $query->whereIn('sale_returns.created_by', $request->created_by);
            })
            ->when($request->WHID, function ($query) use ($request) {
                return $query->whereIn('stock_details.WHID', $request->WHID);
            })
            ->when($request->df, function ($query) use ($request) {
                return $query->whereBetween(DB::raw('DATE(sale_returns.inv_date)'), [$request->df, isset($request->dt) ? $request->dt : date('Y-m-d')]);
            })
            ->get();

        return view('Reports.sale.return.report',$data);
    }
}
