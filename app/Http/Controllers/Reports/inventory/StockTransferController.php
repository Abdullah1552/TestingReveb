<?php

namespace App\Http\Controllers\Reports\Inventory;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Transfer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StockTransferController extends Controller
{
    public function index()
    {
        return view('Reports.Inventory.stock_transfer.index');
    }
    public function get_records(Request $request)
    {
        $reports['request'] = $request;
        $reports['products'] = Transfer::join('where_houses as from_where_houses','from_where_houses.id','=','transfers.WHIDF')
            ->join('where_houses as to_where_houses','to_where_houses.id','=','transfers.WHIDT')
            ->join('stock_details','stock_details.TRFID','=','transfers.id')
            ->join('products','stock_details.product_id','products.id')
            ->join('categories', 'categories.id', '=', 'products.product_category')
            ->select('from_where_houses.WH_Name as from','to_where_houses.WH_Name as to',
                'categories.name as category_name','products.name as name','stock_details.product_code','stock_details.Qty','transfers.created_at','transfers.status')
            ->when($request->df, function ($query) use ($request) {
                $query->whereBetween(DB::raw('DATE(transfers.created_at)'), [$request->df, isset($request->dt) ? $request->dt : date('Y-m-d')]);
            })->when($request->WHIDF, function ($query) use ($request) {
                $query->whereIn('transfers.WHIDF', $request->WHIDF);
            })->when($request->WHIDT, function ($query) use ($request) {
                $query->whereIn('transfers.WHIDT', $request->WHIDT);
            })->when($request->category, function ($query) use ($request) {
                $query->whereIn('products.product_category', $request->category);
            })->when($request->product_code, function ($query) use ($request) {
                $query->whereIn('stock_details.product_code', $request->product_code);
            })->groupBy('stock_details.product_code','stock_details.TRFID')
            ->get();
        return view('Reports.Inventory.stock_transfer.report', $reports);
    }

}
