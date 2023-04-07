<?php

namespace App\Models\Product;

use App\Models\User;
use App\Models\WhereHouse;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Adjustment extends Model
{
    use HasFactory;
    protected $fillable=['id', 'WHID', 'attached_documents', 'created_by', 'updated_by', 'notes','reference'];

    public function location(){
        return $this->belongsTo(WhereHouse::class,'WHID','id');
    }

    public function user_create(){
        return $this->belongsTo(User::class,'created_by','id');
    }

}
