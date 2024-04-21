<?php

use App\Livewire\Teams\OpenaiManager;
use App\Models\User;
use Livewire\Livewire;

it('can see the OpenAI settings in the team page if payment mode is Spark', function () {
    config(['codex.payment_mode' => 'spark']);
    $user = User::factory()->inFreeTrialMode()->create();
    $platform = $user->currentTeam->currentPlatform();
    $this->actingAs($user)
        ->get($platform->route('teams.show', ['team' => $user->currentTeam]))
        ->assertSeeLivewire(OpenaiManager::class);
});

it('cannot see the OpenAI settings in the team page if payment mode is AWS', function () {
    config(['codex.payment_mode' => 'aws']);
    $user = User::factory()->inFreeTrialMode()->create();
    $platform = $user->currentTeam->currentPlatform();
    $this->actingAs($user)
        ->get($platform->route('teams.show', ['team' => $user->currentTeam]))
        ->assertDontSeeLivewire(OpenaiManager::class);
});

it('cannot save an invalid or empty key', function () {
    config(['codex.payment_mode' => 'spark']);
    $user = User::factory()->inFreeTrialMode()->create();
    Livewire::actingAs($user)
        ->test(OpenaiManager::class)
        ->call('saveKey')
        ->assertHasErrors('key')
        ->set('key', 'invalid-key')
        ->assertHasErrors('key');
    expect($user->currentTeam->fresh()->openai_key)->toBeNull();
});

it('can save a valid key', function () {
    config(['codex.payment_mode' => 'spark']);
    $user = User::factory()->inFreeTrialMode()->create();
    Livewire::actingAs($user)
        ->test(OpenaiManager::class)
        ->assertSet('isEditing', true)
        ->set('key', config('services.openai.key'))
        ->call('saveKey')
        ->assertHasNoErrors('key')
        ->assertSet('isEditing', false)
        ->assertDispatched('saved');
    expect($user->currentTeam->fresh()->openai_key)->toBe(config('services.openai.key'));
});

it('cannot save if not editing', function () {
    config(['codex.payment_mode' => 'spark']);
    $user = User::factory()->inFreeTrialMode()->create();
    $user->currentTeam->update(['openai_key' => 'test']);
    Livewire::actingAs($user)
        ->test(OpenaiManager::class)
        ->assertSet('isEditing', false)
        ->call('saveKey')
        ->assertHasNoErrors('key')
        ->assertSet('isEditing', false);
});
