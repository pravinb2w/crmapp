<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;
use OwenIt\Auditing\Contracts\Auditable;

class PaymentIntegration extends Model implements Auditable
{
    use HasFactory;
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
    
}
