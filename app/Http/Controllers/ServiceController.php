<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateServiceRequest;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;
use Inertia\Response;

class ServiceController extends Controller
{
    public function index(): Response
    {

        return Inertia::render('Service', [
            'users' => User::withBasicInfo()->withServiceName()->get(),
            'services' => Service::withModerator(),
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

    public function update(Request $request, Service $service): RedirectResponse
    {
        Gate::authorize('update', Service::class);

       $request->validate([
            'name' => 'required|string|max:50'
        ]);

        $service->name = $request->input('name');

        $service->save();

        return redirect()->back();

       
    }

    public function destroy(Service $service): RedirectResponse
    {

        $service->delete();

        return redirect()->back();
    }
}
