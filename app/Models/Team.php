<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;

class Team extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'team_name',
        'team_limit',
        'description',
        'added_by',
        'status',
    ];

    public function added()
    {
        return $this->hasOne(User::class, 'id', 'added_by');
    }

    public function scopeLatests( Builder $query ) {
        return $query->orderBy( static::CREATED_AT, 'desc' );
    }

    public function scopeSearch( Builder $query, $search ) {

        if( empty( $search ) ) {
            return $query;
        }

        return  $query->where( function( $query ) use( $search ) {
            $query->where( 'team_name', 'like', "%{$search}%" )
                ->orWhere( 'team_limit', 'like', "%{$search}%" );
        }); 
    }
}
