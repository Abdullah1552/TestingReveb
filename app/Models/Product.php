<?php

namespace App\Models;

use App\Models\Product\Brand;
use App\Models\Product\Category;
use App\Models\Product\ProductVariant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
use App\Models\WhereHouse;

class Product extends Model
{
    use HasFactory;
    protected $fillable=[ 'name', 'brand_id', 'product_code', 'product_category',
        'weight', 'unit', 'product_cost', 'product_price', 'Inventory',
        'alert_qty', 'tax_method', 'featured', 'product_images', 'detail',
        'promotional_price', 'promotional_start', 'promotional_end','is_diffPrice',
        'is_variant','is_promo','w_id','v_id','profit_per','profit_val'];

    public function brand(){
        return $this->belongsTo(Brand::class,'brand_id','id');
    }
    public function category(){
        return $this->belongsTo(Category::class,'product_category','id');
    }
    public function stock_det(){
        return $this->hasMany(StockDetails::class,'product_id','id');
    }
    //product datalist dropdown
    public static function dropdown(){
        $list='';
        $resutl=DB::table('products')
            ->leftJoin('product_variants','products.id', 'product_variants.PID')
            ->select('products.name','products.product_code',
                'products.is_variant','product_variants.item_code', 'product_variants.name AS vn')
            ->get();
        foreach ($resutl as $item){
            if($item->is_variant==1) {
                $list .= '<option pc="'.$item->item_code.'" value="'.$item->name.' ('.$item->item_code.')">';
            }else{
                $list .= '<option pc="'.$item->product_code.'" value="'.$item->name.'('.$item->product_code.')">';
            }
        }
        return $list;
    }
    public static function dropdown2(){
        $list='';
        $resutl=DB::table('products')
            ->leftJoin('product_variants','products.id', 'product_variants.PID')
            ->select('products.name','products.product_code',
                'products.is_variant','product_variants.item_code', 'product_variants.name AS vn')
            ->get();
        foreach ($resutl as $item){
            if($item->is_variant==1) {
                $list .= '<option value="'.$item->item_code.'"> '.$item->name.'('.$item->item_code.') </option>';
            }else{
                $list .= '<option value="'.$item->product_code.'"> '.$item->name.'('.$item->product_code.') </option>';
            }
        }
        return $list;
    }
    public function variants()
    {
        return $this->hasMany(ProductVariant::class,'PID','id');
    }
    public function WH()
    {
        return $this->belongsTo(WhereHouse::class,'WHID','id');
    }
}
