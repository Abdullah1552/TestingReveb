<?php

namespace App\Http\Controllers\Sale;

use App\Http\Controllers\Controller;
use App\Models\BusinessSetting;
use Illuminate\Http\Request;
use App\Models\CashRegister;
use Illuminate\Support\Facades\DB;
use App\Models\SaleReturn;
use App\Models\SaleInvoice;
use Auth;

class CashRegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
            'register_location' => 'required',
            'cash_in_hand' => 'required',
        ];
        $message=[
            'register_location.required'=>'Location Required',
            'cash_in_hand.required'=>'Cash in Hand Required',
        ];
        $this->validate($request, $rules, $message);
        $data['WHID']=$request->register_location;
        $data['cash_in_hand']=$request->cash_in_hand;
        $data['open_by']=Auth::user()->id;
        $data['status']=0;
        DB::beginTransaction();
        $id=$request->id;
        try{
            if($id==0 || $id==''){
                CashRegister::create($data);
            }else{
                CashRegister::where('id',$id)->update($data);
            }
            DB::commit();
            return response()->json(['success'=>'Added new record Successfully.']);
        }catch (\Illuminate\Database\QueryException $e){
            $errorCode = $e->errorInfo[1];
            return response()->json([
                'status' => 'false',
                'errors'  => $e->getMessage(),
            ], 400);
            DB::rollBack();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $register = CashRegister::with(['location' => function ($query) {
            $query->select('id', 'WH_Name');
        },
            'staff'=>function($query){
                $query->select('id', 'name');
            },
            'closing_staff'=>function($query){
                $query->select('id', 'name');
            }])
            ->select('cash_registers.*')
            ->where('id',$id)
            ->first();
        return view('pos.cash-register-print',compact('register'));
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

    /*
     * close register
     */
    public function close_register(Request $request){
        DB::beginTransaction();
        $id=$request->cash_register_id;
        $data = $request->except(['_token','cash_register_id']);
        $data['status']='1';
        $data['closed_by']=Auth::user()->id;
        $update=CashRegister::where(['open_by'=>Auth::user()->id,'status'=>0])->where('id',$id)->update($data);
        if($update){
            $business_settings = BusinessSetting::first();
            if( isset($business_settings->corresponding_email) && $business_settings->corresponding_email){


                $register = CashRegister::with(['location' => function ($query) {
                    $query->select('id', 'WH_Name');
                },
                    'staff'=>function($query){
                        $query->select('id', 'name');
                    },
                    'closing_staff'=>function($query){
                        $query->select('id', 'name');
                    }])
                    ->select('cash_registers.*')
                    ->where('id',$id)
                    ->first();



                $details = [
                    'subject' => 'Cash register closed',
                ];

                $business_settings = DB::table('business_settings')->where('id',auth()->user()->company_id )->first();
                if(  isset($business_settings->corresponding_email ) && $business_settings->corresponding_email ){
                    \Mail::to($business_settings->corresponding_email)->send(new \App\Mail\CommonMail('pos.cash-register-print',$details,compact('register')));
                }


                return view('pos.cash-register-print',compact('register'));
            }
            DB::commit();
            return redirect('/sale/pos/cash-register/'.$id);
        }else{
            DB::rollBack();
            abort(404, "No records updated");
        }
    }

    public function check_cash_register(){
        $output=[];
        $output['register']=CashRegister::with([
            'location' => function ($query) {
                $query->select('id', 'WH_Name');
            },
            'staff'=>function($query){
                $query->select('id', 'name');
            }
        ])->where('open_by',Auth::user()->id)
            ->when(Auth::user()->type == "end_user",function ($query) {
                $query->where(['WHID'=>Auth::user()->WHID]);
            })
            ->where(['status'=> '0'])
            ->orderBy('id','DESC')->first();

        if($output['register']){

            $output['cash_payment'] = SaleInvoice::where('created_by',Auth::user()->id)->where('created_at', '>', $output['register']->created_at)
                ->orderBy('id','DESC')->sum('cash');

            $output['credit_card_payment'] = SaleInvoice::where('created_by',Auth::user()->id)
                ->where('created_at', '>', $output['register']->created_at)
                ->orderBy('id','DESC')->sum('credit_card');

            $output['qr_code_payment'] = SaleInvoice::where('created_by',Auth::user()->id)
                ->where('created_at', '>', $output['register']->created_at)
                ->orderBy('id','DESC')->sum('qr_code');
            $output['total_sale_return'] = SaleReturn::where('created_by',Auth::user()->id)
                ->where('created_at', '>', $output['register']->created_at)
                ->orderBy('id','DESC')->sum('net_total');

            $output['status'] = $output['register']->status;
        }else{
            $output['status'] = 3;
        }

        return $output;
    }
}
