<?php

namespace App\Models;

use App\Scopes\CompanyScope;
use App\Traits\ObservantTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;
use OwenIt\Auditing\Contracts\Auditable;

class PrefixSetting extends Model implements Auditable
{
    use HasFactory, SoftDeletes, ObservantTrait;
    use \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'company_id',
        'prefix_field',
        'prefix_value',
        'status',
    ];

    protected static function booted()
    {
        static::addGlobalScope(new CompanyScope);
    }
}
