<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CustomGuide>
 */
class CustomGuideFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence,
            'content' => $this->faker->text(250),
        ];
    }

    public function withQuestion(): static
    {
        return $this->state(fn () => [
            'question' => $this->faker->sentence,
        ]);
    }
}
