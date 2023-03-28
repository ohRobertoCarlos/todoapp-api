<?php

use App\Models\User;
use App\ToDo\Todos\Models\Todo;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\Sanctum;

test('must show a todo', function() {
    Sanctum::actingAs(
        User::factory()->create()
    );

    $todo = Todo::factory()->create(['user_id' => Auth::user()->id]);

    $response = $this->getJson('/api/v1/todos/'. $todo->id);

    $response->assertJsonPath('content', $todo->content);
});

test('must not show a todo', function() {
    Sanctum::actingAs(
        User::factory()->create()
    );

    $todo = Todo::factory()->create(['user_id' => Auth::user()->id]);

    $response = $this->get('/api/v1/todos/'. 10);

    $response->assertNotFound();
});

test('must create a todo', function () {
    Sanctum::actingAs(
        User::factory()->create()
    );

    $data = Todo::factory()->make()->toArray();

    $response = $this->postJson('/api/v1/todos', $data);

    $response->assertCreated();
});

test('must change a todo to done', function () {
    Sanctum::actingAs(
        User::factory()->create()
    );

    $todo = Todo::factory()->create(['user_id' => Auth::user()->id]);

    $response = $this->post('/api/v1/todos/'. $todo->id .'/done');

    $response->assertStatus(200);
});
