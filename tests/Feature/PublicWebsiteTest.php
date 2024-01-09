<?php

it('has a homepage', function () {
    $this->get('/')->assertStatus(200);
});

it('has a terms and conditions page', function () {
    $this->get(route('terms.show'))->assertStatus(200);
});

it('has a privacy policy page', function () {
    $this->get(route('policy.show'))->assertStatus(200);
});

it('can be indexed', function () {
    config(['app.indexable' => true]);
    $this->get('/')->assertHeaderMissing('X-Robots-Tag');
});

it('can\'t be indexed if env variable', function () {
    config(['app.indexable' => false]);
    $this->get('/')->assertHeader('X-Robots-Tag', 'noindex, nofollow, noarchive, nosnippet, noodp, notranslate, noimageindex');
});

it('redirects to secret page if password protected', function () {
    config(['app.password_protected.enabled' => true]);
    $this->get('/')->assertRedirect(route('password-protected'));
});
