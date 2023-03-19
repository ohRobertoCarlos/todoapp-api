<?php

namespace App\ToDo\Todos\Http\Controllers;

use App\Http\Controllers\Controller;
use App\ToDo\Todos\Services\TodoService;
use Illuminate\Http\Request;
use Throwable;

class TodoController extends Controller
{
    public function __construct(
        private TodoService $todoService = new TodoService(),
    )
    {}

    public function index(Request $request)
    {
        try {
            $todos = $this->todoService->index($request);
        } catch(Throwable $e) {
            return ['error' => $e->getMessage()];
        }

        return $todos;
    }

    public function show(Request $request, $id)
    {
        try {
            $todo = $this->todoService->show($request, $id);
        } catch(Throwable $e) {
            return ['error' => $e->getMessage()];
        }

        return $todo;
    }

    public function store(Request $request)
    {
        try {
            $todo = $this->todoService->store($request);
        } catch(Throwable $e) {
            return ['error' => $e->getMessage()];
        }

        return $todo;
    }

    public function update(Request $request, $id)
    {
        try {
            $this->todoService->update($request, $id);
        } catch(Throwable $e) {
            return ['error' => $e->getMessage()];
        }
        return 'Todo atualizado com sucesso!';
    }

    public function destroy(Request $request, $id)
    {
        try {
            $this->todoService->destroy($request, $id);
        } catch(Throwable $e) {
            return ['error' => $e->getMessage()];
        }

        return 'Tarefa deletada com sucesso!';
    }
}
