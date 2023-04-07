<?php

namespace App\Http\Controllers;
use App\Models\Product\Adjustment;
use Illuminate\Http\Request;
use DB;
use Auth;
use App\Helpers\helpers;
use App\Models\StockDetails;
use App\Models\Product;
use Codexshaper\WooCommerce\Models\Variation;
use App\Models\Product\ProductVariant;
use App\Jobs\UpdateWordpressQty;

class AdjustmentController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:adjustment_view', ['only' => ['index']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('adjustment.index');
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
            'WHID' => 'required',
            'product_id' => 'required',
            'qty' => 'required|min:1',
            'reference' => 'required',
        ];
        $message=[
            'WHID.required'=>'Location Required',
            'product_id.required'=>'Product(s) are Required',
            'qty.required' => 'Product Quantity Required',
            'qty.min' => 'Product Quantity greater than 0',
            'reference.unique' => 'Reference should be unique than 0',
        ];
        $this->validate($request, $rules, $message);
        if ($image = $request->file('attached_document')) {
            $destinationPath = 'storage/app/public/transfer_image';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $data['photo'] = $profileImage;
        }
        $data['WHID']=$request->WHID;
        $data['notes']=$request->inovice_details;
        $data['reference']=trim( $request->reference );
        $id=$request->id;
        DB::beginTransaction();
        $count=0;
        if(isset($request['product_id'])) {
            $count = count($request->product_id);
        }
        try {
            if ($id == 0 && $count>0) {
                $data['created_by']=Auth::user()->id;
                $insert = Adjustment::create($data);
                $ADJID=  $insert->id;
                for ($i=0; $i<$count; $i++) {
                    if(!empty($request['product_id'][$i])) {
                        /*This code will check if Stock exist*/
                        if($request['action_type'][$i]==2 && StockDetails::check_stock($request['product_varient'][$i],$request->WHID) < ((int)$request['qty'][$i])){
                            return response()->json([
                                'status' => 'false',
                                'errors'  => [$request['product_varient'][$i]."'s Insufficient Stock."],
                            ], 400);
                        }
                        $itemdata = ['product_id' => $request['product_id'][$i],
                            'Qty' => $request['qty'][$i],
                            'product_code' => $request['product_varient'][$i],
                            'ADJID' => $ADJID,
                            'WHID'=>$request->WHID,
                            'in_out'=>($request['action_type'][$i]==1?'1':'2'),
                        ];
                        $pq=helpers::updated_stock($request['product_varient'][$i]);
                        StockDetails::create($itemdata);
                        if(woo_state()) {
                            $wPID = Product::find($request['product_id'][$i])->w_id;
                            //wordpress product update qty total quantity
                            $wTQty = helpers::product_updated_stock($request['product_id'][$i]);
                            $variation_id = ProductVariant::where('item_code', $request['product_varient'][$i])->value('v_id');
                            $variation_data = [
                                'stock_quantity' => ($request['action_type'][$i] == 1 ? $pq + $request['qty'][$i] : $pq - $request['qty'][$i]),
                            ];
                            UpdateWordpressQty::dispatch($wPID, $variation_id, $variation_data, $wTQty)
                                ->delay(now()->addSeconds(30));
                        }
                    }
                }
            } else {
                StockDetails::where('ADJID',$id)->delete();
                $data['updated_by']=Auth::user()->id;
                Adjustment::where('id',$id)->update($data);
                for ($i=0; $i<$count; $i++) {
                    if(!empty($request['product_id'][$i])) {
                        $itemdata = ['product_id' => $request['product_id'][$i],
                            'Qty' => $request['qty'][$i],
                            'product_code' => $request['product_varient'][$i],
                            'ADJID' => $id,
                            'WHID'=>$request->WHID,
                            'reference'=>$request->reference,
                            'in_out'=>($request['action_type'][$i]==1?'1':'2'),
                        ];
                        StockDetails::create($itemdata);
                        $pq=helpers::updated_stock($request['product_varient'][$i]);
                        if(woo_state()) {
                            $wPID = Product::find($request['product_id'][$i])->w_id;
                            //worpdress product update qty total quantity
                            $wTQty = helpers::product_updated_stock($request['product_id'][$i]);
                            $variation_id = ProductVariant::where('item_code', $request['product_varient'][$i])->value('v_id');
                            $variation_data = [
                                'stock_quantity' => ($request['action_type'][$i] == 1 ? $pq + $request['qty'][$i] : $pq + $request['qty'][$i]),
                            ];
                            UpdateWordpressQty::dispatch($wPID, $variation_id, $variation_data, $wTQty)
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
            $per_page=Adjustment::all()->count();
        }else{
            $per_page=25;
        }
        return $result = DB::table('adjustments')
            ->leftjoin('stock_details AS s','adjustments.id','s.ADJID')
            ->leftjoin('where_houses','adjustments.WHID','where_houses.id')
            ->select('adjustments.created_at','where_houses.WH_Name','adjustments.notes',
                'adjustments.id','adjustments.reference',DB::raw("sum(s.Qty) as pq"))
            ->when($request->df, function($query)use ($request){
                $query->whereBetween(DB::raw('DATE(adjustments.created_at)'),[$request->df, $request->dt]);
            })
            ->when($request->wherehouse_id, function($query)use ($request){
            $query->where('where_houses.id', $request->wherehouse_id);
            })
            ->when($request->reference, function($query)use ($request){
                $query->where('s.reference','LIKE', '%'.$request->reference.'%');
            })
            ->groupBy('s.ADJID')->orderBy('id','DESC')->paginate($per_page);
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
        $result=Adjustment::find($id);
        $product_result=StockDetails::where('ADJID',$result->id)->get();
        $product_line='';
        foreach ($product_result as $item){
            $product_line.='<tr class="rows">
                <td colspan="1"><input type="hidden" name="product_id[]" value="'.$item->product_id.'">'.Product::find($item->product_id)->name.'</td>
                <td class="product-code"> <input type="hidden" name="product_varient[]" value="'.$item->product_code.'">'.$item->product_code.'</td>
                <td class="input-qty"><input type="number" min="1" class="quantity" name="qty[]" value="'.$item->Qty.'"></td>
                \'<td class="input-qty"><select name="action_type[]"><option value="1" '.($item->in_out==1?'selected':'').'>Plus</option><option '.($item->in_out==2?'selected':'').' value="2">Minus</option> </select></td>\'+
                <td><i class="fa fa-trash trash" style="border: none"></i></td>
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
            $stockDetails=StockDetails::where('ADJID', $id)->get();
            foreach ($stockDetails as $item)
            {
                $is_var=Product::find($item->product_id);
                if($is_var->is_variant==1) {
                    $pq=helpers::updated_stock($item->product_code);
                    $variation_data = [
                        'stock_quantity' => $pq+$item->Qty,
                    ];
                    $variation_id=ProductVariant::where('item_code', $item->product_code)->value('v_id');
                }else{
                    $variation_data=[];
                    $variation_id=0;
                }
                StockDetails::where('product_code',$item->product_code)->where('ADJID',$id)->delete();
                if(woo_state()) {
                    $wTQty = helpers::product_updated_stock($item->product_id);
                    $wPID = Product::find($item->product_id)->w_id;
                    UpdateWordpressQty::dispatch($wPID, $variation_id, $variation_data, $wTQty)
                        ->delay(now()->addSeconds(60));
                }
            }
            Adjustment::destroy($id);
    }
    public function delete_multiple(Request $request)
    {
        foreach ($request->records as $record){
            $this->destroy($record);
        }
    }
    public function print_data($id){
        $po=Adjustment::with(['location','user_create'])->where('id',$id)->first();
        $result=DB::table('stock_details')
            ->join('products','stock_details.product_id','products.id')
            ->select('*','stock_details.product_code')
            ->where('stock_details.ADJID',$id)->get();
        return view('adjustment.print',compact('po','result'));
    }
}
