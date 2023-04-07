<?php

namespace App\Http\Controllers\People;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\CustomerItem;
use App\Models\Item;
use App\Models\TransAccount;
use App\Models\User;
use DB;
use Illuminate\Http\Request;
use function request;
use function response;
use function view;

class CustomerController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:customer_view', ['only' => ['index']]);
        $this->middleware('permission:customer_create', ['only' => ['store']]);
        $this->middleware('permission:customer_edit', ['only' => ['edit']]);
        $this->middleware('permission:customer_delete', ['only' => ['delete']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('people.customer.index');
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
            'customer_group_id' => 'required',
            'name' => 'required',
        ];
        $message=[
            'customer_group_id.required'=>'Customer Group Required',
            'name.required'=>'Name Required',
        ];
        $this->validate($request, $rules, $message);
        $data=request()->except(['_token', 'checkbox', 'user_email', 'password']);
        $id=$request->id;
        $tData['Trans_Acc_Name']=$request->name;
        $tData['PID']=5;
        DB::beginTransaction();
        try {
            if ($id == '' || $id == 0) {
                 $ret=Customer::create($data);
                $tData['Parent_Type']=$ret->id;
                $trans_id=TransAccount::create($tData);
                Customer::where('id', $ret->id)->update(['trans_id'=>$trans_id->id]);
                DB::commit();
                return $ret;
            } else {
                 Customer::where('id', $id)->update($data);
                $trans_id=Customer::where('id', $id)->first()->trans_id;
                $tData['Parent_Type']=$id;
                TransAccount::where('id', $trans_id)->update($tData);
                DB::commit();
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
    //get data in listing
    public function get_data(Request $request){
        $result=Customer::with('customerGroup')
            ->when($request->phone_number, function ($query) use ($request){
                return $query->where('phone_number','LIKE', '%'.$request->phone_number.'%');
            })->when($request->email, function ($query) use ($request){
                return $query->where('email','LIKE', '%'.$request->email.'%');
            })->when($request->customer_id, function ($query) use ($request){
                return $query->where('id',$request->customer_id);
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

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $result=Customer::find($id);
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
        Customer::destroy($id);
    }
}
