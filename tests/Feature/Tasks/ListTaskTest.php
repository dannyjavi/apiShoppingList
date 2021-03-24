<?php

namespace Tests\Feature\Tasks;

use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ListTaskTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_can_fetch_all_tasks()
    {
        $this->withoutExceptionHandling();

        $task = Task::factory()->times(3)->create();

        $response = $this->getJson(route('api.v1.tasks.index'));
        $response->assertExactJson([
            'data' => [
                [
                    'type' => 'tasks',
                    'id' => (string) $task[0]->getRouteKey(),
                    'attributes' => [
                        'uuid_task' => $task[0]->uuid_task,
                        'title' => $task[0]->title,
                        'slug' => $task[0]->slug,
                        'description' => $task[0]->description,
                        'status' => $task[0]->status,
                        'created_by' => $task[0]->created_by,
                        'user_id' => $task[0]->user_id,
                    ],
                    'links' => [
                        'self' => route('api.v1.tasks.show', $task[0])
                    ]
                ],
                [
                    'type' => 'tasks',
                    'id' => (string) $task[1]->getRouteKey(),
                    'attributes' => [
                        'uuid_task' => $task[1]->uuid_task,
                        'title' => $task[1]->title,
                        'slug' => $task[1]->slug,
                        'description' => $task[1]->description,
                        'status' => $task[1]->status,
                        'created_by' => $task[1]->created_by,
                        'user_id' => $task[1]->user_id,
                    ],
                    'links' => [
                        'self' => route('api.v1.tasks.show', $task[1])
                    ]
                ],
                [
                    'type' => 'tasks',
                    'id' => (string) $task[2]->getRouteKey(),
                    'attributes' => [
                        'uuid_task' => $task[2]->uuid_task,
                        'title' => $task[2]->title,
                        'slug' => $task[2]->slug,
                        'description' => $task[2]->description,
                        'status' => $task[2]->status,
                        'created_by' => $task[2]->created_by,
                        'user_id' => $task[2]->user_id,
                    ],
                    'links' => [
                        'self' => route('api.v1.tasks.show', $task[2])
                    ]
                ],
            ],
            'links' => [
                'self' => route('api.v1.tasks.index')
            ],
            'meta' => [
                'tasks_count' => 3
            ]
        ]);
    }

    public function test_can_fetch_single_task()
    {
        $task = Task::factory()->create();

        $response = $this->getJson(route('api.v1.tasks.show', $task));

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
