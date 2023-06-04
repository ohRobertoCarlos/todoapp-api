<?php

namespace App\ToDo\Todos\Http\Controllers;

use App\Http\Controllers\Controller;
use App\ToDo\Todos\Services\TodoService;
use Exception;
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
            return response()->json([
                'message' => 'Não foi possível listar os ToDos'
            ], 404);
        }

        return response()->json($todos);
    }

    public function show(Request $request, $id)
    {
        try {
            $todo = $this->todoService->show($request, $id);
            if (empty($todo)) {
                throw new Exception('Todo Não encontrado!');
            }
        } catch(Throwable $e) {
            return response()->json([
                'message' => 'Não foi possível buscar o ToDo'
            ], 404);
        }

        return response()->json($todo);
    }

    public function store(Request $request)
    {
        try {
            $todo = $this->todoService->store($request);
        } catch(Throwable $e) {
            return response()->json([
                'message' => 'Não foi possível criar o ToDo'
            ], 404);
        }

        return response()->json($todo, 201);
    }

    public function update(Request $request, $id)
    {
        try {
            $this->todoService->update($request, $id);
        } catch(Throwable $e) {
            return response()->json([
                'message' => 'Não foi possível atualizar o ToDo'
            ], 404);
        }
        return response()->json([]);
    }

    public function destroy(Request $request, $id)
    {
        try {
            $todoDeleted = $this->todoService->destroy($request, $id);
            if (!$todoDeleted) {
                throw new Exception('Não foi possível deletar o ToDo!');
            }
        } catch(Throwable $e) {
            return response()->json([
                'message' => 'Não foi possível deletar o ToDo'
            ], 404);
        }

        return response()->json([]);
    }

    public function destroyAll(Request $request)
    {
        try {
            $this->todoService->destroyAll($request);
        } catch(Throwable $e) {
            return response()->json([
                'message' => 'Não foi possível deletar todos ToDos'
            ], 404);
        }

        return response()->json([]);
    }

    public function done(Request $request, $id)
    {
        try {
            $this->todoService->done($id);
        } catch(Throwable $e) {
            return response()->json([
                'message' => 'Não foi possível marcar como feito um ToDo'
            ], 404);
        }

        return response()->json([]);
    }
}
