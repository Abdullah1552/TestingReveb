<?php
namespace App\Helpers;

use App\Models\BusinessSetting;
use App\Models\StockDetails;
use App\Models\TransAccount;
use App\Models\Transaction;
use App\Models\WhereHouse;
use Illuminate\Support\Facades\DB;
use Auth;

class helpers{
    //payment type
    public static function payment_type(){
        $list='';
        $lisArray=[1=>'Credit',2=>'Cash', 3=>'Cheque',3=>'Online', 4=>'other'];
        foreach ($lisArray as $key=>$value){
            $list.='<option value="'.$key.'">'.$value.'</option>';
        }
        return $list;
    }
    public static function dr_cr(){
        $list='';
        $array=array(1=>'Dr', 2=>'Cr');
        foreach ($array as $key=>$value){
            $list.='<option value="'.$key.'">'.$value.'</option>';
        }
        return $list;
    }
    public static function raw_material_nature(){
        $list='';
        $array=array(1=>'Powder', 2=>'Solid', 3=>'Gas');
        foreach ($array as $key=>$value){
            $list.='<option value="'.$key.'">'.$value.'</option>';
        }
        return $list;
    }
    public static function Vehicle_type(){
        $list='';
        $array=array(1=>'Truck', 2=>'Van', 3=>'Mazda');
        foreach ($array as $key=>$value){
            $list.='<option value="'.$key.'">'.$value.'</option>';
        }
        return $list;
    }
    public static function vendor_type(){
        $list='';
        $array=array(1=>'Broker', 2=>'Miller');
        foreach ($array as $key=>$value){
            $list.='<option value="'.$key.'">'.$value.'</option>';
        }
        return $list;
    }
    public static function trans_code(){
        $tc=Transaction::max('trans_code');
        if($tc>0){
            return ($tc)+(1);
        }else {
            return 1;
        }
    }
    //count realtime stock || count stock on base of product code
    public static function updated_stock($code){
        $purchase=StockDetails::where('in_out',1)->where('product_code',$code)->sum('Qty');
        $sale=StockDetails::where('in_out',2)->where('product_code',$code)->sum('Qty');
        $total=$purchase-$sale;
        return $total;
    }

    //updated stock product wise || count stock on base of product id
    public static function product_updated_stock($id){
        $total = 0 ;
        $product = DB::table('products')
         ->where('products.id',$id)
         ->first();

        if(isset($product->is_variant) && $product->is_variant == "1"){
            $purchase = DB::table('stock_details')
                ->where('in_out',1)
                ->where('product_id',$id)
                ->sum('Qty');
            $sale = DB::table('stock_details')
                ->where('in_out',2)
                ->where('product_id',$id)
                ->sum('Qty');
            $total = $purchase-$sale;

        }else{
            $purchase =StockDetails::where('in_out',1)->where('product_id',$id)->sum('Qty');
            $sale = StockDetails::where('in_out',2)->where('product_id',$id)->sum('Qty');
            $total = $purchase-$sale;

        }
        return $total;
    }

