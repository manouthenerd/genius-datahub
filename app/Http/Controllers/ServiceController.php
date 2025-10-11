<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\CreateServiceRequest;

class ServiceController extends Controller
{
    public function index(): Response
    {

        $services = Service::withModerator()->map(function ($service) {

            $service['members'] = $service->users()->get(['id', 'name', 'email']);

            return  $service;
        });

        return Inertia::render('Service', [
            'users' => User::withBasicInfo()->withServiceName()->get(),
            'services' => $services,
        ]);
    }

    public function edit(Service $service): Response
    {
        return Inertia::render('EditServiceForm', []);
    }


    public function store(CreateServiceRequest $request): RedirectResponse
    {
        Gate::authorize('create', Service::class);

        Service::create([
            'name' => $request->validated('service_name'),
            'user_id' => $request->user()->id
        ]);

        return redirect()->back();
    }


    public function update(Request $request, Service $service)
    {
        Gate::authorize('action', Service::class);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'moderator' => ['required', 'integer', Rule::exists('users', 'id')],
            'members' => ['required', 'array', 'min:1'],
            'members.*' => ['integer', Rule::exists('users', 'id')],
        ]);


        // Update du service
        $service->update([
            'name' => $validated['name'],
        ]);

        // Supprimer les utilisateurs retirés coté Front
        User::whereNotIn('id', $validated['members'])
            ->where('users.service_id', $service->id)
            ->delete();

        // Définir le nouveau modérateur du service
        User::where('id', (int) $validated['moderator'])
            ->update(['role' => 'moderator']);

        // Définir le role des autres User sur "membre"
        User::where('id', '!=', (int) $validated['moderator'])
            ->where('service_id', $service->id)
            ->update(['role' => 'member']);

        // Associer chaque membre au service
        User::whereIn('id', $validated['members'])
            ->update(['service_id' => $service->id]);


        return redirect()->back()->with('success', 'Service mis à jour avec succès.');
    }

    public function destroy(Service $service): RedirectResponse
    {
        Gate::authorize('action', Service::class);

        $service->delete();

        return redirect()->back();
    }
}
