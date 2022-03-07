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
}
