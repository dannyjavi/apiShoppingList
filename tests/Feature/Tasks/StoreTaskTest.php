<?php

namespace Tests\Feature\Tasks;

use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StoreTaskTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_can_a_user_create_a_task()
    {
        $this->withoutExceptionHandling();

        $url = route('api.v1.tasks.store');

        $tasks = Task::factory()->create()->toArray();

        $response = $this->postJson($url,$tasks);

        $response->assertCreated();

        $this->assertDatabaseHas('tasks', $tasks);
    }
}
