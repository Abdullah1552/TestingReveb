<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'discount_by', 'valid_from', 'valid_till', 'discount_type', 'value', 'min_qty', 'max_qty', 'days', 'discount_on','status'];
}
