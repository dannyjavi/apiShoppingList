<?php

namespace Tests\Feature\Tasks;

use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SortTasksTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_can_sort_tasks_by_name_asc()
    {
        $this->withoutExceptionHandling();

        Task::factory()->create(['title' => 'A name']);
        Task::factory()->create(['title' => 'B name']);
        Task::factory()->create(['title' => 'C name']);

        $url = route('api.v1.tasks.index', ['sort' => 'title']);

        $this->getJson($url)->assertSeeInOrder([
            'A name',
            'B name',
            'C name'
        ]);
    }

    public function test_can_sort_tasks_by_title_desc()
    {
        $this->withoutExceptionHandling();

        Task::factory()->create(['title' => 'C Name']);
        Task::factory()->create(['title' => 'A Name']);
        Task::factory()->create(['title' => 'B Name']);

        $url = route('api.v1.tasks.index', ['sort' => '-title']);

        $this->getJson($url)->assertSeeInOrder([
            'C Name',
            'B Name',
            'A Name'
        ]);
    }

    /* order by status desc */
    public function test_can_sort_tasks_by_status_desc()
    {
        $this->withoutExceptionHandling();

        Task::factory()->create([
            'status' => 'pending',
        ]);
        Task::factory()->create([
            'status' => 'completed',
        ]);
        Task::factory()->create([
            'status' => 'pending',
        ]);

        // Esta es otra alternativa para ordenación
        $url = route('api.v1.tasks.index') . '?sort=-status';
        #$url = route('api.v1.products.index', ['sort' => 'name,price']);

        $this->getJson($url)->assertSeeInOrder([
            'pending',
            'pending',
            'completed'
        ]);
    }

    /* not order products by unknow, fields */
    public function test_cannot_sort_tasks_by_unknown_fields()
    {
        #$this->withoutExceptionHandling();

        Task::factory()->times(3)->create();

        // Esta es otra alternativa para ordenación
        $url = route('api.v1.tasks.index') . '?sort=unknown';
        #$url = route('api.v1.products.index', ['sort' => 'name,price']);

        $this->getJson($url)->assertStatus(400);
    }
}
