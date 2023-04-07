<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;


    public function uom(){
        return $this->belongsTo(UnitType::class,'Item_UOM','id');
    }
    static function itemList($id=0){
        $list='';
        $result=self::all();
        foreach ($result as $item){
            $list.='<option '.(($id==$item->id)?'selected':'').' value="'.$item->id.'">'.$item->Item_Name.'</option>';
        }
        return $list;
    }
}
