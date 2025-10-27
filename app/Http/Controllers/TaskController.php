<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Notification;
use App\Models\Project;
use Inertia\Inertia;
use App\Models\Service;
use App\Models\Task;
use App\Models\User;
use App\Services\NotificationService;
use Illuminate\Http\Request;

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

    public function getUsers(Service $service)
    {
        $users = $service->users()->get(['id', 'name']) ?? [];

        return $users->toJson();
    }

    public function store(CreateTaskRequest $request)
    {

        $user = $request->user();

        $validated = $request->validated();

        $current_date = now()->format('Y-m-d');

        $task = Task::create($validated);

        if ($task->from > $current_date) {
            $task->status = 'pending';

            $task->save();
        }

        if ($current_date == $task->from) {
            $task->status = 'in_progress';

            $task->save();
        }

        // Associer la tâche aux différents users sélectionnés
        $task->users()->attach($validated['users'], ['created_at' => now(), 'updated_at' => now()]);

        extract(NotificationService::fetchUsersToNotify($task->service_id, $user));

        $message = NotificationService::setNotificationMessage(
            $user, 
            $service_name,
            "Une nouvelle tâche a été créée par l'admin pour l'équipe du service",
            "vient d'ajouter une nouvelle tâche pour son équipe."

        );
        
        // Création de la notification
        $notification = Notification::create([
            'title' => 'Nouvelle tâche',
            'content' => $message,
            'service_id' => $task->service_id
        ]);

        $notification->users()->attach($service_users);

        return redirect()->back();
    }

    public function update(UpdateTaskRequest $request, Task $task)
    {

        $validated = $request->validated();

        $task->update($validated);

        $current_date = now()->format('Y-m-d');

        if ($task->from > $current_date) {
            $task->status = 'pending';

            $task->save();
        }

        if ($current_date == $task->from) {
            $task->status = 'in_progress';

            $task->save();
        }

        $task->users()->detach();
        $task->users()->attach($validated['users'], ['created_at' => now(), 'updated_at' => now()]);

        return redirect()->back();
    }

    public function edit(Request $request, Task $task)
    {

        $user = $request->user();

        $project = Project::with('service')->find($task->project_id);

        $service = $project->service;

        $service_users = $service->users()->get();

        $task_users = $task->users()->get(['users.id', 'users.name']);

        if (!($user->role === 'admin' || ($user->role === 'moderator' && $service->id === $user->service_id))) {
            return abort(403);
        }

        return Inertia::render('EditTask', [
            'project'       => $project,
            'task'          => $task,
            'users'         => $service_users,
            'selectedUsers' => $task_users
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
