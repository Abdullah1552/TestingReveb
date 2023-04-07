<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transport;
use App\Models\TransAccount;
use DB;
class TransportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('settings.Transports.index');
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
            'TR_Name' => 'required',
            'TR_Mobile' => 'required',
        ];
        $message=[
            'TR_Name.required'=>'Transport Name Required',
            'TR_Mobile.required'=>'Mobile Required',
        ];
        $this->validate($request, $rules, $message);
        $data=request()->except(['_token', 'PID']);
        $id=$request->id;
        $AccData['Trans_Acc_Name']=$request->TR_Name;
        $AccData['PID']=$request->PID;
        DB::beginTransaction();
        try{
            if($id=='' || $id==0){
                $ret=Transport::create($data);
                $AccData['Parent_Type']=$ret->id;
                TransAccount::create($AccData);

            }else{
                $ret=Transport::where('id', $id)->update($data);
                TransAccount::where('Parent_Type', $id)->where('PID', $request->PID)->update($AccData);
            }
            DB::commit();
            if($ret){
                return response()->json(['success'=>'Added new record Successfully.']);

            }
        }catch (\Exception $e){
            DB::rollBack();
            return response()->json([
                'success' => 'false',
                'errors'  => $e->getMessage(),
            ], 400);
        }
    }
    /*
     * display listing data
     */
    public function get_data(){
        $result=Transport::paginate(15);
        return $result;
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
        return Transport::find($id);
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
