<?php

use App\Models\User;

uses(\Illuminate\Foundation\Testing\RefreshDatabase::class);

describe('delete some folders', function() {

    test('login and redirect to dashboard', function () {
        
        $user = User::factory()->create();
    
        $response = $this->actingAs($user)->get('/dashboard');

        $response->assertStatus(200);
    });

    // test('Navigate inside first service', function() {
    //     $response = $this->get('/services/{service}', ['service' => 1]);

    //     $response->dump();
    // });
});
