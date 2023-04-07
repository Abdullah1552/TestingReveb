<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use App\Models\PosSetting;
use Illuminate\Http\Request;
use DB;
use Auth;

class PosSettingController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:pos_setting_view', ['only' => ['index']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pos=PosSetting::with(['wh','customer','sale_person'])->get();
        return view('settings.pos_setting.index', compact('pos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('settings.pos_setting.create');
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
            'default_location' => 'required',
            'default_customer' => 'required',
            'default_saleperson' => 'required',
            'invoice_footer' => 'required',
        ];
        $message=[
            'default_location.required'=>'Default Location Required',
            'default_customer.required'=>'Default Customer Required',
            'default_saleperson.required'=>'Default Sale Person Required',
            'invoice_footer.required'=>'Invioice Footer Required',
        ];
        $this->validate($request, $rules, $message);
        $data=request()->except(['_token']);
        if(isset($request->inv_img)) {
            $logo=$request->inv_img;
            $logo= url('storage/app/' . $logo->store('public/pos_setting'));
            $data['inv_img'] = $logo;
        }
        if(isset($request->qr_img)) {
            $qr_img=$request->qr_img;
            $qr_img= url('storage/app/' . $qr_img->store('public/pos_setting'));
            $data['qr_img'] = $qr_img;
        }
        if(isset($request->purchase_tax) && $request->purchase_tax==1){
            $data['purchase_tax']=$request->purchase_tax;
            $data['purchase_taxID']=$request->purchase_taxID;
            $data['purchase_tax_label']=$request->purchase_tax_label;
        }
        if(isset($request->sale_tax) && $request->sale_tax==1){
            $data['sale_tax']=$request->sale_tax;
            $data['sale_tax_label']=$request->sale_tax_label;
            $data['sale_taxID']=$request->sale_taxID;
        }
        if(isset($request->wat) && $request->wat==1){
            $data['wat']=$request->wat;
            $data['wat_label']=$request->wat_label;
            $data['watID']=$request->watID;
        }
        DB::beginTransaction();
        try {
                $data['created_by']=Auth::user()->id;
                PosSetting::create($data);
                DB::commit();
                return  redirect('/settings/pos_setting' )->with(['success'=>'Added new record Successfully.']);
        }catch (\Illuminate\Database\QueryException $e){
            $errorCode = $e->errorInfo[1];
            DB::rollBack();
            if($errorCode == '1062'){
                return back()->with('error', 'Your message may be a duplicate entry.');
            }
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
        $pos=PosSetting::find($id);
        return view('settings.pos_setting.edit', compact('pos'));
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
        $rules = [
            'default_location' => 'required',
            'default_customer' => 'required',
            'default_saleperson' => 'required',
            'invoice_footer' => 'required',
        ];
        $message=[
            'default_location.required'=>'Default Location Required',
            'default_customer.required'=>'Default Customer Required',
            'default_saleperson.required'=>'Default Sale Person Required',
            'invoice_footer.required'=>'Invioice Footer Required',
        ];
        $this->validate($request, $rules, $message);
        $data=request()->except(['_token','_method']);
        if(isset($request->inv_img)) {
            $logo=$request->inv_img;
            $logo= url('storage/app/' . $logo->store('public/pos_setting'));
            $data['inv_img'] = $logo;
        }
        if(isset($request->qr_img)) {
            $qr_img=$request->qr_img;
            $qr_img= url('storage/app/' . $qr_img->store('public/pos_setting'));
            $data['qr_img'] = $qr_img;
        }
        if(isset($request->purchase_tax) && $request->purchase_tax==1){
            $data['purchase_tax']=$request->purchase_tax;
            $data['purchase_taxID']=$request->purchase_taxID;
            $data['purchase_tax_label']=$request->purchase_tax_label;
        }
        if(isset($request->sale_tax) && $request->sale_tax==1){
            $data['sale_tax']=$request->sale_tax;
            $data['sale_tax_label']=$request->sale_tax_label;
            $data['sale_taxID']=$request->sale_taxID;
        }
        if(isset($request->wat) && $request->wat==1){
            $data['wat']=$request->wat;
            $data['wat_label']=$request->wat_label;
            $data['watID']=$request->watID;
        }
        DB::beginTransaction();
        try {
            $data['created_by']=Auth::user()->id;
            PosSetting::where('id',$id)->update($data);
            DB::commit();
            return back()->with(['success'=>'Added new record Successfully.']);
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function user_setting($id)
    {
        if($id){
            return PosSetting::where('default_location', $id)->first();
        }else
        return PosSetting::where('default_location', Auth::user()->WHID)->first();

    }
}
