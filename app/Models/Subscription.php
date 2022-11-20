<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;
use OwenIt\Auditing\Contracts\Auditable;

class Subscription extends Model implements Auditable
{
    use HasFactory, SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'subscription_name',
        'subscription_period',
        'no_of_clients',
        'no_of_employees',
        'no_of_leads',
        'no_of_deals',
        'no_of_deal_stages',
        'no_of_pages',
        'no_of_email_templates',
        'no_of_sms_templates',
        'no_of_products',
        'bulk_import',
        'bulk_upload',
        'announcements',
        'predefined_configurations',
        'newletter_subscriptions',
        'tasks',
        'activities',
        'payment_tracking',
        'thirdparty_integration',
        'technical_support',
        'onetime_setup',
        'server_procurement',
        'server_space',
        'database_backup',
        'work_automation',
        'telegram_bot',
        'sms_integration',
        'payment_gateway',
        'business_whatsapp',
        'amount',
        'status',
        'added_by',
        'updated_by',

    ];

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
            $query->where('subscription_name', 'like', "%{$search}%")
                ->orWhere('subscription_period', 'like', "%{$search}%")
                ->orWhere('amount', 'like', "%{$search}%");
        });
    }

    public function added()
    {
        return $this->hasOne(User::class, 'id', 'added_by');
    }
}