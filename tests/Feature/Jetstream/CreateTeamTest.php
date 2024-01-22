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

test('user can own maximum 1 team in free mode', function (User $user) {
    $this->actingAs($user);
    $this->get(route('teams.create'))->assertStatus(200);

    Livewire::test(CreateTeamForm::class)
        ->set(['state' => ['name' => 'Test Team']])
        ->call('createTeam');

    expect($user->fresh()->ownedTeams)->toHaveCount(2);
    $this->actingAs($user->fresh())->get(route('teams.create'))->assertStatus(403);
})->with([
    fn () => User::factory()->inPayAsYouGoMode()->create(),
    fn () => User::factory()->inLimitedCompanyPlanMode()->create(),
    fn () => User::factory()->inUnlimitedCompanyPlanMode()->create(),
]);
