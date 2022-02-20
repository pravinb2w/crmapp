<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;
use OwenIt\Auditing\Contracts\Auditable;

class Customer extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'company_id',
        'first_name',
        'last_name',
        'logo',
        'dob',
        'email',
        'mobile_no',
        'address',
        'country_id',
        'added_by',
        'status',
        'updated_by'
    ];

    public function company()
    {
        return $this->hasOne(Organization::class, 'id', 'organization_id');
    }

    public function scopeLatests( Builder $query ) {
        return $query->orderBy( static::CREATED_AT, 'desc' );
    }

    public function scopeSearch( Builder $query, $search ) {

        if( empty( $search ) ) {
            return $query;
        }

        return  $query->where( function( $query ) use( $search ) {
                    $query->where( 'first_name', 'like', "%{$search}%" )
                        ->orWhere( 'last_name', 'like', "%{$search}%" )
                        ->orWhere( 'email', 'like', "%{$search}%" )
                        ->orWhere( 'mobile_no', 'like', "%{$search}%" );
                }); 
    }
}
