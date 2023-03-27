<?php

use App\ToDo\Auth\Http\Controllers\LoginController;
use App\ToDo\Auth\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'api/v1'], function() {
    Route::post('/auth/login', [LoginController::class,'login'])->name('login');
    Route::post('/auth/register', [RegisterController::class,'register'])->name('register');
});

Route::group(['middleware' => ['api', 'auth:sanctum'], 'prefix' => 'api/v1'], function() {
    Route::post('/auth/logout', [LoginController::class,'logout'])->name('logout');
    Route::post('/auth/logout-all', [LoginController::class,'logoutAll'])->name('logout-all');
    Route::get('/auth/me', [LoginController::class,'me'])->name('me');
});
