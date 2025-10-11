<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Project;
use Inertia\Inertia;
use App\Models\Service;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TaskController extends Controller
{
    public function index()
    {

        $user = auth()->user();

        return Inertia::render('Task', [
            'projects' => Project::all(),
            'tasks' => Task::all(),
            'services' => Service::all(['id', 'name']),
            'service_id' => $user->service_id ?? NULL,
        ]);
    }

    public function create()
    {
        return Inertia::render('CreateTask', [
            'projects' => Project::with('service')->get(),
        ]);
    }

    public function getUsers(Service $service) {
        $users = $service->users()->get(['id', 'name']) ?? [];

        return $users->toJson();
    }

    public function store(CreateTaskRequest $request)
    {

        $validated = $request->validated();
        
        $task = Task::create($validated);

        $task->users()->attach($validated['users'], ['created_at' => now(), 'updated_at' => now()]);

        return redirect()->back();
    }

    public function update(UpdateTaskRequest $request, Task $task)
    {
        $validated = $request->validated();

        $task->update($validated);

        return redirect()->back();
    }

    public function edit(CreateTaskRequest $request, Task $task)
    {   

        $user = $request->user();

        $project = Project::with('service')->find($task->project_id);

        $service = $project->service;

        $service_users = $service->users()->get();

        if (!($user->role === 'admin' || ($user->role === 'moderator' && $service->id === $user->service_id))) {
            return abort(403);
        }

        return Inertia::render('EditTask', [
            'project' => $project,
            'task' => $task,
            'users' => $service_users
        ]);
    }

    public function destroy(Task $task)
    {

        $user = request()->user();

        $project = Project::with('service')->find($task->project_id);

        $service = $project->service;

        if (!($user->role === 'admin' || ($user->role === 'moderator' && $service->id === $user->service_id))) {
            return abort(403);
        }

        $task->delete();

        return redirect('/tasks');
    }
}
