<?php

namespace App\Models;

use App\Scopes\CompanyScope;
use App\Traits\ObservantTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;
use OwenIt\Auditing\Contracts\Auditable;

class Team extends Model implements Auditable
{
    use HasFactory,SoftDeletes, ObservantTrait;
    use \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'team_name',
        'team_limit',
        'description',
        'added_by',
        'status',
    ];

    protected static function booted()
    {
        static::addGlobalScope(new CompanyScope);
    }

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
