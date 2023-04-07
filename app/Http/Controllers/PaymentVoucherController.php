<?php

namespace App\Http\Controllers;

use App\Models\PaymentVoucher;
use Illuminate\Http\Request;
use App\Helpers\helpers;
use DB;
use Auth;
use App\Models\Transaction;

class PaymentVoucherController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:payment_voucher_view', ['only' => ['index']]);
        $this->middleware('permission:payment_voucher_create', ['only' => ['store']]);
        $this->middleware('permission:payment_voucher_edit', ['only' => ['edit']]);
        $this->middleware('permission:payment_voucher_delete', ['only' => ['delete']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('accounts.Vouchers.pv.index');
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
        $rules = [
            'trans_date' => 'required',
            'payment_from' => 'required',
            'payment_to' => 'required',
            'paid_amount' => 'required',
        ];
        $message=[
            'trans_date.required'=>'Transaction Date Required',
            'payment_from.required'=>'Bank Cash Required',
            'payment_to.required'=>'Payable Required',
            'paid_amount.required'=>'Paid Amount Required',
        ];
        $this->validate($request, $rules, $message);
        $id=$request->id;
        $data['trans_date']=$request->trans_date;
        $data['trans_acc_id']=$request->payment_from;
        $data['payment_type']=$request->payment_type;
        $data['narration']=$request['particulars'][0];
        $data['amount']=$request['paid_amount'][0];
        $data['trans_code']=helpers::trans_code();
        DB::beginTransaction();
        try {
            if ($id == '' || $id == 0) {
                $data['created_by']=Auth::user()->id;
                $ret=PaymentVoucher::create($data);
                //create account entry
                $tData['trans_date']=$request->trans_date;
                $tData['posting_date']=$request->posting_date;
                $tData['trans_code']=helpers::trans_code();
                $tData['narration']=$request['particulars'][0];
                $tData['amount']=$request['paid_amount'][0];
                $tData['status']=1;
                $tData['dr_cr']=2;
                $tData['vt']=2;
                Transaction::create($tData);
                //cr to client while payment received
                $tData['trans_acc_id']=$request['payment_to'][0];
                $tData['dr_cr']=1;
                Transaction::create($tData);
            }
            DB::commit();
            return response()->json(['success'=>'Added new record Successfully.']);
        }catch (\Exception $e){
            DB::rollBack();
            return response()->json([
                'success' => 'false',
                'errors'  => $e->getMessage(),
            ], 400);
        }
    }
    public function get_data(){
        return PaymentVoucher::paginate(15);
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
