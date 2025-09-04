<?php

// use Illuminate\Foundation\Testing\RefreshDatabase;

test('login screen can be rendered', function () {
    $response = $this->get('/login');

    $response->assertStatus(200);
});

test('Login page dispays "Connectez-vous"', function () {
    $page = visit('/login');

    $page->assertSee("Connectez-vous à votre espace");
});
