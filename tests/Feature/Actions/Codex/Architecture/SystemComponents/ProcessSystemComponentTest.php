<?php

it('has actions/codex/architecture/systemcomponents/processsystemcomponent page', function () {
    $response = $this->get('/actions/codex/architecture/systemcomponents/processsystemcomponent');

    $response->assertStatus(200);
});
