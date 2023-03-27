<?php

namespace App\ToDo\Todos\Services;

use App\ToDo\Todos\Contracts\TodoRepositoryInterface;
use App\ToDo\Todos\Repositories\TodoRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TodoService
{
    public function __construct(
        private TodoRepositoryInterface $todoRepository = new TodoRepository(),
    )
    {}

    public function index(Request $request)
    {
        return $this->todoRepository->all(Auth::user()->id);
    }

    public function show(Request $request, $id)
    {
        return $this->todoRepository->get($id, Auth::user()->id);
    }

    public function store(Request $request)
    {
        $requestData = $request->all();
        $requestData['user_id'] = Auth::user()->id;
        return $this->todoRepository->create($requestData);
    }

    public function update(Request $request, $id)
    {
        return $this->todoRepository->update($request->all(), $id, Auth::user()->id);
    }

    public function destroy(Request $request, $id)
    {
        return $this->todoRepository->delete($id, Auth::user()->id);
    }

    public function destroyAll(Request $request)
    {
        return $this->todoRepository->destroyAll(Auth::user()->id);
    }
}
