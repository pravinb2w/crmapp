<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;
use OwenIt\Auditing\Contracts\Auditable;

class SmsIntegration extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'company_id',
        'twilio_sid',
        'twilio_auth_token',
        'twilio_number',
        'enable_twilio',
        'sms_type',
        'user_name',
        'api_key',
        'sender_id',
        'template_id',
        'type',
        'template',
        'variables'
    ];

    public function sms()
    {
        return $this->hasOne(CompanySettings::class, 'id', 'company_id');
    }
}
