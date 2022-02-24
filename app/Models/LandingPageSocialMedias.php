<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LandingPageSocialMedias extends Model
{
    use HasFactory;
    protected $fillable = [
        "page_id",
        "name",
        "link",
        'icon',
    ];
}
