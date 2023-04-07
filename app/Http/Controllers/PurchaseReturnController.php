<?php

namespace App\Http\Controllers;

use App\Helpers\helpers;
use App\Models\Product;
use App\Models\Product\ProductVariant;
use App\Models\PurchaseReturn;
use App\Models\StockDetails;
use App\Models\Supplier;
use App\Models\TransAccount;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Jobs\UpdateWordpressQty;
use App\Models\PosSetting;
use App\Models\WhereHouse;
use DB;

class PurchaseReturnController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:purchase_return_view', ['only' => ['index']]);
        $this->middleware('permission:purchase_return_create', ['only' => ['store']]);
        $this->middleware('permission:purchase_return_edit', ['only' => ['edit']]);
        $this->middleware('permission:purchase_return_delete', ['only' => ['delete']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('purchasereturn.index');
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
            'SUPID' => 'required',
            'WHID' => 'required',
        ];
        $message=[
            'SUPID.required'=>'Supply Required',
            'WHID.required'=>'Location Required',
        ];

        $this->validate($request, $rules, $message);
        $data['WHID']=$request->WHID;
        $data['SUPID']=$request->SUPID;
        if ($image = $request->file('photo')) {
            $destinationPath = 'storage/app/public/sale_images';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $data['photo'] = $profileImage;
        }
        $data['date']=$request->date;
//        $data['order_tax']=0;
        $data['net_total']=$request->net_total;
        $data['discount']=$request->discount;
        $data['inovice_details']=$request->inovice_details;
        $data['date']=date('d-m-y h:i:s');
        $id=$request->id;
        DB::beginTransaction();
        //accounts entry
        $tData['trans_acc_id']=TransAccount::where(['Parent_Type'=>$request->SUPID,'PID'=>13])->value('id');
        $tData['amount']=$request->net_total;
        $tData['trans_date']=date('Y-m-d');
        $tData['dr_cr']=1;
        $tData['status']=1;
        $count=0;
        if(isset($request['product_id'])) {
            $count = count($request->product_id);
        }
        $unit = $request->Unit_cost;
        $quantity = $request->qty;
        $sub_total = $request->sub_total;
        try {
            if ($id == 0 && $count>0) {
                $tData['trans_code']=helpers::trans_code();
                $tdata['Created_By']=Auth::user()->id;
                $data['trans_code']=helpers::trans_code();
                $data['created_by']=Auth::user()->id;
                $insert = PurchaseReturn::create($data);
                $PID=  $insert->id;
                $pr=date('ymd').$PID;
                PurchaseReturn::where('id',$PID)->update(['pr'=>$pr]);
                $tData['narration']='Against Purchase Return inovice #'.$PID;
                Transaction::create($tData);
                //dr to purchae account
                $tData['trans_acc_id']=3;
                $tData['dr_cr']=2;
                Transaction::create($tData);
                for ($i=0; $i<$count; $i++) {

                    if( StockDetails::check_stock($request['product_varient'][$i],$request->WHID) < ((int)$request['qty'][$i])){
                        return response()->json([
                            'status' => 'false',
                            'errors'  => [$request['product_varient'][$i]."'s Insufficient Stock."],
                        ], 400);
                    }

                    if(!empty($request['product_id'][$i])) {
                        if( StockDetails::check_stock($request['product_varient'][$i],$request->WHID) < ((int)$request['qty'][$i])){
                            return response()->json([
                                'status' => 'false',
                                'errors'  => [$request['product_varient'][$i]."'s Insufficient Stock."],
                            ], 400);
                        }

                        $itemdata = ['product_id' => $request['product_id'][$i],
                            'product_code' => $request['product_varient'][$i],
                            'WHID'=>$request->WHID,
                            'Unit_cost' => $request['Unit_cost'][$i],
                            'Qty' => $request['qty'][$i],
                            'sub_total' => $request['sub_total'][$i],
                            'PRID' => $PID,
                            'in_out'=>2
                        ];
                        StockDetails::create($itemdata);
                        if(woo_state()) {
                            $variation_data = [
                                'stock_quantity' => $request['qty'][$i],
                            ];
                            $wp_id = Product::find($request['product_id'][$i])->w_id;
                            $wp_qty = helpers::product_updated_stock($request['product_id'][$i]);
                            $variation_id = ProductVariant::where('item_code', $request['product_varient'][$i])->value('v_id');
                            UpdateWordpressQty::dispatch($wp_id, $variation_id, $variation_data, $wp_qty)
                                ->delay(now()->addSeconds(30));
                        }
                    }
                }
            } else {
                $trans_code=PurchaseReturn::where('id',$id)->value('trans_code');
                Transaction::where('trans_code',$trans_code)->delete();
                $tData['trans_code']=$trans_code;
                $tdata['updated_by']=Auth::user()->id;
                $data['updated_by']=Auth::user()->id;
                PurchaseReturn::where('id',$id)->update($data);
                $PID=  $id;
                $tData['narration']='Against Purchase Return inovice #'.$PID;
                Transaction::create($tData);
                //dr to purchae account
                $tData['trans_acc_id']=3;
                $tData['dr_cr']=2;
                Transaction::create($tData);
                StockDetails::where('PRID', $id)->delete();
                for ($i=0; $i<$count; $i++) {
                    if(!empty($request['product_id'][$i])) {
                        if( StockDetails::check_stock($request['product_varient'][$i],$request->WHID) < ((int)$request['qty'][$i])){
                            return response()->json([
                                'status' => 'false',
                                'errors'  => [$request['product_varient'][$i]."'s Insufficient Stock."],
                            ], 400);
                        }
                        $itemdata = ['product_id' => $request['product_id'][$i],
                            'product_code' => $request['product_varient'][$i],
                            'WHID'=>$request->WHID,
                            'Unit_cost' => $request['Unit_cost'][$i],
                            'Qty' => $request['qty'][$i],
                            'sub_total' => $request['sub_total'][$i],
                            'PRID' => $PID,
                            'in_out'=>2
                        ];
                        StockDetails::create($itemdata);
                        if(woo_state()) {
                            $variation_data = [
                                'stock_quantity' => $request['qty'][$i],
                            ];
                            $wp_id = Product::find($request['product_id'][$i])->w_id;
                            $wp_qty = helpers::product_updated_stock($request['product_id'][$i]);
                            $variation_id = ProductVariant::where('item_code', $request['product_varient'][$i])->value('v_id');
                            UpdateWordpressQty::dispatch($wp_id, $variation_id, $variation_data, $wp_qty)
                                ->delay(now()->addSeconds(30));
                        }
                    }
                }
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

        $result=PurchaseReturn::with('supplier','location')
            ->when($request->df, function($query)use ($request){
                $query->whereBetween('date',[$request->df,$request->dt]);
            })->when($request->sr, function($query)use ($request){
                $query->where('pr',$request->sr);
            })->when($request->SUPID, function($query)use ($request){
                $query->where('SUPID',$request->SUPID);
            })->leftJoin('stock_details','stock_details.PRID','=','purchase_returns.id')
            ->where('stock_details.in_out',2)->groupBY('stock_details.PRID')
            ->select('purchase_returns.*',DB::raw('sum(stock_details.QTY) as total_QTY'))
            ->orderBy('purchase_returns.id', 'DESC')
            ->paginate(15);
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
        $result=PurchaseReturn::find($id);
        $itemresult = StockDetails::where('PRID',$id)->get();
        $html='';
        foreach ($itemresult as $item){
            $html.='<tr class="rows">
                <td colspan="1">
                <input type="hidden" name="product_id[]" value="'.$item->product_id.'">'.Product::find($item->product_id)->name.'
                </td>
                <td class="product-code">
                <input type="hidden" name="product_varient[]" value="'.$item->product_code.'">
                '.$item->product_code.'</td>
                <td id="">
                <input type="number" min="1" class="quantity" name="qty[]" value="'.$item->Qty.'">
                </td>
                <td class="product-cost"><input type="hidden" name="Unit_cost[]" value="'.$item->Unit_cost.'">'.$item->Unit_cost.'</td>
                <td id="">0.00</td>
                <td class="tax-amount">'.$item->tax.'</td>
                <td class="sub-total"><span>'.$item->sub_total.'</span><input type="hidden" name="sub_total[]" value="'.$item->sub_total.'"></td>
                <td><i class="fa fa-trash trash" style="border: none"></i></td>
                </tr>';
        }
        return response()->json([$result,$html]);
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
        $stockDetails=StockDetails::where('PRID', $id)->get();
        foreach ($stockDetails as $item)
        {
            $is_var=Product::find($item->product_id);
            if($is_var->is_variant==1) {
                $pq=helpers::updated_stock($item->product_code);
                $variation_data = [
                    'stock_quantity' => $pq-$item->Qty,
                ];
                $variation_id=ProductVariant::where('item_code', $item->product_code)->value('v_id');
            }else{
                $variation_data=[];
                $variation_id=0;
            }
            StockDetails::where('product_code',$item->product_code)->where('PID',$id)->delete();
            if(woo_state()) {
                $wp_qty = helpers::product_updated_stock($item->product_id);
                $wp_id = Product::find($item->product_id)->w_id;
                UpdateWordpressQty::dispatch($wp_id, $variation_id, $variation_data, $wp_qty)
                    ->delay(now()->addSeconds(60));
            }
        }
        PurchaseReturn::destroy($id);
    }
    //print data
    public function print_data($id){
        $pos=PosSetting::where('default_location', Auth::user()->WHID)->first();
        $sinv = PurchaseReturn::find($id);
        $customer=Supplier::find($sinv->SUPID);
        $result=DB::table('stock_details')->join('products','stock_details.product_id','products.id')
            ->where('stock_details.PRID',$sinv->id)->get();
        $location=WhereHouse::where('id',$sinv->WHID)->first();
        return view('purchasereturn.print',compact('sinv','result','location','pos','customer'));
    }
}
