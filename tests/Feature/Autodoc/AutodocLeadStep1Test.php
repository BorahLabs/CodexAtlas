<?php

use App\Livewire\Autodoc\GetStartedForm;
use App\Models\AutodocLead;
use Livewire\Livewire;

test('user can introduce their email', function () {
    expect(AutodocLead::count())->toBe(0);
    Livewire::test(GetStartedForm::class)
        ->set('data.email', 'hi@raullg.com')
        ->call('submitEmail')
        ->assertDispatched('autodoc:lead-registered');

    expect(AutodocLead::count())->toBe(1);
    $lead = AutodocLead::first();
    expect($lead->email)->toBe('hi@raullg.com');
});

test('data is validated', function () {
    expect(AutodocLead::count())->toBe(0);
    Livewire::test(GetStartedForm::class)
        ->set('data.email', null)
        ->call('submitEmail')
        ->assertNotDispatched('autodoc:lead-registered');

    Livewire::test(GetStartedForm::class)
        ->set('data.email', 'not an email')
        ->call('submitEmail')
        ->assertNotDispatched('autodoc:lead-registered');
    expect(AutodocLead::count())->toBe(0);
});
