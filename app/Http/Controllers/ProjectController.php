<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProjectRequest;
use App\Models\Project;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProjectController extends Controller
{
    public function store(CreateProjectRequest $request)
    {

        $validated = $request->validated();

        // Création du projet
        $project = Project::create($validated);

        return redirect()->back()
            ->with('success', 'Projet créé avec succès !');
    }
}
