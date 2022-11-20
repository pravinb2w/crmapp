<?php

namespace App\Models;

use App\Scopes\CompanyScope;
use App\Traits\ObservantTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrganizationLink extends Model
{
    use HasFactory,ObservantTrait;
    protected $fillable = [
        'company_id',
        'facebook_url',
        'twitter_url',
        'instagram_url',
        'linkedin_url',
        'skype_url',
        'github_url',
    ];

    protected static function booted()
    {
        static::addGlobalScope(new CompanyScope);
    }
}
