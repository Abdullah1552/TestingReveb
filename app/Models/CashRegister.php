<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CashRegister extends Model
{
    use HasFactory;
    protected $fillable=['id', 'WHID', 'cash_in_hand', 'total_sale', 'total_cash',
    'cash_payment', 'credit_card_payment', 'qr_code_payment', 'other_payment',
        'total_sale_return', 'total_expense', 'status', 'open_by', 'closed_by'];

    public function location(){
        return $this->belongsTo(WhereHouse::class,'WHID','id');
    }
    public function staff(){
        return $this->belongsTo(User::class,'open_by','id');
    }
    public function closing_staff(){
        return $this->belongsTo(User::class,'closed_by','id');
    }

}
