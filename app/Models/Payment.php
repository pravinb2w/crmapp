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
    ];
}
