<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Designation extends Model
{
    use HasFactory;
    protected $fillable=['Designation'];

    static function dropdown(){
        $list='';
        $result=self::all();
        foreach ($result as $item){
            $list.='<option value="'.$item->id.'">'.$item->Designation.'</option>';
        }
        return $list;
    }
}
