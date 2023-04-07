<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubHead extends Model
{
    use HasFactory;
    protected $fillable=['Sub_Head_Name', 'HID', 'RID'];
    public function root_acc(){
        return $this->belongsTo(RootAccount::class, 'RID', 'id');
    }
    public function head_acc(){
        return $this->belongsTo(HeadAccount::class, 'HID', 'id');
    }
    static function AccountType(){
        $result=self::all();
        $list='';
        foreach ($result as $item){
            $list.='<option value="'.$item->id.'">'.$item->Sub_Head_Name.'</option>';
        }
        return $list;
    }
}
