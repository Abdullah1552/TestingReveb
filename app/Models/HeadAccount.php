<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HeadAccount extends Model
{
    use HasFactory;
    public function root_acc(){
        return $this->belongsTo(RootAccount::class, 'RID', 'id');
    }
    static function headAccList($id=0){
        $list='';
        if($id==0 || $id=='') {
            $result = self::all();
        }else{
            $result = self::where('RID', $id)->get();
        }
        foreach ($result as $item){
            $list.='<option value="'.$item->id.'">'.$item->Head_Ac_Name.'</option>';
        }
        return $list;
    }
}
