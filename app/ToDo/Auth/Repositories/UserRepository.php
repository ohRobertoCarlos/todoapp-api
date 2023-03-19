<?php

namespace App\ToDo\Auth\Repositories;

use App\Models\User;
use App\ToDo\Auth\Contracts\UserRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class UserRepository implements UserRepositoryInterface
{
    public function __construct(
        private $model = new User(),
    )
    {}

    public function create($data) : Model
    {
        return $this->model->create($data);
    }
}
