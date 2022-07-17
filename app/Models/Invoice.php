<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;
use OwenIt\Auditing\Contracts\Auditable;

class Invoice extends Model implements Auditable
{
    use HasFactory, SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'deal_id',
        'invoice_no',
        'order_no',
        'issue_date',
        'due_date',
        'customer_id',
        'address',
        'email',
        'subtotal',
        'tax',
        'discount',
        'total',
        'status',
        'approved_at',
        'added_by',
        'updated_by',
        'pending_at',
        'rejected_at',
        'approved_by',
        'rejected_by',
        'reject_reason',
        'paid_at',
        'paid_amount',
        'remarks',
        'currency'
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
            $query->where('invoice_no', 'like', "%{$search}%")
                ->orWhere('issue_date', 'like', "%{$search}%")
                ->orWhere('due_date', 'like', "%{$search}%")
                ->orWhere('address', 'like', "%{$search}%")
                ->orWhere('total', 'like', "%{$search}%");
        });
    }

    public function customer()
    {
        return $this->hasOne(Customer::class, 'id', 'customer_id');
    }

    public function deal()
    {
        return $this->hasOne(Deal::class, 'id', 'deal_id');
    }

    public function added()
    {
        return $this->hasOne(User::class, 'id', 'added_by');
    }

    public function updatedBy()
    {
        return $this->hasOne(User::class, 'id', 'updated_by');
    }

    public function items()
    {
        return $this->hasMany(InvoiceItem::class, 'invoice_id')->orderBy('invoice_items.created_at', 'asc');
    }
}