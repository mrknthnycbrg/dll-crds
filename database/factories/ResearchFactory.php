<?php

namespace Database\Factories;

use App\Models\Research;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Research>
 */
class ResearchFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Research::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $title = $this->faker->unique()->sentence(),
            'slug' => Str::slug($title),
            'author' => $this->faker->unique()->name(),
            'adviser' => $this->faker->name(),
            'keyword' => $this->faker->word(),
            'pdf_path' => null,
            'abstract' => $this->faker->unique()->realText(3000),
            'department_id' => $this->faker->numberBetween(1, 8),
            'published' => true,
            'date_submitted' => $this->faker->dateTimeBetween('-3 years'),
        ];
    }
}
