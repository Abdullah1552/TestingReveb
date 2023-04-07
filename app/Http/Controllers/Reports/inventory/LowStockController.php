<?php

namespace App\Http\Controllers\reports\inventory;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LowStockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Reports.Inventory.Low_stock.index');
    }

    public function get_records(Request $request)
    {

        $reports['request']=$request;
        $reports['products'] =DB::table('stock_details')
            ->join('where_houses','stock_details.WHID','where_houses.id')
            ->join('products', 'stock_details.product_id', 'products.id')
            ->leftJoin('categories', 'categories.id', '=', 'products.product_category')
            ->select(
                DB::raw("((SELECT IFNULL(sum(Qty),0) from stock_details AS T where T.in_out=1 and T.WHID=stock_details.WHID and T.product_code=stock_details.product_code) - (SELECT IFNULL(sum(Qty),0) from stock_details AS T where T.in_out=2 and T.WHID=stock_details.WHID and T.product_code=stock_details.product_code)) As available_stock"),
                'products.name as product_name','stock_details.product_code','where_houses.WH_Name as warehouse_name', 'categories.name as category_name','products.alert_qty'
            )
            ->whereRaw("((SELECT IFNULL(sum(Qty),0) from stock_details AS T where T.in_out=1 and T.WHID=stock_details.WHID and T.product_code=stock_details.product_code) - (SELECT IFNULL(sum(Qty),0) from stock_details AS T where T.in_out=2 and T.WHID=stock_details.WHID and T.product_code=stock_details.product_code)) <= products.alert_qty")
            ->groupBy('stock_details.product_code','stock_details.WHID')
            ->when($request->WHID, function ($query) use ($request) {
                $query->whereIn('stock_details.WHID', $request->WHID);
            })->when($request->category, function ($query) use ($request) {
                $query->whereIn('products.product_category', $request->category);
            })->when($request->include_0 =="0", function ($query) use ($request) {
                $query->whereRaw("((SELECT IFNULL(sum(Qty),0) from stock_details AS T where T.in_out=1 and T.WHID=stock_details.WHID and T.product_code=stock_details.product_code) - (SELECT IFNULL(sum(Qty),0) from stock_details AS T where T.in_out=2 and T.WHID=stock_details.WHID and T.product_code=stock_details.product_code)) > 0");
            })->when($request->product_code, function ($query) use ($request) {
                $query->whereIn('stock_details.product_code', $request->product_code);
            });
        if(isset($request->alert_qty) && $request->alert_qty > 0){
            $reports['products']= $reports['products']->whereRaw("((SELECT IFNULL(sum(Qty),0) from stock_details AS T where T.in_out=1 and T.WHID=stock_details.WHID and T.product_code=stock_details.product_code) - (SELECT IFNULL(sum(Qty),0) from stock_details AS T where T.in_out=2 and T.WHID=stock_details.WHID and T.product_code=stock_details.product_code)) <= ?",[$request->alert_qty])->get();

        }else{
            $reports['products'] = $reports['products']->get();
        }


        return view('Reports.Inventory.Low_stock.report', $reports);
    }

}
