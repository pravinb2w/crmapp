<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityComment extends Model
{
    use HasFactory;
    protected $fillable = [
        'activity_id',
        'comments',
        'added_by'
    ];
}