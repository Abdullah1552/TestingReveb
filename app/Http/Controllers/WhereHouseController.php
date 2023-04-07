<?php

namespace App\Http\Controllers;

use App\Models\{WhereHouse,PosSetting};
use Illuminate\Http\Request;
use function GuzzleHttp\Promise\all;
use Illuminate\Support\Facades\Auth;

class WhereHouseController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:location_view', ['only' => ['index']]);
        $this->middleware('permission:location_create', ['only' => ['create','store']]);
        $this->middleware('permission:location_edit', ['only' => ['edit']]);
        $this->middleware('permission:location_delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result=WhereHouse::all();
        return view('settings.WhereHouse.index', compact('result'));
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
        $request->validate([
            "WH_Name" => 'required',
            "WH_Mobile" => 'required',
            "WH_Email" => 'required',
        ]);
        $data=request()->except(['_token']);
        $id=$request->id;
        if($id==0 || $id==''){
            return WhereHouse::create($data);
        }else{
            return WhereHouse::where('id', $id)->update($data);
        }
    }
    public function get_data(){

        $result=WhereHouse::paginate();
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
        $result=WhereHouse::where('id', $id)->get();
        return response()->json($result);
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
        WhereHouse::destroy($id);
    }

    public function user_warehouses($id=0)
    {
        if($id){
            $pos = PosSetting::where('default_location', $id)->first();
        }else
            $pos = PosSetting::where('default_location', Auth::user()->WHID)->first();
        return WhereHouse::dropdown($pos->default_location);
    }
}
