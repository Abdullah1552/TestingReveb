<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerItem extends Model
{
    use HasFactory;
    protected $fillable=['C_ItemID', 'C_Item_Price', 'CID'];
}
