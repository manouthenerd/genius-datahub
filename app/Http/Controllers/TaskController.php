<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Inertia\Inertia;
use App\Models\Service;
use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{
    public function index() {

        $user = auth()->user();

        return Inertia::render('Task', [
            'projects' => Project::all(),
            'tasks' => Task::all(),
            'services' => Service::all(['id', 'name']), 
            'service_id' => $user->service_id ?? NULL,
        ]);
    }

    public function create() {
        return Inertia::render('CreateTask', [
            'projects' => Project::all(['id', 'name']),
        ]);
    }

    
}
