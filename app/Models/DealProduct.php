<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;

class DealProduct extends Model
{
    use HasFactory;
    protected $fillable = [
        'deal_id',
        'product_id',
        'product_name',
        'price',
        'quantity',
        'amount',
        'discount',
        'unit',
        'status'
    ];

    public function deal()
    {
        return $this->hasOne(Deal::class, 'id', 'deal_id');
    }

    public function product()
    {
        return $this->hasOne(Product::class, 'id', 'product_id');
    }
}
