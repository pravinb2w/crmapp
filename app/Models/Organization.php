<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;
use OwenIt\Auditing\Contracts\Auditable;

class Organization extends Model implements Auditable
{
    use HasFactory, SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'company_id',
        'name',
        'mobile_no',
        'email',
        'address',
        'logo',
        'description',
        'fax',
        'added_by',
        'status'
    ];

    public function scopeLatests( Builder $query ) {
        return $query->orderBy( static::CREATED_AT, 'desc' );
    }

    public function scopeSearch( Builder $query, $search ) {

        if( empty( $search ) ) {
            return $query;
        }

        return  $query->where( function( $query ) use( $search ) {
                    $query->where( 'name', 'like', "%{$search}%" )
                        ->orWhere( 'mobile_no', 'like', "%{$search}%" )
                        ->orWhere( 'email', 'like', "%{$search}%" )
                        ->orWhere( 'address', 'like', "%{$search}%" );
                }); 
    }
}
