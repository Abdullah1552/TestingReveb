<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class StockDetails extends Model
{
    use HasFactory;
    protected $fillable=['product_id', 'batch_no', 'Unit', 'Qty', 'Unit_cost',
        'discount', 'tax', 'sub_total', 'PID', 'SID', 'SID','product_code',
        'in_out','WHID','OID','SRID','PRID','TRFID','ADJID','reference'];


    public static function check_stock($id,$WHID=null){
        $stocks=DB::table('stock_details AS SD')
            ->select('SD.product_code as item_code',
                DB::raw("(SELECT IFNULL(sum(Qty),0) from stock_details AS T where T.in_out=1 and T.WHID=SD.WHID and T.product_code=SD.product_code) AS pq"),
                DB::raw("(SELECT IFNULL(sum(Qty),0) from stock_details AS T where T.in_out=2 and T.WHID=SD.WHID and T.product_code=SD.product_code) AS sq")
            )->where('SD.product_code',$id)
            ->when(isset($WHID) && $WHID!= null,function ($query) use ($WHID){
                $query->where('SD.WHID',$WHID);
            })->groupBy('SD.WHID')
            ->get();
        $stockCount = 0;
        if(isset($stocks)){
            foreach ($stocks as $stock){
                $stockCount += ((int)$stock->pq) - ((int)$stock->sq);
            }
        }
        return $stockCount;
    }
}
