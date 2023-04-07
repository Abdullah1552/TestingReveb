<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branches extends Model
{
    use HasFactory;
    protected $fillable=['BR_Name', 'BR_Email', 'BR_Phone', 'CYID', 'BR_Address1', 'BR_Address2', 'CMPID'];

    static function dropdown(){
        $list='';
        $result=self::all();
        foreach ($result as $item){
            $list.='<option value="'.$item->id.'">'.$item->BR_Name.'</option>';
        }
        return $list;
    }
}
