<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item_Detail extends Model
{
    use HasFactory;

    protected $fillable = [

        "item_id",
        "unit",
        "quantity",
        "unit_price",
        "amount",
        "total",
        "purchase_order_id"
    ];
}
