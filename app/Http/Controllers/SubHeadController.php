<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SubHead;
use Response;

class SubHeadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result=SubHead::with(['root_acc', 'head_acc'])->get();
        return view('accounts.Subheads.index', compact('result'));
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
            "Sub_Head_Name" => 'required|unique:sub_heads',
            "HID" => 'required',
        ]);
        $id=$req->id;
        if($id==0 || $id==''){
            $ret = SubHead::create($inputs);
        }else{
            $ret=SubHead::where('id', $id)->update($inputs);
        }
        if($ret){
            return redirect()->back()->with('message', 'Operation Successfull!');
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
    public function get_data(){
        $result=SubHead::with(['root', 'head_acc'])->select('*')->orderBy('id', 'DESC')->paginate(10000000);
        return Response::json($result);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $result=SubHead::where('id', $id)->get();
        return Response::json($result);
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
        $id=explode(',', $id);
        SubHead::wherein('id',$id)->delete();
    }
}
