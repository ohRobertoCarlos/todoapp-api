<?php
namespace App\ToDo\Todos\Contracts;

use Illuminate\Http\Request;

interface TodoServiceInterface
{
    public function index(Request $request) : string;
}
