<?php

namespace App\Http\Controllers\reports\Sale;

use App\Http\Controllers\Controller;
use App\Models\SaleInvoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SaleInvoiceController extends Controller
{
    public function index()
    {
        return view('Reports.sale.invoice.index');
    }

    public function get_records(Request $request)
    {
        $data['request']=$request;
        $data['reports']=SaleInvoice::orderBy('stock_details.id','DESC')
            ->join('customers','sale_invoices.customer_id','customers.id')
            ->join('sale_persons','sale_invoices.sale_person','sale_persons.id')
            ->Join('stock_details','stock_details.SID','=','sale_invoices.id')
            ->join('where_houses','stock_details.WHID','where_houses.id')
            ->Leftjoin('users','sale_invoices.created_by','users.id')
            ->select('where_houses.WH_Name as warehouse_name','customers.name as customer_name','sale_persons.name as sale_person_name',
                'sale_invoices.id','sale_invoices.id', 'sale_invoices.sale_type','sale_invoices.received_amount as paid','sale_invoices.inv_date as date','sale_invoices.net_total',
                'users.name as created_by',DB::raw('sum(stock_details.QTY) as total_qty'))
            ->groupBY('SID')
            ->when($request->customers,function ($query) use ($request) {
                return $query->whereIn('sale_invoices.customer_id', $request->customers);
            })
            ->when($request->created_by,function ($query) use ($request) {
                return $query->whereIn('sale_invoices.created_by', $request->created_by);
            })
            ->when($request->WHID, function ($query) use ($request) {
                return $query->whereIn('stock_details.WHID', $request->WHID);
            })
            ->when($request->df, function ($query) use ($request) {
                return $query->whereBetween(DB::raw('DATE(sale_invoices.inv_date)'), [$request->df, isset($request->dt) ? $request->dt : date('Y-m-d')]);
            })->when($request->sale_type !='all', function($query)use ($request){
                $query->where('sale_invoices.sale_type', $request->sale_type);
            })
            ->get();

        return view('Reports.sale.invoice.report',$data);
    }
}
