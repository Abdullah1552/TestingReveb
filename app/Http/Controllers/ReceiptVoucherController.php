<?php

namespace App\Http\Controllers;

use App\Helpers\helpers;
use App\Models\TransAccount;
use App\Models\Transaction;
use App\Models\Vouchers\ReceiptVoucher;
use Illuminate\Http\Request;
use DB;
use Auth;

class ReceiptVoucherController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:receipt_vouhcer_view', ['only' => ['index']]);
        $this->middleware('permission:receipt_vouhcer_create', ['only' => ['store']]);
        $this->middleware('permission:receipt_vouhcer_edit', ['only' => ['edit']]);
        $this->middleware('permission:receipt_vouhcer_delete', ['only' => ['delete']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('accounts.Vouchers.rv.index');
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
            'payment_to' => 'required',
            'client_id' => 'required',
            'rec_amount' => 'required',
        ];
        $message=[
            'trans_date.required'=>'Transaction Date Required',
            'payment_to.required'=>'Bank Cash Required',
            'client_id.required'=>'Client Required',
            'rec_amount.required'=>'Received Amount Required',
        ];
        $this->validate($request, $rules, $message);
        $id=$request->id;
        $data['trans_date']=$request->trans_date;
        $data['trans_acc_id']=$request->payment_to;
        $data['payment_type']=$request->payment_type;
        $data['narration']=$request['particulars'][0];
        $data['amount']=$request['rec_amount'][0];
        $data['trans_code']=helpers::trans_code();
        DB::beginTransaction();
        try {
            if ($id == '' || $id == 0) {
                $data['created_by']=Auth::user()->id;
                $ret=ReceiptVoucher::create($data);
                //create account entry
                $tData['trans_date']=$request->trans_date;
                $tData['posting_date']=$request->posting_date;
                $tData['trans_code']=helpers::trans_code();
                $tData['narration']=$request['particulars'][0];
                $tData['amount']=$request['rec_amount'][0];
                $tData['SID']=$request['inv_id'][0];
                $tData['status']=1;
                $tData['dr_cr']=1;
                $tData['vt']=1;
                Transaction::create($tData);
                //cr to client while payment received
                $tData['trans_acc_id']=TransAccount::where(['Parent_Type'=>$request['client_id'][0],'PID'=>5])->value('id');
                $tData['dr_cr']=2;
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
    //@display data in list
    public function get_data(){
        return ReceiptVoucher::paginate(15);
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
    //fetch sale invoices against client id
    public function get_client_inv_list($id){
        $CLID=TransAccount::where('PID',5)->where('Parent_Type',$id)->value('id');
        $invoices=Transaction::where('trans_acc_id',$CLID)->where('vt',4)->get();
        foreach ($invoices as $invoice){
            $dr=Transaction::where(['SID'=>$invoice->SID,'vt'=>4,'trans_acc_id'=>$CLID])->sum('amount');
            $cr=Transaction::where(['SID'=>$invoice->SID,'vt'=>1,'trans_acc_id'=>$CLID])->sum('amount');
            $balance=($dr)-($cr);
            $array[]=['SID'=>$invoice->SID, 'balance'=>$balance];
        }
        return response()->json($array);
    }
}
