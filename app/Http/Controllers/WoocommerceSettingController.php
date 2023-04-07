<?php

namespace App\Http\Controllers;

use App\Models\{WoocommerceSetting,Product\ProductVariant,Product,WooSyncHistory};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use App\Helpers\helpers;
use App\Traits\WooSyncTrait;

class WoocommerceSettingController extends Controller
{
    use WooSyncTrait;

    function __construct()
    {
        $this->middleware('permission:woocommerce_setting_view', ['only' => ['index']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result=WoocommerceSetting::first();
        return view('settings.woocommerce.index',compact('result'));
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
            'woocommerce_url' => 'required',
            'woocommerce_sk' => 'required',
            'woocommerce_sc' => 'required',
        ];
        $message=[
            'woocommerce_url.required'=>'Woocommerce URL Required',
            'woocommerce_sk.required'=>'Woocommerce Secrete Key Required',
            'woocommerce_sc.required'=>'Woocommerce Consumer Key Required',
        ];
        $this->validate($request, $rules, $message);
        $data=request()->except(['_token']);
        $id=$request->id;
        DB::beginTransaction();
        try {
            if($id==0 || $id=='') {
                $data['created_by'] = Auth::user()->id;
                WoocommerceSetting::create($data);
            }else{
                $data['updated_by'] = Auth::user()->id;
                WoocommerceSetting::where('id',$id)->update($data);
            }
            DB::commit();
            return back()->with(['success'=>'Added new record Successfully.']);
        }catch (\Illuminate\Database\QueryException $e){
            $errorCode = $e->errorInfo[1];
            DB::rollBack();
            if($errorCode == '1062'){
                return back()->with('error', 'Your message may be a duplicate entry.');
            }
        }
    }
    public  function woocommerce_toggle(Request $request){
        $rules = [
            'state' => 'required',
            'id' => 'required',
        ];
        $this->validate($request, $rules, []);
        $data=[
            'state'=>$request->state
        ];
        $id=$request->id;
        DB::beginTransaction();
        try {
            if($id==0 || $id=='') {
                $data['created_by'] = Auth::user()->id;
                WoocommerceSetting::create($data);
            }else{
                $data['updated_by'] = Auth::user()->id;
                WoocommerceSetting::where('id',$id)->update($data);
            }
            DB::commit();

            if($request->state == "1"){
                return response()->json(['success'=>'WooComerce API has been Actived.']);
            }else if($request->state == "0"){
                return response()->json(['success'=>'WooComerce API has been Deactived.']);
            }

        }catch (\Illuminate\Database\QueryException $e){
            $errorCode = $e->errorInfo[1];
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
    public function upload_products()
    {
        DB::beginTransaction();
        try {
           $user = Auth::user();
           $sync_history_record = WooSyncHistory::create([
               'company_id' => $user->company_id,
               'sync_by' => $user->id,
               'is_completed' => '0',
           ]);
           dispatch(new \App\Jobs\SyncWooQueue($user->company_id, $sync_history_record->id));


           DB::commit();
           return response()->json([
               'success' => true,
               'message' => "Be Patient we mail you when synchronizing is complete",
           ],  200);

        }catch (\Exception $e){

           DB::rollback();

           return response()->json([
               'success' => false,
               'error_code' =>  $e->getCode(),
               'message' => $e->getMessage(),
           ], 505);
        }

    }
    public function update_products_stock()
    {
        DB::beginTransaction();
        try {
           $user = Auth::user();
           $sync_history_record = WooSyncHistory::create([
               'company_id' => $user->company_id,
               'sync_type' => "update_stock",
               'sync_by' => $user->id,
               'is_completed' => '0',
           ]);
           dispatch(new \App\Jobs\UpdateStockWooQueue($user->company_id, $sync_history_record->id));


           DB::commit();
           return response()->json([
               'success' => true,
               'message' => "Be Patient we mail you when synchronizing is complete",
           ],  200);

        }catch (\Exception $e){

           DB::rollback();

           return response()->json([
               'success' => false,
               'error_code' =>  $e->getCode(),
               'message' => $e->getMessage(),
           ], 505);
        }

    }

    public function update_products()
    {
        DB::beginTransaction();
        try {
            $user = Auth::user();
            $sync_history_record = WooSyncHistory::create([
                'company_id' => $user->company_id,
                'sync_type' => "update_products",
                'sync_by' => $user->id,
                'is_completed' => '0',
            ]);
            dispatch(new \App\Jobs\UpdateProductWooQueue($user->company_id, $sync_history_record->id));


            DB::commit();
            return response()->json([
                'success' => true,
                'message' => "Be Patient we mail you when synchronizing is complete",
            ],  200);

        }catch (\Exception $e){

            DB::rollback();

            return response()->json([
                'success' => false,
                'error_code' =>  $e->getCode(),
                'message' => $e->getMessage(),
            ], 505);
        }

    }


}
