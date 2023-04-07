<?php

namespace App\Http\Controllers\People;

use App\Http\Controllers\Controller;
use App\Models\SalePerson;
use Illuminate\Http\Request;
use DB;
class SalePersonController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:sale_person_view', ['only' => ['index']]);
        $this->middleware('permission:sale_person_create', ['only' => ['store']]);
        $this->middleware('permission:sale_person_edit', ['only' => ['edit']]);
        $this->middleware('permission:sale_person_delete', ['only' => ['delete']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('people.saleperson.index');
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
            'name' => 'required',
            'commission_per' => 'required',
        ];
        $message=[
            'name.required'=>'Slae Persone Name Required',
            'commission_per.required'=>'Commission Required',

        ];
        $this->validate($request, $rules, $message);
        $data=request()->except(['_token']);
        $id=$request->id;
        DB::beginTransaction();
        try {
            if ($id == '' || $id == 0) {
                SalePerson::create($data);
            } else {
                SalePerson::where('id', $id)->update($data);

            }
            DB::commit();
            return response()->json(['success'=>'Added new record Successfully.']);
        }catch (\Exception $e){
            DB::rollBack();
            return response()->json([
                'success' => 'false',
                'errors'  => $e->getMessage(),
            ], 400);
        }
    }
    public function get_data(Request $request){
        $result=SalePerson::with('location')
            ->when($request->supplier_id, function ($query) use ($request){
                return $query->where('id', $request->supplier_id);
            })->when($request->WHID, function ($query) use ($request){
                return $query->where('WHID', $request->WHID);
            })->OrderBy('id', 'DESC')->paginate();
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
        $result=SalePerson::find($id);
        return response()->json([$result]);
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
        SalePerson::destroy($id);
    }
}
