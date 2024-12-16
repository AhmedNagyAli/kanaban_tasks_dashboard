<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->sentence(),
            'description' => $this->faker->paragraph(),
            'user_id' => User::factory(),
            'task_user' => User::factory(),
            'started_at' => $this->faker->optional()->dateTimeBetween('-1 week', 'now'),
            'end_date' => $this->faker->optional()->dateTimeBetween('now', '+1 week'), 
            'status' => $this->faker->randomElement(['complete', 'waiting', 'problem', 'ideas', 'under_execution']),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
