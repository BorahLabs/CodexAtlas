<?php

use App\Models\Team;
use App\Models\User;
use Laravel\Jetstream\Http\Livewire\DeleteUserForm;
use Livewire\Livewire;

test('user accounts can be deleted', function () {
    $this->actingAs($user = User::factory()->create());

    $component = Livewire::test(DeleteUserForm::class)
        ->set('password', 'password')
        ->call('deleteUser');

    expect($user->fresh())->toBeNull();
});

test('user accounts with a subscribed team can be deleted', function () {
    $this->actingAs($user = User::factory()->create());
    $team = Team::factory()->inLimitedCompanyPlanMode()->create([
        'personal_team' => false,
    ]);
    $user->ownedTeams()->save($team);
    $component = Livewire::test(DeleteUserForm::class)
        ->set('password', 'password')
        ->call('deleteUser');
})->expectException(\Stripe\Exception\ApiErrorException::class); // expects exception on Stripe because sub does not exist

test('correct password must be provided before account can be deleted', function () {
    $this->actingAs($user = User::factory()->create());

    Livewire::test(DeleteUserForm::class)
        ->set('password', 'wrong-password')
        ->call('deleteUser')
        ->assertHasErrors(['password']);

    expect($user->fresh())->not->toBeNull();
});
