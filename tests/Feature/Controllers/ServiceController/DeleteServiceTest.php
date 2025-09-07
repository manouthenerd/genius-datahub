<?php

use App\Models\Service;
use App\Models\User;


it("is authenticated and as admin role", function () { {
        $user = User::factory()->create();

        $user->role = 'moderator';

        $service = Service::factory()->create();

        $this->actingAs($user)
            ->delete("/services/{$service->id}")
            ->assertForbidden();
    }
});

it('is an admin and can delete any service', function () {
    $user = User::factory()->create();

    $service = Service::factory()->create();

    $this->actingAs($user)->delete("/services/{$service->id}")->assertredirectBack();
});
