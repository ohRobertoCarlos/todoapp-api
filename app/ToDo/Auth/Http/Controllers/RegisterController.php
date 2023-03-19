<?php

namespace App\ToDo\Auth\Http\Controllers;

use App\Http\Controllers\Controller;
use App\ToDo\Auth\Contracts\UserRepositoryInterface;
use App\ToDo\Auth\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{

    public function __construct
    (
        private UserRepositoryInterface $repository = new UserRepository(),
    )
    {}

    public function register(Request $request)
    {
        $userData = $request->validate([
            'email' => ['required','email'],
            'password' => ['required','min:4'],
            'name' => 'min:2'
        ]);

        $userData['password'] = Hash::make($userData['password']);

        if (!$user = $this->repository->create($userData))
            abort('Could not create user');

        return response()->json([
            'data' => [
                'user' => $user
            ]
        ]);


    }
}
