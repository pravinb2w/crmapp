<?php

namespace App\Models;

use App\Scopes\CompanyScope;
use App\Traits\ObservantTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class KycDocumentType extends Model implements Auditable
{
    use HasFactory, SoftDeletes, ObservantTrait;

    use \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'document_name',
        'added_by',
        'status'
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
            $query->where('document_name', 'like', "%{$search}%")
                ->orWhere('status', 'like', "%{$search}%");
               
        });
    }

    public function added()
    {
        return $this->hasOne(User::class, 'id', 'added_by');
    }
}
