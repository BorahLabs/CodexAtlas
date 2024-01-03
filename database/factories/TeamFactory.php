<?php

namespace Database\Factories;

use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Team>
 */
class TeamFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->company(),
            'user_id' => User::factory(),
            'personal_team' => true,
        ];
    }

    public function inPayAsYouGoMode(): static
    {
        return $this->state([
            'openai_key' => config('services.openai.key'),
        ]);
    }

    public function inFreeTrialMode(): static
    {
        return $this->state([
            'openai_key' => null,
        ]);
    }

    public function inLimitedCompanyPlanMode(): static
    {
        return $this->withSubscription(config('spark.billables.user.plans.0.monthly_id'));
    }

    public function inUnlimitedCompanyPlanMode(): static
    {
        return $this
            ->withSubscription(config('spark.billables.user.plans.0.monthly_id'))
            ->state([
                'openai_key' => config('services.openai.key'),
            ]);
    }

    /**
     * Indicate that the user should have a subscription plan.
     *
     * @return $this
     */
    public function withSubscription(string|int|null $planId = null): static
    {
        return $this->afterCreating(function (Team $team) use ($planId) {
            $subscription = $team->subscriptions()->create([
                'type' => 'default',
                'stripe_id' => Str::random(10),
                'stripe_status' => 'active',
                'stripe_price' => $planId,
                'quantity' => 1,
                'trial_ends_at' => null,
                'ends_at' => null,
            ]);

            $subscription->items()->create([
                'stripe_id' => Str::random(10),
                'stripe_product' => Str::random(10),
                'stripe_price' => $planId,
                'quantity' => 1,
            ]);
        });
    }
}
