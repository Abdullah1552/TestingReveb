<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;

class WhereHouse extends Model
{
    use HasFactory;
    protected $fillable=['id', 'WH_Name', 'WH_Mobile', 'WH_Phone', 'WH_Email', 'WH_CYID', 'WH_Address'];

    static function dropdown($id=0,$all = false){

        $list='';
        $result = self::when(!$all && (Auth::user()->type == "end_user" || Auth::user()->type == "admin"),function ($query) {
            $query->whereIn('id',Auth::user()->warehouses);
        })
        ->get();


        if(is_array($id)){
            foreach ($result as $item){
                $list.='<option '.(in_array ($item->id,$id)?'selected':'').' value="'.$item->id.'">'.$item->WH_Name.'</option>';
            }
        }else{
            foreach ($result as $item){
                $list.='<option '.($id==$item->id?'selected':'').' value="'.$item->id.'">'.$item->WH_Name.'</option>';
            }
        }

        return $list;
    }
}
