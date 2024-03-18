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
            'access_token' => 'glpat-115te_tfs58BBftkD_99',
        ]);
    }

    public function bitbucket(): static
    {
        return $this->state([
            'provider' => \App\Enums\SourceCodeProvider::Bitbucket,
            'name' => 'codexatlastest',
            'external_id' => '712020:66b6b9e3-6d1d-48dd-ba48-ce260bee0e01',
            'access_token' => 'ATBBLMUSzuV8mmRCcyMdBrsVrjAND1DF6F7C',
        ]);
    }

    public function prAssistantGithub(): static
    {
        return $this->state([
            'provider' => \App\Enums\SourceCodeProvider::GitHub,
            'name' => 'ismaelilloDev',
            'external_id' => '127984176',
            'installation_id' => '48486190',
            'impersonate_token' => config('services.github.factory_impersonate_token')
        ]);
    }
}
