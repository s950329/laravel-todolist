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
        $user_id = User::inRandomOrder()->value('id');

        return [
            'user_id' => $user_id,
            'title' => $this->faker->sentence(),
            'content' => $this->faker->sentence(),
            'attachment' => $this->faker->filePath(),
            'done_at' => $this->faker->dateTime(),
        ];
    }
}
