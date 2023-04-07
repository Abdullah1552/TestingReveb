<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $fillable=['customer_group_id', 'name', 'company_name', 'email', 'phone_number',
        'tax_number', 'address', 'city_id', 'country_id', 'state', 'postal_code'];
    public function customer_items(){
        return $this->hasMany(CustomerItem::class,'CID', 'id');
    }
    public function customerGroup(){
        return $this->belongsTo(CustomerGroup::class, 'customer_group_id', 'id');
    }
    public function SaleInvoice(){
        return $this->hasMany(SaleInvoice::class,'id');
    }
    public function PurchaseReturn(){
        return $this->hasMany(PurchaseReturn::class,'id');
    }
    public function SaleReturn(){
        return $this->hasMany(SaleReturn::class,'id');
    }
    public function quatation(){
        return $this->hasMany(Quotation::class);
    }
   public static function dropdown($id=0){
        $list='';
        $result=self::all();
        foreach ($result as $item){
            $list.='<option '.($item->id==$id?'selected':'').' value="'.$item->id.'">'.$item->name.' ('.$item->phone_number.')</option>';
        }
        return $list;
    }
    public static function dropdown_mobile($id=0){
        $list='';
        $result=self::all();
        foreach ($result as $item){
            $list.='<option '.($item->id==$id?'selected':'').' value="'.$item->id.'">'.$item->name.'('.$item->phone_number.')</option>';
        }
        return $list;
    }

//    public static function boot()
//    {
//        // Update field update_by with current user id each time article is updated.
//        static::updating(function ($article) {
//            $article->updated_by = Auth::user()->id;
//        });
//    }

}
