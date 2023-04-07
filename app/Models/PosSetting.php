<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PosSetting extends Model
{
    use HasFactory;
    protected $fillable=['id', 'default_customer', 'default_location',
        'default_saleperson', 'invoice_header', 'invoice_footer', 'thermal_format',
        'a_format', 'inv_img', 'qr_img', 'created_by', 'updated_by','purchase_tax',
        'purchase_taxID','purchase_tax_label','sale_tax','sale_taxID',
        'sale_tax_label','wat','watID','wat_label','invoice_business_header'];

    public function wh(){
        return $this->belongsTo(WhereHouse::class,'default_location','id');
    }
    //customer
    public function customer(){
        return $this->belongsTo(Customer::class,'default_customer','id');
    }
    public function sale_person(){
        return $this->belongsTo(SalePerson::class,'default_saleperson','id');
    }
}
