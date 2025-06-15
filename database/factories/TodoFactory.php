<?php

namespace Database\Factories;

use App\Enums\TodoStatus;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Todo>
 */
class TodoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'content' => $this->faker->text(64),
            'status' => $this->faker->randomElement([TodoStatus::TODO, TodoStatus::IN_PROGRESS, TodoStatus::DONE])
        ];
    }
}
