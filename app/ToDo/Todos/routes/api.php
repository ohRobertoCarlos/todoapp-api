<?php

use App\ToDo\Todos\Http\Controllers\TodoController;
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'api/v1'], function() {
    Route::resource('todos', TodoController::class);
});
