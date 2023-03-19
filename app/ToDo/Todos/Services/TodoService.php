<?php

namespace App\ToDo\Todos\Services;

use App\ToDo\Todos\Contracts\TodoServiceInterface;
use Illuminate\Http\Request;

class TodoService implements TodoServiceInterface
{
    public function __construct()
    {

    }

    public function index(Request $request) : string
    {
        return 'index service';
    }
}
