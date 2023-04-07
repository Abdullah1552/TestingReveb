<?php

namespace App\Http\Controllers\Reports\Purchase;

use App\Http\Controllers\Controller;
use App\Models\PurchaseReturn;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PurchaseReturnController extends Controller
{

    public function index()
    {
        return view('Reports.Purchase.Return.index');
    }

    public function get_records(Request $request)
    {
        $data['request']=$request;
        $data['reports']=PurchaseReturn::orderBy('id','DESC')
            ->join('suppliers','purchase_returns.SUPID','suppliers.id')
            ->Join('stock_details','stock_details.PID','=','purchase_returns.id')
            ->join('where_houses','stock_details.WHID','where_houses.id')
            ->Leftjoin('users','purchase_returns.created_by','users.id')
            ->groupBY('PRID')
            ->select('where_houses.WH_Name as warehouse_name','suppliers.name as supplier_name',
                'purchase_returns.id','purchase_returns.pr as reference','purchase_returns.date','purchase_returns.net_total',
                'users.name as created_by',DB::raw('sum(stock_details.QTY) as total_qty'))
            ->when($request->suppliers,function ($query) use ($request) {
                return $query->whereIn('purchase_returns.SUPID', $request->suppliers);
            })
            ->when($request->created_by,function ($query) use ($request) {
                return $query->whereIn('purchase_returns.created_by', $request->created_by);
            })
            ->when($request->WHID, function ($query) use ($request) {
                return $query->whereIn('stock_details.WHID', $request->WHID);
            })
            ->when($request->df, function ($query) use ($request) {
                return $query->whereBetween(DB::raw('DATE(purchase_returns.date)'), [$request->df, isset($request->dt) ? $request->dt : date('Y-m-d')]);
            })
            ->get();

        return view('Reports.Purchase.Return.report',$data);
    }


}
