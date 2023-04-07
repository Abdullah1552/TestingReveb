<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransAccount extends Model
{
    use HasFactory;
    protected $fillable=['Trans_Acc_Name', 'PID', 'Parent_Type', 'OB', 'OB_Type', 'BID'];

    public function subhead(){
        return $this->belongsTo(SubHead::class, 'PID', 'id');
    }

    public static function dropdown(){
        $list='';
        $result=self::all();
        foreach($result as $item){
            $list.='<option value="'.$item->id.'">'.$item->Trans_Acc_Name.'</option>';
        }
        return $list;
    }
    public function clients(){
        $list='';
        $result=self::where('PID',5)->get();
        foreach($result as $item){
            $list.='<option value="'.$item->id.'">'.$item->Trans_Acc_Name.'</option>';
        }
        return $list;
    }
    //bank and cash
    public static function bank_cash(){
        $list='';
        $result=self::where('PID',4)->get();
        foreach($result as $item){
            $list.='<option value="'.$item->id.'">'.$item->Trans_Acc_Name.'</option>';
        }
        return $list;
    }
}
