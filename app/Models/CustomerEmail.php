<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;

class CustomerEmail extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'custor_email';
    protected $fillable = [
        'company_id',
        'email',
        'contact_type_id',
        'description',
        'status',
        'added_by',
        'updated_by',
    ];
}
