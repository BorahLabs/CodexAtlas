<?php

it('has actions/codex/generateprojectdocumentation page', function () {
    $response = $this->get('/actions/codex/generateprojectdocumentation');

    $response->assertStatus(200);
});
