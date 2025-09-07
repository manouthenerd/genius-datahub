<?php

use App\Models\Service;
use App\Models\User;


test('that user role is admin', function() {
    $user = User::factory()->create();

    $this->actingAs($user)->assertEquals('admin', $user->role);
});

test('Another user role can not update service', function() {

    // Arrange
    $user = User::factory()->create();
    $service = Service::factory()->create();

    // Act
    $user->role = 'member';
    $user->save();

    // Assert

    $this->actingAs($user)->put("/services/{$service->id}", ['name' => 'nouveau nom'])->assertStatus(403);
});

test('Only user with admin role can update Services', function() {

    $service = Service::factory()->create();

    $user = User::factory()->create();

    $this->actingAs($user)->put("/services/{$service->id}", ['name' => 'nouveau nom'])->assertRedirectBack();

});