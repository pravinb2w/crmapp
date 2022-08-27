<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrganizationLink extends Model
{
    use HasFactory;
    protected $fillable = [
        'company_id',
        'facebook_url',
        'twitter_url',
        'instagram_url',
        'linkedin_url',
        'skype_url',
        'github_url',
    ];
}
