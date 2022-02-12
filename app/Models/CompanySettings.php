<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;

class CompanySettings extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'company_settings';
    protected $fillable = [
        'subscription_id',
        'site_name',
        'site_url',
        'site_logo',
        'site_favicon',
        'aws_access_key',
        'aws_secret_key',
        'fcm_token',
        'facebook_url',
        'twitter_url',
        'instagram_url',
        'status'
    ];

    public function subscription()
    {
        return $this->hasOne(CompanySubscription::class, 'id', 'subscription_id');
    }

    public function scopeLatests( Builder $query ) {
        return $query->orderBy( static::CREATED_AT, 'desc' );
    }

    public function scopeSearch( Builder $query, $search ) {

        if( empty( $search ) ) {
            return $query;
        }

        return  $query->where( function( $query ) use( $search ) {
                    $query->where( 'role', 'like', "%{$search}%" )
                        ->orWhere( 'description', 'like', "%{$search}%" );
                }); 
    }
}
