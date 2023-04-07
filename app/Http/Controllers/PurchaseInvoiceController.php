<?php

namespace App\Http\Controllers;

use App\Helpers\helpers;
use App\Jobs\UpdateWordpressQty;
use App\Models\Product;
use App\Models\Product\ProductVariant;
use App\Models\TransAccount;
use App\Models\Transaction;
use Codexshaper\WooCommerce\Models\Variation;
use Illuminate\Http\Request;
use App\Models\PurchaseInvoice;
use App\Models\StockDetails;
use App\Models\Item;
use App\Models\UnitType;
use DB;
use Auth;

class PurchaseInvoiceController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:purchase_list_create', ['only' => ['index']]);
        $this->middleware('permission:purchase_list_create', ['only' => ['store']]);
        $this->middleware('permission:purchase_list_edit', ['only' => ['edit']]);
        $this->middleware('permission:purchase_list_delete', ['only' => ['delete']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Purchase_order.index');
//        return view('Purchase_invoice.index');
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
     * @return false
     */
    public function store(Request $request)
    {
        $rules = [
            'SUPID' => 'required',
            'WHID' => 'required',
            'purchase_status' => 'required',
            'purchase_date' => 'required',
            'product_id' => 'required',
        ];
        $message=[
            'SUPID.required'=>'Supply Required',
            'WHID.required'=>'Location Required',
            'purchase_status.required' => 'Purchase Status Required',
            'product_id.required'=>'Product(s) are Required',
        ];
        $this->validate($request, $rules, $message);
        $data['WHID']=$request->WHID;
        $data['SUPID']=$request->SUPID;
        $data['purchase_status']=$request->purchase_status;
        if ($image = $request->file('attached_document')) {
            $destinationPath = 'storage/app/public/product_images';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $data['attached_document'] = $profileImage;
        }
        $data['reference']= $request->reference;
        $data['purchase_date']= $request->purchase_date;
        $data['order_tax']=$request->order_tax;
        $data['net_total']=$request->net_total;
        $data['shipping_cost']=$request->shipping_cost;
        $data['discount']=$request->discount;
        $data['inovice_details']=$request->inovice_details ;
        $data['updated_by']=Auth::user()->id;
        $id=$request->id;
        $count=0;
        if(isset($request['product_id'])) {
            $count = count($request->product_id);
        }
        //accounts entry
        $tData['trans_acc_id']=TransAccount::where(['Parent_Type'=>$request->SUPID,'PID'=>13])->value('id');
        $tData['amount']=$request->net_total;
        $tData['trans_date']=date('Y-m-d');
        $tData['dr_cr']=2;
        $tData['status']=1;
        DB::beginTransaction();
        try {
            if ($id == 0 && $count>0) {
                $data['created_by']=Auth::user()->id;
                $tData['trans_code']=helpers::trans_code();
                $tdata['Created_By']=Auth::user()->id;
                $data['trans_code']=helpers::trans_code();
                $insert = PurchaseInvoice::create($data);
                $PID=  $insert->id;
                $tData['narration']='Against Purchase inovice #'.$PID;
                Transaction::create($tData);
                //dr to purchae account
                $tData['trans_acc_id']=5;
                $tData['dr_cr']=2;
                Transaction::create($tData);
                for ($i=0; $i<$count; $i++) {
                    if(!empty($request['product_id'][$i])) {
                        $itemdata =[
                            'product_id'=> $request['product_id'][$i],
                            'Unit_cost' => $request['Unit_cost'][$i],
                            'Qty' => $request['qty'][$i],
                            'sub_total' => $request['sub_total'][$i],
                            'product_code' => $request['product_varient'][$i],
                            'PID'=>$PID,
                            'WHID'=>$request->WHID,
                            'in_out'=>1,
                        ];
                        StockDetails::create($itemdata);
                        $is_var=Product::find($request['product_id'][$i]);
                        if($is_var->is_variant==1)
                        {
                            $pq=helpers::updated_stock($request['product_varient'][$i]);
                            $variation_id=ProductVariant::where('item_code', $request['product_varient'][$i])->value('v_id');
                            $variation_data = [
                                'stock_quantity' => $request['qty'][$i]+$pq,
                            ];
                        }
                        else
                        {
                            $variation_data='';
                            $variation_id=0;
                        }
                        if(woo_state()){
                            //wordpress product update qty total quantity
                            $wp_qty=helpers::product_updated_stock($request['product_id'][$i]);
                            $wp_id = Product::find($request['product_id'][$i])->w_id;
                            UpdateWordpressQty::dispatch($wp_id, $variation_id, $variation_data,$wp_qty)
                                ->delay(now()->addSeconds(60));
                        }
                    }
                }
            }else{
                $pData=PurchaseInvoice::find($id);
                PurchaseInvoice::where('id',$id)->update($data);
                StockDetails::where('PID',$id)->delete();
                for ($i=0; $i<$count; $i++) {
                    if(!empty($request['product_id'][$i])) {
                        $itemdata =[
                            'product_id'=> $request['product_id'][$i],
                            'Unit_cost' => $request['Unit_cost'][$i],
                            'Qty' => $request['qty'][$i],
                            'sub_total' => $request['sub_total'][$i],
                            'product_code' => $request['product_varient'][$i],
                            'PID'=>$id,
                            'WHID'=>$request->WHID,
                            'in_out'=>1,
                        ];
                        StockDetails::create($itemdata);
                        $is_var=Product::find($request['product_id'][$i]);
                        if($is_var->is_variant==1)
                        {
                            $pq=helpers::updated_stock($request['product_varient'][$i]);
                            $variation_id=ProductVariant::where('item_code', $request['product_varient'][$i])->value('v_id');
                            $variation_data = [
                                'stock_quantity' =>$pq,
                            ];
                        }
                        else
                        {
                            $variation_data='';
                            $variation_id=0;
                        }

                        if(woo_state()) {
                            //wordpress product update qty total quantity
                            $wp_qty = helpers::product_updated_stock($request['product_id'][$i]);
                            $wp_id = Product::find($request['product_id'][$i])->w_id;
                            UpdateWordpressQty::dispatch($wp_id, $variation_id, $variation_data, $wp_qty)
                                ->delay(now()->addSeconds(60));
                        }
                    }
                }
                Transaction::where('trans_code',$pData->trans_code)->delete();
                $tData['trans_code']=helpers::trans_code();
                $tdata['Created_By']=Auth::user()->id;
                $tData['narration']='Against Purchase inovice #'.$id;
                Transaction::create($tData);
                //dr to purchae account
                $tData['trans_acc_id']=5;
                $tData['dr_cr']=1;
                Transaction::create($tData);
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
        $result=PurchaseInvoice::with(['supplier','location'])
            ->when($request->df, function ($query) use ($request){
                return $query->whereBetween(DB::raw('DATE(purchase_invoices.created_at)'), [$request->df,$request->dt]);
            })->when($request->reference, function ($query) use ($request){
                return $query->where('reference',$request->reference);
            })->orderBy('id', 'DESC')
            ->leftJoin('stock_details','stock_details.PID','=','purchase_invoices.id')
            ->groupBY('PID')
            ->select('purchase_invoices.*',DB::raw('sum(stock_details.QTY) as total_QTY'))
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
        $result=PurchaseInvoice::find($id);
        $html='';
        $itemresult = StockDetails::where('PID',$id)->get();
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
                <td><span class="sub-total">'.$item->sub_total.'</span><input type="hidden" name="sub_total[]" value="'.$item->sub_total.'"></td>
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
        $stockDetails=StockDetails::where('PID', $id)->get();
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
        PurchaseInvoice::destroy($id);
    }
}
