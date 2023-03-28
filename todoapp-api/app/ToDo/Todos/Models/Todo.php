<?php

namespace App\ToDo\Todos\Models;

use Database\Factories\TodoFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
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

    protected static function newFactory(): Factory
    {
        return TodoFactory::new();
    }
}
