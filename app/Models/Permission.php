<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;

class Permission extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'role_permissions';
    protected $fillable = [
        'role_id',
        'menu',
        'is_view',
        'is_edit',
        'is_delete',
        'is_assign',
        'status',
        'added_by',
        'updated_by',
    ];

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
}
