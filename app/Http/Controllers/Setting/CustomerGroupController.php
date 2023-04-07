<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use App\Models\CustomerGroup;
use App\Models\Tax;
use Illuminate\Http\Request;
use DB;
class CustomerGroupController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:customer_group_view', ['only' => ['index']]);
        $this->middleware('permission:customer_group_create', ['only' => ['store']]);
        $this->middleware('permission:customer_group_edit', ['only' => ['edit']]);
        $this->middleware('permission:customer_group_delete', ['only' => ['delete']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('settings.customer_group.index');
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
            'percentage' => 'required',

        ];
        $message=[
            'name.required'=>'Name Required',
            'percentage.required'=>'Percentage Required',
        ];


        $this->validate($request, $rules, $message);
        $data=request()->except(['_token']);
        $id=$request->id;
        DB::beginTransaction();
        try {
            if ($id == '' || $id == 0) {

                CustomerGroup::create($data);
            } else {
                CustomerGroup::where('id', $id)->update($data);

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
    public function get_data(){
        $result=CustomerGroup::OrderBy('id', 'DESC')->paginate();
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
        $result=CustomerGroup::find($id);
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
        CustomerGroup::destroy($id);
    }
}
