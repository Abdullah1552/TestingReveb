<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Product;
use App\Models\Product\Category;
use App\Models\Quotation;
use App\Models\SaleInvoice;
use App\Models\StockDetails;
use Illuminate\Http\Request;
use DB;
class QuotationController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:quotation_view', ['only' => ['index']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Quotation.index');
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
            'saleperson_id' => 'required',
            'WHID' => 'required',
            'customer_id' => 'required',
        ];
        $message=[
            'saleperson_id.required'=>'Sale Person Required',
            'WHID.required'=>'Location Required',
            'customer_id.required'=>'Customer Required',
        ];
        $this->validate($request, $rules, $message);

        if ($image = $request->file('attach_document')) {
            $destinationPath = 'storage/app/public/sale_images';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $data['attach_document'] = $profileImage;
        }
        $data['WHID']=$request->WHID;
        $data['saleperson_id']=$request->saleperson_id;
        $data['order_tax']=$request->order_tax;
        $data['net_total']=$request->net_total;
        $data['shipping_cost']=$request->shipping_cost;
        $data['discount']=$request->discount;
        $data['note']=$request->note;
        $data['status']=$request->status;
        $data['reference_number']=$request->reference_number;
        $data['customer_id']=$request->customer_id;
        $data['date']=date('d-m-y h:i:s');
        $data['status']=0;
        $id=$request->id;
        DB::beginTransaction();
        $count=0;
        if(isset($request['product_id'])) {
            $count = count($request->product_id);
        }

        try {
            if ($id == 0 && $count>0) {

                $insert = Quotation::create($data);
                $PID=  $insert->id;
                for ($i=0; $i<$count; $i++) {
                    if(!empty($request['product_id'][$i])) {

                        $itemdata = ['product_id' => $request['product_id'][$i],
                        'Unit_cost' => $request['Unit_cost'][$i],
                            'product_code' => $request['product_varient'][$i],
                            'Qty' => $request['qty'][$i],
                            'sub_total' => $request['sub_total'][$i] ?? $request['sub_total'],
                            'PID' => $PID,
                            'SID'=>0,'in_out'=>0];
                        StockDetails::create($itemdata);
                    }
                }
            } else {
                return response()->json([
                    'status' => 'false',
                    'errors'  => 'fsf',
                ], 400);
                return false;
            }
            DB::commit();
            return response()->json(['success'=>'Added new record Successfully.']);
        }catch (\Illuminate\Database\QueryException $e){
            $errorCode = $e->errorInfo[1];
            return response()->json([
                'status' => 'false',
                'errors'  => $e->getMessage(),
            ], 400);
            DB::rollBack();
        }
    }
    public function get_data(Request $request){

        $result=Quotation::with('customer','salePerson', 'supplier')->orderBy('id', 'DESC')->select('*')->paginate(15);
        return response()->json($result);
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
        //
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
      Quotation::destroy($id);
    }

    public function print_quotation($id){
        $so=Quotation::where('id',$id)->first();
        $customer=Customer::find($so->customer_id);
        $result=DB::table('stock_details')
            ->join('products','stock_details.product_id','products.id')
            ->where('stock_details.SID',$id)->get();
        return view('Quotation.print',compact('so','result','customer'));
    }

}
