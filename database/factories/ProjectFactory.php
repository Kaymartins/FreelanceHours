<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
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
            'ends_at' => $this->faker->dateTimeBetween('now', '+3 days'),
            'status' => $this->faker->randomElement(['open', 'closed']),
            'tech_stack' => $this->faker->randomElements(['react', 'nodejs', 'javascript', 'vite', 'nextjs'], random_int(1,5)),
        ];
    }
}
