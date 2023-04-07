<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
    use HasFactory;

    protected $fillable = ['date', 'SUPID', 'lab', 'EMPID', 'Payment_Term', 'Delivery_Via',
        'Delivery_days', 'Delivery_date', 'Payment_on', 'After_delivery', 'Buyer_name', 'net_total',
        'Delivery_address', 'Contact_Person', 'Created_By', 'Updated_By', 'BID', 'status'];

    public function supplier(){
        return $this->belongsTo('App\Models\Supplier','SUPID','id');
    }
    public function branch(){
        return $this->belongsTo('App\Models\Branches','BID','id');
    }
    public function wherehouse(){
        return $this->belongsTo('App\Models\WhereHouse','WHID','id');
    }
    public function employee(){
        return $this->belongsTo('App\Models\Employee','EMPID','id');
    }
    
}
