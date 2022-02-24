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
    ];
    public function LandingPageSocialMedias() {
        return $this->hasMany(LandingPageSocialMedias::class, 'page_id', 'id');
    } 
    public function LandingPageBannerSliders() {
        return $this->hasMany(LandingPageBannerSliders::class, 'page_id', 'id');
    } 
} 