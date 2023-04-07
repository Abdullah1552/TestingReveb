<?php

namespace App\Http\Controllers;

use App\Helpers\helpers;
use App\Jobs\UpdateWordpressQty;
use App\Models\OInventory;
use App\Models\Product;
use App\Models\Product\ProductVariant;
use App\Models\StockDetails;
use App\Models\TransAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
class OInventoryController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:opening_inventory_view', ['only' => ['index']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Opening_Inventory.index');
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
            'WHID' => 'required|not_in:0',
            'product_id' => 'required',
        ];
        $message=[
            'WHID.required'=>'Wharehouse Required',
            'WHID.not_in'=>'Wharehouse Required',
            'product_id.required'=>'Product(s) are Required',
        ];

        $this->validate($request, $rules, $message);
        $dataArr['WHID'] = $request->WHID;
        $dataArr['created_by'] = Auth::id();
        $dataArr['updated_by'] = Auth::id();
        $dataArr['total_qty'] = array_sum($request->qty);
        $dataArr['date'] = date('Y-m-d H:i:s');
//        $dataArr['sub_total'] =array_sum($request->sub_total);
        $id=$request->id;
        $count=0;
        if(isset($request['product_id'])) {
            $count = count($request->product_id);
        }
        //accounts entry
        $tData['trans_acc_id']=TransAccount::where(['Parent_Type'=>$request->SUPID,'PID'=>2])->value('id');
        $tData['amount']=$request->net_total;
        $tData['trans_date']=date('Y-m-d');
        $tData['dr_cr']=2;
        $tData['status']=1;
        DB::beginTransaction();
        try {
            if ($id == 0 && $count>0) {
                $insert = OInventory::create($dataArr);
                $PID=  $insert->id;
                for ($i=0; $i<$count; $i++) {
                    if(!empty($request['product_id'][$i])) {
                        $itemdata =[
                            'product_id'=> $request['product_id'][$i],
//                            'Unit_cost' => $request['Unit_cost'][$i],
                            'Qty' => $request['qty'][$i],
//                            'sub_total' => $request['sub_total'][$i],
                            'product_code' => $request['product_varient'][$i],
                            'OID'=>$PID,
                            'WHID'=>$request->WHID,
                            'in_out'=>1,
                        ];
                        StockDetails::create($itemdata);
                        $is_var=Product::find($request['product_id'][$i]);
                        $wPID = Product::find($request['product_id'][$i]);
                        if($is_var->is_variant==1) {
                            $pq = helpers::updated_stock($request['product_varient'][$i]);
                            $variation_data = [
                                'stock_quantity' =>$pq,
                            ];
                            $variation_id = ProductVariant::where('item_code', $request['product_varient'][$i])->value('v_id');
                        }else{
                            $variation_data=[];
                            $variation_id=0;

                        }
                        if(woo_state()) {
                            //wordpress product update qty total quantity
                            $wTQty = helpers::product_updated_stock($request['product_id'][$i]);
                            UpdateWordpressQty::dispatch($wPID->w_id, $variation_id, $variation_data, $wTQty)
                                ->delay(now()->addSeconds(30));
                        }
                    }
                }
            }else{
                StockDetails::where('OID',$id)->delete();
                $data['updated_by']=Auth::user()->id;
                OInventory::where('id',$id)->update($dataArr);
                $PID= $id;
                for ($i=0; $i<$count; $i++) {
                    if(!empty($request['product_id'][$i])) {
                        $itemdata =[
                            'product_id'=> $request['product_id'][$i],
//                            'Unit_cost' => $request['Unit_cost'][$i],
                            'Qty' => $request['qty'][$i],
//                            'sub_total' => $request['sub_total'][$i],
                            'product_code' => $request['product_varient'][$i],
                            'OID'=>$PID,
                            'WHID'=>$request->WHID,
                            'in_out'=>1,
                        ];
                        StockDetails::create($itemdata);

                        $is_var=Product::find($request['product_id'][$i]);
                        $wPID = Product::find($request['product_id'][$i]);

                        if(isset($is_var->is_variant) && $is_var->is_variant==1) {
                            $pq = helpers::updated_stock($request['product_varient'][$i]);
                            $variation_data = [
                                'stock_quantity' =>$pq,
                            ];
                            $variation_id = ProductVariant::where('item_code', $request['product_varient'][$i])->value('v_id');
                        }else{
                            $variation_data=[];
                            $variation_id=0;

                        }
                        if(isset($wPID->w_id) && woo_state()){
                            //wordpress product update qty total quantity
                            $wTQty = helpers::product_updated_stock($request['product_id'][$i]);
                            UpdateWordpressQty::dispatch($wPID->w_id, $variation_id, $variation_data,$wTQty)
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
    //@display data in list
    public function get_data(Request $request){
        $count=$request->per_page;
        if($count>0){
            $per_page=$count;

        }else if($count=='0'){
            $per_page=DB::table('stock_details')
                ->leftjoin('products','stock_details.product_id','products.id')
                ->leftjoin('o_inventories','stock_details.OID','o_inventories.id')
                ->join('where_houses','o_inventories.WHID','where_houses.id')
                ->select('o_inventories.id AS id','stock_details.product_code AS pc','o_inventories.date',
                    'products.name', DB::raw('sum(Qty) As tq'),
                    'where_houses.WH_Name')
                ->where('stock_details.in_out',1)
                ->groupBy('stock_details.product_code')
                ->orderBy('o_inventories.id','DESC')
                ->get()->count();

        }else{
            $per_page=25;
        }
        $result=DB::table('o_inventories')
            ->leftjoin('stock_details','o_inventories.id','stock_details.OID')
            ->leftjoin('where_houses','o_inventories.WHID','where_houses.id')
            ->select('o_inventories.id AS id','stock_details.product_code AS pc','o_inventories.date',
                DB::raw('sum(stock_details.Qty) As tq'),
                'where_houses.WH_Name')->where('stock_details.in_out',1)
            ->when($request->df, function ($query) use ($request){
                $query->whereBetween('o_inventories.created_at',[$request->df, $request->dt]);
            })
            ->when($request->category_id, function ($query) use ($request){
                $query->where('products.product_category',$request->product_category);
            })->when($request->pn, function ($query) use ($request) {
                $query->where('o_inventories.id', 'LIKE', '%' . $request->pn . '%')
                ->orderBy('o_inventories.id','DESC');
            })->when($request->WHID, function ($query) use ($request){
                $query->where('where_houses.id',$request->WHID);
            })
            ->groupBy('o_inventories.id')
            // ->orderBy('o_inventories.id','DESC')
            ->paginate($per_page);
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
        $result=OInventory::find($id);
         $product_result=StockDetails::where('OID',$id)->get();
//        return $product_result;
        $product_line='';
        foreach ($product_result as $item){

            $product_line.='<tr class="rows">
                <td colspan="1">
                <input type="hidden" name="product_id[]" value="'.$item->product_id.'">'.Product::find($item->product_id)->name.'
                </td>
                <td class="product-code">
                <input type="hidden" name="product_varient[]" value="'.$item->product_code.'">
                '.$item->product_code.'</td>
                <td id="">
                <input type="number" min="1" class="quantity" name="qty[]" value="'.$item->Qty.'">
                </td>'.
                /*'<td class="product-cost"><input type="hidden" name="Unit_cost[]" value="'.$item->Unit_cost.'">'.$item->Unit_cost.'</td>
                <td id="">0.00</td>
                <td class="tax-amount">'.$item->tax.'</td>
                <td><span class="sub-total">'.$item->sub_total.'</span><input type="hidden" name="sub_total[]" value="'.$item->sub_total.'"></td>'.*/
                '<td><i class="fa fa-trash trash" style="border: none"></i></td>
                </tr>';

        }

        return compact('result','product_line');
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
        $stockDetails=StockDetails::where('OID', $id)->get();
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
            StockDetails::where('product_code',$item->product_code)->where('OID',$id)->delete();
            if(woo_state()) {
                $wTQty=helpers::product_updated_stock($item->product_id);
                $wPID = Product::find($item->product_id)->w_id;
                UpdateWordpressQty::dispatch($wPID, $variation_id, $variation_data, $wTQty)
                    ->delay(now()->addSeconds(60));
            }
        }
        OInventory::destroy($id);
        StockDetails::where('OID', $id)->delete();
    }

    public function delete_multiple(Request $request)
    {
        foreach ($request->records as $record){
            $this->destroy(trim($record));
        }
    }

    public function print_data($id){
        $opening_inv=OInventory::with(['location','user_create'])->where('id',$id)->first();

        $result=StockDetails::join('products','products.id','=','stock_details.product_id')
            ->join('categories','products.product_category','=','categories.id')
            ->select('stock_details.*','stock_details.product_code as product_code ',DB::raw('categories.name as category_name'))
            ->where('OID',$id)->get();

        return view('Opening_Inventory.print',compact('opening_inv','result'));
    }
}
