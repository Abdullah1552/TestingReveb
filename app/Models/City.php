<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;
    protected $fillable=['ZID', 'CY_Name'];
    public function zone(){
        return $this->belongsTo(Zone::class, 'ZID', 'id');
    }
    static function cityList($ZID=0){
        $list='';
        if($ZID==0 || $ZID==''){
            $result=self::all();
        }else{
            $result=self::where('ZID', $ZID)->get();
        }
        foreach ($result as $item){
            $list.='<option value="'.$item->id.'">'.$item->CY_Name.'</option>';
        }
        return $list;
    }
}
