<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use OwenIt\Auditing\Contracts\Auditable;
use Auth;

class TaskComment extends Model implements Auditable
{
    use HasFactory; 
    use HasFactory;
    use \OwenIt\Auditing\Auditable;
    protected $table = 'task_comments';
    protected $fillable = [
        'task_id',
        'comments',
        'added_by'
    ]; 

    public function added()
    {
        return $this->hasOne(User::class, 'id', 'added_by');
    }

}
