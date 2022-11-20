<?php

namespace App\Models;

use App\Scopes\CompanyScope;
use App\Traits\ObservantTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;
use OwenIt\Auditing\Contracts\Auditable;

class Payment extends Model implements Auditable
{
    use HasFactory,ObservantTrait;
    use \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'payment_mode',
        'customer_id',
        'deal_id',
        'amount',
        'payment_method',
        'cheque_no',
        'cheque_date',
        'reference_no',
        'upi_id',
        'card_no',
        'payment_status',
        'description',
        'status',
        'added_by',
        'session_id',
        'order_id',
        'razorpay_id',
        'name',
        'email',
        'contact_no',
        'currency',
        'invoice_id',
        'payment_response',
        'generated_links',
        'temp_no',
        'dial_code'
    ];

    protected static function booted()
    {
        static::addGlobalScope(new CompanyScope);
    }

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
            $query->where('payment_mode', 'like', "%{$search}%")
                ->orWhere('amount', 'like', "%{$search}%")
                ->orWhere('payment_status', 'like', "%{$search}%")
                ->orWhere('order_id', 'like', "%{$search}%")
                ->orWhere('name', 'like', "%{$search}%")
                ->orWhere('payment_method', 'like', "%{$search}%");
        });
    }

    public function added()
    {
        return $this->hasOne(User::class, 'id', 'added_by');
    }

    public function customer()
    {
        return $this->hasOne(Customer::class, 'id', 'customer_id');
    }

    public function deal()
    {
        return $this->hasOne(Deal::class, 'id', 'deal_id');
    }

    public function invoice()
    {
        return $this->hasOne(Invoice::class, 'id', 'invoice_id');
    }
}