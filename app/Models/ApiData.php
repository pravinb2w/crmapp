<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApiData extends Model
{
    use HasFactory;
    protected $fillable = [
        "type",
        "field",
        "field_value",
        "status"
    ];
}
