<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RootAccount extends Model
{
    use HasFactory;

    static function rootList(){
        $list='';
        $result=self::all();
        foreach ($result as $item){
            $list.='<option value="'.$item->id.'">'.$item->acc_name.'</option>';
        }
        return $list;
    }
}
