<?php

namespace App\Models;

use App\Scopes\CompanyScope;
use App\Traits\ObservantTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory,ObservantTrait;
    protected $fillable = [
        'subscription_id',
        'company_id',
        'startAt',
        'endAt',
        'total_amount',
        'description',
        'status',
        'deleted_at',
    ];

    protected static function booted()
    {
        static::addGlobalScope(new CompanyScope);
    }
}
