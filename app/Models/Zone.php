<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Zone extends Model
{
    use HasFactory;
    protected $fillable=['Z_Name', 'CTID'];

    public function country(){
        return $this->belongsTo(Country::class,'CTID', 'id');
    }
    static function zoneList($CTID=0){
        if($CTID==0 || $CTID==''){
            $result=self::all()  ;
        }else{
            $result=self::where('id', $CTID)->get();
        }
        $list='';
        foreach ($result as $item){
            $list.='<option value="'.$item->id.'">'.$item->Z_Name.'</option>';
        }
        return $list;
    }
}
