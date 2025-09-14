<?php

use App\Models\User;



describe('can performs some actions on projects and tasks page', function () {

    beforeEach(function () {
        $this->user = User::factory()->create(['role' => 'moderator']);
    });

    it('can visit projects', function () {

        $response = $this->actingAs($this->user)->get('/tasks');

        $response->assertStatus(200);
    });

    it('session has no errors', function() {
        $response = $this->actingAs($this->user)->post('/projects', [
            'title' => 'Titre du projet',
            'tag' => 'vidéosurveillance',
            'priority' => 'high',
            'service_id' => $this->user->service_id,
            'from' => now(),
            'to' => now()->addHour(),
            'description' => 'Description du projet'
        ]);

        $response->assertValid();;
    });
});
