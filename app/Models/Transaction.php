<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $fillable=['amount', 'dr_cr', 'vt', 'trans_code', 'trans_acc_id', 'trans_date', 'posting_date',
        'rec_date', 'narration', 'status', 'Created_By', 'Updated_By','SID'];
    public function trans_acc(){
        return $this->belongsTo(TransAccount::class,'trans_acc_id','id');
    }
}
