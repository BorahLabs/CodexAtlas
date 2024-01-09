<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SourceCodeAccount>
 */
class SourceCodeAccountFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [

        ];
    }

    public function github(): static
    {
        return $this->state([
            'provider' => \App\Enums\SourceCodeProvider::GitHub,
            'name' => 'codexatlastest',
            'external_id' => '155184101',
            'installation_id' => '45584067',
        ]);
    }

    public function gitlab(): static
    {
        return $this->state([
            'provider' => \App\Enums\SourceCodeProvider::GitLab,
            'name' => 'codexatlastest',
            'external_id' => '19516758',
            'access_token' => 'glpat-6KGSMRg9j-QRe9q34L9d',
        ]);
    }
}
