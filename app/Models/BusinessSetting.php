<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessSetting extends Model
{
    use HasFactory;
    protected $table = 'business_settings';
//    protected $fillable = ['id', 'business_name', 'business_logo', 'default_currency',
//        'currency_decimal', 'time_zone', 'created_by', 'updated_by'];
    protected $guarded = [];

    static function codeFormats(){
        $list='';
        $code_format = self::first()->code_format;
        $code_formats=['C', 'YC', 'MYC ', 'YMC'];
        foreach ($code_formats as $item){
            $list.='<option '.($item == $code_format?'selected':'').' value="'.$item.'">'.$item.'</option>';
        }
        return $list;
    }
}
