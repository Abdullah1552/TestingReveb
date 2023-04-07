<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalePerson extends Model
{
    use HasFactory;
    protected $table = 'sale_persons';
    protected $fillable = ['name','commission_per','WHID'];

    public static function dropdown($id=0){
        $list='';
        $result=self::all();
        foreach ($result as $item){
            $list.='<option '.($id==$item->id?'selected':'').' value="'.$item->id.'">'.$item->name.'</option>';
        }
        return $list;
    }
    public function PurchaseReturn(){
        return $this->hasMany(PurchaseReturn::class,'id');
    }
    public function saleInvoice(){
        return $this->hasMany(SaleInvoice::class,'id');
    }
    public function saleReturn(){
        return $this->hasMany(SaleReturn::class,'id');
    }
    public function quatation(){
        return $this->hasMany(Quotation::class);
    }
    public function location(){
        return $this->belongsTo(WhereHouse::class,'WHID','id');
    }


}
