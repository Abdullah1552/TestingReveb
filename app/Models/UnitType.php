<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnitType extends Model
{
    use HasFactory;
    protected $fillable=['unit_name'];


    static function unitTypeList($id=0){
        $list='';
        $result=self::all();
        foreach ($result as $item) {
            $list.='<option '.(($id==$item->id)?'selected':'').' value="'.$item->id.'">'.$item->unit_name.'</option>';
        }
        return $list;
    }
}
