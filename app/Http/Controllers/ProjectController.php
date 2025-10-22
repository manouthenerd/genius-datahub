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
        $project = Project::create($validated);

        $current_date = now()->format('Y-m-d');
        
        if($project->from > $current_date) {
            $project->status = 'pending';

            $project->save();
        }

        if($current_date == $project->from) {
            $project->status = 'in_progress';

            $project->save();
        }

        return redirect()->back()
            ->with('success', 'Projet créé avec succès !');
    }

    public function update(UpdateProjectRequest $request, Project $project) {

        $project->update($request->validated());

        $current_date = now()->format('Y-m-d');
        
        if($project->from > $current_date) {
            $project->status = 'pending';

            $project->save();
        }

        if($current_date == $project->from) {
            $project->status = 'in_progress';

            $project->save();
        }

        return redirect()->back();
    }

    public function destroy(Project $project) {
        
        $project->delete();

        return redirect()->back();
    }
}
