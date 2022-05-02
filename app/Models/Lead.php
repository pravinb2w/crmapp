<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;
use OwenIt\Auditing\Contracts\Auditable;

class Lead extends Model implements Auditable
{
    use HasFactory, SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'lead_title',
        'lead_subject',
        'lead_description',
        'customer_id',
        'lead_value',
        'lead_currency',
        'lead_type_id',
        'lead_source_id',
        'assigned_at',
        'assigned_to',
        'assinged_by',
        'visible_to',
        'status',
        'added_by',
        'updated_by'
    ];

    public function scopeLatests( Builder $query ) {
        return $query->orderBy( static::CREATED_AT, 'desc' );
    }

    public function scopeAccess( Builder $query ) {
        $role_id = auth()->user()->role_id;
        if($role_id){
            return $query->where('assigned_to', auth()->user()->id );

        }
        return $query;
    }

    public function scopeSearch( Builder $query, $search ) {

        if( empty( $search ) ) {
            return $query;
        }

        return  $query->where( function( $query ) use( $search ) {
                    $query->where( 'lead_title', 'like', "%{$search}%" )
                        ->orWhere( 'lead_subject', 'like', "%{$search}%" )
                        ->orWhere( 'lead_description', 'like', "%{$search}%" )
                        ->orWhere( 'lead_value', 'like', "%{$search}%" )
                        ->orWhere( 'assigned_at', 'like', "%{$search}%" );

                }); 
    }

    public function assignedTo()
    {
        return $this->hasOne(User::class, 'id', 'assigned_to');
    }

    public function assignedBy()
    {
        return $this->hasOne(User::class, 'id', 'assinged_by');
    }

    public function added()
    {
        return $this->hasOne(User::class, 'id', 'added_by');
    }

    public function updatedBy()
    {
        return $this->hasOne(User::class, 'id', 'updated_by');
    } 
    
    public function customer()
    {
        return $this->hasOne(Customer::class, 'id', 'customer_id');
    } 

    public function leadType()
    {
        return $this->hasOne(LeadType::class, 'id', 'lead_type_id');
    }

    public function leadSource()
    {
        return $this->hasOne(LeadSource::class, 'id', 'lead_source_id');
    }

    public function planned_activity()
    {
        return $this->hasMany(Activity::class, 'lead_id')->whereNull('activities.done_at')->where('status', 1)->orderBy('activities.created_at', 'desc');
    }

    public function done_activity()
    {
        return $this->hasMany(Activity::class, 'lead_id')->whereNotNull('activities.done_at')->where('status', 1)->orderBy('activities.done_at', 'desc');
    }

    public function all_activity()
    {
        return $this->hasMany(Activity::class, 'lead_id')->where('status', 1)->orderBy('activities.created_at', 'desc');
    }

    public function notes()
    {
        return $this->hasMany(Note::class, 'lead_id')->orderBy('notes.created_at', 'desc');
    }
    
}
