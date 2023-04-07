<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RootAccount;

class RootCoaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $root=RootAccount::all();
        return view('accounts.root.index', compact('root'));
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
            "CT_Name" => 'required|min:2',
        ]);

        $id=$req->id;
        if($id==0 || $id==''){
            $ret = Country::create($inputs);
        }else{
            $ret=Country::where('id', $id)->update($inputs);
        }
        if($ret){
            return response()->json(['success'=>'Added new record Successfully.']);
        }
    }

    public function get_data(Request $request){
        if(!empty($request->CT_Name)){
            $result=Country::orderBy('id', 'DESC')->where('CT_Name', 'like', '%'.$request->CT_Name.'%')->select('*')->paginate(Config::get('constants.pagination_count'));
        }else{
            $result=Country::orderBy('id', 'DESC')->select('*')->paginate(Config::get('constants.pagination_count'));
        }

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
        $result=Country::where('id', $id)->get();
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
        Country::wherein('id',$id)->delete();
    }
    public function excel_sample(Request $request){
        $fil=$request->file;
        $file=$fil.".xlsx";
        $file_path = public_path('excel_sample/'.$file);
        return response()->download($file_path);
    }
}
