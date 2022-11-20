<?php

namespace App\Models;

use App\Scopes\CompanyScope;
use App\Traits\ObservantTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LandingPageFeatures extends Model
{
    use HasFactory, ObservantTrait;
   
    protected $fillable = [
        "icon",
        "title",
        "content",
    ];

    protected static function booted()
    {
        static::addGlobalScope(new CompanyScope);
    }
}
