<?php

namespace App\Models;

use App\Scopes\CompanyScope;
use App\Traits\ObservantTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tax extends Model
{
    use HasFactory, ObservantTrait;

    protected static function booted()
    {
        static::addGlobalScope(new CompanyScope);
    }
}
