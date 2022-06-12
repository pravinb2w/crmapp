<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;
use Auth;

class Task extends Model implements Auditable
{
    use HasFactory, SoftDeletes;
    use \OwenIt\Auditing\Auditable;
    protected $fillable = [
        'task_name',
        'assigned_to',
        'start_date',
        'end_date',
        'description',
        'done_at',
        'added_by',
        'updated_by',
        'status',
        'status_id'
    ];
    
    public function scopeLatests( Builder $query ) {
        return $query->orderBy( static::CREATED_AT, 'desc' );
    }

    public function scopeSearch( Builder $query, $search ) {

        if( empty( $search ) ) {
            return $query;
        }

        return  $query->where( function( $query ) use( $search ) {
                    $query->where( 'task_name', 'like', "%{$search}%" )
                        ->orWhere( 'description', 'like', "%{$search}%" )
                        ->orWhere( 'start_date', 'like', "%{$search}%" )
                        ->orWhere( 'end_date', 'like', "%{$search}%" );
                    }); 
    }

    public function scopeRoledata( Builder $query ){
        $role = Auth::user()->role_id;
        if( !$role ) {
            return $query;   
        }
        return $query->where('assigned_to', Auth::id())->orWhere('added_by', Auth::id());
    }

    public function added()
    {
        return $this->hasOne(User::class, 'id', 'added_by');
    }

    public function updatedBy()
    {
        return $this->hasOne(User::class, 'id', 'updated_by');
    }

    public function assigned()
    {
        return $this->hasOne(User::class, 'id', 'assigned_to');
    }

    public function statusAll()
    {
        return $this->hasOne(Status::class, 'id', 'status_id');
    }
}
