<?php

it('has llm/openai page', function () {
    $response = $this->get('/llm/openai');

    $response->assertStatus(200);
});
