<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transfer;
use Illuminate\Http\Request;
use DB;
use Auth;
use App\Models\StockDetails;
use Carbon\Carbon;
class TransferController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:transfer_list_view', ['only' => ['index']]);
        $this->middleware('permission:transfer_list_create', ['only' => ['store','create']]);
        $this->middleware('permission:transfer_list_edit', ['only' => ['edit']]);
        $this->middleware('permission:transfer_list_delete', ['only' => ['delete']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      return view('transfer.index');
    }

    public function transferByCsv()
    {
        return view('transfer.transferbycsv');
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
            'WHIDF' => 'required',
            'WHIDT' => 'required|different:WHIDF',
            'date' => 'required|date',
            'status' => 'required',
        ];
        $message=[
            'WHIDF.required'=>'From Location Required',
            'WHIDT.required'=>'To Location Required',
            'WHIDT.different'=>'From and To Location should be different',
            'status.required'=>'Status Required',
        ];
        $this->validate($request, $rules, $message);
        if ($image = $request->file('attached_document')) {
            $destinationPath = 'storage/app/public/transfer_image';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $data['photo'] = $profileImage;
        }
        $data['WHIDF']=$request->WHIDF;
        $data['WHIDT']=$request->WHIDT;
        $data['status']=$request->status;
        $data['date']= Carbon::createFromFormat('m/d/Y', $request->input('date'))->format('Y-m-d');
        $date = '05/23/2022'; // this is the input date in mm/dd/yyyy format
$formatted_date = date('Y-m-d', strtotime($date));
$data->date = $formatted_date;
        // $date = Carbon::createFromFormat('m/d/Y', $request->input('date'))->format('Y-m-d');
        $data['shipping_cost']=$request->shipping_cost;
        $data['notes']=$request->inovice_details;
        $data['net_total']=$request->net_total;
        $id=$request->id;
        DB::beginTransaction();
        $count=0;
        if(isset($request['product_id'])) {
            $count = count($request->product_id);
        }
        try {
            if ($id == 0 && $count>0) {
                $data['created_by']=Auth::user()->id;

                $insert = Transfer::create($data);
                $TRFID=  $insert->id;
                for ($i=0; $i<$count; $i++) {
                    if(!empty($request['product_id'][$i])) {
                        /*This code will check if Stock exist*/
                        if( StockDetails::check_stock($request['product_varient'][$i],$request->WHIDF) < ((int)$request['qty'][$i])){
                            return response()->json([
                                'status' => 'false',
                                'errors'  => [$request['product_varient'][$i]."'s Insufficient Stock."],
                            ], 400);
                        }
                        $itemdata = ['product_id' => $request['product_id'][$i],
//                            'Unit_cost' => $request['Unit_cost'][$i],
                            'Qty' => $request['qty'][$i],
                            'product_code' => $request['product_varient'][$i],
//                            'sub_total' => $request['sub_total'][$i],
                            'TRFID' => $TRFID,
                            'WHID'=>$request->WHIDF,
                            'in_out'=>2,
                        ];
                        StockDetails::create($itemdata);
                        $itemdataT=[
                            'WHID'=>$request->WHIDT,
                            'in_out'=>1,
                        ];
                        $itemdata=array_merge($itemdata,$itemdataT);
                        StockDetails::create($itemdata);
                    }
                }
            } else {
                StockDetails::where('TRFID',$id)->delete();
                $data['updated_by']=Auth::user()->id;
                Transfer::where('id',$id)->update($data);
                for ($i=0; $i<$count; $i++) {
                    if(!empty($request['product_id'][$i])) {
                        $itemdata = ['product_id' => $request['product_id'][$i],
//                            'Unit_cost' => $request['Unit_cost'][$i],
                            'Qty' => $request['qty'][$i],
                            'product_code' => $request['product_varient'][$i],
//                            'sub_total' => $request['sub_total'][$i],
                            'TRFID' => $id,
                            'WHID'=>$request->WHIDF,
                            'in_out'=>2,
                        ];
                        StockDetails::create($itemdata);
                        $itemdataT=[
                            'WHID'=>$request->WHIDT,
                            'in_out'=>1,
                        ];
                        $itemdata=array_merge($itemdata,$itemdataT);
                        StockDetails::create($itemdata);
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
            $per_page=Transfer::all()->count();

        }else{
            $per_page=25;
        }
        $result=Transfer::with(['location_from','location_to'])
            ->when($request->df, function ($query) use ($request){
                $query->whereBetween(DB::raw('DATE(created_at)'), [$request->df,$request->dt]);
                return $query->whereBetween(DB::raw('DATE(created_at)'), [$request->df,$request->dt]);
            })
            ->when($request->WHIDF, function ($query) use ($request){
                return $query->where('WHIDF',$request->WHIDF);
            })->when($request->date, function ($query) use ($request){
                return $query->where('DATE',$request->date);
            }) ->when($request->WHIDT, function ($query) use ($request){
                return $query->where('WHIDT',$request->WHIDT);
            })
            ->join('stock_details','stock_details.TRFID','=','transfers.id')
            ->where('stock_details.in_out',1)->groupBY('TRFID')
            ->select('transfers.*',DB::raw('sum(stock_details.QTY) as total_QTY'))
            ->orderBy('transfers.id','DESC')
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
        $result=Transfer::find($id);
        $product_result=StockDetails::where('TRFID',$result->id)->groupBy('product_code')->get();
        $product_line='';
        foreach ($product_result as $item){
            $product_line.='<tr class="rows">
                <td colspan="1"><input type="hidden" name="product_id[]" value="'.$item->product_id.'">'.Product::find($item->product_id)->name.'</td>
                <td class="product-code"> <input type="hidden" name="product_varient[]" value="'.$item->product_code.'">'.$item->product_code.'</td>
                <td class="input-qty"><input type="number" min="1" class="quantity" name="qty[]" value="'.$item->Qty.'"></td>'.
/*                '<td class="product-cost"><input type="hidden" name="Unit_cost[]" value="'.$item->Unit_cost.'">'.$item->Unit_cost.'</td>
                <td id="">0.00</td>
                <td class="tax-amount">10.00</td>
                <td class="sub-total"><input type="hidden" name="sub_total[]" value="'.$item->sub_total.'"><span>'.$item->sub_total.'</span></td>'.*/
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
        StockDetails::where('TRFID',$id)->delete();
        Transfer::destroy($id);
    }

    public function delete_multiple(Request $request)
    {
        foreach ($request->records as $record){
            $this->destroy($record);
        }
    }


    //@print transfer invoice
    public function print_data($id){
        $transfer=Transfer::with(['location_from','location_to'])->where('id',$id)->first();
        $result=DB::table('stock_details')
            ->join('products','stock_details.product_id','products.id')
            ->where('stock_details.TRFID',$id)->groupBy('stock_details.product_code')
            ->select('*','stock_details.product_code')
            ->get();
        return view('transfer.print',compact('transfer','result'));
    }

}
