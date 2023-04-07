<?php

namespace App\Http\Controllers;

use App\Helpers\helpers;
use App\Models\Product;
use App\Models\Product\ProductVariant;
use App\Models\PurchaseReturn;
use App\Models\SaleReturn;
use App\Models\StockDetails;
use App\Models\TransAccount;
use App\Models\Transaction;
use Codexshaper\WooCommerce\Models\Variation;
use Illuminate\Http\Request;
use DB;
use App\Jobs\UpdateWordpressQty;
use Illuminate\Support\Facades\Auth;
use App\Models\Customer;
use App\Models\PosSetting;
use App\Models\WhereHouse;

class SaleReturnController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:sale_return_view', ['only' => ['index']]);
        $this->middleware('permission:sale_return_create', ['only' => ['store']]);
        $this->middleware('permission:sale_return_edit', ['only' => ['edit']]);
        $this->middleware('permission:sale_return_delete', ['only' => ['delete']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('salereturn.index');
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
            'customer_id' => 'required',
            'WHID' => 'required',
        ];
        $message=[
            'customer_id.required'=>'Customer Required',
            'WHID.required'=>'Location Required',
        ];

        $this->validate($request, $rules, $message);
        $data['WHID']=$request->WHID;
        $data['sale_person']=$request->SUPID;
        if ($image = $request->file('photo')) {
            $destinationPath = 'storage/app/public/sale_images';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $data['photo'] = $profileImage;
        }
        $data['order_tax']=0;
        $data['net_total']=$request->net_total;
        $data['inovice_details']=$request->inovice_details;
        $data['customer_id']=$request->customer_id;
        $data['date']=$request->date;
        $data['shipping_cost']=$request->shipping_cost;
        $data['discount']=$request->discount;
        $id=$request->id;
        DB::beginTransaction();
        //accounts entry
        $tData['trans_acc_id']=1;
        $tData['trans_acc_id']=TransAccount::where(['Parent_Type'=>$request->customer_id,'PID'=>5])->value('id');
        $tData['amount']=$request->net_total;
        $tData['trans_date']=date('Y-m-d');
        $tData['dr_cr']=2;
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
                $data['created_by']=Auth::user()->id;
                $data['trans_code']=helpers::trans_code();
                $insert = SaleReturn::create($data);
                $PID=  $insert->id;
                $sr=date('ydm').$PID;
                SaleReturn::where('id',$PID)->update(['sr'=>$sr]);
                $tData['narration']='Sale Return Against SR#'.$PID;
                Transaction::create($tData);
                //dr to sale account
                $tData['trans_acc_id']=3;
                $tData['dr_cr']=1;
                Transaction::create($tData);
                for ($i=0; $i<$count; $i++) {
                    if(!empty($request['product_id'][$i])) {
                        $itemdata = ['product_id' => $request['product_id'][$i],
                            'Unit_cost' => $request['Unit_cost'][$i],
                            'product_code' => $request['product_varient'][$i],
                            'WHID'=>$request->WHID,
                            'Qty' => $request['qty'][$i],
                            'sub_total' => $request['sub_total'][$i],
                            'SRID' => $PID,
                            'in_out'=>1];
                        $pq=helpers::updated_stock($request['product_varient'][$i]);
                        StockDetails::create($itemdata);
                        if(woo_state()) {
                            //wordpress product update qty total quantity
                            $wp_qty = helpers::product_updated_stock($request['product_id'][$i]);
                            $variation_data = [
                                'stock_quantity' => $pq + $request['qty'][$i],
                            ];
                            $wp_id = Product::find($request['product_id'][$i])->w_id;
                            $variation_id = ProductVariant::where('item_code', $request['product_varient'][$i])->value('v_id');
                            UpdateWordpressQty::dispatch($wp_id, $variation_id, $variation_data, $wp_qty)
                                ->delay(now()->addSeconds(30));
                        }
                    }
                }
            } else {
                $data['updated_by']=Auth::user()->id;
                SaleReturn::where('id', $id)->update($data);
                $trans_code=SaleReturn::where('id',$id)->value('trans_code');
                Transaction::where('trans_code',$trans_code)->delete();
                $tData['trans_code']=$trans_code;
                $tdata['Created_By']=Auth::user()->id;
                $tData['narration']='Sale Return Against SR#'.$id;
                Transaction::create($tData);
                //dr to sale account
                $tData['trans_acc_id']=3;
                $tData['dr_cr']=1;
                Transaction::create($tData);
                StockDetails::where('SRID', $id)->delete();
                for ($i=0; $i<$count; $i++) {
                    if(!empty($request['product_id'][$i])) {
                        $itemdata = ['product_id' => $request['product_id'][$i],
                            'Unit_cost' => $request['Unit_cost'][$i],
                            'product_code' => $request['product_varient'][$i],
                            'WHID'=>$request->WHID,
                            'Qty' => $request['qty'][$i],
                            'sub_total' => $request['sub_total'][$i],
                            'SRID' => $id,
                            'in_out'=>1];
                        StockDetails::create($itemdata);
                        if(woo_state()) {
                            $pq = helpers::updated_stock($request['product_varient'][$i]);
                            //wordpress product update qty total quantity
                            $wp_qty = helpers::product_updated_stock($request['product_id'][$i]);
                            $variation_data = [
                                'stock_quantity' => $pq,
                            ];
                            $wp_id = Product::find($request['product_id'][$i])->w_id;
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
        $per_page=($request->per_page)??15;
        $result=SaleReturn::with(['customers','location'])
            ->when($request->df, function($query)use ($request){
                $query->whereBetween('date',[$request->df,$request->dt]);
            })->when($request->sr, function($query)use ($request){
                $query->where('sr',$request->sr);
            }) ->when($request->customer_id, function($query)use ($request){
                return $query->whereHas('customers', function ($query) use ($request) {
                    return $query->where('customers.id', '=', $request->customer_id);
                });
            })
            ->join('stock_details','stock_details.SRID','=','sale_returns.id')
            ->where('stock_details.in_out',1)->groupBY('SRID')
            ->select('sale_returns.*',DB::raw('sum(stock_details.QTY) as total_QTY'))
            ->orderBy('sale_returns.id', 'DESC')
            ->paginate($request->per_page);
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
        $result=SaleReturn::find($id);
        $itemresult = StockDetails::where('SRID',$id)->get();
        $html='';
        foreach ($itemresult as $item){
            $html.='<tr class="rows">
                <td colspan="1">
                <input type="hidden" name="product_id[]" value="1">'.Product::find($item->product_id)->name.'
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
                <td><span class="sub-total">'.$item->sub_total.'</span><input type="hidden" name="sub_total[]" value="'.$item->sub_total.'"></td>
                <td><i class="fa fa-trash trash" style="border: none"></i></td>
                </tr>';
        }
        return response()->json([$result,$html]);

    }
    //print data
    public function print_data($id){
        $pos=PosSetting::where('default_location', Auth::user()->WHID)->first();
        $sinv = SaleReturn::find($id);
        $customer=Customer::find($sinv->customer_id);
        $result=DB::table('stock_details')->join('products','stock_details.product_id','products.id')
            ->where('stock_details.SRID',$sinv->id)->get();
        $location=WhereHouse::where('id',$sinv->WHID)->first();
        return view('salereturn.print',compact('sinv','result','location','pos','customer'));
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
        $stockDetails=StockDetails::where('SRID', $id)->get();
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
            StockDetails::where('product_code',$item->product_code)->where('SRID',$id)->delete();
            if(woo_state()) {
                $wp_qty = helpers::product_updated_stock($item->product_id);
                $wp_id = Product::find($item->product_id)->w_id;
                UpdateWordpressQty::dispatch($wp_id, $variation_id, $variation_data, $wp_qty)
                    ->delay(now()->addSeconds(60));
            }
        }
        SaleReturn::destroy($id);
    }
}
