<?php

namespace App\Http\Controllers\People;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use App\Models\TransAccount;
use DB;
use Illuminate\Http\Request;
use Livewire\RenameMe\SupportLocales;
use function request;
use function response;
use function view;

class SupplierController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:supplier_list_view', ['only' => ['index']]);
        $this->middleware('permission:supplier_list_create', ['only' => ['store']]);
        $this->middleware('permission:supplier_list_edit', ['only' => ['edit']]);
        $this->middleware('permission:supplier_list_delete', ['only' => ['delete']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('people.supplier.index');
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
//            'email' => 'required',
//            'company_name' => 'required',
//            'phone_number' => 'required',
//            'vat_number' => 'required',
//            'address' => 'required',
//            'city' => 'required',
//            'state' => 'required',
//            'postal_code' => 'required',
//            'country' => 'required',
        ];
        $message=[
            'name.required'=>'Supplier Name Required',
//            'email.required'=>'Supplier Email Required',
//            'company_name.required'=>'Supplier Company Name Required',
//            'phone_number.required'=>'Supplier Phone Number Required',
//            'vat_number.required'=>'Supplier VAT Number Required',
//            'address.required'=>'Supplier Address Required',
//            'city.required'=>'Supplier City Required',
//            'state.required'=>'Supplier State Required',
//            'postal_code.required'=>'Supplier Postal Code Required',
//            'country.required'=>'Supplier Country Required',

        ];
        $photo = '';
        if ($image = $request->file('image')) {
            $destinationPath = 'public/assets/images/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $photo = $profileImage;
        }

        $this->validate($request, $rules, $message);
        $data=request()->except(['_token']);
        $id=$request->id;
        $tData['Trans_Acc_Name']=$request->name;
        $tData['PID']=13;
        DB::beginTransaction();
        try {
            if ($id == '' || $id == 0) {
                $data['image']= $photo;
                $ret=Supplier::create($data);
                $tData['Parent_Type']=$ret->id;
                $trans_id=TransAccount::create($tData);
                Supplier::where('id', $ret->id)->update(['trans_id'=>$trans_id->id]);
            } else {
                Supplier::where('id', $id)->update($data);
                $trans_id=Supplier::where('id', $id)->first()->trans_id;
                $tData['Parent_Type']=$id;
                TransAccount::where('id', $trans_id)->update($tData);
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
        $result=Supplier::OrderBy('id', 'DESC')->paginate();
        return $result;
    }
    public function fetch_supplier_det($id){
        return Supplier::where('id', $id)->first();
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
        $result=Supplier::find($id);
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
        Supplier::destroy($id);
        TransAccount::where('PID',2)->where('parent_type', $id)->delete();
    }
}
