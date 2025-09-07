<?php

use App\Models\Service;
use App\Models\User;

test('Non-admin can not visit services', function() {

    $user = User::factory()->create();

    $service = Service::factory()->create();

    $this->actingAs($user)->get("/services/{$service->id}")->assertStatus(200);
});

test('Admin or service User\'s only can visit dedicated service', function() {
    
    $service = Service::factory()->create();
    $user = User::factory()->create(['role' => 'member', 'service_id' => $service->id]);

    $this->actingAs($user)->get("/services/{$service->id}")->assertOk();
});