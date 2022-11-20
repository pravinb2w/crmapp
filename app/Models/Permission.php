<?php

namespace App\Models;

use App\Scopes\CompanyScope;
use App\Traits\ObservantTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;

class Permission extends Model
{
    use HasFactory, SoftDeletes,ObservantTrait;

    protected $table = 'role_permissions';
    protected $fillable = [
        'role_id',
        'menu',
        'status',
        'added_by',
        'updated_by',
    ];

    protected static function booted()
    {
        static::addGlobalScope(new CompanyScope);
    }

    public function scopeLatests( Builder $query ) {
        return $query->orderBy( static::CREATED_AT, 'desc' );
    }

    public function scopeSearch( Builder $query, $search ) {

        if( empty( $search ) ) {
            return $query;
        }

        return  $query->where( function( $query ) use( $search ) {
                    $query->where( 'menu', 'like', "%{$search}%" )
                        ->orWhere( 'role_id', 'like', "%{$search}%" );
                }); 
    }

    public function added()
    {
        return $this->hasOne(User::class, 'id', 'added_by');
    }

    public function role()
    {
        return $this->hasOne(Role::class, 'id', 'role_id');
    }

    public function permission()
    {
        return $this->hasMany(RolePermissionMenu::class, 'permission_id');
    }

    public function scopeHas_access(Builder $query, $menu){
        return $query->join('role_permission_menu', function($join, $menu){
                    $join->on('role_permission_menu.permission_id', '=', 'role_permissions.id')
                    ->where('role_permission_menu.menu', $menu);
        });
            
    }
}
