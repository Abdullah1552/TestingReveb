<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payroll extends Model
{
    use HasFactory;
    protected $fillable = ['employee_id', 'salary_from_acc', 'payment_method', 'basic_salary', 'allowances', 'deductions', 'net_salary', 'remarks'];

    public static function dropdown(){

        $list='';
        $result=self::all();
        foreach ($result as $item) {
            $list.='<option value="'.$item->id.'">'.$item->department_name.'</option>';

        }
        return $list;
    }
}
