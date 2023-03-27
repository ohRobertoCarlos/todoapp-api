<?php

namespace App\ToDo\Todos\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Todo extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $fillable = [
        'content',
        'user_id',
        'done'
    ];
}
