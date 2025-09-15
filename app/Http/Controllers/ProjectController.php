<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Project;

class ProjectController extends Controller
{
    public function store(CreateProjectRequest $request)
    {

        $validated = $request->validated();

        // Création du projet
        Project::create($validated);

        return redirect()->back()
            ->with('success', 'Projet créé avec succès !');
    }

    public function update(UpdateProjectRequest $request, Project $project) {

        $project->update($request->validated());

        return redirect()->back();
    }

    public function destroy(Project $project) {
        
        $project->delete();

        return redirect()->back();
    }
}
