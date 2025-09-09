<?php

use App\Models\Service;
use App\Models\User;


beforeEach(function () {

    $this->user = User::factory()->create(['role' => 'admin']);

    $this->service = Service::factory()->create();
});

test('Non-admin can not visit services', function () {
    $user = $this->user;
    $service = $this->service;

    $this->actingAs($user)->get("/services/{$service->id}")->assertStatus(200);
});

test("Admin or service User's only can visit dedicated service", function () {

    $this->user->role = 'member';
    $this->user->service_id = $this->service->id;

    $this->actingAs($this->user)->get("/services/{$this->service->id}")->assertOk();
});

it('has emails', function (string $email) {
    
    expect($email)->not->toBeEmpty();
})->with(['enunomaduro@gmail.com', 'other@example.com']);
