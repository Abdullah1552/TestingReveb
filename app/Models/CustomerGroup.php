<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerGroup extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'percentage'];
    public static function dropdown(){
        $list='';
        $result=self::all();
        foreach ($result as $item) {
            $list.='<option value="'.$item->id.'">'.$item->name.'</option>';
        }
        return $list;
    }
    public function customer(){
        return $this->hasMany(Customer::class, 'id');
    }
}
