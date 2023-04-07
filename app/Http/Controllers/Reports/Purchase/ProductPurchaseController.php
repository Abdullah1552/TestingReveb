<?php

namespace App\Http\Controllers\reports\purchase;

use App\Http\Controllers\Controller;
use App\Models\PurchaseInvoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductPurchaseController extends Controller
{
    public function index()
    {
        return view('Reports.Purchase.product-purchase.index');
    }

    public function get_records(Request $request)
    {
        $data['request']=$request;
        $data['reports']= PurchaseInvoice::join('where_houses','where_houses.id','=','purchase_invoices.WHID')
            ->join('stock_details','stock_details.PID','=','purchase_invoices.id')
            ->join('products','stock_details.product_id','products.id')
            ->Leftjoin('users','purchase_invoices.created_by','users.id')
            ->join('suppliers','purchase_invoices.SUPID','suppliers.id')
            ->join('categories', 'categories.id', '=', 'products.product_category')
            ->select('where_houses.WH_Name as warehouse_name',
                'categories.name as category_name','products.name as name','stock_details.product_code','stock_details.Qty','purchase_invoices.created_at',
                'purchase_invoices.id','purchase_invoices.purchase_date','purchase_invoices.reference','users.name as created_by',
                'suppliers.name as supplier_name',
                )
            ->when($request->suppliers,function ($query) use ($request) {
                return $query->whereIn('purchase_invoices.SUPID', $request->suppliers);
            })
            ->when($request->created_by,function ($query) use ($request) {
                return $query->whereIn('purchase_invoices.created_by', $request->created_by);
            })
            ->when($request->reference, function($query)use ($request){
                $query->where('purchase_invoices.reference','LIKE', '%'.$request->reference.'%');
            })
            ->when($request->WHID, function ($query) use ($request) {
                return $query->whereIn('stock_details.WHID', $request->WHID);
            })
            ->when($request->product_code, function ($query) use ($request) {
                return $query->whereIn('stock_details.product_code', $request->product_code);
            })
            ->when($request->category, function ($query) use ($request) {
                return $query->whereIn('categories.id', $request->category);
            })
            ->when($request->df, function ($query) use ($request) {
                return $query->whereBetween(DB::raw('DATE(purchase_invoices.purchase_date)'), [$request->df, isset($request->dt) ? $request->dt : date('Y-m-d')]);
            })
            ->get();

        return view('Reports.Purchase.product-purchase.report',$data);
    }
}
