<?php

namespace App\Models\Hrm;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;
    protected $fillable=['department_name'];
    public static function dropdown(){

        $list='';
        $result=self::all();
        foreach ($result as $item) {
            $list.='<option value="'.$item->id.'">'.$item->department_name.'</option>';

        }
        return $list;
    }
    public function employees()
    {
        return $this->hasMany(Employee::class);
    }
}
