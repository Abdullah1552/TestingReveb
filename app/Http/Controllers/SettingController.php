<?php

namespace App\Http\Controllers;

use App\Models\BusinessSetting;
use Illuminate\Http\Request;
use DB;

class SettingController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:business_setting_view', ['only' => ['index']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result=BusinessSetting::first();
        return view('settings.BusinessSetting.index',compact('result'));
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
            'business_name' => 'required',
        ];
        $message=[
            'business_name.required'=>'Name Required',
        ];
        $data=$request->except(['_token']);
        $this->validate($request, $rules, $message);
        if ($image = $request->file('business_logo')) {
            $destinationPath = 'storage/app/public/sale_images';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $data['business_logo'] = $profileImage;
        }
        DB::beginTransaction();
        try {
            if ($request->id==0 || $request->id=='')
            {
                BusinessSetting::create($data);
                DB::commit();
                return back()->with('Added new record Successfully.');
            }
            else{
                BusinessSetting::where('id', $request->id)->update($data);
                DB::commit();
                return back()->with('Updated record Successfully.');
            }
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
        return $result=BusinessSetting::first();
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
