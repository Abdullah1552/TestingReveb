<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseReturn extends Model
{
    use HasFactory;
    protected $fillable = ['WHID', 'SUPID', 'account', 'attachment', 'inovice_details', 'net_total',
        'date','discount','trans_code','created_by','updated_by'];
    public function customers(){
        return $this->belongsTo(Customer::class,'customer_id');
    }

    public function supplier(){
        return $this->belongsTo(Supplier::class,'SUPID','id');
    }
    public function location(){
        return $this->belongsTo(WhereHouse::class,'WHID','id');
    }
}
