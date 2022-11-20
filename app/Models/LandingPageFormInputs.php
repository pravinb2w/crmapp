<?php

namespace App\Models;

use App\Scopes\CompanyScope;
use App\Traits\ObservantTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LandingPageFormInputs extends Model
{
    use HasFactory, ObservantTrait; 
    
    protected $fillable = [
        "input_type",
        "input_required" 
    ];

    protected static function booted()
    {
        static::addGlobalScope(new CompanyScope);
    }
}
