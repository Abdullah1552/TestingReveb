<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transport extends Model
{
    use HasFactory;
    protected $fillable=['TR_Name', 'TR_Mobile', 'TR_Phone', 'CYID', 'TR_National_Tax', 'TR_Sale_Tax',
    'TR_Adress1','TR_Adress2', 'BID'];
}
