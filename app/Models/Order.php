<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;
use OwenIt\Auditing\Contracts\Auditable;

class Order extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;
    protected $fillable = [
        'order_id',
        'customer_id',
        'amount',
        'product_code',
        'payment_gateway',
        'description',
        'status',
        'added_by'
    ];

    public function customer()
    {
        return $this->hasOne(Customer::class, 'id', 'customer_id');
    }

    public function product()
    {
        return $this->hasOne(Product::class, 'product_code', 'product_code');
    }

    public function invoice() {
        return $this->hasOne(Invoice::class, 'order_no', 'order_id');
    }

    public function payment() {
        return $this->hasOne(Payment::class, 'order_id', 'order_id');
    }
}