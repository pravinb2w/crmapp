<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Auth;

class Audit extends Model
{
    use HasFactory;
    protected $casts = [
        'old_values'   => 'array',
        'new_values'   => 'array',
        'auditable_id' => 'integer',
    ];
    
    public function scopeLatests( Builder $query ) {
        return $query->orderBy( static::CREATED_AT, 'desc' );
    }

    public function scopeSearch( Builder $query, $search ) {

        if( empty( $search ) ) {
            return $query;
        }

        return  $query->where( function( $query ) use( $search ) {
                    $query->where( 'user_type', 'like', "%{$search}%" )
                        ->orWhere( 'event', 'like', "%{$search}%" )
                        ->orWhere( 'old_values', 'like', "%{$search}%" )
                        ->orWhere( 'new_values', 'like', "%{$search}%" );
                    }); 
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

}
