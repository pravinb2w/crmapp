<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanySubscription extends Model
{
    use HasFactory;

    protected $fillable = [
        'subscription_id',
        'company_id',
        'startAt',
        'endAt',
        'total_amount',
        'description',
        'status',
        'deleted_at',
    ];
}
