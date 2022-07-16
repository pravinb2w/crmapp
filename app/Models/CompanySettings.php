<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;
use OwenIt\Auditing\Contracts\Auditable;

class CompanySettings extends Model implements Auditable
{
    use HasFactory, SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'company_settings';
    protected $fillable = [
        'subscription_id',
        'site_name',
        'site_url',
        'site_logo',
        'site_favicon',
        'aws_access_key',
        'aws_secret_key',
        'fcm_token',
        'facebook_url',
        'twitter_url',
        'instagram_url',
        'status',
        'mailer',
        'smtp_host',
        'smtp_port',
        'smtp_user',
        'smtp_password',
        'mail_encryption',
        'copyrights',
        'invoice_terms',
        'lead_access',
        'deal_access',
        'workflow_automation',
        'last_lead_order',
        'last_deal_order',
        'mentorship_link',
        'telegram_bot',
        'testimonial_link',
        'youtube_learning_link',
        'telegram_link'
    ];

    public function subscription()
    {
        return $this->hasOne(CompanySubscription::class, 'id', 'subscription_id');
    }

    public function sms()
    {
        return $this->belongsTo(SmsIntegration::class, 'id', 'subscription_id');
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
            $query->where('role', 'like', "%{$search}%")
                ->orWhere('description', 'like', "%{$search}%");
        });
    }

    public function prefix()
    {
        return $this->hasMany(PrefixSetting::class, 'company_id');
    }
}