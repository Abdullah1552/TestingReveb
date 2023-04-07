<?php

namespace App\Http\Controllers\reports\inventory;

use App\Http\Controllers\Controller;
use App\Models\OInventory;
use App\Models\Product\Adjustment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OpeningInventoryController extends Controller
{

    public function index()
    {
        return view('Reports.Inventory.opening_inventory.index');
    }
    public function get_records(Request $request)
    {
        $reports['products'] = OInventory::
        join('where_houses','where_houses.id','=','o_inventories.WHID')
            ->join('stock_details','stock_details.OID','=','o_inventories.id')
            ->join('products','stock_details.product_id','products.id')
            ->join('categories', 'categories.id', '=', 'products.product_category')
            ->select('where_houses.WH_Name as warehouse_name',
                'categories.name as category_name','products.name as name','stock_details.product_code','stock_details.Qty','o_inventories.created_at')
            ->when($request->df, function ($query) use ($request) {
                $query->whereBetween(DB::raw('DATE(o_inventories.created_at)'), [$request->df, isset($request->dt) ? $request->dt : date('Y-m-d')]);
            })->when($request->WHID, function ($query) use ($request) {
                $query->whereIn('o_inventories.WHID', $request->WHID);
            })->when($request->category, function ($query) use ($request) {
                $query->whereIn('products.product_category', $request->category);
            })->when($request->product_code, function ($query) use ($request) {
                $query->whereIn('stock_details.product_code', $request->product_code);
            })
            ->get();
        return view('Reports.Inventory.opening_inventory.report', $reports);
    }

}
