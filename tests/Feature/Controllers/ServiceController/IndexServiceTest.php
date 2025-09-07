<?php

use App\Models\Service;
use App\Models\User;

test('Non-admin can not visit services', function() {

    $user = User::factory()->create(['role' => 'member']);

    $this->actingAs($user)->get('/services/1')->assertForbidden();
});

test('Admin or service User\'s only can visit dedicated service', function() {
    
    $service = Service::factory()->create();
    $user = User::factory()->create(['service_id' => $service->id]);

    $this->actingAs($user)->get("/services/{$service->id}")->assertForbidden();
});