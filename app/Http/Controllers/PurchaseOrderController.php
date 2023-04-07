<?php

namespace App\Http\Controllers;

use App\Models\Discount;
use App\Models\Product;
use App\Models\PurchaseInvoice;
use App\Models\StockDetails;
use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Models\PurchaseOrder;
use App\Models\Item;
use App\Models\UnitType;
use DB;
use App\Helpers\helpers;
use App\Models\Product\ProductVariant;
use App\Jobs\UpdateWordpressQty;
use App\Http\Controllers\StockCountController;

class PurchaseOrderController extends Controller
{

    public function loadProducts(Request $request)
    {
        $stock= new StockCountController();
        $string = $request->product_string;
        $pd=0;
        //preg_match_all('!\d+!', $string, $matches);
        $matches=explode("(",$string);
        $matches=explode("-",$matches[0]);
        $count=count($matches);
        if($count>1){
            $srch=$matches[1];
        }else{
            $srch=$matches[0];
        }
        $is_var=Product::where('product_code',$srch)->value('is_variant');
        if($is_var==1) {
            $result = DB::table('products')
                ->join('product_variants','products.id','product_variants.PID')
                ->leftjoin('stock_details','stock_details.product_id','products.id')
                ->leftJoin('categories','categories.id','=','products.product_category')
                ->select('products.id as product_id','products.name as product_name','product_variants.*','products.*',
                    DB::raw("(SELECT IFNULL(sum(Qty),0) from stock_details AS T where T.in_out=1 and T.WHID=stock_details.WHID and T.product_code=stock_details.product_code) AS pq"),
                    DB::raw("(SELECT IFNULL(sum(Qty),0) from stock_details AS T where T.in_out=2 and T.WHID=stock_details.WHID and T.product_code=stock_details.product_code) AS sq"),
                    'categories.name as category_name')
                ->where('product_variants.item_code',$string)
                ->groupBy('product_variants.item_code')
                ->get();

            if(isset($request->WHID)){
                $results = $result->where('WHID',3)->unique('product_code');
                foreach ($results as $res)
                {
                    $result=[];
                    $result[]=$res;
                }
                $avialable_stock=0;
                $wh_stock = $stock->check_wh_stock($string,$request->WHID);
                if(count($wh_stock)>0 ){
                    $avialable_stock= ((float) $wh_stock[0]->pq) - ((float) $wh_stock[0]->sq);
                    $result[0]->available_stock=$avialable_stock;
                }
                $result[0]->available_stock=$avialable_stock;

            }

            $discounts=Discount::where('valid_from','<',date('Y-m-d'))
                ->where('valid_till','>',date('Y-m-d'))->where('discount_by','product')->where('status','1')->orderBy('id', 'DESC')->get();

            foreach ($discounts as $dis ){
                if($dis) {
                    $discounted_product = explode(',', $dis->discount_on);
                    if (in_array($result[0]->id, $discounted_product)) {
                        switch ($dis->discount_type){
                            case "Fixed":
                                $pd = $dis->value;
                                break;
                            case "Percentage":
                                $percentage = (int) $dis->value;
                                $product_price = (int) $result[0]->product_price;
                                $pd = $percentage /100 * $product_price;

                                break;
                            default:
                                echo "not identified";
                            break;
                        }
                        if($dis->min_qty == '1') {
                            $result[0]->product_discount = $pd;
                        }

                        $result[0]->min_qty= (int)$dis->min_qty;
                        $result[0]->max_qty=(int)$dis->max_qty;
                        $result[0]->discount_type=$dis->discount_type;
                        $result[0]->discount_value=$dis->value;
                        break;
                    }
                }
            }

            $variants=DB::table('products')
                ->join('product_variants','products.id','product_variants.PID')
                ->select('product_variants.item_code')
                ->where('products.id',$result[0]->product_id)
                ->groupBy('product_variants.item_code')
                ->get();
            $variant_arr=[];
            foreach ($variants as $variant){
                $variant_arr[]=$variant->item_code;
            }
            $result[0]->variants=implode(',',$variant_arr);

            $result[0]->discount=$pd;

        }else{
            $result = Product::where('products.product_code', trim($srch))
                ->leftJoin('brands','products.brand_id','brands.id')
                ->leftjoin('stock_details','stock_details.product_id','products.id')
                ->leftJoin('categories','categories.id','=','products.product_category')
                ->select('*','products.id As PID','products.name as product_name','products.product_code as item_code','products.*',
                    DB::raw("(SELECT IFNULL(sum(Qty),0) from stock_details AS T where T.in_out=1 and T.WHID=stock_details.WHID and T.product_code=stock_details.product_code) AS pq"),
                    DB::raw("(SELECT IFNULL(sum(Qty),0) from stock_details AS T where T.in_out=2 and T.WHID=stock_details.WHID and T.product_code=stock_details.product_code) AS sq"),
                    'brands.brand_name','categories.name as category_name')/*->groupBy('products.product_code')*/
                ->get();

            if(isset($request->WHID)){
                $results = $result->where('WHID',$request->WHID)->unique('product_code');
                foreach ($results as $res)
                {
                    $result=[];
                    $result[]=$res;
                }
                $avialable_stock=0;
                $wh_stock = $stock->check_wh_stock(trim($srch),$request->WHID);
                if(count($wh_stock)>0 ){
                    $avialable_stock= ((float) $wh_stock[0]->pq) - ((float) $wh_stock[0]->sq);
                    $result[0]->available_stock=$avialable_stock;
                }
                $result[0]->available_stock=$avialable_stock;
            }

            $discounts=Discount::where('valid_from','<', date('Y-m-d'))
                ->where('valid_till','>', date('Y-m-d'))->where('status','1')->where('discount_by','product')->get();
            foreach ($discounts as $dis ){
                if($dis) {
                    $discounted_product = explode(',', $dis->discount_on);
                    if (count($result) >0 && in_array($result[0]->id, $discounted_product)) {
                        switch ($dis->discount_type){
                            case "Fixed":
                                $pd = $dis->value;
                                break;
                            case "Percentage":
                                $percentage = (int) $dis->value;
                                $product_price = (int) $result[0]->product_price;
                                $pd = $percentage /100 * $product_price;

                                break;
                            default:
                                echo "not identified";
                                break;
                        }
                        if($dis->min_qty== '1') {
                            $result[0]->product_discount = $pd;
                        }

                        $result[0]->min_qty= (int)$dis->min_qty;
                        $result[0]->max_qty=(int)$dis->max_qty;
                        break;
                    }
                }


            }

            $result[0]->discount=$pd;
        }
        return response()->json($result);
    }
    public function loadProductsPurchase(Request $request)
    {
        $string = $request->product_string;
        $pd=0;
        //preg_match_all('!\d+!', $string, $matches);
        $matches=explode("(",$string);
        $matches=explode("-",$matches[0]);
        $count=count($matches);
        if($count>1){
            $srch=$matches[1];
        }else{
            $srch=$matches[0];
        }
        $is_var=Product::where('product_code',$srch)->value('is_variant');
        if($is_var==1) {
            $result = DB::table('products')
                ->join('product_variants','products.id','product_variants.PID')
                ->leftJoin('brands','products.brand_id','brands.id')
                ->leftJoin('categories','categories.id','=','products.product_category')
                ->select('products.name as product_name','product_variants.*','products.*',
                    'brands.brand_name','categories.name as category_name')
                ->where('product_variants.item_code',$string)->get();
        }else{
            $result = Product::where('product_code', trim($srch))
                ->leftJoin('brands','products.brand_id','brands.id')
                ->leftJoin('categories','categories.id','=','products.product_category')
                ->select('*','products.id As PID','products.name as product_name','products.product_code as item_code','products.*',
                    'brands.brand_name','categories.name as category_name')->get();
        }
        return response()->json($result);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Purchase_order.index');
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
            'net_total' => 'required',
        ];
        $message=[
            'SUPID.required'=>'Supply Required',
            'net_total.required'=>'Total Should Not be 0',
        ];
        $this->validate($request, $rules, $message);
        $id = $request->id;
        $data = $request->input();
        $orderdata=request()->except(['_token', 'item_id', 'unit', 'bag_weight', 'quantity', 'per_kg_weight', 'unit_price', 'amount']);
        DB::beginTransaction();
        $item_id = $request->item_id;
        $count = count($request->item_id);
        $unit = $request->unit;
        $bag_weight = $request->bag_weight;
        $per_kg_rate = $request->per_kg_rate;
        $quantity = $request->quantity;
        $total_bag = $request->total_bag;
        $per_bag_rate = $request->per_bag_rate;
        $unit_price = $request->unit_price;
        $amount = $request->amount;
        $total = $request->total;
        try {
            if ($id == 0) {
                $insert = PurchaseOrder::create($orderdata);
                $purchase_order_id =  $insert->id;
                $i = 0;
                for ($i=0; $i<$count; $i++) {
                    if(!empty($item_id[$i])) {
                        $itemdata = ['Item_Id' => $item_id[$i],
                            'Unit' => $unit[$i],
                            'Qty' => $quantity[$i],
                            'Unit_Price' => $unit_price[$i],
                            'amount' => $amount[$i],
                            'POID' => $purchase_order_id,
                            'per_kg_rate' => $per_kg_rate[$i],
                            'bag_weight' => $bag_weight[$i],
                            'total_bag'=>$total_bag[$i], 'per_bag_rate'=>$per_bag_rate[$i],
                            'product_code'=>$request['product_varient'][$i]];
                        StockDetails::create($itemdata);
                    }
                }
            } else {
                $insert = PurchaseOrder::where('id', $id)->first();
                $insert->update($orderdata);
                $i = 0;
                StockDetails::where('PID',$id)->delete();
                for ($i=0; $i<$count; $i++) {
                    if(!empty($item_id[$i])) {
                        $itemdata = ['Item_Id' => $item_id[$i], 'Unit' => $unit[$i],
                            'Qty' => $quantity[$i], 'Unit_Price' => $unit_price[$i],
                            'amount' => $amount[$i], 'POID' => $id, 'per_kg_rate' => $per_kg_rate[$i],
                            'bag_weight' => $bag_weight[$i], 'total_bag'=>$total_bag[$i], 'per_bag_rate'=>$per_bag_rate[$i]];
                        StockDetails::create($itemdata);
                    }
                }
            }
            DB::commit();
            return response()->json(['success'=>'Added new record Successfully.']);
        }catch (\Exception $e){
            DB::rollBack();
            return response()->json([
                'status' => 'false',
                'errors'  => $e->getMessage(),
            ], 400);
        }
    }

    public function get_data(Request $request){

        $result=PurchaseOrder::with('supplier','branch','employee')->orderBy('id', 'DESC')->select('*')->paginate(15);

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
        $result=PurchaseOrder::where('SUPID',$id)->first();
        $html='';
        $itemresult = StockDetails::where('POID',$result->id)->get();
        foreach ($itemresult as $item){
            $html.='<div class="parentRemove row-rem">
                    <div class="form-group col-md-2 pf">
                        <label>Item Name</label>
                        <select class="js-example-basic-single form-control form-control-sm" name="item_id[]" id="" required="required">
                            <option value="">Select Item</option>
                            '.Item::itemList($item->Item_Id).'
                        </select>
                    </div>
                    <div class="form-group col-md-1 pf">
                        <label>Unit</label>
                        <select class="form-control form-control-sm js-example-basic-single" id="" name="unit[]">
                            <option value="">Select</option>
                            '.UnitType::unitTypeList($item->Unit).'
                        </select>
                    </div>
                    <div class="form-group col-md-1 pf" style="width: 12% !important;">
                        <label>Standard Bag Weight</label>
                        <input type="text" class="form-control form-control-sm st_bag_weight" id="quantity" name="bag_weight[]" placeholder="Standard Bag Weight" required="required" value="'.$item->bag_weight.'">
                    </div>
                    <div class="form-group col-md-1 pf" style="width: 6% !important;">
                        <label>Quantity</label>
                        <input type="text" class="form-control form-control-sm qty" id="quantity" name="quantity[]" placeholder="Quantity" required="required" value="'.$item->Qty.'">
                    </div>
                    <div class="form-group col-md-1 pf" style="width: 8% !important;">
                        <label>Total Bag</label>
                        <input type="text" class="form-control form-control-sm total_bag" id="quantity" name="total_bag[]" placeholder="Total Bag" required="required" value="'.$item->total_bag.'">
                    </div>
                    <div class="form-group col-md-1 pf" style="width: 8% !important;">
                            <label>Per Bag Rate</label>
                            <input type="text" class="form-control form-control-sm per_bag_rate" id="quantity" name="per_bag_rate[]" placeholder="Per Bag Rate" required="required" value="'.$item->per_bag_rate.'">
                        </div>
                        <div class="form-group col-md-1 pf" style="width: 8% !important;">
                            <label>Per Kg Rate</label>
                            <input type="text" class="form-control form-control-sm per_kg_w" id="quantity" name="per_kg_rate[]" placeholder="Per Kg Rate" required="required" value="'.$item->per_kg_rate.'">
                        </div>
                    <div class="form-group col-md-1 pf">
                        <label>Unit Price</label>
                        <input type="text" class="form-control form-control-sm price" id="unitprice" name="unit_price[]" placeholder="Rate" required="required" value="'.$item->Unit_Price.'">
                    </div>
                    <div class="form-group col-md-1 pf">
                        <label>Amount</label>
                        <input type="text" class="form-control form-control-sm total" id="amount" name="amount[]" placeholder="Amount" required="required" value="'.$item->amount.'">
                    </div>
                    <div class="form-group col-md-1 pf" style="width: 5% !important;">
                        <label style="visibility: hidden">Amountflakhfahfah</label>
                        <button type="button" class="btn btn-mini btn-primary" onclick="more_item()"><i class="fa fa-plus"></i> </button>
                    </div>';
        }
        return response()->json([$result,$html]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $result=PurchaseOrder::find($id);
        $html='';
        $itemresult = StockDetails::where('POID',$id)->get();
        foreach ($itemresult as $item){
            $html.='<div class="parentRemove row-rem">
                    <div class="form-group col-md-2 pf">
                        <label>Item Name</label>
                        <select class="js-example-basic-single form-control form-control-sm" name="item_id[]" id="" required="required">
                            <option value="">Select Item</option>
                            '.Item::itemList($item->Item_Id).'
                        </select>
                    </div>
                    <div class="form-group col-md-1 pf">
                        <label>Unit</label>
                        <select class="form-control form-control-sm js-example-basic-single" id="" name="unit[]">
                            <option value="">Select</option>
                            '.UnitType::unitTypeList($item->Unit).'
                        </select>
                    </div>
                        <div class="form-group col-md-1 pf" style="width: 12% !important;">
                            <label>Standard Bag Weight</label>
                            <input type="text" class="form-control form-control-sm st_bag_weight" id="quantity" name="bag_weight[]" placeholder="Standard Bag Weight" required="required" value="'.$item->bag_weight.'">
                        </div>
                    <div class="form-group col-md-1 pf" style="width: 6% !important;">
                        <label>Quantity</label>
                        <input type="text" class="form-control form-control-sm qty" id="quantity" name="quantity[]" placeholder="Quantity" required="required" value="'.$item->Qty.'">
                    </div>
                    <div class="form-group col-md-1 pf" style="width: 8% !important;">
                        <label>Total Bag</label>
                        <input type="text" class="form-control form-control-sm total_bag" id="quantity" name="total_bag[]" placeholder="Total Bag" required="required" value="'.$item->total_bag.'">
                    </div>
                    <div class="form-group col-md-1 pf" style="width: 8% !important;">
                    <label>Per Bag Rate</label>
                    <input type="text" class="form-control form-control-sm per_bag_rate" id="quantity" name="per_bag_rate[]" placeholder="Per Bag Rate" required="required" value="'.$item->per_bag_rate.'">
                    </div>
                        <div class="form-group col-md-1 pf" style="width: 8% !important;">
                            <label>Per Kg Rate</label>
                            <input type="text" class="form-control form-control-sm per_kg_w" id="quantity" name="per_kg_rate[]" placeholder="Per Kg Rate" required="required" value="'.$item->per_kg_rate.'">
                        </div>
                    <div class="form-group col-md-1 pf">
                        <label>Unit Price</label>
                        <input type="text" class="form-control form-control-sm price" id="unitprice" name="unit_price[]" placeholder="Rate" required="required" value="'.$item->Unit_Price.'">
                    </div>
                    <div class="form-group col-md-1 pf">
                        <label>Amount</label>
                        <input type="text" class="form-control form-control-sm total" id="amount" name="amount[]" placeholder="Amount" required="required" value="'.$item->amount.'">
                    </div>
                    <div class="form-group col-md-1 pf" style="width: 5% !important;">
                        <label style="visibility: hidden">Amountflakhfahfah</label>
                        <button type="button" class="btn btn-mini btn-primary" onclick="more_item()"><i class="fa fa-plus"></i> </button>
                    </div>';
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
                $wTQty = helpers::product_updated_stock($item->product_id);
                $wPID = Product::find($item->product_id)->w_id;
                UpdateWordpressQty::dispatch($wPID, $variation_id, $variation_data, $wTQty)
                    ->delay(now()->addSeconds(60));
            }
        }
        PurchaseInvoice::destroy($id);
    }

    public function purchaseByCsv()
    {
        return view('Purchase_order.purchasebycsv');
    }
    /*print purchase order */
    public function print_purchase($id){
        $po=PurchaseInvoice::where('purchase_invoices.id',$id)
            ->leftJoin('stock_details','stock_details.PID','=','purchase_invoices.id')
                ->select('purchase_invoices.*',DB::raw('sum(stock_details.QTY) as total_QTY'))->first();
        $supplier=Supplier::find($po->SUPID);
        $result=DB::table('stock_details')
            ->join('products','stock_details.product_id','products.id')
            ->where('stock_details.PID',$id)->get();
        return view('Purchase_order.print',compact('po','result','supplier'));
    }
}
