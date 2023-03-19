<?php

namespace App\ToDo\Todos\Contracts;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface TodoRepositoryInterface
{
    public function all(int $userId) : Collection;
    public function create(array $data) : Model;
    public function update(array $data, int $todoId, int $userId) : bool;
    public function delete(int $todoId , int $userId) : bool;
    public function get(int $todoId, int $userId) : Model | null;
}
