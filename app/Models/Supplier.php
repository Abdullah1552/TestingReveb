<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;
    protected $fillable=['name', 'image', 'company_name', 'email', 'phone_number',
        'vat_number', 'address', 'city','state', 'postal_code', 'country','trans_id','WHID'];

    public static function dropdown(){
        $list='';
        $result=self::all();
        foreach ($result as $item) {
            $list.='<option value="'.$item->id.'">'.$item->name.'</option>';
        }
        return $list;
    }
    public function quotation()
    {
        return $this->hasMany(Quotation::class,'id');
    }
}
