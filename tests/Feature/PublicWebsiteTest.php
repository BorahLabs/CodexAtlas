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
