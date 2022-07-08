<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LandingPages extends Model
{
    use HasFactory;
    protected $fillable = [
        "page_type",
        "page_title",
        "page_logo",
        "permalink",
        "mail_us",
        "call_us",
        "contact_us",
        "iframe_tags",
        "other_tags",
        'about_title',
        'file_about',
        'about_content',
        'primary_color',
        'secondary_color',
        'is_default_landing_page'
    ];
    public function LandingPageSocialMedias()
    {
        return $this->hasMany(LandingPageSocialMedias::class, 'page_id', 'id');
    }
    public function LandingPageBannerSliders()
    {
        return $this->hasMany(LandingPageBannerSliders::class, 'page_id', 'id');
    }
    public function LandingPageFormInputs()
    {
        return $this->hasMany(LandingPageFormInputs::class, 'page_id', 'id');
    }
    public function LandingPageFeatures()
    {
        return $this->hasMany(LandingPageFeatures::class, 'page_id', 'id');
    }
}