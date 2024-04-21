<?php

use App\Models\User;
use Laravel\Jetstream\Http\Livewire\CreateTeamForm;
use Livewire\Livewire;

test('teams cannot be created in free mode', function () {
    $this->actingAs($user = User::factory()->inFreeTrialMode()->create());

    Livewire::test(CreateTeamForm::class)
        ->set(['state' => ['name' => 'Test Team']])
        ->call('createTeam');

    expect($user->fresh()->ownedTeams)->toHaveCount(1);
    $this->get(route('teams.create'))->assertStatus(403);
});

test('user can own maximum 1 team in free mode', function (string $paymentMode, string $planMode) {
    config(['codex.payment_mode' => $paymentMode]);
    $user = User::factory()->{$planMode}()->create();

    $this->actingAs($user);
    $this->get(route('teams.create'))->assertStatus(200);

    Livewire::test(CreateTeamForm::class)
        ->set(['state' => ['name' => 'Test Team']])
        ->call('createTeam');

    expect($user->fresh()->ownedTeams)->toHaveCount(2);
    if (config('codex.payment_mode') === 'spark') {
        $this->actingAs($user->fresh())->get(route('teams.create'))->assertStatus(403);
    } else {
        $this->actingAs($user->fresh())->get(route('teams.create'))->assertStatus(200);
    }
})->with([
    fn () => ['spark', 'inPayAsYouGoMode'],
    fn () => ['spark', 'inLimitedCompanyPlanMode'],
    fn () => ['spark', 'inUnlimitedCompanyPlanMode'],
    fn () => ['aws', 'inPayAsYouGoMode'],
]);
