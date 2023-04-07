<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleReturn extends Model
{
    use HasFactory;
    protected $fillable = ['date', 'customer_id', 'WHID', 'sale_person',
        'order_tax','trans_code','inovice_details','attach_document',
        'trans_code','discount','shipping_cost','net_total','created_by','updated_by'];
    public function customers(){
        return $this->belongsTo(Customer::class,'customer_id','id');
    }

    public function salePerson(){
        return $this->belongsTo(SalePerson::class,'sale_person');
    }
    public function location(){
        return $this->belongsTo(WhereHouse::class,'WHID','id');
    }

}
