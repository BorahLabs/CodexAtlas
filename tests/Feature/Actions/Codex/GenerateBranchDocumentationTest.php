<?php

it('has actions/codex/generatebranchdocumentation page', function () {
    $response = $this->get('/actions/codex/generatebranchdocumentation');

    $response->assertStatus(200);
});
