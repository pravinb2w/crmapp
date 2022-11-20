<?php

namespace App\Models;

use App\Scopes\CompanyScope;
use App\Traits\ObservantTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;
use OwenIt\Auditing\Contracts\Auditable;

class PaymentIntegration extends Model implements Auditable
{
    use HasFactory,ObservantTrait;
    use \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'company_id',
        'gateway',
        'enabled',
        'test_access_key',
        'test_secret_key',
        'test_merchant_id',
        'live_merchant_id',
        'live_access_key',
        'live_secret_key',
        'success_page',
        'fail_page',
        'status',
    ];

    protected static function booted()
    {
        static::addGlobalScope(new CompanyScope);
    }
    
}
