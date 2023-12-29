<?php

it('has actions/codex/architecture/systemcomponents page', function () {
    $response = $this->get('/actions/codex/architecture/systemcomponents');

    $response->assertStatus(200);
});
