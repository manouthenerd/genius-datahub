<?php

uses(\Illuminate\Foundation\Testing\RefreshDatabase::class);

// 1. Test si la page s'affiche
test('registration screen can be rendered', function () {
    $response = $this->get('/register');

    $response->assertStatus(200);
});

// Test si un nouveau utilisateur peut s'inscrire
test('new users can register', function () {
    $response = $this->post('/register', [
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
    ]);

    $this->assertAuthenticated();
    $response->assertRedirect(route('dashboard', absolute: false));
});