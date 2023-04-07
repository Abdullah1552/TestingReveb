<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WoocommerceSetting extends Model
{
    use HasFactory;
    protected $fillable=['id', 'woocommerce_url', 'woocommerce_sk', 'woocommerce_sc',
        'created_by', 'updated_by','state'];
}
