<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    use HasFactory;
    protected $fillable=['name','attr_value','w_id'];

    public static function dropdown($id=0){
        $result=self::all();
        $list='';
        foreach ($result as $item){
            $list.='<option '.($item->name==$id?'Selected':'').' value="'.$item->attr_value.'">'.$item->name.'</option>';
        }
        return $list;
    }

    public static function attribute_dropdown($name,$para=null){
        $result=self::where('name',$name)->first();
        $attribute = explode(',',$result->attr_value);
        $list='';
        foreach ($attribute as $attr){
            $list.='<option '.($attr==$para?'Selected':'').' value="'.$attr.'">'.$attr.'</option>';
        }
        return $list;
    }


}
