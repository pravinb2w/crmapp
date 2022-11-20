<?php

namespace App\Models;

use App\Scopes\CompanyScope;
use App\Traits\ObservantTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;


class Status extends Model
{
    use HasFactory,ObservantTrait;
    use SoftDeletes;
    protected $table = 'status';
    protected $fillable = [
        "type",
        "status_name",
        "order",
        "is_active",
        "color"
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
                    $query->where( 'status_name', 'like', "%{$search}%" )
                        ->orWhere( 'type', 'like', "%{$search}%" );
                }); 
    }
}
