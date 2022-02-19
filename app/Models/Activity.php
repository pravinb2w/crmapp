<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;
use OwenIt\Auditing\Contracts\Auditable;

class Activity extends Model implements Auditable
{
    use HasFactory, SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'subject',
        'activity_type',
        'notes',
        'lead_id',
        'customer_id',
        'user_id',
        'started_at',
        'due_at',
        'done_at',
        'done_by',
        'available',
        'status',
        'added_by',
        'updated_by'
    ];

    public function scopeLatests( Builder $query ) {
        return $query->orderBy( static::CREATED_AT, 'desc' );
    }

    public function scopeSearch( Builder $query, $search ) {

        if( empty( $search ) ) {
            return $query;
        }

        return  $query->where( function( $query ) use( $search ) {
                    $query->where( 'subject', 'like', "%{$search}%" )
                        ->orWhere( 'activity_type', 'like', "%{$search}%" )
                        ->orWhere( 'notes', 'like', "%{$search}%" )
                        ->orWhere( 'started_at', 'like', "%{$search}%" )
                        ->orWhere( 'due_at', 'like', "%{$search}%" );

                }); 
    }

    public function added()
    {
        return $this->hasOne(User::class, 'id', 'added_by');
    }

    public function updatedBy()
    {
        return $this->hasOne(User::class, 'id', 'updated_by');
    }

    public function lead()
    {
        return $this->hasOne(Lead::class, 'id', 'lead_id');
    }

    public function customer()
    {
        return $this->hasOne(Customer::class, 'id', 'customer_id');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function done()
    {
        return $this->hasOne(User::class, 'id', 'done_by');
    }
}
