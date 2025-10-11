<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Project;
use App\Models\Service;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    protected $model = Project::class;

    public function definition(): array
    {
        $start = $this->faker->dateTimeBetween('-1 month', '+1 month');
        $end = $this->faker->dateTimeBetween($start, '+3 months');

        return [
            'title' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph(),
            'status' => $this->faker->randomElement(['pending', 'in progress', 'completed']),
            'service_id' => Service::factory(),
            'tag' => $this->faker->word(),
            'priority' => $this->faker->randomElement(['low', 'medium', 'high']),
            'from' => $start->format('Y-m-d'),
            'to' => $end->format('Y-m-d'),
        ];
    }
}
