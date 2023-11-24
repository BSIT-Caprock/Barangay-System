<?php

test('has registration page', function () {
    $response = $this->get('/register');

    $response->assertStatus(200);
});
