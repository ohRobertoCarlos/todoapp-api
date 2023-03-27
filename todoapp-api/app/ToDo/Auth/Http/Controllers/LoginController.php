<?php

namespace App\ToDo\Auth\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required','email'],
            'password' => ['required']
        ]);

        if (!Auth::attempt($credentials))
            abort(401,'Invalid Credentials');

        $newAccessTokenObj = $request->user()->createToken($request->user()->email. '_token');

        return response()->json([
            'data' => [
                'token' => $newAccessTokenObj->plainTextToken
            ]
        ]);

    }

    public function logoutAll(Request $request)
    {
        $request->user()->tokens()->delete();
        Auth::guard('web')->logout();

        return response()->json(['data' => [
            'status' => 'all logged out'
        ]]);
    }

    public function me(Request $request)
    {
        return response()->json($request->user());
    }

}
