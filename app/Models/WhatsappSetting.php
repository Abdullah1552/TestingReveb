<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WhatsappSetting extends Model
{
    use HasFactory;
    protected $fillable=['id', 'whatsapp_id', 'whatsapp_token', 'created_by',
        'updated_by', 'created_at', 'updated_at'];
}
