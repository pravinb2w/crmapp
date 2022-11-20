<?php

namespace App\Models;

use App\Scopes\CompanyScope;
use App\Traits\ObservantTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class CustomerDocument extends Model implements Auditable
{
    use HasFactory, SoftDeletes, ObservantTrait;

    use \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'customer_id',
        'document_id',
        'document',
        'uploadAt',
        'approvedAt',
        'approvedBy',
        'rejectedAt',
        'rejectedBy',
        'reject_reason',
        'description',
        'status'
    ];

    // protected static function booted()
    // {
    //     static::addGlobalScope(new CompanyScope);
    // }

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
            $query->where('customer_documents.status', 'like', "%{$search}%")
                ->orWhere('customer_documents.uploadAt', 'like', "%{$search}%")
                ->orWhere('customers.first_name', 'like', "%{$search}%")
                ->orWhere('customers.email', 'like', "%{$search}%")
                ->orWhere('customers.mobile_no', 'like', "%{$search}%")
                ->orWhere('kyc_document_types.document_name', 'like', "%{$search}%");
        });
    }


    public function documentType()
    {
        return $this->hasOne(KycDocumentType::class, 'id', 'document_id');
    }

    public function customer()
    {
        return $this->hasOne(Customer::class, 'id', 'customer_id');
    }

    
}
