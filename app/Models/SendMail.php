<?php

namespace App\Models;

use App\Scopes\CompanyScope;
use App\Traits\ObservantTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SendMail extends Model
{
    use HasFactory,ObservantTrait;
    protected $table = 'send_mail';
    protected $fillable = [
        'type',
        'type_id',
        'email_type',
        'params',
        'to',
        'send_type'
    ];

    protected static function booted()
    {
        static::addGlobalScope(new CompanyScope);
    }
}