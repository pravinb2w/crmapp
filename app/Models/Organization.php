<?php

namespace App\Models;

use App\Scopes\CompanyScope;
use App\Traits\ObservantTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;
use OwenIt\Auditing\Contracts\Auditable;

class Organization extends Model implements Auditable
{
    use HasFactory, SoftDeletes,ObservantTrait;
    use \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'company_id',
        'name',
        'mobile_no',
        'email',
        'address',
        'logo',
        'description',
        'fax',
        'added_by',
        'status',
        'dial_code'
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
            $query->where('name', 'like', "%{$search}%")
                ->orWhere('mobile_no', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%")
                ->orWhere('address', 'like', "%{$search}%");
        });
    }

    public function added()
    {
        return $this->hasOne(User::class, 'id', 'added_by');
    }

    public function links()
    {
        return $this->hasOne(OrganizationLink::class, 'company_id');
    }
}