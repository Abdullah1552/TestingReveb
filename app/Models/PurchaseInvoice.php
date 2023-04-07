<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseInvoice extends Model
{
    use HasFactory;
    protected $fillable=['purchase_date', 'SUPID', 'GID', 'WHID', 'purchase_status',
        'attached_document', 'order_tax', 'shipping_cost', 'discount', 'net_total',
        'inovice_details','trans_code','reference','created_by','updated_by'];

    public function supplier(){
        return $this->belongsTo(Supplier::class,'SUPID','id');
    }

    public function location(){
        return $this->belongsTo(WhereHouse::class,'WHID','id');
    }
}
