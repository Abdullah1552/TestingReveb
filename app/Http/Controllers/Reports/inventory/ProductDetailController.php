<?php

namespace App\Http\Controllers\reports\inventory;

use App\Http\Controllers\Controller;
use App\Models\OInventory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductDetailController extends Controller
{
    public function index()
    {
        return view('Reports.Inventory.product_detail.index');
    }

    public function get_records(Request $request)
    {
        $reports['request'] = $request;

        $reports['products'] =DB::table('stock_details')
            ->join('where_houses','stock_details.WHID','where_houses.id')
            ->join ('products', 'stock_details.product_id', 'products.id')
            ->leftJoin('categories', 'categories.id', '=', 'products.product_category')
            ->leftJoin('o_inventories','stock_details.OID','=','o_inventories.id')
            ->leftJoin('adjustments','stock_details.ADJID','=','adjustments.id')
            ->leftJoin('transfers','stock_details.TRFID','=','transfers.id')
            ->leftJoin('sale_invoices','stock_details.SID','=','sale_invoices.id')
            ->leftJoin('sale_returns','stock_details.SRID','=','sale_returns.id')
            ->leftJoin('purchase_returns','stock_details.PRID','=','purchase_returns.id')
            ->leftJoin('purchase_invoices','stock_details.PID','=','purchase_invoices.id')
            ->select(
                DB::raw("((SELECT IFNULL(sum(Qty),0) from stock_details AS T where T.in_out=1 and T.WHID=stock_details.WHID and T.product_code=stock_details.product_code) - (SELECT IFNULL(sum(Qty),0) from stock_details AS T where T.in_out=2 and T.WHID=stock_details.WHID and T.product_code=stock_details.product_code)) As available_stock"),
                DB::raw("SUM((SELECT IFNULL(sum(Qty),0)  from stock_details AS T where T.in_out=1 and T.WHID=stock_details.WHID  and T.product_code=stock_details.product_code and T.OID=o_inventories.id  and  T.WHID=o_inventories.WHID )) As oi"),
                DB::raw("SUM((SELECT IFNULL(sum(Qty),0)  from stock_details AS T where T.in_out=2 and T.WHID=stock_details.WHID  and T.product_code=stock_details.product_code and T.ADJID=adjustments.id and T.WHID=adjustments.WHID  )) As adjustment_minus"),
                DB::raw("SUM((SELECT IFNULL(sum(Qty),0)  from stock_details AS T where T.in_out=1 and T.WHID=stock_details.WHID  and T.product_code=stock_details.product_code and T.ADJID=adjustments.id and T.WHID=adjustments.WHID  )) As adjustment_plus"),
                DB::raw("SUM((SELECT IFNULL(sum(Qty),0)  from stock_details AS T where T.in_out=1 and T.WHID=stock_details.WHID  and T.product_code=stock_details.product_code and T.TRFID=transfers.id and T.WHID=transfers.WHIDT  )) As transfer_in"),
                DB::raw("SUM((SELECT IFNULL(sum(Qty),0)  from stock_details AS T where T.in_out=2 and T.WHID=stock_details.WHID  and T.product_code=stock_details.product_code and T.TRFID=transfers.id and T.WHID=transfers.WHIDF  )) As transfer_out"),
                DB::raw("SUM((SELECT IFNULL(sum(Qty),0)  from stock_details AS T where T.in_out=2 and T.WHID=stock_details.WHID  and T.product_code=stock_details.product_code and T.SID=stock_details.SID and T.WHID=sale_invoices.WHID  )) As sold"),
                DB::raw("SUM((SELECT IFNULL(sum(Qty),0)  from stock_details AS T where T.in_out=1 and T.WHID=stock_details.WHID  and T.product_code=stock_details.product_code and T.SRID=sale_returns.id and T.WHID=sale_returns.WHID  )) As sale_return"),
                DB::raw("SUM((SELECT IFNULL(sum(Qty),0)  from stock_details AS T where T.in_out=2 and T.WHID=stock_details.WHID  and T.product_code=stock_details.product_code and T.PRID=purchase_returns.id and T.WHID=purchase_returns.WHID  )) As purchase_return"),
                DB::raw("SUM((SELECT IFNULL(sum(Qty),0)  from stock_details AS T where T.in_out=1 and T.WHID=stock_details.WHID  and T.product_code=stock_details.product_code and T.PID=purchase_invoices.id and T.WHID=purchase_invoices.WHID  )) As purchase"),
                'products.name as product_name','stock_details.product_code','where_houses.WH_Name as warehouse_name', 'categories.name as category_name','products.alert_qty'
            )
            ->groupBy('stock_details.product_code','stock_details.WHID')
            ->when($request->df, function ($query) use ($request) {
                $query->whereBetween(DB::raw('DATE(stock_details.created_at)'), [$request->df, isset($request->dt) ? $request->dt : date('Y-m-d')])
                    ->selectRaw("((SELECT IFNULL(sum(Qty),0) from stock_details AS T where T.in_out=1 and T.WHID=stock_details.WHID and T.product_code=stock_details.product_code and DATE(T.created_at) < ?) - (SELECT IFNULL(sum(Qty),0) from stock_details AS T where T.in_out=2 and T.WHID=stock_details.WHID and T.product_code=stock_details.product_code and DATE(T.created_at) < ?)) As previous_stock",[$request->df,$request->df]);
            })->when($request->WHID, function ($query) use ($request) {
                $query->whereIn('stock_details.WHID', $request->WHID);
            })->when($request->category, function ($query) use ($request) {
                $query->whereIn('products.product_category', $request->category);
            })->when($request->include_0 =="0", function ($query) use ($request) {
                $query->whereRaw("((SELECT IFNULL(sum(Qty),0) from stock_details AS T where T.in_out=1 and T.WHID=stock_details.WHID and T.product_code=stock_details.product_code) - (SELECT IFNULL(sum(Qty),0) from stock_details AS T where T.in_out=2 and T.WHID=stock_details.WHID and T.product_code=stock_details.product_code)) > 0");
            })->when($request->product_code, function ($query) use ($request) {
                $query->whereIn('stock_details.product_code', $request->product_code);
            })
            ->orderBy('stock_details.updated_at', 'DESC')
            ->get();

        return view('Reports.Inventory.product_detail.report',$reports);
    }
}
