<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use App\Models\CashRegister;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Helpers\helpers;

class FinanceReportController extends Controller
{
    //leger reports
    public function ledger_report()
    {
        return view('Reports.finance.ledger.index');
    }
    public function print_ledger(Request $request){
        $tdr=0; $tcr=0; $cb=0;
        $res=Transaction::whereBetween('trans_date', [$request->df, $request->dt])->where(['trans_acc_id'=>$request->ledger_id, 'status'=>1])->get();
        $ob=helpers::ob($request->df, $request->ledger_id);
        $data='';
        $ob=helpers::ob($request->df, $request->ledger_id);
        $data.='<tr>';
        $data.='<td colspan="6" align="right">Opening Balance As At '.$request->df.'</td>';
        $data.='<td align="right">'.helpers::show_bal($ob).'</td>';
        $data.='</tr>';
        foreach ($res as $item){
            if($item->dr_cr==1){
                $tdr+=$item->amount;
            }
            if($item->dr_cr==2){
                $tcr+=$item->amount;
            }
            $cb=$ob+($tdr-$tcr);
            $data.='<tr>';
            $data.='<td>'.$item->trans_date.'</td>';
            $data.='<td>'.helpers::vt($item->vt).'</td>';
            $data.='<td>'.helpers::dsn($item->trans_code).'</td>';
            $data.='<td>'.$item->narration.'</td>';
            $data.='<td>'.(($item->dr_cr==1)?$item->amount:'0.00').'</td>';
            $data.='<td>'.(($item->dr_cr==2)?$item->amount:'0.00').'</td>';
            $data.='<td align="right">'.helpers::show_bal($cb).'</td>';
            $data.='</tr>';
        }
        $data.='<tr>';
        $data.='<td colspan="4"></td>';
        $data.='<th style="border-top: double">'.number_format($tdr,2).'</th>';
        $data.='<th style="border-top: double"> '.number_format($tcr,2).'</th>';
        $data.='<th style="text-align: right; border-top:double">'.helpers::show_bal($cb).'</th>';
        $data.='</tr>';
        return view('Reports.finance.ledger.print_ledger',compact('data','ob'));
    }
    public function cash_register(){
        return view('Reports.finance.cash_register.index');
    }
    public function get_cash_register(){
        $result=CashRegister::with('location','staff')->paginate(15);
        return $result;
    }
    public function print_cash_register(){
        $result=CashRegister::with('location','staff')->get();
        return view('Reports.finance.cash_register.print',compact('result'));
    }
}
