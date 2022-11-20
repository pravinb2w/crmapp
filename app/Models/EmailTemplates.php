<?php

namespace App\Models;

use App\Scopes\CompanyScope;
use App\Traits\ObservantTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailTemplates extends Model
{
    use HasFactory, ObservantTrait;
    protected $fillable =[
        'title',
        'content',
        'status',
        'subject',
        'email_type',
        'created_by',
    ];

    protected static function booted()
    {
        static::addGlobalScope(new CompanyScope);
    }
}
