<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\StockDetails;

class Transfer extends Model
{
    use HasFactory;
    protected $fillable=['id', 'WHIDF', 'WHIDT', 'status', 'created_by', 'updated_by',
        'shipping_cost', 'net_total', 'attached_document', 'notes', 'created_at',
        'updated_at'];
        protected $dateFormat = 'm-d-Y';
    public function location_from(){
        return $this->belongsTo(WhereHouse::class,'WHIDF','id');
    }
    public function location_to(){
        return $this->belongsTo(WhereHouse::class,'WHIDT','id');
    }
    public function stock(){
        return $this->hasMany(StockDetails::class,'TRFID','id');
    }
}
