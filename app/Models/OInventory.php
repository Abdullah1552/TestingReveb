<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OInventory extends Model
{
    use HasFactory;
    protected $fillable = ['WHID', 'created_by', 'updated_by', 'total_qty', 'sub_total', 'date'];

    public function location(){
        return $this->belongsTo(WhereHouse::class,'WHID','id');
    }
    public function user_create(){
        return $this->belongsTo(User::class,'created_by','id');
    }
}
