<?php

namespace App\Models;

use App\Scopes\CompanyScope;
use App\Traits\ObservantTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Auth;

class Automation extends Model
{
    use HasFactory, ObservantTrait;
    protected $fillable = [
        'activity_type',
        'activity_title',
        'description',
        'template_id',
        'is_mail_to_customer',
        'team_template_id',
        'is_mail_to_team',
        'is_notification_to_team',
        'notification_title',
        'notification_message',
        'status',
        'added_by',

    ];

    protected static function booted()
    {
        static::addGlobalScope(new CompanyScope);
    }

    public function scopeRoledata( Builder $query ){
        $role = Auth::user()->role_id;
        if( !$role ) {
            return $query;   
        }
        return $query->where('added_by', Auth::id());
    }

    public function scopeLatests( Builder $query ) {
        return $query->orderBy( static::CREATED_AT, 'desc' );
    }

    public function scopeSearch( Builder $query, $search ) {

        if( empty( $search ) ) {
            return $query;
        }

        return  $query->where( function( $query ) use( $search ) {
                    $query->where( 'activity_type', 'like', "%{$search}%" )
                        ->orWhere( 'notification_title', 'like', "%{$search}%" )
                        ->orWhere( 'notification_message', 'like', "%{$search}%" )
                        ->orWhere( 'status', 'like', "%{$search}%" );
                    }); 
    }

    public function customer_template()
    {
        return $this->hasOne(EmailTemplates::class, 'id', 'template_id');
    }

    public function team_template()
    {
        return $this->hasOne(EmailTemplates::class, 'id', 'template_id');
    }


    
}
