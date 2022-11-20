<?php

namespace App\Models;

use App\Scopes\CompanyScope;
use App\Traits\ObservantTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;
use OwenIt\Auditing\Contracts\Auditable;

class TaxGroup extends Model implements Auditable
{
    use HasFactory, SoftDeletes, ObservantTrait;
    use \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'group_name',
        'description',
        'status',
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
                    $query->where( 'group_name', 'like', "%{$search}%" )
                        ->orWhere( 'description', 'like', "%{$search}%" );
                }); 
    }


}
