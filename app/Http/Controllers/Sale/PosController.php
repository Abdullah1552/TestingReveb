<?php

namespace App\Http\Controllers\Sale;

use App\Http\Controllers\Controller;
use App\Jobs\UpdateWordpressQty;
use App\Jobs\WhatsAppMessageJob;
use App\Models\Customer;
use App\Models\PosSetting;
use App\Models\WhereHouse;
use Illuminate\Http\Request;
use DB;
use Auth;
use App\Models\TransAccount;
use App\Models\Transaction;
use App\Helpers\helpers;
use App\Models\SaleInvoice;
use App\Models\StockDetails;
use App\Models\Product\ProductVariant;
use App\Models\Product;
use Carbon\Carbon;
use function PHPUnit\Framework\isNull;

class PosController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:pos_view', ['only' => ['index']]);
        $this->middleware('permission:pos_create', ['only' => ['store']]);
        $this->middleware('permission:pos_edit', ['only' => ['edit']]);
        $this->middleware('permission:pos_delete', ['only' => ['delete']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $output=[];
        $output['pos']=PosSetting::where('default_location', Auth::user()->WHID)->first();
        return view('pos.index',$output);
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
            'sale_person' => 'required',
            'WHID' => 'required',
            'product_id' => 'required',
        ];
        $message=[
            'sale_person.required'=>'Sale Person Required',
            'WHID.required'=>'Location Required',
            'product_id.required'=>'Product(s) are Required',
        ];
        $this->validate($request, $rules, $message);
        $total_amount_recieved = (float)$request->cash +(float)$request->credit_card +(float)$request->qr_code +(float)$request->other_payment ;
         if($total_amount_recieved < (float)$request->net_total  ){
             return response()->json([
                 'status' => 'false',
                 'errors'  => ["Paid is Mis match"],
             ], 400);
         }
        $data['additional_discount']=$request->additional_discount;
        $data['promotional_discount']=$request->promotional_discount;
        $data['WHID']=$request->WHID;
        $data['sale_person']=$request->sale_person;
        $data['purchase_status']=$request->purchase_status;
        if ($image = $request->file('photo')) {
            $destinationPath = 'storage/app/public/sale_images';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $data['photo'] = $profileImage;
        }
        $data['inv_date']=date('Y-m-d');
        $data['order_tax']=$request->order_tax;
        $data['shipping_cost']=$request->shipping_cost;
        $data['discount']=$request->total_discount;
        $data['net_total']=$request->net_total;
        $data['balance']=$request->balance;
        $data['payment_status']=3;
        $data['sale_status']=2;
        $data['customer_id']=$request->customer_id;
        $data['date']=date('d-m-y h:i:s');
        $data['change_cash']=$request->change_cash;
        $data['write_off']=$request->write_off;
        $data['cash']=$request->cash;
        $data['credit_card']=$request->credit_card;
        $data['qr_code']=$request->qr_code;
        $data['received_amount']=($request->cash)+($request->credit_card)+($request->qr_code)+($request->other_payment);
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
        $unit = $request->Unit_cost;
        $quantity = $request->qty;
        $sub_total = $request->sub_total;
        try {
            if ($id == 0 && $count>0) {
                $tData['trans_code']=helpers::trans_code();
                $tdata['Created_By']=Auth::user()->id;
                $data['trans_code']=helpers::trans_code();
                $data['created_by']=Auth::user()->id;
                $data['sale_type']='pos';
                $insert = SaleInvoice::create($data);
                $SID=  $insert->id;
                $si=date('ymd').$SID;
                SaleInvoice::where('id',$SID)->update(['si'=>$si]);
                $tData['narration']='Against Sale inovice #'.$SID;
                Transaction::create($tData);
                //cr to sale account
                $tData['trans_acc_id']=3;
                $tData['dr_cr']=2;
                Transaction::create($tData);
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
                            'discount'=>($request['discount'][$i]!='undefined'?$request['discount'][$i]*$request['qty'][$i]:'0'),
                            'WHID'=>$request->WHID,
                            'in_out'=>2
                        ];
                        StockDetails::create($itemdata);
                        $is_var=Product::find($request['product_id'][$i]);
                        //worpdress product update qty total quantity
                        if($is_var->is_variant==1) {
                            $pq=helpers::updated_stock($request['product_varient'][$i]);
                            $variation_data = [
                                'stock_quantity' => $pq-$request['qty'][$i],
                            ];
                            $variation_id=ProductVariant::where('item_code', $request['product_varient'][$i])->value('v_id');
                        }else{
                            $variation_data=[];
                            $variation_id=0;
                        }
                        $wTQty=helpers::product_updated_stock($request['product_id'][$i]);
                        $wPID=Product::find($request['product_id'][$i])->w_id;
                        UpdateWordpressQty::dispatch($wPID, $variation_id, $variation_data, $wTQty)
                            ->delay(now()->addSeconds(30));
                        WhatsAppMessageJob::dispatch($request->customer_id)->delay(now()->addSeconds(30));
                    }
                }
            }
            DB::commit();
            return $SID;
        }catch (\Illuminate\Database\QueryException $e){
            $errorCode = $e->errorInfo[1];
            return response()->json([
                'status' => 'false',
                'errors'  => $e->getMessage(),
            ], 400);
            DB::rollBack();
        }
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
        //
    }
    //generate invoice
    public function gen_invoice($id=0){
        $pos=PosSetting::where('default_location', Auth::user()->WHID)->first();
        if($id!=0) {
            $sinv = SaleInvoice::with('sale_created_by')->find($id);
        }else{
            $sinv = SaleInvoice::with('sale_created_by')->whereDate('created_at', Carbon::today())->OrderBy('id','DESC')->first();
            if (isNull($sinv ))
                return  view('pos.print_invoice');

        }
        $customer=Customer::find($sinv->customer_id);
        // $result=DB::table('stock_details')->join('products','stock_details.product_id','products.id')
        //     ->where('stock_details.SID',$sinv->id)->select('*',DB::raw('sum(stock_details.QTY) as total_QTY'))->get();
        $location=WhereHouse::where('id',$sinv->WHID)->first();
        $result=DB::table('stock_details')
            ->join('products','stock_details.product_id','products.id')
            ->select('*','stock_details.product_code')
            // ->select('*',DB::raw('sum(stock_details.QTY) as total_QTY'))->get()
            ->where('stock_details.SID',$id)->get();
        return view('pos.print_invoice',compact('sinv','result','location','pos','customer'));


    }
    //fetch product by category and brand wise
    public function fetch_product(Request $request){
        $result=DB::table('products')->leftJoin('product_variants','products.id', 'product_variants.PID')
            ->select('products.name','products.product_code',
                'products.is_variant','product_variants.item_code',
                'product_variants.name AS vn','products.product_images')
            ->when($request->cat, function($query) use ($request){
                  $query->where('products.product_category',$request->cat);
            })
            ->when($request->brand_id, function($query) use ($request){
                  $query->where('products.brand_id',$request->brand_id);
            })
            ->paginate(20);
        return $result;
    }
    /*
     * @store cash sale regiser
     */

}
