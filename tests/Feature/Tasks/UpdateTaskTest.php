<?php

namespace Tests\Feature\Tasks;

use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UpdateTaskTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_can_a_user_update_a_task()
    {

        $this->withoutExceptionHandling();

        $task = Task::factory()->create();

        $payload = [
            'description' => 'He cambiado este atributo',
            'slug' => 'algo-pasa-por-aqui-con-esto'
        ];

        $url = route('api.v1.tasks.update', $task->id);

        $response = $this->patchJson($url, $payload);

        $response->assertStatus(200);

        $task->refresh();

        $response->assertExactJson([
            'data' => [
                'type' => 'tasks',
                'id' => (string) $task->getRouteKey(),
                'attributes' => [
                    'uuid_task' => $task->uuid_task,
                    'title' => $task->title,
                    'slug' => $task->slug,
                    'description' => $task->description,
                    'status' => $task->status,
                    'created_by' => $task->created_by,
                    'user_id' => $task->user_id,
                ],
                'links' => [
                    'self' => route('api.v1.tasks.show', $task)
                ]
            ]
        ]);
    }
}
