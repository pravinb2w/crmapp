<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use OwenIt\Auditing\Contracts\Auditable;
use Auth;

class ActivityComment extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;
    protected $table = 'acitivity_comments';
    protected $fillable = [
        'activity_id',
        'comments',
        'added_by'
    ];

    public function added()
    {
        return $this->hasOne(User::class, 'id', 'added_by');
    }
}
