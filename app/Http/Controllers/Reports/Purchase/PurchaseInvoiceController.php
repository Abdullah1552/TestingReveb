<?php

namespace App\Http\Controllers\reports\Purchase;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\PurchaseInvoice;

class PurchaseInvoiceController extends Controller
{

    public function index()
    {
        return view('Reports.Purchase.Invoice.index');
    }

    public function get_records(Request $request)
    {
        $data['request']=$request;
        $data['reports']=PurchaseInvoice::orderBy('id','DESC')
            ->join('suppliers','purchase_invoices.SUPID','suppliers.id')
            ->Join('stock_details','stock_details.PID','=','purchase_invoices.id')
            ->join('where_houses','stock_details.WHID','where_houses.id')
            ->Leftjoin('users','purchase_invoices.created_by','users.id')
            ->groupBY('PID')
            ->select('where_houses.WH_Name as warehouse_name','suppliers.name as supplier_name',
                'purchase_invoices.id','purchase_invoices.purchase_date','purchase_invoices.net_total',
                'purchase_invoices.reference','users.name as created_by',DB::raw('sum(stock_details.QTY) as total_qty'))
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
            ->when($request->df, function ($query) use ($request) {
                return $query->whereBetween(DB::raw('DATE(purchase_invoices.purchase_date)'), [$request->df, isset($request->dt) ? $request->dt : date('Y-m-d')]);
            })
            ->get();

        return view('Reports.Purchase.Invoice.report',$data);
    }

}
