<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleInvoice extends Model
{
    use HasFactory;
    protected $table = 'sale_invoices';
    protected $fillable = ['inv_date', 'sale_person', 'customer_id', 'WHID', 'order_tax',
        'shipping_cost', 'discount', 'net_total', 'payment_status', 'paid_by',
        'received_amount', 'balance', 'attach_document', 'sale_status', 'sale_note',
        'staff_note', 'reference_number', 'trans_code', 'cash', 'credit_card', 'qr_code',
        'change_cash', 'write_off', 'created_by', 'updated_by','pos','sale_type','promotional_discount','additional_discount','wordpress_order_id','si'];

    public function customers(){
        return $this->belongsTo(Customer::class,'customer_id');
    }

    public function salePerson(){
        return $this->belongsTo(SalePerson::class,'sale_person');
    }
    public function location(){
        return $this->belongsTo(WhereHouse::class,'WHID');
    }

    public function sale_created_by(){
        return $this->belongsTo(User::class,'created_by','id');
    }
    public static function sale_type_dropdown(){
        $list='';
        $list.='<option value="all" >All</option>';
        $list.='<option value="pos">POS sale</option>';
        $list.='<option value="website_order">Website Order</option>';
        $list.='<option value="sale_invoice">Sale Invoice</option>';
        return $list;
    }

}

