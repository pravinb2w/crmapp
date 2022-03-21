<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;

class Product extends Model implements Auditable
{
    use HasFactory, SoftDeletes;
    use \OwenIt\Auditing\Auditable;
    protected $fillable = [
        'product_name',
        'product_code',
        'description',
        'image',
        'price',
        'added_by',
        'status',
        'hsn_no',
    ];
    public function scopeLatests( Builder $query ) {
        return $query->orderBy( static::CREATED_AT, 'desc' );
    }

    public function scopeSearch( Builder $query, $search ) {

        if( empty( $search ) ) {
            return $query;
        }

        return  $query->where( function( $query ) use( $search ) {
                    $query->where( 'product_name', 'like', "%{$search}%" )
                        ->orWhere( 'product_code', 'like', "%{$search}%" );
                }); 
    }

    public function added()
    {
        return $this->hasOne(User::class, 'id', 'added_by');
    }
}
