<?php

use App\Models\Project;
use App\Models\User;

describe('it can performs delete actions on projects', function () {

    beforeEach(function () {
        $this->user = User::factory()->create(['role' => 'moderator']);

        $this->project = Project::factory()->create();
    });

    test('it can delete the created projects', function() {
        $project = $this->project;
        $user = $this->user;

        $this->assertDatabaseHas('projects', ['id' =>$project->id]);

        $response = $this->actingAs($user)->delete(route('projects.destroy', ['project' => $project->id]));

        $response->assertStatus(302);

        $this->assertDatabaseMissing('projects', ['id' => $project->id]);


    });

    
});