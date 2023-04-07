<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MailSetting extends Model
{
    use HasFactory;
    protected $fillable = ['mail_host', 'mail_port', 'mail_address', 'password', 'mail_from_name', 'encryption'];
}
