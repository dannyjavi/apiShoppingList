<?php

namespace Database\Factories;

use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TaskFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Task::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'uuid_task' => $this->faker->uuid,
            'title' => $this->faker->catchPhrase(),
            'slug' => 'probando-los-tests',
            'description' => $this->faker->text(100),
            'status' => $this->faker->randomElement(['completed','pending']),
            'created_by' => $this->faker->randomNumber(2),
            'user_id' => User::factory()
        ];
    }
}
