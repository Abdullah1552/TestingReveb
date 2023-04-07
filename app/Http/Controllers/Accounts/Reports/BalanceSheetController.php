<?php

namespace App\Http\Controllers\Accounts\Reports;

use App\Helpers\helpers;
use App\Http\Controllers\Controller;
use App\Models\HeadAccount;
use App\Models\RootAccount;
use App\Models\SubHead;
use App\Models\TransAccount;
use Illuminate\Http\Request;

class BalanceSheetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $htmlData='';
        $roots=RootAccount::all();
        foreach ($roots as $root) {
            $htmlData .= '<tr class="bg-gradient-info">';
                $htmlData .= '<th colspan="2">0'.$root->id.'-'.$root->acc_name.'</th>';
            $htmlData .= '</tr>';
            $heads=HeadAccount::where('RID', $root->id)->get();
            foreach ($heads as $head){
                $total_asset=0;
                $htmlData .= '<tr>';
                $htmlData .= '<th colspan="2"><span style="margin-left: 25px;">'.$root->id.''.$head->id.'-'.$head->Head_Ac_Name.'</span></th>';
                $htmlData .= '</tr>';
                $subHeads=SubHead::where('HID', $head->id)->get();
                foreach ($subHeads as $subHead){
                    $htmlData .= '<tr>';
                    $htmlData .= '<td colspan="2"><span style="margin-left: 35px;">'.$subHead->Sub_Head_Name.'</span></td>';
                    $htmlData .= '</tr>';
                    $accounts=TransAccount::where('PID', $subHead->id)->get();
                    foreach ($accounts as $account) {
                        $total_asset+=helpers::ob(date('Y-m-d'),$account->id);
                        $htmlData .= '<tr>';
                        $htmlData .= '<td><span style="margin-left: 200px;">' . $account->Trans_Acc_Name . '</span></td>';
                        $htmlData .= '<td style="text-align: right">'.helpers::show_bal(helpers::ob(date('Y-m-d'),$account->id)).'</td>';
                        $htmlData .= '</tr>';
                    }
                }
                $htmlData.='<tr>';
                    $htmlData.='<td style="text-align: right">Total '.$head->name.':</td>';
                    $htmlData.='<th style="text-align: right; border-top: double;border-bottom: double">'.helpers::show_bal($total_asset).'</th>';
                $htmlData.='</tr>';
            }
        }
        return view('Accounts.reports.balance_sheet.index',compact('htmlData'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
