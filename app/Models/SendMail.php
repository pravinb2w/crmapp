<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SendMail extends Model
{
    use HasFactory;
    protected $table = 'send_mail';
    protected $fillable = [
        'type',
        'type_id',
        'email_type',
        'params',
        'to'
    ];
}