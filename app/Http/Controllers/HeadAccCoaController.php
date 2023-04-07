<?php

namespace App\Http\Controllers;

use App\Models\HeadAccount;
use Illuminate\Http\Request;
use App\Models\HeadAccounts;
use Response;
class HeadAccCoaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result=HeadAccount::all();
        return view('accounts.head_acc.index', compact('result'));
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
    public function store(Request $req)
    {
        $inputs = $req->input();
        $req->validate([
            "Head_Ac_Name" => 'required|min:2',
            "RID" => 'required',
        ]);

        $id=$req->id;
        if($id==0 || $id==''){
            $ret = HeadAccounts::create($inputs);
        }else{
            $ret=HeadAccounts::where('id', $id)->update($inputs);
        }
        if($ret){
            return response()->json(['success'=>'Added new record Successfully.']);
        }
    }

    public function get_data(Request $request){
        $result=HeadAccounts::with(['root_acc'])->select('*')->orderBy('id', 'DESC')->paginate(10000000);
        return Response::json($result);
    }
    public function get_countryList(Request $request){
        return Country::countryList();
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
        $result=HeadAccounts::where('id', $id)->get();
        return Response::json($result);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req, $id)
    {

        $req->validate([
            "CT_Name" => 'required|min:2',
            "CT_Code" => 'required',
        ]);



        $country = Country::find($id);

        $country->CT_Name = $req->CT_Name;
        $country->CT_Code = $req->CT_Code;
        $country = $country->save();


        if (!$country) {
            return back()->with("msg", "something went wrong");
        }
        return back()->with("msg", "succesfully data edited");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $id=explode(',', $id);
        HeadAccounts::wherein('id',$id)->delete();
    }
    public function fetch_head_acc(Request $request){
        return HeadAccount::headAccList($request->RID);
    }
}
