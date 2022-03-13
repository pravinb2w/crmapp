<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LandingPageFormInputs extends Model
{
    use HasFactory; 
    
    protected $fillable = [
        "input_type",
        "input_required" 
    ];
}
