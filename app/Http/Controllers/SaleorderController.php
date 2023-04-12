<?php

namespace App\Http\Controllers;

use App\Jobs\UpdateWordpressQty;
use App\Jobs\WhatsAppMessageJob;
use App\Models\{Transaction,StockDetails,SaleInvoice,Customer,Product,TransAccount};
use Carbon\Carbon;
use Illuminate\Http\Request;
use Codexshaper\WooCommerce\Models\Variation;
use App\Helpers\helpers;
use DB;
use Auth;
use App\Models\Product\ProductVariant;

class SaleorderController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:sale_view', ['only' => ['index']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('sale_order.index');
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
            'sale_person_id' => 'required',
            'WHID' => 'required',
            'customer_id' => 'required',
            'payment_status' => 'required',
            'sale_status' => 'required',
            'received' => 'required',

        ];
        $message=[
            'sale_person_id.required'=>'Sale Person Required',
            'WHID.required'=>'Location Required',
            'customer_id.required'=>'Customer Required',
            'payment_status.required'=>'Payment Status Required',
            'sale_status.required'=>'Sale Status Required',
            'received.required'=>'Received Amount  Required',
        ];
        $this->validate($request, $rules, $message);
        if($request->received < (float)$request->net_total  ){
            return response()->json([
                'status' => 'false',
                'errors'  => ["Paid is Mis match"],
            ], 400);
        }

        if ($image = $request->file('photo')) {
            $destinationPath = 'storage/app/public/sale_images';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $data['photo'] = $profileImage;
        }
        $total_amount_recieved = (float)$request->cash + (float)$request->received +(float)$request->credit_card +(float)$request->qr_code +(float)$request->other_payment ;
        if($total_amount_recieved < (float)$request->net_total  ){
            return response()->json([
                'status' => 'false',
                'errors'  => ["Paid is Mis match"],
            ], 400);
        }

        $data['WHID']=$request->WHID;
        $data['net_total']=$request->net_total;
        $data['shipping_cost']=$request->shipping_cost;
        $data['discount']=$request->discount;
        $data['sale_note']=$request->sale_note;
        $data['staff_note']=$request->staff_note;
        $data['payment_status']=$request->payment_status;
        $data['sale_status']=$request->sale_status;
        $data['reference_number']=$request->reference_number;
        $data['customer_id']=$request->customer_id;
        $data['sale_person']=$request->sale_person_id;
        $data['received_amount']=$request->received;
        $data['inv_date']=$request->date;
        $id=$request->id;
        DB::beginTransaction();
        //accounts entry
        $tData['trans_acc_id']=TransAccount::where(['Parent_Type'=>$request->customer_id,'PID'=>5])->value('id');
        $tData['amount']=$request->net_total;
        $tData['trans_date']=date('Y-m-d');
        $tData['dr_cr']=1;
        $tData['status']=1;
        $tData['vt']=4;
        $count=0;
        if(isset($request['product_id'])) {
            $count = count($request->product_id);
        }
        try {
            if ($id == 0 && $count>0) {
                $tData['trans_code']=helpers::trans_code();
                $tdata['Created_By']=Auth::user()->id;
                $data['trans_code']=helpers::trans_code();
                $data['created_by']=Auth::user()->id;
                $data['sale_type']='sale_invoice';
                $insert = SaleInvoice::create($data);
                $SID=  $insert->id;
                $si=date('ymd').$SID;
                SaleInvoice::where('id',$SID)->update(['si'=>$si]);
                $tData['narration']='Against Sale inovice #'.$SID;
                $tData['SID']=$SID;
                Transaction::create($tData);
                //cr to purchae account
                $tData['trans_acc_id']=3;
                $tData['dr_cr']=1;
                Transaction::create($tData);
                if($request->payment_status==2 || $request->payment_status==3){
                    //dr to cash account
                    $tData['amount']=$request->received;
                    $tData['vt']=1;
                    $tData['dr_cr']=1;
                    $tData['trans_acc_id']=1;
                    $tData['narration']='Received Payment Against Sale inovice #'.$SID;
                    Transaction::create($tData);
                    //cr to client while payment received
                    $tData['dr_cr']=2;
                    $tData['trans_acc_id']=TransAccount::where(['Parent_Type'=>$request->customer_id,'PID'=>5])->value('id');;
                    $tData['narration']='Payment Against Sale inovice #'.$SID;
                    Transaction::create($tData);
                }
                for ($i=0; $i<$count; $i++) {
                    if(!empty($request['product_id'][$i])) {
                        /*This code will check if Stock exist*/
                        if( StockDetails::check_stock($request['product_varient'][$i],$request->WHID) < ((int)$request['qty'][$i])){
                            return response()->json([
                                'status' => 'false',
                                'errors'  => [$request['product_varient'][$i]."'s Insufficient Stock."],
                            ], 400);
                        }
                        $itemdata = ['product_id' => $request['product_id'][$i],
                            'Unit_cost' => $request['Unit_cost'][$i],
                            'Qty' => $request['qty'][$i],
                            'product_code' => $request['product_varient'][$i],
                            'sub_total' => $request['sub_total'][$i],
                            'SID' => $SID,
                            'WHID'=>$request->WHID,
                            'in_out'=>2,
                        ];
                        StockDetails::create($itemdata);

                        //wordpress product update qty total quantity
                        if(woo_state()) {
                            $wp_qty = helpers::product_updated_stock($request['product_id'][$i]);
                            $is_var = Product::find($request['product_id'][$i]);
                            if ($is_var->is_variant == 1) {
                                $pq = helpers::updated_stock($request['product_varient'][$i]);
                                $variation_data = [
                                    'stock_quantity' => $pq - $request['qty'][$i],
                                ];
                                $variation_id = ProductVariant::where('item_code', $request['product_varient'][$i])->value('v_id');
                            } else {
                                $variation_data = '';
                                $variation_id = 0;
                            }
                            if(woo_state()) {
                                $wp_id = Product::find($request['product_id'][$i])->w_id;
                                UpdateWordpressQty::dispatch($wp_id, $variation_id, $variation_data, $wp_qty)
                                    ->delay(now()->addSeconds(60));
                            }
                        }
                        WhatsAppMessageJob::dispatch($request->customer_id)->delay(now()->addSeconds(30));
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
        $count=$request->per_page;
        if($count>0){
            $per_page=$count;

        }else if($count=='0'){
            $per_page=SaleInvoice::all()->count();

        }else{
            $per_page=25;
        }

        $result = SaleInvoice::with(['customers','salePerson','sale_created_by' => function ($query) {
                $query->select('id', 'name');
            }])
            ->leftjoin('sale_persons','sale_persons.id','sale_invoices.sale_person')
            ->leftjoin('where_houses','sale_invoices.WHID','where_houses.id')
            ->when($request->df, function ($query) use ($request){
                $query->whereBetween(DB::raw('DATE(sale_invoices.created_at)'),[$request->df, $request->dt]);
            })
            ->when($request->wherehouse_id, function($query)use ($request){
                $query->where('where_houses.id', $request->wherehouse_id)->whereIn('where_houses.id',Auth::user()->warehouses);
            })
            ->when(Auth::user()->type == "end_user",function ($query) {
                $query->where('sale_invoices.created_by',Auth::user()->id);
            })
            ->when($request->created_by,function ($query) use ($request) {
                $query->where('sale_invoices.created_by',$request->created_by);
            })
            ->when($request->invoice_no,function ($query) use ($request) {
                $query->where('sale_invoices.si',$request->invoice_no);
            })
            ->when($request->saleperson_id, function($query)use ($request){
                $query->where('sale_invoices.sale_person', $request->saleperson_id);
            })->when($request->payment_status, function($query)use ($request){
                $query->where('sale_invoices.payment_status', $request->payment_status);
            })->when($request->sale_type !='all', function($query)use ($request){
                $query->where('sale_invoices.sale_type', $request->sale_type);
            })->when($request->customer_id, function($query)use ($request){
                $query->where('sale_invoices.customer_id', $request->customer_id);
            })->orderBy('sale_invoices.id', 'DESC')->select('*','sale_invoices.id AS SID',DB::raw('sale_invoices.id as id'))->paginate($per_page);
        return response()->json($result);
    }
    public function recent_sale_invoice(Request $request){

        $result=SaleInvoice::with(['customers','salePerson','location'=> function ($query) {
            $query->select( 'WH_Name');
        },'sale_created_by'])
            ->leftjoin('sale_persons','sale_persons.id','sale_invoices.sale_person')
            ->leftjoin('where_houses','sale_invoices.WHID','where_houses.id')
            ->orderBy('sale_invoices.id', 'DESC')
            ->select('*','sale_invoices.id AS SID',DB::raw('sale_invoices.id as id'))
            ->when(Auth::user()->type == "end_user",function ($query) {
                    $query->where('sale_invoices.created_by',Auth::user()->id);
                })
            ->whereDate('sale_invoices.created_at', Carbon::today())
            ->paginate();
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
    // public function destroy($id)
    // {
    //     $stockDetails=StockDetails::where('SID', $id)->get();
    //     foreach ($stockDetails as $item)
    //     {

    //         $is_var=Product::find($item->product_id);
    //         if ($is_var !== null && $is_var->is_variant == 1) {
    //             $pq=helpers::updated_stock($item->product_code);
    //             $variation_data = [
    //                 'stock_quantity' => $pq+$item->Qty,
    //             ];
    //             $variation_id=ProductVariant::where('item_code', $item->product_code)->value('v_id');
    //         }else{
    //             $variation_data=[];
    //             $variation_id=0;
    //         }
    //         StockDetails::where('product_code',$item->product_code)->where('SID',$id)->delete();
    //         if(woo_state()) {
    //             $wp_qty = helpers::product_updated_stock($item->product_id);
    //             $wp_id = Product::find($item->product_id)->w_id;
    //             UpdateWordpressQty::dispatch($wp_id, $variation_id, $variation_data, $wp_qty)
    //                 ->delay(now()->addSeconds(60));
    //         }
    //     }
    //     SaleInvoice::destroy($id);
    // }
    public function destroy($id)
{
    $stockDetails=StockDetails::where('SID', $id)->get();
    foreach ($stockDetails as $item)
    {
        $is_var=Product::find($item->product_id);
        if ($is_var !== null && $is_var == 1) {
            $pq=helpers::updated_stock($item->product_code);
            $variation_data = [
                'stock_quantity' => $pq+$item->Qty,
            ];
            $variation_id=ProductVariant::where('item_code', $item->product_code)->value('v_id');
        }else{
            $variation_data=[];
            $variation_id=0;
        }
        StockDetails::where('product_code',$item->product_code)->where('SID',$id)->delete();
        if(woo_state()) {
            $wp_qty = helpers::product_updated_stock($item->product_id);
            $product = Product::find($item->product_id);
            if ($product !== null) {
                $wp_id = $product->w_id;
                UpdateWordpressQty::dispatch($wp_id, $variation_id, $variation_data, $wp_qty)
                    ->delay(now()->addSeconds(60));
            }
        }
    }
    SaleInvoice::destroy($id);
}


    public function saleByCsv()
    {
        return view('sale_order.salebycsv');
    }

    //print sale invoice
    public function print_sale($id){
        $so=SaleInvoice::with('sale_created_by')->where('id',$id)->first();
        $customer=Customer::find($so->customer_id);
        $result=DB::table('stock_details')
            ->join('products','stock_details.product_id','products.id')
            ->select('*','stock_details.product_code')
            ->where('stock_details.SID',$id)->get();
        return view('sale_order.print_sale',compact('so','result','customer'));
    }
}
