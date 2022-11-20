<?php

namespace App\Models;

use App\Scopes\CompanyScope;
use App\Traits\ObservantTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    use HasFactory, ObservantTrait;

    protected   $fillable = [
        "subject",
        "message",
        "show_staff",
        "show_customer",
        "show_my_name",
        "page_id",
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
            $query->where('subject', 'like', "%{$search}%")
                ->orWhere('message', 'like', "%{$search}%");
        });
    }

    public function page()
    {
        return $this->hasOne(LandingPages::class, 'id', 'page_id');
    }
}