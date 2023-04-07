<?php

namespace App\Http\Controllers\reports\inventory;

use App\Http\Controllers\Controller;
use App\Models\Product\Adjustment;
use App\Models\Transfer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StockAdjustmentController extends Controller
{

    public function index(Request $request)
    {
        return view('Reports.Inventory.stock_adjustment.index');
    }
    public function get_records(Request $request)
    {
        $reports['products'] = Adjustment::
        join('where_houses','where_houses.id','=','adjustments.WHID')
            ->join('stock_details','stock_details.ADJID','=','adjustments.id')
            ->join('products','stock_details.product_id','products.id')
            ->join('categories', 'categories.id', '=', 'products.product_category')
            ->select('where_houses.WH_Name as warehouse_name',
                'categories.name as category_name','stock_details.in_out','products.name as name','stock_details.product_code','stock_details.Qty','adjustments.created_at')
            ->when($request->df, function ($query) use ($request) {
                $query->whereBetween(DB::raw('DATE(adjustments.created_at)'), [$request->df, isset($request->dt) ? $request->dt : date('Y-m-d')]);
            })->when($request->WHID, function ($query) use ($request) {
                $query->whereIn('adjustments.WHID', $request->WHID);
            })->when($request->category, function ($query) use ($request) {
                $query->whereIn('products.product_category', $request->category);
            })->when($request->product_code, function ($query) use ($request) {
                $query->whereIn('stock_details.product_code', $request->product_code);
            })->when($request->product_code, function ($query) use ($request) {
                $query->whereIn('stock_details.product_code', $request->product_code);
            })
            ->get();
        return view('Reports.Inventory.stock_adjustment.report', $reports);
    }

}
