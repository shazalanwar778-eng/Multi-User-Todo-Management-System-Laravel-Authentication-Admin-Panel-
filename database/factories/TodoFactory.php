<?php

namespace Database\Factories;

use App\Models\Todo;
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
            'title' => fake()->sentence(rand(3, 8)),
            'description' => fake()->paragraphs(rand(1, 3), true),
            'image' => null,
            'attachment' => null,
            'status' => fake()->randomElement(['pending', 'completed']),
        ];
    }

    /**
     * Indicate that the todo should be pending.
     */
    public function pending(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'pending',
        ]);
    }

    /**
     * Indicate that the todo should be completed.
     */
    public function completed(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'completed',
        ]);
    }

    /**
     * Indicate that the todo should have an image.
     */
    public function withImage(): static
    {
        return $this->state(fn (array $attributes) => [
            'image' => 'todo_images/sample_' . rand(1, 5) . '.jpg',
        ]);
    }

    /**
     * Indicate that the todo should have an attachment.
     */
    public function withAttachment(): static
    {
        return $this->state(fn (array $attributes) => [
            'attachment' => 'todo_attachments/sample_' . rand(1, 3) . '.pdf',
        ]);
    }
}


