<?php

namespace App\Models;

use App\Scopes\CompanyScope;
use App\Traits\ObservantTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;

class RolePermissionMenu extends Model
{
    use HasFactory, ObservantTrait;
    protected $table = 'role_permission_menu';
    protected $fillable = [
        'permission_id',
        'menu',
        'is_view',
        'is_edit',
        'is_delete',
        'is_assign',
        'is_export',
        'is_filter',
        'status',
        'added_by',
        'updated_by',
    ];

    protected static function booted()
    {
        static::addGlobalScope(new CompanyScope);
    }

}
