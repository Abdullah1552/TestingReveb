<?php

namespace App\Models\Product;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    use HasFactory;
    protected $fillable=['id','name', 'item_code', 'additonal_price', 'PID',
        'v_id','attribute','attribute_value'];
        protected $dateFormat = 'm-d-Y';
    public function products()
    {
        return $this->belongsTo(Product::class,'PID','id');
    }
}
