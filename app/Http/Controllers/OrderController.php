<?php

namespace App\Http\Controllers;

use App\Helpers\helpers;
use App\Models\Product\ProductVariant;
use App\Models\SaleInvoice;
use App\Models\StockDetails;
use App\Models\Customer;
use App\Models\Product;
use Codexshaper\WooCommerce\Models\Order;
use Illuminate\Http\Request;
use App\Models\TransAccount;
use Auth;
use DB;
use App\Models\Transaction;
use Config;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;


class OrderController extends Controller
{
    function __construct()
    {
        if(woo_state() =='0'){
            return Redirect::to('/home')->send();
        }
        $this->middleware('permission:website_order_view', ['only' => ['index']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        return view('website_orders.index');
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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $result = Order::find($id);
        return view('website_orders.show', compact('result'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $order_items = Order::find($id)['line_items'];
        foreach ($order_items as $line) {
            if( StockDetails::check_stock($line->sku,$request->WHID) < ((int)$line->quantity)){
                return redirect('website_order')->with(['danger' => $line->name.'('.$line->sku.")'s Insufficient Stock."]);
            }
        }

        DB::beginTransaction();
        try {

            $order_id = $id;
            $Odata = [
                'status' => $request->order_status,
            ];
            $order = Order::find($id);
            //add customer detail while creating sale invoice from website
            $ex_customer = Customer::where('phone_number', $order['billing']->phone)->value('id');
            $cData['name'] = $order['billing']->first_name . ' ' . $order['billing']->last_name;
            $cData['email'] = $order['billing']->email;
            $cData['phone_number'] = $order['billing']->phone;
            $cData['customer_group_id'] = 1;
            /*check customer if already exist*/
            if ($ex_customer > 0) {
                Customer::where('id', $ex_customer)->update($cData);
                $tData['Trans_Acc_Name'] = $order['billing']->first_name . ' ' . $order['billing']->last_name;;
                $tData['Parent_Type'] = $ex_customer;
                TransAccount::where(['PID' => 5, 'Parent_Type' => $ex_customer])->update($tData);
            } else {
                $ret = Customer::create($cData);
                $tData['Trans_Acc_Name'] = $order['billing']->first_name . ' ' . $order['billing']->last_name;;
                $tData['PID'] = 5;
                $tData['Parent_Type'] = $ret->id;
                TransAccount::create($tData);
                $ex_customer = $ret->id;
            }


            if ($request->order_status == 'completed') {

                $order_lines = $order['line_items'];
                $data['WHID'] = $request->WHID;
                $data["inv_date"] = date('Y-m-d');
                $data['net_total'] = $order['total'];
                $data['shipping_cost'] = $order['shipping_total'];
                $data['discount'] = $order['discount_total'];
                $data['payment_status'] = 3;
                $data['sale_status'] = 2;
                $data['customer_id'] = $ex_customer;
                $data['sale_person'] = $request->sale_person;
                $data['received_amount'] = $order['total'];
                $data['date'] = $request->date;
                //accounts entry
                $tData['trans_acc_id'] = TransAccount::where(['Parent_Type' => $ex_customer, 'PID' => 5])->value('id');
                $tData['amount'] = $order['total'];
                $tData['trans_date'] = date('Y-m-d');
                $tData['dr_cr'] = 1;
                $tData['status'] = 1;
                $tData['vt'] = 4;
                $tData['trans_code'] = helpers::trans_code();
                $tdata['Created_By'] = Auth::user()->id;
                $data['trans_code'] = helpers::trans_code();
                $data['sale_type'] = 'website_order';
                $data['created_by'] = Auth::user()->id;
                $data['si'] = $id;
                $data['wordpress_order_id'] = $id;
                $ret = SaleInvoice::create($data);
                $SID = $ret->id;
                $tData['narration'] = 'Against Sale inovice #' . $SID;
                $tData['SID'] = $SID;
                Transaction::create($tData);
                //cr to sale account
                $tData['trans_acc_id'] = 4;
                $tData['dr_cr'] = 2;
                Transaction::create($tData);
                //dr to cash account
                $tData['amount'] = $order['total'];
                $tData['vt'] = 1;
                $tData['dr_cr'] = 1;
                $tData['trans_acc_id'] = 1;
                $tData['narration'] = 'Received Payment Against Sale inovice #' . $SID;
                Transaction::create($tData);
                //cr to client while payment received
                $tData['dr_cr'] = 2;
                $tData['trans_acc_id'] = TransAccount::where(['Parent_Type' => $ex_customer, 'PID' => 5])->value('id');
                $tData['narration'] = 'Payment Against Sale inovice #' . $SID;
                Transaction::create($tData);
                foreach ($order_lines as $line) {

                    $PID = ProductVariant::where('item_code', $line->sku)->value('PID');
                    if ($PID == null) {
                        $PID = Product::where('product_code', $line->sku)->value('id');

                    }
                    if( StockDetails::check_stock($line->sku,$request->WHID) < ((int)$line->quantity)){
                        report($line->sku."'s Insufficient Stock.");
                        abort(505,$line->sku."'s Insufficient Stock.");

                    }
                    $sData[] = [
                        'product_id' => $PID,
                        'Unit_cost' => $line->subtotal,
                        'Qty' => $line->quantity,
                        'product_code' => $line->sku,
                        'sub_total' => $line->total,
                        'WHID' => $request->WHID,
                        'SID' => $SID,
                        'in_out' => 2,
                    ];
                }
                StockDetails::insert($sData);
            }
            Order::update($order_id, $Odata);

            DB::commit();
            return redirect('website_order')->with(['success' => ' Order updated to '.ucfirst($request->order_status).' Successfully.']);

        } catch (\Exception $e) {
            report($e);
            abort(505,$e->getMessage());
            return dd(0);
            DB::rollBack();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function get_data(Request $request)
    {
        $filters='?consumer_key='.config('woocommerce.consumer_key').'&consumer_secret='.config('woocommerce.consumer_secret');
        $count=$request->per_page;
        if($count>0){
            $filters = $filters.'&per_page='. $count;
        }else if($count=='0'){
            $filters = $filters.'&per_page=100';
        }
        else{
            $filters = $filters.'&per_page=25';
        }
        $filters =$filters. ( isset($request->status) && $request->status ? '&status='.$request->status : '' );

        if(isset($request->order_number)){
            $response = Http::get(config('woocommerce.store_url').'/wp-json/wc/v3/orders/'.$request->order_number.$filters);
            return [$response->json()];
        }else{
            $response = Http::get(config('woocommerce.store_url').'/wp-json/wc/v3/orders'.$filters);
        }
        return $response->json();

    }

    public  static function status(){
        $response ='
            <option value="on-hold"> On-Hold</option>
            <option value="processing"> Processing</option>
            <option value="pending"> Pending</option>
            <option value="completed"> Completed</option>
            <option value="cancelled"> Cancelled</option>
            <option value="0" selected>All</option>';

        return $response;

    }

}
