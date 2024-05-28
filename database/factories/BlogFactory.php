<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Blog>
 */
class BlogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(4, true),
            'image' => fake()->sentence(4,true),
            'seo_title' => fake()->sentence(4,true),
            'seo_description' => fake()->sentence(4,true),
            'og_image' => fake()->sentence(4,true),
            'excerpt' => fake()->paragraphs(2, true),
            'markdown_content' => fake()->paragraphs(9, true),
        ];
    }

    public function publishedAt($date): static
    {
        return $this->state([
            'published_at' => $date,
        ]);
    }

    public function active(bool $active): static
    {
        return $this->state([
            'is_active' => $active,
        ]);
    }

}
