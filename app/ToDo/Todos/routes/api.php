<?php

use App\ToDo\Todos\Http\Controllers\TodoController;
use Illuminate\Support\Facades\Route;


Route::group(['middleware' => ['api', 'auth:sanctum'], 'prefix' => 'api/v1'], function() {
    Route::delete('todos/allTodos', [TodoController::class, 'destroyAll']);
    Route::resource('todos', TodoController::class);
});
