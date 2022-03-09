<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;

class InvoiceItem extends Model
{
    use HasFactory;
    protected $fillable = [
       'invoice_id',
       'product_id',
       'description',
       'qty',
       'unit_price',
       'discount',
       'tax',
       'amount',
    ];

    public function invoice()
    {
        return $this->hasOne(Invoice::class, 'id', 'invoice_id');
    }

    public function product()
    {
        return $this->hasOne(Product::class, 'id', 'product_id');
    }
}
