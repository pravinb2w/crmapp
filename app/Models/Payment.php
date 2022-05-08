<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;
use OwenIt\Auditing\Contracts\Auditable;

class Payment extends Model implements Auditable
{
    use HasFactory;
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
    ];

    public function scopeLatests( Builder $query ) {
        return $query->orderBy( static::CREATED_AT, 'desc' );
    }

    public function scopeSearch( Builder $query, $search ) {

        if( empty( $search ) ) {
            return $query;
        }

        return  $query->where( function( $query ) use( $search ) {
                    $query->where( 'payment_mode', 'like', "%{$search}%" )
                        ->orWhere( 'amount', 'like', "%{$search}%" )
                        ->orWhere( 'payment_method', 'like', "%{$search}%" );
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
}
