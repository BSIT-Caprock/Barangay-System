<?php

test('has password reset page', function () {
    $response = $this->get('/password-reset/request');

    $response->assertStatus(200);
});
