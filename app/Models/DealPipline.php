<?php

namespace App\Models;

use App\Scopes\CompanyScope;
use App\Traits\ObservantTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;
use OwenIt\Auditing\Contracts\Auditable;

class DealPipline extends Model implements Auditable
{
    use HasFactory, SoftDeletes, ObservantTrait;
    use \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'deal_id',
        'stage_id',
        'status',
        'completed_at',
        'added_by',
        'updated_by',
    ];

    protected static function booted()
    {
        static::addGlobalScope(new CompanyScope);
    }
}
