<?php

use App\Models\User;
use App\ToDo\Todos\Models\Todo;
use App\ToDo\Todos\Repositories\TodoRepository;
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

test('must not create a todo', function () {
    Sanctum::actingAs(
        User::factory()->create()
    );

    $data = Todo::factory()->make()->toArray();

   unset($data['content']);

    $response = $this->postJson('/api/v1/todos', $data);

    $response->assertNotFound();
});

test('must update a todo', function () {
    Sanctum::actingAs(
        User::factory()->create()
    );

    $todo = Todo::factory()->create(['user_id' => Auth::user()->id]);

    $data = ['content', fake()->text()];

    $response = $this->patchJson('/api/v1/todos/'. $todo->id, $data);

    $response->assertStatus(200);
});

test('must not update a todo', function () {
    Sanctum::actingAs(
        User::factory()->create()
    );

    $data = ['content', fake()->text()];

    $response = $this->patchJson('/api/v1/todos/10', $data);

    $response->assertNotFound();
});

test('must delete a todo', function () {
    Sanctum::actingAs(
        User::factory()->create()
    );

    $todo = Todo::factory()->create(['user_id' => Auth::user()->id]);

    $response = $this->deleteJson('/api/v1/todos/'. $todo->id);

    $response->assertStatus(200);
});

test('must not delete a todo', function () {
    Sanctum::actingAs(
        User::factory()->create()
    );

    $response = $this->deleteJson('/api/v1/todos/'. 12);

    $response->assertNotFound();
});

test('must delete all todos', function () {
    Sanctum::actingAs(
        User::factory()->create()
    );

    Todo::factory()->count(10)->create(['user_id' => Auth::user()->id]);

    $response = $this->delete('/api/v1/todos/allTodos');

    $todoRepository = resolve(TodoRepository::class);
    $todosCount = $todoRepository->all(Auth::user()->id)->count();

    expect($todosCount)->toBe(0);
});

test('must change a todo to done', function () {
    Sanctum::actingAs(
        User::factory()->create()
    );

    $todo = Todo::factory()->create(['user_id' => Auth::user()->id]);

    $response = $this->post('/api/v1/todos/'. $todo->id .'/done');

    $response->assertStatus(200);
});
