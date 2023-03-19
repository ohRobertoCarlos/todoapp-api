<?php

namespace App\ToDo\Todos\Repositories;

use App\ToDo\Todos\Contracts\TodoRepositoryInterface;
use App\ToDo\Todos\Models\Todo;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class TodoRepository implements TodoRepositoryInterface
{
    public function __construct(
        private Todo $model = new Todo(),
    )
    {}

    public function all(int $userId) : Collection
    {
        return $this->model->where('user_id', $userId)->get();
    }

    public function create(array $data) : Model
    {
        return $this->model->create($data);
    }

    public function update(array $data, int $todoId, int $userId) : bool
    {
        $todo = $this->model->find($todoId);
        if (
            empty($todo) ||
            $todo->user_id !== $userId
        ) {
            return false;
        }

        return $todo->update($data);
    }

    public function delete(int $todoId , int $userId) : bool
    {
        $todo = $this->model->find($todoId);
        if (
            empty($todo) ||
            $todo->user_id !== $userId
        ) {
            return false;
        }

        return $todo->delete();
    }

    public function get(int $todoId, int $userId) : Model|null
    {
        return $this->model
        ->where('id', $todoId)
        ->where('user_id', $userId)
        ->first();
    }
}
