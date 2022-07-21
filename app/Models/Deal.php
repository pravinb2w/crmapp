<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;
use OwenIt\Auditing\Contracts\Auditable;

class Deal extends Model implements Auditable
{
    use HasFactory, SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'customer_id',
        'deal_title',
        'deal_description',
        'deal_value',
        'deal_currency',
        'lead_id',
        'current_stage_id',
        'stage_status',
        'expected_completed_date',
        'product_total',
        'assigned_at',
        'assigned_to',
        'assinged_by',
        'status',
        'added_by',
        'updated_by',
        'won_at',
        'loss_at',
    ];

    public function scopeLatests(Builder $query)
    {
        return $query->orderBy(static::CREATED_AT, 'desc');
    }

    public function scopeSearch(Builder $query, $search)
    {

        if (empty($search)) {
            return $query;
        }

        return  $query->where(function ($query) use ($search) {
            $query->where('deal_title', 'like', "%{$search}%")
                ->orWhere('deal_description', 'like', "%{$search}%")
                ->orWhere('deal_value', 'like', "%{$search}%")
                ->orWhere('expected_completed_date', 'like', "%{$search}%")
                ->orWhere('stage_status', 'like', "%{$search}%");
            // ->orWhere('customer.first_name', 'like', "%{$search}%");
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

    public function current_stage()
    {
        return $this->hasOne(DealStage::class, 'id', 'current_stage_id');
    }

    public function notes()
    {
        return $this->hasMany(Note::class, 'deal_id')->orderBy('notes.created_at', 'desc');
    }

    public function deal_products()
    {
        return $this->hasMany(DealProduct::class, 'deal_id')->orderBy('deal_products.created_at', 'asc');
    }

    public function invoice()
    {
        return $this->hasMany(Invoice::class, 'deal_id')->orderBy('invoices.created_at', 'asc');
    }

    public function pipeline()
    {
        return $this->hasMany(DealPipline::class, 'deal_id');
    }

    public function planned_activity()
    {
        return $this->hasMany(Activity::class, 'deal_id')->whereNull('activities.done_at')->where('status', 1)->orderBy('activities.created_at', 'desc');
    }

    public function done_activity()
    {
        return $this->hasMany(Activity::class, 'deal_id')->whereNotNull('activities.done_at')->where('status', 1)->orderBy('activities.done_at', 'desc');
    }

    public function all_activity()
    {
        return $this->hasMany(Activity::class, 'deal_id')->whereNull('deleted_at')->where('status', 1)->orderBy('activities.created_at', 'desc');
    }

    public function files()
    {
        return $this->hasMany(DealDocument::class, 'deal_id')->where('status', 1)->orderBy('deal_documents.created_at', 'desc');
    }

    public function invoice_topay()
    {
        return $this->hasMany(Invoice::class, 'deal_id')->where('status', 1)->whereNull('paid_at');
    }
}