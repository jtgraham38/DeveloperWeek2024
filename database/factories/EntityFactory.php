<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Entity>
 */
class EntityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'display_name' => fake()->sentence(2),
            'singular_name' => fake()->sentence(2),
            'multiple_name' => fake()->sentence(2),
            'description' => "",
            'table_name' => fake()->sentence(3),
            'is_private' => false,
            'project_id' => 1
        ];
    }
}
