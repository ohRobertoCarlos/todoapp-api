<?php

namespace App\ToDo\Auth\Contracts;

use Illuminate\Database\Eloquent\Model;

interface UserRepositoryInterface
{
    public function create($data): Model;
    public function findByEmail($email) : Model|null;
}
