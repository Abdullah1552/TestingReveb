<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quotation extends Model
{
    use HasFactory;
    protected $fillable = ['date', 'WHID', 'SUPID', 'customer_id', 'saleperson_id', 'status', 'attach_document', 'note', 'net_total', 'shipping_cost', 'order_tax', 'discount'];

    public function salePerson()
    {
        return $this->belongsTo(SalePerson::class, 'saleperson_id', 'id');
    }
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }
    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'SUPID', 'id');
    }
}

