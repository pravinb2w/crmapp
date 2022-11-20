<?php

namespace App\Models;

use App\Scopes\CompanyScope;
use App\Traits\ObservantTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;

class CustomerMobile extends Model
{
    use HasFactory, SoftDeletes, ObservantTrait;
    protected $table = 'customer_mobile';
    protected $fillable = [
        'company_id',
        'mobile_no',
        'contact_type_id',
        'description',
        'status',
        'added_by',
        'updated_by',
        'customer_id',
    ];

    protected static function booted()
    {
        static::addGlobalScope(new CompanyScope);
    }
}
