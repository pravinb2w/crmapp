<?php

namespace App\Models;

use App\Scopes\CompanyScope;
use App\Traits\ObservantTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;

class DealProduct extends Model
{
    use HasFactory, ObservantTrait;
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

    protected static function booted()
    {
        static::addGlobalScope(new CompanyScope);
    }

    public function deal()
    {
        return $this->hasOne(Deal::class, 'id', 'deal_id');
    }

    public function product()
    {
        return $this->hasOne(Product::class, 'id', 'product_id');
    }
}
