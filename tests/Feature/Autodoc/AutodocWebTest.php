<?php

use App\Livewire\Autodoc\GetStartedForm;

test('autodoc homepage is visible', function () {
    $this->get('https://'.config('app.autodoc_domain'))
        ->assertStatus(200)
        ->assertSee('AutomaticDocs')
        ->assertSeeLivewire(GetStartedForm::class);
});
