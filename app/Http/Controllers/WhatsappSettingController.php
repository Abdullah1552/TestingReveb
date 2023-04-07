<?php

namespace App\Http\Controllers;

use App\Models\WhatsappSetting;
use Illuminate\Http\Request;
use DB;
use Auth;

class WhatsappSettingController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:whatsapp_view', ['only' => ['index']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result=WhatsappSetting::first();
        return view('settings.whatsapp.index',compact('result'));
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
            'whatsapp_id' => 'required',
            'whatsapp_token' => 'required',
        ];
        $message=[
            'whatsapp_id.required'=>'What\'s App ID Required',
            'whatsapp_token.required'=>'What\'s App Token Required',
        ];
        $this->validate($request, $rules, $message);
        $data=request()->except(['_token']);
        $id=$request->id;
        DB::beginTransaction();
        try {
            if($id==0 || $id=='') {
                $data['created_by'] = Auth::user()->id;
                WhatsappSetting::create($data);
            }else{
                $data['updated_by'] = Auth::user()->id;
                WhatsappSetting::where('id',$id)->update($data);
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
