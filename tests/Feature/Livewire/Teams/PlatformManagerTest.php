<?php

use App\Livewire\Teams\PlatformManager;
use App\Models\User;
use Livewire\Livewire;

it('sets the right subdomain on mount', function () {
    $user = User::factory()->inFreeTrialMode()->create();
    $user->currentTeam->currentPlatform()->update(['domain' => 'test.'.config('app.main_domain')]);
    Livewire::actingAs($user)
        ->test(PlatformManager::class, [
            'team' => $user->currentTeam,
        ])
        ->assertSet('subdomain', str($user->currentTeam->currentPlatform()->domain ?? '')->before('.'.config('app.main_domain')));
});

it('validates the subdomain', function () {
    $user1 = User::factory()->inFreeTrialMode()->create();
    $user1->currentTeam->currentPlatform()->update(['domain' => 'test.'.config('app.main_domain')]);
    $user2 = User::factory()->inFreeTrialMode()->create();
    $user2->currentTeam->currentPlatform()->update(['domain' => 'test2.'.config('app.main_domain')]);

    Livewire::actingAs($user1)
        ->test(PlatformManager::class, [
            'team' => $user1->currentTeam,
        ])
        ->set('subdomain', '')
        ->call('savePlatform')
        ->assertHasErrors('subdomain')
        ->set('subdomain', 1)
        ->call('savePlatform')
        ->assertHasErrors('subdomain')
        ->set('subdomain', str('a')->repeat(76))
        ->call('savePlatform')
        ->assertHasErrors('subdomain')
        ->set('subdomain', 'test2')
        ->call('savePlatform')
        ->assertHasErrors('subdomain')
        ->set('subdomain', 'a wrong subdomain!')
        ->call('savePlatform')
        ->assertHasErrors('subdomain')
        ->set('subdomain', 'a-valid-subdomain')
        ->call('savePlatform')
        ->assertHasNoErrors('subdomain')
        ->assertDispatched('saved');

    expect($user1->currentTeam->currentPlatform()->fresh()->domain)->toBe('a-valid-subdomain.'.config('app.main_domain'));
    expect($user1->currentTeam->platforms()->count())->toBe(1);
});
