<?php

use App\Models\User;

test('guest can not see services page', function () {

    $response = $this->get('/services');

    $response->assertRedirect('/login');
});

describe('Making action on services page when authenticated', function () {

    test('can see services pages after authentication', function () {

        $user = User::factory()->create();

        $response = $this->actingAs($user);

        $response->get('/services')->assertOk();
    });

    test('admin only admins can create', function () {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->post('/services', ['service_name' => 'Testing Service']);

        $response->assertRedirectBack();
    });

   
});