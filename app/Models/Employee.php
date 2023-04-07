<?php

namespace App\Models;

use App\Models\Hrm\Department;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $fillable=['name', 'emp_photo', 'dep_id', 'email' ,'phone',
        'country_id', 'city_id', 'emp_address', 'role_id'];

    public static function dropdown(){
        $list='';
        $result=self::all();
        foreach ($result as $item) {
            $list.='<option value="'.$item->id.'">'.$item->name.'</option>';
        }
        return $list;
    }
    public function departments()
    {
        return $this->belongsTo(Department::class,'dep_id');
    }
}
