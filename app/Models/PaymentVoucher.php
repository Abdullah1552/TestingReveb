<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentVoucher extends Model
{
    use HasFactory;
    protected $fillable=['trans_date', 'trans_acc_id', 'payment_type', 'narration', 'amount', 'trans_code',
        'created_by', 'updated_by', 'cheque_no'];
}
