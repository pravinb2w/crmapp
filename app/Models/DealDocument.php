<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use OwenIt\Auditing\Contracts\Auditable;

class DealDocument extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'deal_id',
        'document',
        'document_name',
        'status',
        'added_by',
    ];

    public function added()
    {
        return $this->hasOne(User::class, 'id', 'added_by');
    }
}
