<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Access\Gate;
use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\GatePass;
use App\Models\StockDetails;
use App\Models\UnitType;
use DB;
use Database;
class GatePassController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('gate_pass.index');
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
            'date' => 'required',
        ];
        $message=[
            'SUPID.required'=>'Supply Required',
            'date.required'=>'Date Required',
        ];
        $this->validate($request, $rules, $message);
        $id = $request->id;
        $data = $request->input();
        $orderdata=request()->except(['_token', 'item_id', 'unit', 'bag_weight',
            'quantity', 'per_kg_rate', 'unit_price', 'amount', 'total_bag', 'per_bag_rate']);
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
                $insert = GatePass::create($orderdata);
                $gid=  $insert->id;
                $i = 0;
                for ($i=0; $i<$count; $i++) {
                    if(!empty($item_id[$i])) {
                        $itemdata = ['Item_Id' => $item_id[$i], 'Unit' => $unit[$i], 'Qty' => $quantity[$i], 'Unit_Price' => $unit_price[$i],
                            'amount' => $amount[$i], 'GID' => $gid, 'per_kg_rate' => $per_kg_rate[$i],
                            'bag_weight' => $bag_weight[$i],
                            'total_bag'=>$total_bag[$i],'per_bag_rate'=>$per_bag_rate[$i]];
                        StockDetails::create($itemdata);
                    }
                }
            } else {
                $insert = GatePass::where('id', $id)->update($orderdata);
                $i = 0;
                StockDetails::where('GID',$id)->delete();
                for ($i=0; $i<$count; $i++) {
                    if(!empty($item_id[$i])) {
                        $itemdata = ['Item_Id' => $item_id[$i], 'Unit' => $unit[$i], 'Qty' => $quantity[$i], 'Unit_Price' => $unit_price[$i],
                            'amount' => $amount[$i], 'GID' => $id, 'per_kg_rate' => $per_kg_rate[$i],
                            'bag_weight' => $bag_weight[$i], 'total_bag'=>$total_bag[$i],'per_bag_rate'=>$per_bag_rate[$i]];
                        StockDetails::create($itemdata);
                    }
                }
            }
            DB::commit();
            return response()->json(['success'=>'Added new record Successfully.']);
        }catch (\Illuminate\Database\QueryException $e){
            DB::rollBack();
            $errorCode = $e->errorInfo[1];
            return response()->json([
                'status' => 'false',
                'errors'  => $e->getMessage(),
            ], 400);
        }
    }
    //display list data
    public function get_data(Request $request){

        $result=GatePass::orderBy('id', 'DESC')->select('*')->paginate(15);

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
        $result=GatePass::find($id);
        $html='';
        $itemresult = StockDetails::where('GID',$id)->get();
        foreach ($itemresult as $item){
            $html.='<div class="parentRemove row-rem">
                    <div class="form-group col-md-1 pf">
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
                        <div class="form-group col-md-1 pf" style="width: 8% !important;">
                            <label>Bag Weight</label>
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
                        <div class="form-group col-md-1 pf">
                            <label>Per Kg Rate</label>
                            <input type="text" class="form-control form-control-sm per_kg_w" id="quantity" name="per_kg_rate[]" placeholder="Per Kg Rate" required="required" value="'.$item->per_kg_rate.'">
                        </div>
                    <div class="form-group col-md-1 pf">
                        <label>Unit Price</label>
                        <input type="text" class="form-control form-control-sm price" id="unitprice" name="unit_price[]" placeholder="Rate" required="required" value="'.$item->Unit_Price.'">
                    </div>
                    <div class="form-group col-md-1 pf" style="width: 5% !important;">
                        <label>GST %</label>
                        <input type="text" class="form-control form-control-sm gst_per" id="qty" name="GST_per[]" placeholder="Gst %">
                    </div>
                    <div class="form-group col-md-1 pf">
                        <label>GST Amount</label>
                        <input type="text" class="form-control form-control-sm gst_amount" id="qty" name="Gst_amount[]" placeholder="Gst Amount">
                    </div>
                    <div class="form-group col-md-1 pf">
                        <label>Amount</label>
                        <input type="text" class="form-control form-control-sm total" id="amount" name="amount[]" placeholder="Amount" required="required" value="'.$item->amount.'">
                    </div>
                    <!--<div class="form-group col-md-1 pf" style="width: 5% !important;">
                        <label style="visibility: hidden">Amountflakhfahfah</label>
                        <button type="button" class="btn btn-mini btn-primary" onclick="more_item()"><i class="fa fa-plus"></i> </button>
                    </div>--></div><div class="clearfix"></div>';
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
        $result=GatePass::find($id);
        $html='';
        $itemresult = StockDetails::where('GID',$id)->get();
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
                        <div class="form-group col-md-1 pf">
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
                    <!--<div class="form-group col-md-1 pf" style="width: 5% !important;">
                        <label style="visibility: hidden">Amountflakhfahfah</label>
                        <button type="button" class="btn btn-mini btn-primary" onclick="more_item()"><i class="fa fa-plus"></i> </button>
                    </div>-->';
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
        //
    }
}
