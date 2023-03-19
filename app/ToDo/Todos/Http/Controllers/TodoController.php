<?php

namespace App\ToDo\Todos\Http\Controllers;

use App\Http\Controllers\Controller;
use App\ToDo\Todos\Contracts\TodoServiceInterface;
use App\ToDo\Todos\Services\TodoService;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function __construct(
        private TodoServiceInterface $todoService = new TodoService(),
    )
    {}

    public function index(Request $request)
    {
        return $this->todoService->index($request);
    }
}
