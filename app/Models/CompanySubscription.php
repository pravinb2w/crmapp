<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;
use OwenIt\Auditing\Contracts\Auditable;

class CompanySubscription extends Model implements Auditable
{
    use HasFactory, SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'subscription_id',
        'company_id',
        'startAt',
        'endAt',
        'total_amount',
        'description',
        'status',
        'deleted_at',
    ];

    public function scopeLatests( Builder $query ) {
        return $query->orderBy( static::CREATED_AT, 'desc' );
    }

    public function scopeSearch( Builder $query, $search ) {

        if( empty( $search ) ) {
            return $query;
        }

        return  $query->where( function( $query ) use( $search ) {
                    $query->where( 'total_amount', 'like', "%{$search}%" )
                        ->orWhere( 'description', 'like', "%{$search}%" )
                        ->orWhere( 'startAt', 'like', "%{$search}%" )
                        ->orWhere( 'endAt', 'like', "%{$search}%" );
                    $query->orwhereHas('company', fn ($q) => $q->where('site_name', 'like' , "%{$search}%" ));
                    $query->orwhereHas('subscription', fn ($q) => $q->where('subscription_name', 'like' , "%{$search}%" ));
                }); 
    }

    public function subscription()
    {
        return $this->hasOne(Subscription::class, 'id', 'subscription_id');
    }

    public function company()
    {
        return $this->hasOne(CompanySettings::class, 'id', 'company_id');
    }
}
