<?php

namespace App\Http\Controllers\reports\sale;

use App\Http\Controllers\Controller;
use App\Models\CashRegister;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CashRegisterController extends Controller
{
    function index(){
        return view('Reports.sale.cash-register.index',);
    }

    public function get_records(Request $request)
    {
        $data['request']=$request;
        $data['reports'] = CashRegister::with(['location' => function ($query) {
            $query->select('id', 'WH_Name');
        },
            'staff'=>function($query){
                $query->select('id', 'name');
            },
            'closing_staff'=>function($query){
                $query->select('id', 'name');
            }])
            ->select('cash_registers.*')
            ->when($request->WHID, function ($query) use ($request) {
                return $query->whereIn('cash_registers.WHID',$request->WHID);
            })
            ->when($request->open_by, function ($query) use ($request) {
                return $query->whereIn('cash_registers.open_by', $request->open_by);
            })
            ->when($request->closed_by, function ($query) use ($request) {
                return $query->whereIn('cash_registers.closed_by', $request->closed_by);
            })
            ->when($request->df, function ($query) use ($request) {
                return $query->whereBetween(DB::raw('DATE(cash_registers.created_at)'), [$request->df, isset($request->dt) ? $request->dt : date('Y-m-d')]);
            })->orderBy('id','Desc')
            ->get();

        return view('Reports.sale.cash-register.report',$data);
    }
}
