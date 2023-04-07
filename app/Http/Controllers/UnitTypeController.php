<?php

namespace App\Http\Controllers;

use App\Models\UnitType;
use Illuminate\Http\Request;

class UnitTypeController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:unit_type_view', ['only' => ['index']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('settings.UnitType.index');
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
            'unit_name' => 'required',
        ];
        $message=[
            'unit_name.required'=>'Unit Name Required',
        ];
        $this->validate($request, $rules, $message);
        $data=request()->except(['_token']);
        $id=$request->id;
        if($id=='' || $id==0){
            $ret=UnitType::create($data);
        }else{
            $ret=UnitType::where('id', $id)->update($data);
        }
        if($ret){
            return response()->json(['success'=>'Added new record Successfully.']);
        }
    }
    /*
     * dispay listing data
     */
    public function get_data(){
        $result=UnitType::all();
        return $result;
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UnitType  $unitType
     * @return \Illuminate\Http\Response
     */
    public function show(UnitType $unitType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UnitType  $unitType
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return UnitType::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UnitType  $unitType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UnitType $unitType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UnitType  $unitType
     * @return \Illuminate\Http\Response
     */
//    public function destroy(UnitType $unitType)
//    {
//        //
//    }
    public function destroy($id)
    {
        UnitType::destroy($id);
    }
}
