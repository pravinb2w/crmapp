<?php

namespace App\Models;

use App\Scopes\CompanyScope;
use App\Traits\ObservantTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;
use OwenIt\Auditing\Contracts\Auditable;

class DealStage extends Model implements Auditable
{
    use HasFactory, SoftDeletes, ObservantTrait;
    use \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'stages',
        'description',
        'added_by',
        'status',
        'order_by',
        'company_id'
    ];

    protected static function booted()
    {
        static::addGlobalScope(new CompanyScope);
    }

    public function scopeLatests(Builder $query)
    {
        return $query->orderBy(static::CREATED_AT, 'desc');
    }

    public function scopeSearch(Builder $query, $search)
    {

        if (empty($search)) {
            return $query;
        }

        return  $query->where(function ($query) use ($search) {
            $query->where('deal_stages', 'like', "%{$search}%")
                ->orWhere('description', 'like', "%{$search}%");
        });
    }

    public function company()
    {
        return $this->hasOne(CompanySettings::class, 'id', 'company_id');
    }

    public function deals()
    {
        return $this->hasMany(Deal::class, 'current_stage_id')->orderBy('deals.created_at', 'desc');
    }

    public function added()
    {
        return $this->hasOne(User::class, 'id', 'added_by');
    }
}