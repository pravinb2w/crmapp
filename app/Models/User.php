<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\Builder;
use DB;

class User extends Authenticatable implements Auditable
{
    use HasApiTokens, HasFactory, Notifiable;
    use \OwenIt\Auditing\Auditable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'last_name',
        'mobile_no',
        'image',
        'company_id',
        'role_id',
        'login_ip',
        'last_login',
        'password',
        'status',
        'lead_limit',
        'deal_limit',
        'dial_code',
        
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function company()
    {
        return $this->hasOne(CompanySettings::class, 'id', 'company_id');
    }

    public function role()
    {
        return $this->hasOne(Role::class, 'id', 'role_id');
    }

    public function scopeLatests( Builder $query ) {
        return $query->orderBy( static::CREATED_AT, 'desc' );
    }

    public function scopeSearch( Builder $query, $search ) {

        if( empty( $search ) ) {
            return $query;
        }

        return  $query->where( function( $query ) use( $search ) {
                    $query->where( 'name', 'like', "%{$search}%" )
                        ->orWhere( 'last_name', 'like', "%{$search}%" )
                        ->orWhere( 'email', 'like', "%{$search}%" )
                        ->orWhere( 'mobile_no', 'like', "%{$search}%" );
                }); 
    }

    public function hasAccess($menu, $access) {
        $role_id = auth()->user()->role_id;
        if( $role_id ) {
            $info = DB::table('role_permissions')
                    ->join('role_permission_menu', function ($join) use ($menu) {
                        $join->on('role_permissions.id', '=', 'role_permission_menu.permission_id')
                            ->where('role_permission_menu.menu', '=', $menu);
                    })->where('role_permissions.role_id', $role_id)->first();

            if( isset($info) && !empty($info)) {
                
                if( isset( $info->$access ) && $info->$access == 'on') {
                    return true;
                } else {
                    return false;
                }
            }
        }
        return true;
    }

    public function hasLimit($module) {
            
        $info = DB::table('company_subscriptions')
                ->join('subscriptions', function ($join) {
                    $join->on('company_subscriptions.subscription_id', '=', 'subscriptions.id');
                })->where('company_subscriptions.status', 1)->first();

        if( isset($info) && !empty($info)) {
            
            if( $module == 'template' ) {
                return $info->no_of_email_templates ?? 0;
            } else {
                return false;
            }
            
        }
        return true;
    }
}
