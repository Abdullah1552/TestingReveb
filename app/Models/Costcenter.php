<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Costcenter extends Model
{
    use HasFactory;
    protected $fillable=['CC_Name'];
}
