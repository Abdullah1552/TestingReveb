<?php

namespace App\Http\Controllers\reports\sale;

use App\Http\Controllers\Controller;
use App\Models\{PurchaseInvoice,SaleInvoice};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductSaleController extends Controller
{

    public function index()
    {
        return view('Reports.sale.product-wise-sale.index');
    }

    public function get_records(Request $request)
    {
        $data['request']=$request;
        $data['reports']= SaleInvoice::join('where_houses','where_houses.id','=','sale_invoices.WHID')
            ->join('stock_details','stock_details.SID','=','sale_invoices.id')
            ->join('products','stock_details.product_id','products.id')
            ->join('customers','sale_invoices.customer_id','customers.id')
            ->Leftjoin('users','sale_invoices.created_by','users.id')
            ->join('categories', 'categories.id', '=', 'products.product_category')
            ->select('where_houses.WH_Name as warehouse_name',
                'categories.name as category_name','products.name as name','stock_details.product_code','stock_details.Qty',
                'sale_invoices.id','sale_invoices.inv_date as date','users.name as created_by','customers.name as customer_name',
                )
            ->when($request->customers,function ($query) use ($request) {
                return $query->whereIn('sale_invoices.customer_id', $request->customers);
            })
            ->when($request->created_by,function ($query) use ($request) {
                return $query->whereIn('sale_invoices.created_by', $request->created_by);
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
                return $query->whereBetween(DB::raw('DATE(sale_invoices.inv_date)'), [$request->df, isset($request->dt) ? $request->dt : date('Y-m-d')]);
            })
            ->get();

        return view('Reports.sale.product-wise-sale.report',$data);
    }
}
