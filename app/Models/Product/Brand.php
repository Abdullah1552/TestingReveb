<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;
    protected $fillable=['brand_name', 'brand_image'];

    public static function dropdown($id=0){
        $list='';
        $result=self::all();
        foreach ($result as $item){
            $list.='<option '.(($item->id==$id)?'selected':'').' value="'.$item->id.'">'.$item->brand_name.'</option>';
        }
        return $list;
    }
}