    //updated stock warehoue wise
    public static function wh_updated_stock($code, $WHID=0){
        $purchase=StockDetails::where('in_out',1)->where('product_code',$code)->where('WHID',$WHID)->sum('Qty');
        $sale=StockDetails::where('in_out',2)->where('product_code',$code)->where('WHID',$WHID)->sum('Qty');
        $total=$purchase-$sale;
        return $total;
    }
    //@opening balance as on date as well while createing account
    public static function ob($date, $tid){
        $df=date('Y-m-d', strtotime('0 day', strtotime('2015-08-10')));
        $dt=date('Y-m-d', strtotime('-1 day', strtotime($date)));
        $ob_res=TransAccount::find($tid);
        if($ob_res->OB_Type=='1'){
            $opening_balance=$ob_res->ob;
        }else{
            $opening_balance=-$ob_res->ob;
        }
        $dr=Transaction::where(['trans_acc_id'=>$tid, 'dr_cr'=>1])->where(function($query) use ($df, $dt){
            $query->WhereBetween('trans_date', [$df, $dt]);
        })->sum('amount');
        $cr=Transaction::where(['trans_acc_id'=>$tid, 'dr_cr'=>2])->where(function ($query) use ($df, $dt){
            $query->WhereBetween('trans_date', [$df, $dt]);
        })->sum('amount');
        $ob=$opening_balance+($dr-$cr);
        if($ob>0){
            return $ob;
        }else{
            return $ob;
        }
    }
    //@dr or cr
    public static function show_bal($bal){
        if ($bal>0) {
            return number_format(abs($bal), 2)." Dr";
        }
        elseif($bal<0) {
            return '('.number_format(abs($bal), 2).") Cr";
        }
        elseif($bal==0) {
            return "Nil";
        }
    }
    public static function show_bal_format($bal){
        if ($bal>0) {
            return number_format(abs($bal), 2);
        }
        elseif($bal<0) {
            return '('.number_format(abs($bal), 2).")";
        }
        elseif($bal==0) {
            return "Nil";
        }
    }
    //@voucher type rv=receipt voucehr pv=payment voucher jv=journal voucher
    public static function vt($type){
        if($type==1){
            return 'RV';
        }elseif ($type==2){
            return 'PV';
        }elseif($type==3){
            return 'JV';
        }elseif($type==4){
            return 'SV';
        }
    }
    //@serial number with 00 dsn=double serial numebr
    public static function dsn($no){
        if($no<10){
            return '00'.$no;
        }else{
            return $no;
        }
    }
    //payment type
    public static function payment_by(){
        $list='';
        $array=['1'=>'Cash',2=>'Credit Card',3=>'Qr Code Payment',4=>'Other'];
        foreach ($array as $key=>$val){
            $list.='<option value="'.$key.'">'.$val.'</option>';
        }
        return $list;
    }
    //payment status
    public static function payment_status(){
        $list='';
        $array=['1'=>'Pending',2=>'Partial',3=>'Paid'];
        foreach ($array as $key=>$val){
            $list.='<option value="'.$key.'">'.$val.'</option>';
        }
        return $list;
    }
    //a4 pirnt size header
    public static function a_four_header($WHID=null)
    {
        $setting = BusinessSetting::first();
        if($WHID){
            $where_house=WhereHouse::find($WHID);
        }else{
            $where_house=WhereHouse::find(Auth::user()->WHID);

        }
        $html = '';
        $html .= '
              <table width="100%" style="font-family: sans-serif; display: none" class="report-show">
                    <tr>
                        <td width="66.33%"><img src="'.url('storage/app/public/sale_images').'/'.$setting->business_logo.'" width="150" />
                            <p style="margin-bottom: 2px;font-size: 12px;margin-top: 2px;"><strong>Address:</strong> '.$where_house->WH_Address.'</p>
                            <p style="margin-bottom: 2px;font-size: 12px;margin-top: 2px;"><strong>Phone:</strong> '.$where_house->WH_Mobile.'</p>
                            <p style="margin-bottom: 2px;font-size: 12px;margin-top: 2px;"><strong>Email:</strong> '.$where_house->WH_Email.'</p></td>
                        </td>
                    </tr>
                </table>';
        return $html;
    }
    /*
     * show per page listing e.g 25,50,all
     */
    public static function per_page(){
        $list='';
        $list.='<option value="15"  selected>15</option>';
        $list.='<option value="50">50</option>';
        $list.='<option value="100">100</option>';
        $list.='<option value="0">All</option>';
        return $list;
    }
    public static function select_Timezone($selected = '') {
        $OptionsArray = timezone_identifiers_list();
        $select= '';
        foreach($OptionsArray as  $row) {
            $select .='<option value="'.$row.'"'.($row == $selected ? ' selected ' : '').'>'.$row.'</option>';
        }
        return $select;
    }

}
