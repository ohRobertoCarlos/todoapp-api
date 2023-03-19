<?php

namespace App\ToDo\Todos\Repositories;

use App\ToDo\Todos\Models\Todo;

class TodoRepository
{
    public function __construct(
        private $model = new Todo(),
    )
    {}
}
